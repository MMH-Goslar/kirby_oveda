<?php

foreach($events as $event) {

  $html .= snippet('oveda_element', ['event' => $event], true);

}
$json['html'] = $html;
$json['more'] = $more;

echo json_encode($json);