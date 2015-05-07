<?php

namespace Tests\Hum2\BingResource\Resource\App;

use Hum2\BingResource\Module\Transfer\Language;
use Hum2\BingResource\Resource\App\Transfer;
use Ray\Di\Exception;
use Tests\Hum2\BingResource\Fake\FakeTransferClient;

class TransferTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Transfer
     */
    private $resource;

    public function setUp()
    {
        $resource = new Transfer();
        $resource->setClient(new FakeTransferClient);

        $this->resource = $resource;
    }

    public function testOnGet()
    {
        $response = $this->resource->onGet('hello,world', Language::ENGLISH, Language::JAPANESE);
        $this->assertSame(Language::ENGLISH, $response->body['from']);
        $this->assertSame(Language::JAPANESE, $response->body['to']);
        $this->assertSame('hello,world', $response->body['fromText']);
        $this->assertSame('こんにちは、世界', $response->body['toText']);
    }
}
