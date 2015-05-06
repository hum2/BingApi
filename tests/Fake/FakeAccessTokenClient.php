<?php
namespace Tests\Hum2\BingResource\Fake;

use BEAR\Resource\Code;
use GuzzleHttp\Client;
use GuzzleHttp\Message\FutureResponse;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Stream\Stream;
use React\Promise\FulfilledPromise;

/**
 * HTTP client
 */
class FakeAccessTokenClient extends Client
{
    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function send(RequestInterface $request)
    {
        return new FutureResponse(new FulfilledPromise(new Response(Code::OK, [], $this->getFakeStream())));
    }

    /**
     * @return Stream
     */
    public function getFakeStream()
    {
        $json = file_get_contents(dirname(__DIR__) . '/Fake/var/fake_access_token.json');

        return Stream::factory($json);
    }
}
