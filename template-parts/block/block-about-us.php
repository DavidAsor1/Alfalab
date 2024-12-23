<?php

$id = $block['id'];
$class = sanitize_title($block['name']);
$group = get_field('about_us');
$flip_order = $group['flip_order'] ?? false;
$images_repeater = $group['images_repeater'] ?? [];
$tags_repeater = $group['tags_repeater'] ?? [];
$title = $group['title'] ?? '';
$paragraph = $group['paragraph'] ?? '';
?>
<section class="section section-padding mt-5 pt-5 <?= $class ?>" id="About-Us">
    <div class="container">
        <div class="row justify-content-md-between">
            <div
                class="col-md-6 col-12 d-flex gap-3 <?= $flip_order || wp_is_mobile() ? 'order-2 flex-row-reverse' : ''; ?>">
                <?php
                foreach ($images_repeater as $key => $image):
                    $image_id = $image['image']['id'] ?? 0;
                    $is_even = $key % 2 == 0;
                    ?>
                    <div class="about-us-image <?= $is_even ? '' : 'mt-5 pt-5' ?>">
                        <?= load_image($image_id, 'w-auto'); ?>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
            <div class="col-md-6 col-12 d-flex flex-column justify-content-center <?= $flip_order || wp_is_mobile() ? 'order-1' : ''; ?>">
                <?php
                if (!empty($tags_repeater)):
                    foreach ($tags_repeater as $tag):
                        ?>
                        <div class="tag bg-light mb-3 w-fit py-2 px-4">
                            <?= $tag['tag'] ?? '' ?>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
                <div class="h1 color-black bold">
                    <?= $title ?>
                </div>
                <p>
                    <?= $paragraph ?>
                </p>
            </div>
        </div>
    </div>
    <?php if ($flip_order): ?>
        <div class="position-absolute right-0 side-circle">
            <?= load_image(267) ?>
        </div>
    <?php endif; ?>
</section>