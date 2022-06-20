<?php


namespace App\Traits\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta as SEOMetaBase;

trait SEOMeta
{
    public function setTitle($title = '', $replace = false)
    {
        SEOMetaBase::setTitle($replace ? $title : SEOMetaBase::getTitle() . ' ' . $title);

        return $this;
    }

    public function setKeywords($keywords = '', $replace = true)
    {
        SEOMetaBase::setKeywords($replace ? $keywords : SEOMetaBase::getKeywords() . ' ' . $keywords);

        return $this;
    }

    public function setDescription($description = '', $replace = true)
    {
        SEOMetaBase::setDescription($replace ? $description : SEOMetaBase::getDescription() . ' ' . $description);

        return $this;
    }

    public function getTitle()
    {
        return SEOMetaBase::getTitle();
    }

    public function getDescription()
    {
        return SEOMetaBase::getDescription();
    }

    public function getKeywords()
    {
        return SEOMetaBase::getKeywords();
    }

    public function setCanonical($url)
    {
        return SEOMetaBase::setCanonical($url);
    }

    public function getCanonical()
    {
        return SEOMetaBase::getCanonical();
    }

    public function setNext($url)
    {
        return SEOMetaBase::setNext($url);
    }

    public function setPrev($url)
    {
        return SEOMetaBase::setPrev($url);
    }
}
