<?php

namespace Hum2\BingResource\Module;

use BEAR\Package\PackageModule;
use BEAR\Resource\Module\SchemeCollectionProvider;
use BEAR\Resource\SchemeCollectionInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Hum2\BingResource\Resource\App\Transfer;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

class BingResourceModule extends AbstractModule
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
        $this->bind()->annotatedWith('bing_app_name')->toInstance('Hum2\BingResource');
        $this->bind(SchemeCollectionInterface::class)->annotatedWith('defaultScheme')->toProvider(SchemeCollectionProvider::class);
        $this->bind(SchemeCollectionInterface::class)->toProvider(BingSchemeCollectionProvider::class)->in(Scope::SINGLETON);
        $this->bind(ClientInterface::class)->to(Client::class)->in(Scope::SINGLETON);
        $this->bind()->annotatedWith('azure_client_id')->toInstance($this->clientId);
        $this->bind()->annotatedWith('azure_client_secret')->toInstance($this->clientSecret);

        $this->bindInterceptor(
            $this->matcher->subclassesOf(Transfer::class),
            $this->matcher->logicalOr(
                $this->matcher->startsWith('onGet'),
                $this->matcher->startsWith('onPost'),
                $this->matcher->startsWith('onPut'),
                $this->matcher->startsWith('onDelete')
            ),
            [AccessTokenInterceptor::class]
        );
    }
}
