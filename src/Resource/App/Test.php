<?php

namespace Hum2\BingResource\Resource\App;

use BEAR\Resource\ResourceObject;
use GuzzleHttp\ClientInterface;
use Hum2\BingResource\Module\Transfer\Language;
use Ray\Di\Di\Inject;

/**
 * Class Transfer
 * @package Hum2\BingResource\Resource\App
 * @see     https://msdn.microsoft.com/en-us/library/ff512421.aspx
 */
class Test extends ResourceObject
{
    /**
     * @return $this
     */
    public function onGet()
    {
        return $this;
    }
}