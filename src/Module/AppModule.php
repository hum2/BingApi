<?php

namespace Hum2\BingApi\Module;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Hum2\BingApi\Module\Annotation\AzureAccessToken;
use Hum2\BingApi\Resource\App\Transfer;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

class AppModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bind()->annotatedWith('bing_app_name')->toInstance('Hum2\BingApi');
        $this->bind(ClientInterface::class)->to(Client::class)->in(Scope::SINGLETON);

        $this->bindInterceptor(
            $this->matcher->annotatedWith(AzureAccessToken::class),
            $this->matcher->any(),
            [AccessTokenInterceptor::class]
        );
    }
}
