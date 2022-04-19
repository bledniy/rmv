<?php


namespace App\Contracts\Modules\Transfer;


interface MetaTransferContract
{
    /**
     * @param string $url
     * @return \View
     */
    function getForm(string $url): \View;

}