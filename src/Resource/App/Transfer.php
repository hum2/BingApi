<?php

namespace Hum2\BingApi\Resource\App;

use BEAR\Resource\ResourceObject;
use GuzzleHttp\ClientInterface;
use Hum2\BingApi\Module\Annotation\AzureAccessToken;
use Hum2\BingApi\Module\Transfer\Language;
use Ray\Di\Di\Inject;

/**
 * Class Transfer
 * @package Hum2\BingApi\Resource\App
 * @see     https://msdn.microsoft.com/en-us/library/ff512421.aspx
 */
class Transfer extends ResourceObject
{
    /**
     * @const string
     */
    const API_URL = 'http://api.microsofttranslator.com/V2/Http.svc/Translate';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var array
     */
    private $apiParams = [
        'appId' => 'Bearer ',
        'text'  => '',
        'from'  => '',
        'to'    => ''
    ];

    /**
     * @param ClientInterface $client
     *
     * @Inject
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param        $text
     * @param string $from
     * @param string $to
     *
     * @return $this
     *
     * @AzureAccessToken
     */
    public function onGet($text, $from = Language::JAPANESE, $to = Language::ENGLISH)
    {
        $this->apiParams['appId'] = $this->apiParams['appId'] . $this['access_token'];
        $this->apiParams['text']  = $text;
        $this->apiParams['from']  = $from;
        $this->apiParams['to']    = $to;

        $url = self::API_URL . '?' . http_build_query($this->apiParams);

        $response = $this->client->get($url);
        $result   = $response->getBody()->getContents();

        $this['from']     = $from;
        $this['to']       = $to;
        $this['fromText'] = $text;
        $this['toText']   = $this->escapeXml($result);

        return $this;
    }

    /**
     * @param $xml
     *
     * @return mixed
     */
    private function escapeXml($xml)
    {
        return str_replace(
            ['<string xmlns="http://schemas.microsoft.com/2003/10/Serialization/">', '</string>'],
            '',
            $xml);
    }
}