<?php

use Kirby\Events\Events;
use Kirby\Events\SearchAttributes;

$oveda_search; //from Template

?>

<?php if($oveda_search->exists() && $search = $oveda_search->toObject()): ?>
    <?php
        $events_manager = new Events([]);
        $search_attributes = new SearchAttributes(1, 30);

        if($oveda_search->organziers()->isNotEmpty())  {
            $search_attributes->organizer_id = $search->organizer();
        }

        if($oveda_search->start()->isNotEmpty()) {
            var_dump($search->start());
            $search_attributes->date_from = $search->start()->format("Y-m-d")->toString();
        } else {
            $search_attributes->date_from = (new DateTime("now"))->format("Y-m-d");
        }

        $events_manager->search = $search_attributes;

    ?>
    <?php if($events_manager->fetch()): ?>
        <?php $events = $events_manager->events; ?>
        
        

        <div class="list">
            <?php foreach($events as $event): ?>

                <div class="event">
                    <h1> <?= $event->name ?> </h1>
                </div>
            <?php endforeach; ?>






    <?php endif; ?>
<?php else: ?>
    <?php throw new Exception("Kein Oveda Element übergeben");?>
<?php endif; ?>