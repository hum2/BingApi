<?php

namespace Hum2\BingApi\Resource\App\Transfer;

use BEAR\Resource\ResourceObject;
use Hum2\BingApi\Module\Transfer\Language;

/**
 * Class Languages
 * @package Hum2\BingApi\Resource\App\Transfer
 */
class Languages extends ResourceObject
{
    /**
     * @return array
     */
    public function onGet()
    {
        return [
            Language::ARABIC   => 'アラビア語',
            Language::THAI     => 'タイ語',
            Language::ENGLISH  => '英語',
            Language::FRENCH   => 'フランス語',
            Language::JAPANESE => '日本語',
            Language::GERMAN   => 'ドイツ語',
            Language::KOREAN   => '韓国語',
            Language::RUSSIAN  => 'ロシア語'
        ];
    }
}