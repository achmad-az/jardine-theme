<?php

namespace jardine\Util;

class Hook 
{
    private static $instance;

    public static function loadInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function __construct()
    {
        $this->loadHooks();
    }

    public function loadHooks()
    {
        require B_BASEDIR . '/inc/hooks.php';
    }
}
