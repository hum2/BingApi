<?php

namespace Hum2\BingResource\Module;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Hum2\BingResource\Module\Azure\Exception\InvalidTokenException;
use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

class AccessTokenInterceptor implements MethodInterceptor
{
    /**
     * @const string
     */
    const API_URL = 'https://datamarket.accesscontrol.windows.net/v2/Oauth2-13';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var array
     */
    private $apiParams = [
        'client_id'     => '',
        'client_secret' => '',
        'scope'         => 'http://api.microsofttranslator.com',
        'grant_type'    => 'client_credentials'
    ];

    /**
     * @param $azure_client_id
     * @param $azure_client_secret
     *
     * @Named("azure_client_id=azure_client_id,azure_client_secret=azure_client_secret")
     */
    public function __construct($azure_client_id, $azure_client_secret)
    {
        $this->apiParams['client_id']     = $azure_client_id;
        $this->apiParams['client_secret'] = $azure_client_secret;
    }

    /**
     * @param ClientInterface $client
     * @Inject
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function invoke(MethodInvocation $invocation)
    {
        $body = $this->getAccessTokenResponse();

        $resourceObject                         = $invocation->getThis();
        $resourceObject['access_token']         = $body['access_token'];
        $resourceObject['access_token_expires'] = $body['expires_in'];

        $invocation->proceed();

        unset($resourceObject['access_token']);
        unset($resourceObject['access_token_expires']);

        return $resourceObject;
    }

    /**
     * @return array
     */
    private function getAccessTokenResponse()
    {
        try {
            $response = $this->client->post(self::API_URL, [
                'headers' => ['Content-Type', 'application/x-www-form-urlencoded'],
                'body'    => $this->apiParams
            ]);
        } catch (RequestException $e) {
            $response = $e->getResponse();
        }

        $body = json_decode($response->getBody(), true);

        if (isset($body['error'])) {
            throw new InvalidTokenException($body['description']);
        }

        return $body;
    }
}
