<?php

namespace Tests\Hum2\BingApi\Fake;

use BEAR\Resource\ResourceObject;

class FakeResource extends ResourceObject
{
    public function onGet()
    {
        return $this;
    }
}
