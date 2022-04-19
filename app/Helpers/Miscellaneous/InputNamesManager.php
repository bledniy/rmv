<?php


namespace App\Helpers\Miscellaneous;


use App\Models\Model;

class InputNamesManager
{
    /** @var Model */
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $input
     * @return string
     * generate string like: news[3]['url']
     */
    public function getNameInputByKey(string $input)
    {
        return $this->getNameInput() . '[' . $input . ']';
    }

    /**
     * @param string $input
     * @return mixed
     * @example $name = $request->input($model->getNameInputRequestKey('name'))
     * @generate string like: news.3.url
     */
    public function getNameInputRequestByKey(string $input)
    {
        return remakeInputKeyDotted($this->getNameInputByKey($input));
    }

    /**
     * @return mixed
     * @example $key = $model->getNameInputRequest()
     * generate string like: news.3
     */
    public function getNameInputRequest()
    {
        return remakeInputKeyDotted($this->getNameInput());
    }

    /**
     * @return string
     * generate string like: news[3]
     */
    public function getNameInput()
    {
        $primary = ($primaryValue = $this->model->getKey()) ? '[' . $primaryValue . ']' : '';

        return $this->model->getTable() . $primary;
    }

    public function createArrayWithData(array $data = [])
    {
        return [$this->model->getTable() => $data];
    }


}