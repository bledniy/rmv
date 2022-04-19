<?php


namespace App\Helpers\Http;


class Message
{
    private $messages = [];

    private function __construct() { }

    public static function setMessage(string $message)
    {
        //todo add other methods, remake HasMessages trait to this class
    }
}