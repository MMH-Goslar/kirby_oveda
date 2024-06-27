<?php

use Kirby\Toolkit\I18n;
use Kirby\Events\Organizations;

$organisations = Organizations::fetch_orgas()->organizations;
$options = [];
//var_dump( $organisations );
$i = 0;
foreach( $organisations as $organization => $value ) {
    $options[$value->id] = [
      "value" => $value->id,
      "text" => $value->name
    ];
}

return [
    'label'  => 'Veranstalter',
    'options' => $options,
    'type' => 'select'
];
?>