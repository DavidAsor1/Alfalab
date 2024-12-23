<?php

$id = $block['id'];
$class = sanitize_title($block['name']);
$group = get_field('our_services');
$items = $group['items'] ?? [];
$section_title = $group['title'] ?? '';
?>
<section class="section section-padding mt-5 pt-5 <?= $class ?>" id="Our-Services">
    <div class="container">
        <div class="h1 bold color-black my-4 text-center">
            <?= $section_title ?>
        </div>
        <div class="row">
            <?php
            foreach ($items as $key => $item):
                $icon = $item['icon'] ?? [];
                $icon_id = $icon['id'] ?? 0;
                $title = $item['title'] ?? '';
                $paragraph = $item['paragraph'] ?? '';
                ?>
                <div class="col-md-3 col-6 mb-3">
                    <div class="bg-light position-relative our-service-item p-3 overflow-hidden d-flex flex-column">
                        <div class="side-image position-absolute top-0 left-0">
                            <div class="circle our-service-circle"></div>
                        </div>
                        <div class="our-service-icon w-fit p-2">
                            <?= load_image($icon_id); ?>
                        </div>
                        <div class="services-title mt-3 color-black bold">
                            <?= $title ?>
                        </div>
                        <div class="mt-md-4 mt-2">
                            <?= $paragraph ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="position-absolute left-0 side-circle">
        <?= load_image(266) ?>
    </div>
</section>