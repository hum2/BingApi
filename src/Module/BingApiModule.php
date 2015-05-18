<?php

namespace Hum2\BingApi\Module;

use Hum2\BingApi\Resource\App\Transfer;
use Ray\Di\AbstractModule;

class BingApiModule extends AbstractModule
{
    /**
     * @var string Azure Client ID
     */
    private $clientId;

    /**
     * @var string Azure Client Secret
     */
    private $clientSecret;

    public function __construct($azure_client_id, $azure_client_secret)
    {
        $this->clientId     = $azure_client_id;
        $this->clientSecret = $azure_client_secret;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bind()->annotatedWith('azure_client_id')->toInstance($this->clientId);
        $this->bind()->annotatedWith('azure_client_secret')->toInstance($this->clientSecret);
    }
}
