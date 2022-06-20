<?php

namespace App\Rules\Uploads;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;

class NotDangerExecutable implements Rule
{
    private $deprecatedExtensions = [
        'php',
        'htaccess',
    ];
    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param UploadedFile $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!$value instanceof UploadedFile) {
            return 1;
        }
        $this->file = $value;

        return !in_array($value->getClientOriginalExtension(), $this->deprecatedExtensions, true);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return translateFormat('uploads.danger', [
            '%extension%' => $this->file->getClientOriginalExtension(),
            '%file%' => $this->file->getClientOriginalName(),
        ]);
    }
}
