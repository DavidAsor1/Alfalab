<?php

$id = $block['id'];
$class = sanitize_title($block['name']);
$group = get_field('technologies_we_use_group');
$items = $group['technologies_we_use_repeater'] ?? [];
$section_title = $group['section_title'] ?? '';
?>
<section class="section section-padding mt-5 <?= $class ?>" id="<?= $id ?>">
    <div class="container">
        <div class="h1 bold color-black my-4 text-center">
            <?= $section_title ?>
        </div>
        <div class="row justify-content-center">
            <?php
            foreach ($items as $key => $item):
                $image = $item['image'] ?? [];
                $image_id = $image['id'] ?? 0;
                $title = $item['title'] ?? '';
                $isLast = $key === array_key_last($items);
                ?>
                <div class="col-md-2 col-4 mb-3">
                    <div
                        class="p-3 tech-item text-center bg-light d-flex align-items-center flex-column justify-content-center">
                        <div class="p-2">
                            <?= load_image($image_id, 'our-services-icon'); ?>
                        </div>
                        <div class="title text-dark bolder mt-auto">
                            <?= $title ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>