<div class="c-element event_list_item">

            <a href="<?=$event->link?>">
            <?php foreach ($event->date_definitions as $key => $date): ?>
                <?php if ($key < 2): ?>
                    <?php if (isset($date->reccurrence_rule)): ?>
                        <time class="block mt-1 text-sm leading-tight font-medium text-black"><?= $date->reccurrence_rule ?>
                            <?= $date->start->format("H:i") ?><?= $date->end ? " - ".$date->end->format("H:i") : "" ?></time>
                    <?php else: ?>
                        <?php if ($date->allday): ?>
                            <time class="block mt-1 text-sm leading-tight font-medium text-black"><?= $date->start->format("d.m.Y") ?>
                                <?= $date->end ? " - ".$date->end->format("d.m.Y") : "" ?></time>
                        <?php else: ?>
                            <time class="block mt-1 text-sm leading-tight font-medium text-black">
                                <?= $date->start->format("d.m.Y - H:i") ?><?= $date->end ? " - ".$date->end->format("d.m.Y H:i") : "" ?>
                        </time>

                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

            <?php endforeach; ?>
            <?php if(count($event->date_definitions) > 2): ?>
                <p class="block mt-1 text-lg leading-tight font-medium text-black">...</p>
            <?php endif; ?>
            </a>
        <div class="uppercase tracking-wide text-lg text-gold-700 font-semibold"><?= $event->name ?></div>

        <p class="mt-2 text-body line-clamp-3"><?= substr($event->description, 0, 150) ?></p>
</div>