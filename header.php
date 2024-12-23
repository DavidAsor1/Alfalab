<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-P2L6PSS6');</script>
</head>

<body <?php body_class("rtl"); ?>>
     <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P2L6PSS6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <header class="py-2 position-fixed w-100 top-0 right-0 bg-white shadow">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-4 logo">
                    <?php
                    $header_settings = getSettingPageField('header');
                    $logo = $header_settings['logo'] ?? [];
                    $logo_image_id = $logo['id'] ?? 0;
                    ?>
                    <?= load_image($logo_image_id, "img-fluid header-logo-image", false); ?>
                </div>
                <div class="col-md-6 col">
                    <nav class="main-menunavbar navbar-expand-lg navbar-light">
                        <button class="navbar-toggler me-auto" type="button" data-toggle="collapse"
                            data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse bg-white" id="navbarNav">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'primary',
                                    'menu_class' => 'nav-menu navbar-nav ml-auto',
                                    'container' => false,
                                    'walker' => new WP_Bootstrap_Navwalker(),
                                )
                            );
                            ?>
                            <div class="col-2 d-md-none mobile-contact-us">
                                <div class="contact-us">
                                    <a href="#Contact-Us" class="btn btn-primary">צור קשר</A>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-2 d-md-block d-none">
                    <div class="contact-us">
                        <a href="#Contact-Us" class="btn btn-primary">צור קשר</A>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="content" class="site-content">