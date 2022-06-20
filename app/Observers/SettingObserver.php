<?php

namespace App\Observers;

use App\Models\Setting;

class SettingObserver
{

    /**
     * @param Setting $setting
     */
    public function creating(Setting $setting)
    {
        if (!Setting::isStaff($setting->key)) {
            if (\Str::contains($setting->key, '.')) {
                $parts = explode('.', $setting->key);
                $setting->group = reset($parts);
            }
            if (!\Arr::get($setting, 'group')) {
                $setting->group = Setting::DEFAULT_GROUP;
            }
        } else {
            $setting->group = Setting::STAFF_GROUP;
        }

        $this->addEditedBy($setting);
    }

    /**
     * @param Setting $setting
     */
    public function updating(Setting $setting)
    {
        $this->addEditedBy($setting);
    }

    private function addEditedBy(Setting $setting)
    {
        if ($user = \Auth::guard('admin')->user()) {
            $userId = $user->getKey();
            $setting->setAttribute('user_id', $userId);
        }

    }

    public function deleted(Setting $setting)
    {
        $this->addDeletedBy($setting);
    }

    private function addDeletedBy(Setting $setting)
    {
        if ($user = \Auth::guard('admin')->user()) {
            $userId = $user->getKey();
            $setting->setDeletedByAttribute($userId);
            $setting->save();
        }

    }

}
