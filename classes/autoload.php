<?php

spl_autoload_register(function($class) {
    $file = str_replace('\\', '/', $class);
    
    $class = get_template_directory() . '/classes' . '/' . $file . '.php';

    if (is_file($class)) {
        include($class);
    }
});