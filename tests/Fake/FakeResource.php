<?php

namespace Tests\Hum2\BingResource\Fake;

use BEAR\Resource\ResourceObject;

class FakeResource extends ResourceObject
{
    public function onGet()
    {
        return $this;
    }
}
