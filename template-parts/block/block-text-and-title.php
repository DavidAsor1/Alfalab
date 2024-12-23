<?php

$id = $block['id'];
$class = sanitize_title($block['name']);
$group = get_field('text_and_title');
$title = $group['title'] ?? '';
$paragraph = $group['paragraph'] ?? '';
?>
<section class="section position-relative section-padding mt-5 mb-5 <?= $class ?>" id="<?= $id ?>">
    <div class="container text-center">
        <div class="h1 bolder color-black my-4">
            <?= $title ?>
        </div>
        <p>
            <?= $paragraph ?>
        </p>
    </div>
    <div class="position-absolute right-0 side-circle">
        <?= load_image(267) ?>
    </div>
</section>