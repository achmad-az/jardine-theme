<?php

add_filter('acf/settings/load_json', 'acfLoadEndPoint');
add_filter('acf/settings/save_json', 'acfSaveEndPoint');

function acfLoadEndPoint() {
    return get_template_directory() . '/blocks/json';
}

function acfSaveEndPoint() {
    return get_template_directory() . '/blocks/json';
}