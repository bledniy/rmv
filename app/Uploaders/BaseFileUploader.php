<?php declare(strict_types=1);

namespace App\Uploaders;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class BaseFileUploader
{
    protected $path = 'uploads';

    public function upload(UploadedFile $file, $filename = null): string
    {
        $filename = $filename ?: $this->createFileName($file);
        $basename = implode('.', [$filename, $file->getClientOriginalExtension()]);
        $file->storeAs($this->path, $basename);

        return $this->path . DIRECTORY_SEPARATOR . $basename;
    }

    /**
     * @param string $path
     * @return self
     */
    public function setPath(string $path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param $append
     * @return $this
     */
    public function appendToPath($append)
    {
        $this->setPath($this->getPath() . DIRECTORY_SEPARATOR . $append);

        return $this;
    }

    protected function createFileName(UploadedFile $file)
    {
        return md5(Str::random(32) . $file->getClientOriginalName());
    }
}