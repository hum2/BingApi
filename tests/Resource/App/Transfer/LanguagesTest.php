<?php

namespace Tests\Hum2\BingApi\Resource\App\Transfer;

use Hum2\BingApi\Resource\App\Transfer;
use Hum2\BingApi\Resource\App\Transfer\Languages;
use Ray\Di\Exception;

/**
 * Class LanguagesTest
 * @package Tests\Hum2\BingApi\Resource\App\Transfer
 * TODO 途中
 */
class LanguagesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Languages
     */
    private $resource;

    public function setUp()
    {
        $resource       = new Languages();
        $this->resource = $resource;
    }

    public function testOnGet()
    {
        $response = $this->resource->onGet();
        $this->assertTrue(is_array($response));
    }
}
