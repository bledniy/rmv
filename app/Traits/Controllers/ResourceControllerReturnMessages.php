<?php

namespace App\Traits\Controllers;


/**
 * Trait ResourceControllerReturnMessages
 * @package App\Traits\Controllers
 * @uses \App\Traits\Controllers\HasMessages
 */
trait ResourceControllerReturnMessages
{

    protected function setFailUpdate(): void
    {
        $this->setFailMessage(__('generic.update_failed'));
    }

    protected function setFailStore(): void
    {
        $this->setFailMessage(__('generic.create_failed'));
    }

    protected function setFailDestroy(): void
    {
        $this->setFailMessage(__('generic.error_deleting'));
    }

    protected function setSuccessUpdate(): void
    {
        $this->setSuccessMessage(__('generic.successfully_updated'));
    }

    protected function setSuccessStore(): void
    {
        $this->setSuccessMessage(__('generic.successfully_added_new'));
    }

    protected function setSuccessDestroy(): void
    {
        $this->setSuccessMessage(__('generic.successfully_deleted'));
    }
}
