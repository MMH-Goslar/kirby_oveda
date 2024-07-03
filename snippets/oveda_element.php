<div class="md:flex col-span-1 max-w-md mx-auto rounded-xl shadow-md overflow-hidden md:max-w-2xl m-5">
    <div class="md:flex-shrink-0">
        <img class="h-48 w-full object-cover md:w-48"
            src="<?= isset($event->image) ? $event->image : $page->cover() ?>" alt="Event image">
    </div>
    <div class="p-8">

        <a href="<?= $event->link ?>"><div class="uppercase tracking-wide text-sm text-gold-500 font-semibold"><?= $event->name ?></div></a>

        <div class="date_section">
            <?php if(count($event->date_definitions) > 1): ?>
            <button id="dropdownMenuIconButton" data-dropdown-toggle="tooglable_<?=$event->id?>" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                </svg>
            </button> 
            <?php endif; ?>

            <?php foreach ($event->date_definitions as $key => $date): ?>
                <div class="date_elements <?=$key == 0 ? '' : 'hidden'?>" id="<?=$key == 0 ? "first_date" : "tooglable_".$event->id ?>">
                <?php if (isset($date->reccurrence_rule)): ?>
                    <p class="block mt-1 text-lg leading-tight font-medium text-black"><?= $date->reccurrence_rule ?>
                        <?= $date->start->format("H:i") ?> - <?= $date->end ? $date->end->format("H:i") : "" ?></p>
                <?php else: ?>
                    <?php if ($date->allday): ?>
                        <p class="block mt-1 text-lg leading-tight font-medium text-black"><?= $date->start->format("d.m.Y") ?> 
                            <?= $date->end && ($date->end > $date->start) ? " - ".$date->end->format("d.m.Y") : "" ?></p>
                    <?php else: ?>
                        <p class="block mt-1 text-lg leading-tight font-medium text-black">
                            <?= $date->start->format("d.m.Y - H:i") ?> - <?= $date->end ? $date->end->format("d.m.Y H:i") : "" ?>
                        </p>

                    <?php endif; ?>
                <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="mt-2 text-gray-500"><?= substr($event->description, 0, 150) ?></p>
    </div>
</div>