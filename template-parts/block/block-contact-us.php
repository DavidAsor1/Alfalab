<?php

$id = $block['id'];
$class = sanitize_title($block['name']);
$group = get_field('contact_us_group');
$paragraph = $group['paragraph'] ?? '';
$title = $group['title'] ?? '';
$contact_us_repeater = $group['contact_us_repeater'] ?? [];
$cf7_shortcode = $group['cf7_shortcode'] ?? '';
$background_image = $group['background_image'] ?? [];
$background_id = $background_image['id'] ?? 0;
?>
<section class="section section-padding my-5 position-relative <?= $class ?>" id="Contact-Us">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 col-12 mb-md-0 mb-3">
                <div class="wrap w-100 position-relative">
                    <?= load_image($background_id, 'w-100'); ?>
                    <div class="position-absolute text-white bottom-0 w-100 text-start p-4">
                        <?php
                        $social_settings = getSettingPageField('social');

                        echo get_template_part(
                            'template-parts/components/social-contact-us-icons',
                            null,
                            array(
                                'contact_us_repeater' => $social_settings['social_contact_us'] ?? [],
                            )
                        );
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-12">
                <div class="contact-form">
                    <h2 class="color-black h1 bold"><?= $title ?></h2>
                    <p class="color-black"><?= $paragraph ?></p>
                    <?= do_shortcode($cf7_shortcode); ?>
                </div>
            </div>
        </div>
        <div class="position-absolute left-0 side-circle top-0">
            <?= load_image(266) ?>
        </div>
</section>