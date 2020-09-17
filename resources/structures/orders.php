<?php

include base_path('vendor/oohology/wax-shop/resources/structures/orders.php');

$structure['filters'] = [
    '' => [ // this filter is selected by default since the key name is blank
        'label' => 'Show All',
        'use_structure_params' => true,
        'structure_params_operator' => 'and',
        'params' => '1=1'
    ],
    'to-ship' => [
        'label' => 'Awaiting Shipment',
        'use_structure_params' => true,
        'structure_params_operator' => 'and',
        'params' => 'shipped_at IS NULL'
    ],
    'shipped' => [
        'label' => 'Shipped',
        'use_structure_params' => true,
        'structure_params_operator' => 'and',
        'params' => 'shipped_at IS NOT NULL'
    ],
    'to-process' => [
        'label' => 'Awaiting processing',
        'use_structure_params' => true,
        'structure_params_operator' => 'and',
        'params' => 'processed_at IS NULL'
    ],
    'processed' => [
        'label' => 'Processed',
        'use_structure_params' => true,
        'structure_params_operator' => 'and',
        'params' => 'processed_at IS NOT NULL'
    ],
];
