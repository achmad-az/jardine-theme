<?php

namespace jardine\Util;

class Metabox
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
        $this->loadMetabox();
    }

    public function loadMetabox()
    {
        require B_BASEDIR . '/inc/admin/metaboxes.php';
    }
}
