<?php


namespace App\Helpers\Media;


use App\Helpers\File\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image as InterventionImage;
use Intervention\Image\ImageManagerStatic as Image;

class ImageSaver
{
    public const THUMBNAIL_WIDTH = 400;

    public const THUMBNAIL_HEIGHT = 250;

    private $resizeWidth;

    private $resizeHeight;

    public const DEFAULT_EXTENSION = 'jpg';

    public const DEFAULT_FOLDER = 'images';

    private $fileExtension;

    private $fileName;

    private $fullImageName;

    /** @var string */
    private $storageDisk;

    /** @var string */
    private $nameKey;

    /** @var Request */
    private $request;

    /** @var string */
    private $folderName;

    /** @var int */
    private $thumbnailWidth;

    /** @var int */
    private $thumbnailHeight;

    private $withThumbnails = true;

    /** @var UploadedFile */
    private $file;

    protected static $extensionAllowed = [
        'jpg',
        'jpeg',
        'png',
        'gif',
        'webp',
    ];

    public function __construct(?Request $request = null, string $nameKey = 'image', string $folderName = 'images', string $storageDisk = 'public')
    {
        if ($request) {
            $this->setRequest($request);
        }
        $this->setFolderName($folderName);
        $this->setNameKey($nameKey);
        $this->setStorage($storageDisk);
    }

    public function withFileExtension(string $extension): self
    {
        if ($this->extensionAllowed($extension)) {
            $this->fileExtension = $extension;
        }

        return $this;
    }

    public function withFileName(string $name): self
    {
        $this->fileName = $name;

        return $this;
    }

    protected function extensionAllowed($ext): bool
    {
        return in_array($ext, self::$extensionAllowed, true);
    }

    protected function isRequestHasFile(): bool
    {
        return $this->request->hasFile($this->nameKey);
    }

    private function getUploadedFile(): ?UploadedFile
    {
        return $this->isRequestHasFile() ? $this->request->file($this->nameKey) : null;
    }

    private function checkImageRequest()
    {
        if (!$this->isRequestHasFile()) {
            return false;
        }

        return $this->extensionAllowed($this->getUploadedFile()->getClientOriginalExtension());
    }

    private function isInvalidImageCanBeUploaded(): bool
    {
        return $this->isRequestHasFile();
    }

    public function saveFromUrl(string $url): string
    {
        if (!$image = $this->createImage($url)) {
            return '';
        }

        return $this->saveFromImage($image);
    }

    public function saveFromRequest(): string
    {
        return $this->saveFromUploadedFile($this->request->file($this->nameKey));
    }

    public function saveFromUploadedFile(UploadedFile $uploadedFile): string
    {
        $this->setFile($uploadedFile);
        $imageIntervention = $this->createImage($this->getFile());
        if ($imageIntervention) {
            return $this->saveFromImage($imageIntervention);
        }

        if ($this->isInvalidImageCanBeUploaded()) {
            $this->setFile($uploadedFile);

            return $this->moveUploadedFile($this->getUploadedFile());
        }

        return '';
    }

    private function checkImageBase64(string $imageBase64)
    {
        return is_base64($imageBase64);
    }

    public function saveFromBase64(string $imageBase64): string
    {
        $imageBase64 = $this->getClearBase64($imageBase64);
        if ($this->checkImageBase64($imageBase64)) {
            $imageIntervention = $this->createImage($imageBase64);

            return $this->saveFromImage($imageIntervention);
        }

        return '';
    }

    public function saveManyImages(): array
    {
        $imageArr = [];

        $images = \Arr::get($this->request->all(), $this->nameKey);

        foreach ($images as $image) {
            $this->setFile($image);
            $imageIntervention = $this->createImage($image);
            if (!$imageIntervention) {
                $imageArr[] = '';
                continue;
            }
            $imageArr[] = $this->saveFromImage($imageIntervention);
        }

        return $imageArr;
    }

    public function saveFromImage(InterventionImage $image): string
    {
        return $this->save($image->stream());
    }

    private function moveUploadedFile($image): string
    {
        if ($this->hasFullImageName()) {
            $filePathWithName = $this->getFullImageName();
            $filePath = File::extractPath($filePathWithName);
            $fileName = File::extractBaseName($filePathWithName);
            $fileExtension = File::extractExtension($filePathWithName);
        } else {
            $name = $this->getFileName();
            $fileExtension = $this->getFileExtension();
            $filePath = $this->getFolderName();
            $fileName = $name . '.' . $fileExtension;
            $filePathWithName = implode(DIRECTORY_SEPARATOR, [$filePath, $fileName]);
        }
        $returnFileName = $filePathWithName;

        if ($image instanceof UploadedFile) {
            $image->storeAs($filePath, $fileName);
        } else if ($image instanceof InterventionImage) {
            try {
                Storage::disk($this->storageDisk)->put($filePathWithName, $image->stream($fileExtension));
            } catch (\Exception $e) {
                $returnFileName = '';
            }
        }

        return $returnFileName;
    }

    private function save($image): string
    {
        if ($this->hasFullImageName()) {
            $filePathWithName = $this->getFullImageName();
            $filePath = File::extractPath($filePathWithName);
            $fileName = File::extractBaseName($filePathWithName);
            $fileExtension = File::extractExtension($filePathWithName);
        } else {
            $fileName = $this->getFileName();
            $fileExtension = $this->getFileExtension();
            $filePath = $this->getFolderName();
        }

        $image = $this->createImage($image);
        if ($this->needResize()) {
            $image = $this->resize($image, ...$this->getResizeTo());
        }
        $returnFileName = $this->moveUploadedFile($image);
        if ($this->thumbnailsAllowed() && $this->extensionAllowed($fileExtension)) {
            $file_name_s = $filePath . DIRECTORY_SEPARATOR . $fileName . '_s.' . $fileExtension;
            $thumbnailImage = $this->thumbnailImage($this->createImage($image), ...$this->getThumbnailSizes());
            Storage::disk($this->storageDisk)->put($file_name_s, $thumbnailImage->stream($fileExtension));
            $returnFileName = $file_name_s;
        }
        $this->resetFileData();

        return $returnFileName;
    }


    public function thumbnailImage(InterventionImage $image, int $width = 250, int $height = 250): InterventionImage
    {
        return $image->fit($width, $height);
    }

    /**
     * @param string $storageDisk
     * @return $this
     */
    public function setStorage(string $storageDisk): self
    {
        $this->storageDisk = $storageDisk;

        return $this;
    }

    /**
     * @param string $nameKey
     * @return $this
     */
    public function setNameKey(string $nameKey): self
    {
        $this->nameKey = $nameKey;

        return $this;
    }

    public function setFolderName(string $folderName): self
    {
        $this->folderName = $folderName;

        return $this;
    }

    public function getFolderName(): string
    {
        return $this->folderName ?: self::DEFAULT_FOLDER;
    }

    public function setRequest(Request $request): self
    {
        $this->request = $request;

        return $this;
    }

    private function getClearBase64(string $base64): string
    {
        $base64 = str_replace(['data:image/jpeg;base64,', 'data:image/png;base64,', ' '], ['', '', '+'], $base64);

        return $base64;
    }


    private function getFileName(): string
    {
        return $this->fileName ?? md5(($file = $this->getFile()) ? $file->getClientOriginalName() : \Str::random(40));
    }

    private function getFileExtension(): string
    {
        return $this->fileExtension ?? (($file = $this->getFile()) ? $file->getClientOriginalExtension() : self::DEFAULT_EXTENSION);
    }

    private function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    private function setFile(UploadedFile $file): self
    {
        $this->file = $file;

        return $this;
    }

    private function createImage($image): ?InterventionImage
    {
        $imageReturn = null;
        if ($image instanceof UploadedFile) {
            try {
                $imageReturn = Image::make(\File::get($image->getRealPath()));
            } catch (\Throwable $e) {
                return null;
            }
        } else if ((is_string($image) && is_base64($image))) {
            $imageReturn = Image::make($image);
        } else if ($image instanceof InterventionImage) {
            $imageReturn = $image;
        }
        if (!$imageReturn) {
            try {
                $imageReturn = Image::make($image);
            } catch (\Exception $e) {
                $imageReturn = null;
            }
        }

        return $imageReturn;
    }

    public function setFullImageName(string $full): self
    {
        $this->fullImageName = $full;

        return $this;
    }

    public function getFullImageName(): ?string
    {
        return $this->fullImageName;
    }

    public function hasFullImageName(): bool
    {
        return (bool)$this->getFullImageName();
    }

    private function resetFileData(): void
    {
        $this->fileExtension = null;
        $this->fileName = null;
    }


    /**
     * @deprecated  GROUP
     */


    public function setThumbnailSizes(int $width, int $height): self
    {
        $this->thumbnailWidth = $width;
        $this->thumbnailHeight = $height;

        return $this;
    }


    private function getThumbnailSizes(): array
    {
        return [$this->getThumbnailWidth(), $this->getThumbnailHeight()];
    }

    private function getThumbnailWidth(): int
    {
        return ($this->thumbnailWidth ?: self::THUMBNAIL_WIDTH);
    }

    private function getThumbnailHeight(): int
    {
        return ($this->thumbnailHeight ?: self::THUMBNAIL_HEIGHT);
    }

    public function setWithThumbnail(bool $flag): self
    {
        $this->withThumbnails = $flag;

        return $this;
    }

    /**
     * @return bool
     * @deprecated
     */
    private function thumbnailsAllowed(): bool
    {
        return $this->withThumbnails;
    }

    public function setResizeTo(int $width, ?int $height = null)
    {
        $this->resizeWidth = $width;
        $this->resizeHeight = $height;
    }

    private function resize(InterventionImage $image, $width, $height): InterventionImage
    {
        $image->fit($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        return $image;
    }

    private function needResize(): bool
    {
        return (bool)array_filter($this->getResizeTo(), 'strlen');
    }

    public function getResizeTo(): array
    {
        return [
            $this->resizeWidth, $this->resizeHeight,
        ];
    }
}
