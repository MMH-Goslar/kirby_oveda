<?php

use Kirby\Events\Events;
use Kirby\Events\SearchAttributes;

$oveda_search; //from Template

?>

<?php if ($oveda_search->exists() && $search = $oveda_search->toObject()): ?>
    <?php
    $events_manager = new Events([]);
    $search_attributes = new SearchAttributes(1, 6);

    if ($oveda_search->organziers()->isNotEmpty()) {
        $search_attributes->organizer_id = $search->organizer();
    }

    if ($oveda_search->start()->isNotEmpty()) {
        $search_attributes->date_from = $search->start()->format("Y-m-d")->toString();
    } else {
        $search_attributes->date_from = (new DateTime("now"))->format("Y-m-d");
    }

    $events_manager->search = $search_attributes;

    ?>
    <?php if ($events_manager->fetch()): ?>
        <?php $events = $events_manager->events; ?>

    <div class="events mt-4 mb-2">

        <h1> Veranstaltungen </h1>

        <div class="list  bg-white grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 gap-3">
            <?php foreach ($events as $event): ?>
                <div class="md:flex col-span-1 max-w-md mx-auto rounded-xl shadow-md overflow-hidden md:max-w-2xl m-5">
                    <div class="md:flex-shrink-0">
                        <img class="h-48 w-full object-cover md:w-48" src="<?= isset($event->image) ? $event->image : $page->cover() ?>"
                            alt="Event image">
                    </div>
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold"><?= $event->name ?></div>
                        <?php foreach($event->date_definitions as $date):?>
                            <?php if(isset($date->reccurrence_rule)): ?>
                                <p class="block mt-1 text-lg leading-tight font-medium text-black"><?=$date->reccurrence_rule?> <?= $date->start->format("H:i") ?> - <?=$date->end ? $date->end->format("H:i") : ""?></p>
                            <?php else: ?>
                                <?php if($date->allday) : ?>
                                    <p class="block mt-1 text-lg leading-tight font-medium text-black"><?=$date->start->format("d.m.Y") ?> - <?=$date->end ? $date->end->format("d.m.Y") : ""?></p>
                                <?php else: ?>
                                    <p class="block mt-1 text-lg leading-tight font-medium text-black"><?=$date->start->format("d.m.Y - H:i") ?> - <?=$date->end ? $date->end->format("d.m.Y H:i") : ""?></p>

                                <?php endif;    ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <p class="mt-2 text-gray-500"><?= substr($event->description, 0, 150) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <p class="text-black"> powered by: <a class="text-gold" href="https://oveda.de">Oveda</a> Goslar </p>

            </div>






    <?php endif; ?>
<?php else: ?>
    <?php throw new Exception("Kein Oveda Element übergeben"); ?>
<?php endif; ?>