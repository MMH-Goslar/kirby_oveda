<div class="md:flex col-span-1 max-w-md mx-auto rounded-xl shadow-md overflow-hidden md:max-w-2xl m-5">
                        <div class="md:flex-shrink-0">
                            <img class="h-48 w-full object-cover md:w-48"
                                src="<?= isset($event->image) ? $event->image : $page->cover() ?>" alt="Event image">
                        </div>
                        <div class="p-8">
                            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold"><?= $event->name ?></div>
                            <?php foreach ($event->date_definitions as $date): ?>
                                <?php if (isset($date->reccurrence_rule)): ?>
                                    <p class="block mt-1 text-lg leading-tight font-medium text-black"><?= $date->reccurrence_rule ?>
                                        <?= $date->start->format("H:i") ?> - <?= $date->end ? $date->end->format("H:i") : "" ?></p>
                                <?php else: ?>
                                    <?php if ($date->allday): ?>
                                        <p class="block mt-1 text-lg leading-tight font-medium text-black"><?= $date->start->format("d.m.Y") ?> -
                                            <?= $date->end ? $date->end->format("d.m.Y") : "" ?></p>
                                    <?php else: ?>
                                        <p class="block mt-1 text-lg leading-tight font-medium text-black">
                                            <?= $date->start->format("d.m.Y - H:i") ?> - <?= $date->end ? $date->end->format("d.m.Y H:i") : "" ?>
                                        </p>

                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <p class="mt-2 text-gray-500"><?= substr($event->description, 0, 150) ?></p>
                        </div>
                    </div>