<?php
/**
 * Created by PhpStorm.
 * User: qwerty
 * Date: 29.06.2019
 * Time: 8:55
 */

namespace App\Traits\Controllers;

use App\Helpers\ResponseHelper;

/**
 * Trait ThumbnailSizes
 * @package App\Traits\Controllers
 * @property mixed $thumbnailWidth
 * @property mixed $thumbnailHeight
 */
trait HasMessages
{
    protected $responseMessages = [];

    protected $responseData = [];

    protected function setMessageData(string $key, $value): void
    {
        \Arr::set($this->responseMessages, $key, $value);
    }

    protected function getMessageData($key, $default = null)
    {
        return \Arr::get($this->responseMessages, $key, $default);
    }

    /**
     * @param $message
     * @param bool $replace
     * @return $this
     */

    protected function setMessage($message, $replace = true): self
    {
        $message = (array)$message;
        if (!$replace) {
            $message = array_merge($this->getMessage(), $message);
        }
        $this->setMessageData('message', $message);

        return $this;
    }

    protected function setSuccessMessage($message): self
    {
        return $this->setStatus(true)->setMessage($message);
    }

    protected function setFailMessage($message): self
    {
        return $this->setStatus(false)->setMessage($message);
    }

    /**
     * @return array
     */
    protected function getMessage(): array
    {
        return $this->getMessageData('message', []);
    }

    /**
     * @param string $glue
     * @return string
     */
    protected function getMessageDisplay($glue = ' '): string
    {
        return implode($glue, $this->getMessage());
    }

    protected function setStatus($status = false): self
    {
        $statusKey = $status ? ResponseHelper::SUCCESS_KEY : ResponseHelper::ERROR_KEY;
        $this->setMessageData('status', $statusKey);

        return $this;
    }

    protected function getStatus()
    {
        if (!$this->getMessageData('status')) {
            $this->setStatus();
        }

        return $this->getMessageData('status');
    }

    protected function getResponseMessageForJson($glue = ' '): array
    {
        return [
                ResponseHelper::STATUS_KEY => $this->getStatus(),
                ResponseHelper::MESSAGE_KEY => $this->getMessageDisplay($glue),
            ] + $this->getResponseData();
    }

    protected function getResponseMessageJsonToErrorValidation($field = null): array
    {
        $field = $field ?: $this->getStatus();

        return [
                'errors' => [
                    $field => [
                        $this->getMessageDisplay(),
                    ],
                ],
            ] + $this->getResponseData();
    }

    protected function getResponseMessage($glue = ' '): array
    {
        return [
                $this->getStatus() => $this->getMessageDisplay($glue),
            ] + $this->getResponseData();
    }

    protected function getResponseData(): array
    {
        return \Arr::wrap($this->responseData ?? []);
    }

    protected function setResponseData(array $data): self
    {
        $this->responseData = array_merge($this->responseData, $data);

        return $this;
    }

    protected function replaceResponseData(array $data): self
    {
        $this->responseData = $data;

        return $this;
    }

}
