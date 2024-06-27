<?php

use Kirby\Toolkit\I18n;
use Kirby\Events\Places;

$places = Places::fetch_orgas()->places;
$options = [];
//var_dump( $organisations );
$i = 0;
foreach( $places as $place => $value ) {
    $options[$value->id] = [
      "value" => $value->id,
      "text" => $value->name
    ];
}

return [
    'label'  => 'Ort',
    'options' => $options,
    'type' => 'select'
];
?>