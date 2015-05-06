<?php

namespace Tests\Hum2\BingResource\Module;

use BEAR\Package\PackageModule;
use BEAR\Resource\Code;
use BEAR\Resource\ResourceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Hum2\BingResource\Module\BingResourceModule;
use Hum2\BingResource\Resource\App\Transfer;
use Ray\Di\Exception;
use Ray\Di\Injector;

class BingResourceModuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Injector
     */
    private $injector;

    public function setUp()
    {
        $module = new PackageModule();
        $module->override(new BingResourceModule($GLOBALS['azure_client_id'], $GLOBALS['azure_client_secret']));
        $this->injector = new Injector($module);
    }

    public function testClientInterface()
    {
        $client = $this->injector->getInstance(Client::class);
        $this->assertInstanceOf(ClientInterface::class, $client);
    }

    public function testClientId()
    {
        $clientId = $this->injector->getInstance('', 'azure_client_id');
        $this->assertEquals($GLOBALS['azure_client_id'], $clientId);
    }

    public function testClientSecret()
    {
        $clientSecret = $this->injector->getInstance('', 'azure_client_secret');
        $this->assertEquals($GLOBALS['azure_client_secret'], $clientSecret);
    }

    public function testBingSchemeCollection()
    {
        /* @var $resource ResourceInterface */
        $resource = $this->injector->getInstance(ResourceInterface::class);
        $response = $resource->get->uri('app://bing/transfer/languages')->eager->request();

        $this->assertEquals(Code::OK, $response->code);
        $this->assertTrue(is_array($response->body));
    }

    /**
     * @expectedException \BEAR\Resource\Exception\ResourceNotFoundException
     * @expectedExceptionMessage page://self/provide/error/errorPage
     */
    public function testSelfSchemeCollectionException()
    {
        /* @var $resource ResourceInterface */
        $resource = $this->injector->getInstance(ResourceInterface::class);
        $resource->get->uri('page://self/provide/error/errorPage')->request();
    }
}
