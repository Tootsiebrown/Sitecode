<?php

include base_path('vendor/oohology/wax-cms/modules/vintage/structures/carousel.php');

$structure['table'] = 'slides';

$structure['fields'][] = [
    'name' => 'background_image',
    'display_name' => 'Background Image',
    'type' => 'image',
    'path' => upload_src_url('carousel/bg', true),
    'prefix' => '',
    'required' => false,
    'bind' => false,
];
