<?php

$id = $block['id'];
$class = sanitize_title($block['name']);
$banner_group = get_field("banner_group");
$banner_mobile = $banner_group['banner_mobile'] ?? [];
$banner_desktop = $banner_group['banner_desktop'] ?? [];
$banner = wp_is_mobile() ? $banner_mobile['id'] ?? 0 : $banner_desktop['id'] ?? 0;
$title_line_1 = $banner_group['title_line_1'] ?? '';
$title_line_2 = $banner_group['title_line_2'] ?? '';
$title_line_3 = $banner_group['title_line_3'] ?? '';
$title_line_3 = isset($title_line_3['id']) ? load_image($title_line_3['id'], "alphalab-banner-logo") : $title_line_3;

$sub_title = $banner_group['sub_title'] ?? '';
$banner_bottom = $banner_group['banner_bottom'] ?? [];
$banner_bottom_id = $banner_bottom['id'] ?? 0;
$image = $banner_group['image'] ?? [];
$image_id = $image['id'] ?? 0;
$sub_title_image = $banner_group['sub_title_image'] ?? [];
$sub_title_image_id = $sub_title_image['id'] ?? 0;
?>
<section class="section section-padding position-relative <?= $class ?>" id="<?= $id ?>">
    <div class="container-fluid p-0">
        <?= load_image($banner, 'w-100 main-website-banner', false); ?>
        <div class="position-absolute center-absoulte w-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-12 d-flex flex-column justify-content-center banner-main-content">
                        <h1 class="h1">
                            <div class="d-flex align-items-center">
                                <span class="font-weight-light"><?= $title_line_1 ?></span>
                                <span class="mx-3"><?= load_image(103, "arrow-icon-banner", false) ?></span>
                            </div>
                            <span class="bold gradient-primary-text">
                                <?= $title_line_2 ?>
                            </span>
                        </h1>
                        <div class="sub-title bold">
                            <span><?= $sub_title ?></span>
                            <span><?= load_image($sub_title_image_id, 'mini-logo', false); ?></span>
                        </div>
                        <div class="d-flex gap-4 mt-4">
                            <a class="btn btn-secondary"
                                href="https://wa.me/message/M4ZVKGMLGH5JI1"><?= __('דברו איתנו', TRANSLATION_DOMAIN); ?></a>
                            <a class="btn btn-primary"
                                href="#About-Us"><?= __('בואו נתחיל!', TRANSLATION_DOMAIN); ?></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 text-center mt-md-0 mt-4">
                        <?= load_image($image_id, "banner-image", false); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= load_image($banner_bottom_id, 'w-100 position-absolute banner-bottom-strip', false); ?>