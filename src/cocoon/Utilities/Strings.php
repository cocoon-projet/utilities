<?php

namespace Cocoon\Utilities;

use ICanBoogie\Inflector;

/**
 * Class Strings
 * @package Cocoon\Utilities
 */
class Strings
{
    private static $inflector;
    public static $lang;

    public static function slugify($str, $separator = "-")
    {
        $search = ['À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó'
        ,'Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í',
            'î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','A','a','A','a','A','a','C','c',
            'C','c','C','c','C','c','D','d','Ð','d','E','e','E','e','E','e','E','e','E','e','G','g','G',
            'g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','?','?','J','j',
            'K','k','L','l','L','l','L','l','?','?','L','l','N','n','N','n','N','n','?','O','o','O','o',
            'O','o','Œ','œ','R','r','R','r','R','r','S','s','S','s','S','s','Š','š','T','t','T','t','T',
            't','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Ÿ','Z','z','Z','z','Ž',
            'ž','?','ƒ','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u',
            '?','?','?','?','?','?', '\'', '"'];

        $replace = ['A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O'
        ,'O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i',
            'i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C',
            'c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G',
            'g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k',
            'L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE',
            'oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U',
            'u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o',
            'U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O',
            'o', $separator, $separator];

        $slug = str_replace(" ", $separator, $str);
        $slug = str_replace($search, $replace, $slug);
        return strtolower($slug);
    }

    public static function random($length = 16, $withSymbols = false)
    {
        $chaine = 'abcdefghijklmnopkrstuvwxyz';
        $chaine .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chaine .= '0123456789';
        if ($withSymbols) {
            $chaine .= '@*%$=/:,;&#|';
        }
        $i = 0;
        $random = '';
        srand((double)microtime()*1000000);
        while ($i < $length) {
            $value = rand(0, strlen($chaine));
            $random .= substr($chaine, $value, 1);
            $i++;
        }
        return $random;
    }

    public static function token($length = 16)
    {
        return bin2hex(random_bytes($length));
    }

    public static function contains($string, $needle)
    {
           return str_contains($string, $needle);
    }

    public static function limitWords($string, $limit = 10, $append = '...')
    {
        $words = str_word_count($string, 1);
        $result = array_slice($words, 0, $limit);
        return implode(' ', $result) . $append;
    }

    private static function getInflector($lang = 'fr')
    {
        return self::$inflector = Inflector::get($lang);
    }

    public static function plural($string)
    {
        return self::getInflector()->pluralize($string);
    }

    public static function singular($string)
    {
        return self::getInflector()->singularize($string);
    }

    public static function camelize($string)
    {
        return self::getInflector()->camelize($string);
    }

    public static function underscore($string)
    {
        return self::getInflector()->underscore($string);
    }

    public static function humanize($string)
    {
        return self::getInflector()->humanize($string);
    }

    public static function titleize($string)
    {
        return self::getInflector()->titleize($string);
    }

    public static function tableize($string)
    {
        $tableize = self::getInflector()->underscore($string);
        return Strings::plural($tableize);
    }

    public static function unTableize($string)
    {
        $unTableize = Strings::singular($string);
        $str = Strings::camelize($unTableize);
        return ucwords($str);
    }
}
