<?php

namespace Rosello\T411\Config;

/**
 * Class BaseConfig
 */
abstract class BaseConfig
{
    /**
     * @var string
     */
    private $baseUrl = "https://api.t411.io";

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }
}