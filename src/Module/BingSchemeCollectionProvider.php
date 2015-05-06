<?php

namespace Hum2\BingResource\Module;

use BEAR\Resource\AppAdapter;
use BEAR\Resource\SchemeCollection;
use BEAR\Resource\SchemeCollectionInterface;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;
use Ray\Di\InjectorInterface;
use Ray\Di\ProviderInterface;

class BingSchemeCollectionProvider implements ProviderInterface
{
    /**
     * @var string
     */
    private $appName;

    /**
     * @var InjectorInterface
     */
    private $injector;

    /**
     * @var SchemeCollectionInterface
     */
    private $schemeCollection;

    /**
     * @param InjectorInterface         $injector
     * @param SchemeCollectionInterface $schemeCollection
     * @param                           $appName
     *
     * @Inject
     * @Named("schemeCollection=defaultScheme,appName=bing_app_name")
     */
    public function __construct(InjectorInterface $injector, SchemeCollectionInterface $schemeCollection, $appName)
    {
        $this->appName          = $appName;
        $this->injector         = $injector;
        $this->schemeCollection = $schemeCollection;
    }

    /**
     * Return instance
     *
     * @return SchemeCollection
     */
    public function get()
    {
        $appAdapter = new AppAdapter($this->injector, $this->appName);
        $this->schemeCollection->scheme('app')->host('bing')->toAdapter($appAdapter);

        return $this->schemeCollection;
    }
}
