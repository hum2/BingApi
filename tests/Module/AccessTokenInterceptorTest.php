<?php

namespace Tests\Hum2\BingResource\Module;

use BEAR\Resource\Code;
use Hum2\BingResource\Module\AccessTokenInterceptor;
use Ray\Aop\Arguments;
use Ray\Aop\ReflectiveMethodInvocation;
use Tests\Hum2\BingResource\Fake\FakeAccessTokenClient;
use Tests\Hum2\BingResource\Fake\FakeResource;

class AccessTokenInterceptorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AccessTokenInterceptor
     */
    private $accessTokenInterceptor;

    public function setup()
    {
        $client                       = new FakeAccessTokenClient();
        $this->accessTokenInterceptor = new AccessTokenInterceptor(
            $GLOBALS['azure_client_id'], $GLOBALS['azure_client_secret']);
        $this->accessTokenInterceptor->setClient($client);
    }

    /**
     * @param       $mock
     * @param array $server
     *
     * @return ReflectiveMethodInvocation
     */
    private function getInvocation($mock, array $server)
    {
        return new ReflectiveMethodInvocation(
            $mock,
            new \ReflectionMethod($mock, 'onGet'),
            new Arguments($server),
            [$this->accessTokenInterceptor]
        );
    }

    public function testAccessTokenResponse()
    {
        $method = new \ReflectionMethod($this->accessTokenInterceptor, 'getAccessTokenResponse');
        $method->setAccessible(true);
        $response = $method->invoke($this->accessTokenInterceptor);

        $this->assertEquals(600, $response['expires_in']);
        $this->assertEquals('hogehoge', $response['access_token']);
    }

    public function testProceedCode()
    {
        $mock       = new FakeResource();
        $invocation = $this->getInvocation($mock, []);
        /* @var $result FakeResource */
        $result = $invocation->proceed();
        $this->assertEquals(Code::OK, $result->code);
    }
}
