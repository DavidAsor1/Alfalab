<?php

$id = $block['id'];
$class = sanitize_title($block['name']);
$group = get_field('our_projects');
$logo = $group['logo'] ?? [];
$project_image = $group['project_image'] ?? [];
$project_image_id = $project_image['id'] ?? 0;
$logo_id = $logo['id'] ?? 0;
$title = $group['title'] ?? '';
$description = $group['description'] ?? '';
$button_text = $group['button_text'] ?? '';
$flip_order = $group['flip_order'] ?? 0;
$project_gallery = $group['project_gallery'] ?? [];
$gallery_icon = $group['gallery_icon'] ?? [];
$gallery_icon_image_url = $gallery_icon['url'] ?? $logo['url'] ?? '';
$gallery_content = $group['gallery_content'] ?? '';
?>
<section class="section section-padding mt-5  <?= $class ?>" id="Our-Projects">
    <div class="container">
        <div class="row">
            <div
                class="our-projects-content col-md-4 col-12 d-flex flex-column justify-content-center <?= $flip_order && !wp_is_mobile() ? 'order-2' : '' ?>">
                <div class="logo w-100">
                    <?= load_image($logo_id); ?>
                </div>
                <!-- <div class="color-black bold h2 my-3">
                    <?= $title ?>
                </div> -->
                <p class="description mb-3">
                    <?= $description; ?>
                </p>
                <div class="btn btn-primary max-w-fit open-gallery" data-content="<?= $gallery_content ?>"
                    data-icon="<?= $gallery_icon_image_url ?>" data-gallery="project-gallery-<?= $id ?>">
                    <?= $button_text ?>
                </div>
                <?php if ($project_gallery):

                    ?>
                    <div class="hidden-gallery" style="display:none;">
                        <?php foreach ($project_gallery as $key => $image): ?>
                            <a href="<?php echo esc_url($image['url']); ?>" data-fancybox="project-gallery-<?= $id ?>"
                                data-caption="<?= esc_attr($image['alt']); ?>">
                                <img loading="lazy" src="<?php echo esc_url($image['url']); ?>"
                                    alt="<?php echo esc_attr($image['alt']); ?>" />
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>
            <div class="col-md-8 col-12  <?= $flip_order && !wp_is_mobile() ? 'order-1' : '' ?>">
                <div class="w-100 <?= !$flip_order ? 'text-start' : '' ?>">
                    <?= load_image($project_image_id, 'mt-md-0 mt-5') ?>
                </div>
            </div>
        </div>
    </div>
</section>