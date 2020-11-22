<?php

namespace App\Helper;

class Urls
{
    protected string $url;

    public function __construct(string $urlSiteProd)
    {
        $this->url = $urlSiteProd;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
