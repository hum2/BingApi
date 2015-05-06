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
class FakeTransferClient extends Client
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
        $json = '{"token_type":"http://schemas.xmlsoap.org/ws/2009/11/swt-token-profile-1.0","access_token":"http%3a%2f%2fschemas.xmlsoap.org%2fws%2f2005%2f05%2fidentity%2fclaims%2fnameidentifier=hum2-transfer&http%3a%2f%2fschemas.microsoft.com%2faccesscontrolservice%2f2010%2f07%2fclaims%2fidentityprovider=https%3a%2f%2fdatamarket.accesscontrol.windows.net%2f&Audience=http%3a%2f%2fapi.microsofttranslator.com&ExpiresOn=1430897577&Issuer=https%3a%2f%2fdatamarket.accesscontrol.windows.net%2f&HMACSHA256=BmNZy44yYMowXWL%2fOBn0aea2OVv4SUYg3EBO1Js2Qvk%3d","expires_in":"600","scope":"http://api.microsofttranslator.com"}';

        return Stream::factory($json);
    }
}
