<?php

namespace App\Http\Controllers\Admin;

use App\ContentTypes\Checkbox;
use App\ContentTypes\Coordinates;
use App\ContentTypes\File;
use App\ContentTypes\Image as ContentImage;
use App\ContentTypes\KeyValue;
use App\ContentTypes\MultipleImage;
use App\ContentTypes\Password;
use App\ContentTypes\SelectMultiple;
use App\ContentTypes\Text;
use App\ContentTypes\Timestamp;
use App\Models\Setting;
use App\Repositories\Admin\SettingsRepository;
use App\Traits\Authorizable;
use Illuminate\Http\Request;

class SettingController extends AdminController
{
    use Authorizable;

    protected $key = 'settings';

    protected $permissionKey = 'settings';

    public function __construct()
    {
        parent::__construct();
        $this->addBreadCrumb(__('modules.settings.title'), $this->resourceRoute('index'));
        $this->setTitle(__('modules.settings.title'));
        $this->shareViewModuleData();
    }

    public function index(Request $request, SettingsRepository $settingsRepository)
    {
        if ($request->has('seed')) {
            seedByClass('SettingsTableSeeder');
        }
        $settings = $settingsRepository->getSettings($request);
        $groups = $settings->where('group')->pluck('group')->unique();

        $active = request()->session()->get('setting_tab', old('setting_tab', ($groups->first())));

        $data['content'] = view('admin.settings.index', compact('settings', 'groups', 'request', 'active'));

        return $this->main($data);
    }

    public function store(Request $request)
    {
        $key = $request->input('key');
        if (!Setting::isStaff($key) && $request->has('group')) {
            $key = implode('.', [\Str::slug($request->input('group')), $key]);
        }
        $key_check = Setting::where('key', $key)->get()->count();
        if ($key_check > 0) {
            return back()->with([
                'message' => __('settings.key_already_exists', ['key' => $key]),
                'alert-type' => 'error',
            ]);
        }
        $request->merge(['sort' => 0, 'value' => '', 'key' => $key]);
        (new Setting)->fillExisting($request->all())->save();
        request()->flashOnly('setting_tab');

        return back()->with([
            'message' => __('settings.successfully_created'),
            'alert-type' => 'success',
        ]);
    }

    public function update(Request $request)
    {
        // Check permission
        $input = $request->input('settings');
        $settings = [];

        if ($input && ($ids = array_column($input, 'id'))) {
            $settings = Setting::find($ids);
        }
        if ($settings) {

            foreach ($input as $item) {
                if (!$setting = $settings->where('id', \Arr::get($item, 'id'))->first()) {
                    continue;
                }
                if (
                    !$setting->isTypeCheckbox()
                    && !\Arr::has($item, 'group')
                    && !$request->has($setting->getKeyForSave())
                ) {
                    continue;
                }
                if ($setting->isTypeCheckbox() || $request->has($setting->getKeyForSave())) {
                    $options = json_decode($setting->details) ?? new \stdClass;
                    $options->preserveFileUploadName = true;

                    $content = $this->getContentBasedOnType($request, 'setting', (object)[
                        'type' => $setting->type,
                        'field' => $setting->getKeyForSave(),
                        'details' => $setting->details,
                        'group' => $setting->group,
                    ], $options);

                    $setting->setAttribute('value', $content);

                    if (($setting->type === 'image') && ($content === null)) {
                        continue;
                    }
                    if (($content === json_encode([])) && ($setting->isTypeFile() || $setting->isTypeFileMultiple())) {
                        continue;
                    }
                }

                if (\Arr::has($item, 'group')) {
                    $setting->setAttribute('group', \Arr::get($item, 'group'));
                }
                $setting->save();
            }
        }
        request()->flashOnly('setting_tab');

        return back()->with([
            'message' => __('settings.successfully_saved'),
            'alert-type' => 'success',
        ]);
    }

    public function destroy(Setting $setting)
    {
        $this->delete_value($setting->id);
        $setting->delete();

        return back()
            ->with([
                'message' => __('settings.successfully_deleted'),
                'alert-type' => 'success',
            ]);
    }

    public function delete_value($id)
    {
        $setting = Setting::find($id);
        // Check permission
        if (isset($setting->id)) {
            // If the type is an image... Then delete it
            $deleteable = [
                'image',
                'file',
            ];
            if (in_array($setting->type, $deleteable, true)) {
                $files = [];
                if ($setting->type === 'image') {
                    $image = normalizePath($setting->value);
                    $files[] = $image;
                    $details = json_decode($setting->details);
                    if (isset($details->thumbnails)) {
                        $ext = \App\Helpers\File\File::extractExtension($setting->value);
                        $original = \App\Helpers\File\File::extractFilename($image);
                        foreach ($details->thumbnails as $thumbnail) {
                            $files[] = $original . '-' . $thumbnail->name . '.' . $ext;
                        }
                    }
                } else if ($setting->type === 'file') {
                    $files[] = \Arr::get(json_decode($setting->value, true)[0], 'download_link');
                }
                foreach ($files as $file) {
                    if (\Storage::disk()->exists($file)) {
                        \Storage::disk()->delete($file);
                    }
                }
            }
            $setting->value = '';
            $setting->save();
        }

        return back()->with([
            'message' => __('settings.successfully_removed', ['name' => $setting->display_name]),
            'alert-type' => 'success',
        ]);
    }

    public function getContentBasedOnType(Request $request, $slug, $row, $options = null)
    {
        switch ($row->type) {
            case 'password':
                return (new Password($request, $slug, $row, $options))->handle();
            case 'checkbox':
                return (new Checkbox($request, $slug, $row, $options))->handle();
            case 'file':
            case 'file_multiple':
                return (new File($request, $slug, $row, $options))->handle();
            case 'multiple_images':
                return (new MultipleImage($request, $slug, $row, $options))->handle();
            case 'select_multiple':
                return (new SelectMultiple($request, $slug, $row, $options))->handle();
            case 'image':
                return (new ContentImage($request, $slug, $row, $options))->handle();
            case 'timestamp':
                return (new Timestamp($request, $slug, $row, $options))->handle();
            case 'coordinates':
                return (new Coordinates($request, $slug, $row, $options))->handle();
            case 'key_value':
                return (new KeyValue($request, $slug, $row, $options))->handle();
            default:
                return (new Text($request, $slug, $row, $options))->handle();
        }
    }
}
