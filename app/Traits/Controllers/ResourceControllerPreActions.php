<?php declare(strict_types=1);

namespace App\Traits\Controllers;

trait ResourceControllerPreActions
{

    protected function beforeIndex($functionArgs = [])
    {

    }

    protected function beforeStore($functionArgs = [])
    {
        $this->setFailStore();
    }

    protected function beforeCreate($functionArgs = []): void
    {
        $title = __('form.creating');
        $this->addBreadCrumb($title);
        $this->setTitle($title);
    }

    protected function beforeDestroy($functionArgs = [])
    {
        $this->setFailDestroy();
    }

    protected function beforeUpdate($functionArgs = [])
    {
        $this->setFailUpdate();
    }

    protected function beforeEdit($functionArgs = [])
    {

    }

    protected function beforeShow($functionArgs = [])
    {
    }


}
