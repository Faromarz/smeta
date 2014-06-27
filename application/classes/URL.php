<?php
class URL extends Kohana_URL
{
    public static function site($uri = '', $protocol = NULL, $index = TRUE)
    {
        return parent::site($uri, $protocol, $index);
    }

    public static function media($uri = '', $protocol = NULL, $index = TRUE)
    {
        return parent::site($uri, $protocol, $index);
    }

    public static function current($protocol = null, $index = true)
    {
        $uri = Request::initial()->uri();
        return parent::site($uri, $protocol, $index);
    }
}