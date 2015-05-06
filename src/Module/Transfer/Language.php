<?php

namespace Hum2\BingResource\Module\Transfer;

/**
 * Class Language
 * @package Hum2\BingResource\Module\Transfer
 * @see     https://msdn.microsoft.com/en-us/library/hh456380.aspx
 */
class Language
{
    /**
     * @const string
     */
    const ARABIC = 'ar';
    const BOSNIAN = 'bs-Latn';
    const BULGARIAN = 'bg';
    const CATALAN = 'ca';
    const CHINESE_SIMPLIFIED = 'zh-CHS';
    const CHINESE_TRADITIONAL = 'zh-CHT';
    const CROATIAN = 'hr';
    const CZECH = 'cs';
    const DANISH = 'da';
    const DUTCH = 'nl';
    const ENGLISH = 'en';
    const ESTONIAN = 'et';
    const FINNISH = 'fi';
    const FRENCH = 'fr';
    const GERMAN = 'de';
    const GREEK = 'el';
    const HAITIAN_CREOLE = 'ht';
    const HEBREW = 'he';
    const HINDI = 'hi';
    const HMONG_DAW = 'mww';
    const HUNGARIAN = 'hu';
    const INDONESIAN = 'id';
    const ITALIAN = 'it';
    const JAPANESE = 'ja';
    const KLINGON = 'tlh';
    const KLINGON_QAAK = 'tlh-Qaak';
    const KOREAN = 'ko';
    const LATVIAN = 'lv';
    const LITHUANIAN = 'lt';
    const MALAY = 'ms';
    const MALTESE = 'mt';
    const NORWEGIAN = 'no';
    const PERSIAN = 'fa';
    const POLISH = 'pl';
    const PORTUGUESE = 'pt';
    const QUERETARO_OTOMI = 'otq';
    const ROMANIAN = 'ro';
    const RUSSIAN = 'ru';
    const SERBIAN_CYRILLIC = 'sr-Cyrl';
    const SERBIAN_LATIN = 'sr-Latn';
    const SLOVAK = 'sk';
    const SLOVENIAN = 'sl';
    const SPANISH = 'es';
    const SWEDISH = 'sv';
    const THAI = 'th';
    const TURKISH = 'tr';
    const UKRAINIAN = 'uk';
    const URDU = 'ur';
    const VIETNAMESE = 'vi';
    const WELSH = 'cy';
    const YUCATEC_MAYA = 'yua';

    /**
     * @param $lang
     *
     * @return bool
     */
    public static function isAllowLanguage($lang)
    {
        $languages = [
            self::ARABIC,
            self::BOSNIAN,
            self::BULGARIAN,
            self::CATALAN,
            self::CHINESE_SIMPLIFIED,
            self::CHINESE_TRADITIONAL,
            self::CROATIAN,
            self::CZECH,
            self::DANISH,
            self::DUTCH,
            self::ENGLISH,
            self::ESTONIAN,
            self::FINNISH,
            self::FRENCH,
            self::GERMAN,
            self::GREEK,
            self::HAITIAN_CREOLE,
            self::HEBREW,
            self::HINDI,
            self::HMONG_DAW,
            self::HUNGARIAN,
            self::INDONESIAN,
            self::ITALIAN,
            self::JAPANESE,
            self::KLINGON,
            self::KLINGON_QAAK,
            self::KOREAN,
            self::LATVIAN,
            self::LITHUANIAN,
            self::MALAY,
            self::MALTESE,
            self::NORWEGIAN,
            self::PERSIAN,
            self::POLISH,
            self::PORTUGUESE,
            self::QUERETARO_OTOMI,
            self::ROMANIAN,
            self::RUSSIAN,
            self::SERBIAN_CYRILLIC,
            self::SERBIAN_LATIN,
            self::SLOVAK,
            self::SLOVENIAN,
            self::SPANISH,
            self::SWEDISH,
            self::THAI,
            self::TURKISH,
            self::UKRAINIAN,
            self::URDU,
            self::VIETNAMESE,
            self::WELSH,
            self::YUCATEC_MAYA,
        ];

        return in_array($lang, $languages);
    }
}