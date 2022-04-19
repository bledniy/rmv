<?php declare(strict_types=1);

namespace App\Rules\Feedback;

use App\Helpers\Debug\LoggerHelper;
use Illuminate\Contracts\Validation\Rule;

class UploadLimitRule implements Rule
{
    public $limit = 10;

    public function passes($attribute, $value): bool
    {
        if (!$value) {
            return true;
        }
        $files = array_filter((array)$value, static function ($item) {
            try {
                return is_file($item);
            } catch (\Throwable $e) {
                return false;
            }
        });
        $totalSizeMB = array_reduce($files, static function ($sum, $item) {
            // each item is UploadedFile Object
            try {
                $sum += filesize($item->path());
            } catch (\Throwable $e) {
                app(LoggerHelper::class)->error($e);
            }

            return $sum;
        });
        $totalSizeMB /= (1024 * 1024);

        return $totalSizeMB <= $this->limit;
    }


    public function message()
    {
        return getTranslate(
            'feedback.validation.files-total-size.fail',
            sprintf('Общий размер загружаемых файлов не должен превышать %d Мб', $this->limit)
        );
    }

    /**
     * @param int $limit
     * @return UploadLimitRule
     */
    public function setLimit(int $limit): UploadLimitRule
    {
        $this->limit = $limit;

        return $this;
    }
}
