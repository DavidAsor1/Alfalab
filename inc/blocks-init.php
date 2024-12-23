<?php

add_action('acf/init', 'my_acf_init');
function my_acf_init()
{

    if (function_exists('acf_register_block')):

        acf_register_block(
            array(
                'name' => 'banner_section',
                'title' => __('Banner Section'),
                'description' => __('A custom Banner Section block.'),
                'render_callback' => 'my_acf_block_render_callback',
                'category' => 'formatting',
                'icon' => 'admin-comments',
                'keywords' => array('Banner'),
                'example' => array(
                    'attributes' => array(
                        'mode' => 'preview',
                        'data' => array(
                            'preview_image_help' => get_template_directory_uri() . '/images/banner_section.jpg',
                        )
                    )
                )
            )
        );

        acf_register_block(
            array(
                'name' => 'about_us',
                'title' => __('Abouts Us'),
                'description' => __('A custom Abouts Us block.'),
                'render_callback' => 'my_acf_block_render_callback',
                'category' => 'formatting',
                'icon' => 'admin-comments',
                'keywords' => array('Abouts Us'),
                'example' => array(
                    'attributes' => array(
                        'mode' => 'preview',
                        'data' => array(
                            'preview_image_help' => get_template_directory_uri() . '/images/about_us.jpg',
                        )
                    )
                )
            )
        );

        acf_register_block(
            array(
                'name' => 'our_services',
                'title' => __('Our Services'),
                'description' => __('A custom Our Services block.'),
                'render_callback' => 'my_acf_block_render_callback',
                'category' => 'formatting',
                'icon' => 'admin-comments',
                'keywords' => array('Our Services'),
                'example' => array(
                    'attributes' => array(
                        'mode' => 'preview',
                        'data' => array(
                            'preview_image_help' => get_template_directory_uri() . '/images/our_services.jpg',
                        )
                    )
                )
            )
        );

        //Technologies We Use

        acf_register_block(
            array(
                'name' => 'technologies_we_use',
                'title' => __('Technologies We Use'),
                'description' => __('A custom Technologies We Use block.'),
                'render_callback' => 'my_acf_block_render_callback',
                'category' => 'formatting',
                'icon' => 'admin-comments',
                'keywords' => array('Technologies We Use'),
                'example' => array(
                    'attributes' => array(
                        'mode' => 'preview',
                        'data' => array(
                            'preview_image_help' => get_template_directory_uri() . '/images/technologies_we_use.jpg',
                        )
                    )
                )
            )
        );

        acf_register_block(
            array(
                'name' => 'our_projects',
                'title' => __('Our Projects'),
                'description' => __('A custom Our Projects block.'),
                'render_callback' => 'my_acf_block_render_callback',
                'category' => 'formatting',
                'icon' => 'admin-comments',
                'keywords' => array('Our Projects'),
                'example' => array(
                    'attributes' => array(
                        'mode' => 'preview',
                        'data' => array(
                            'preview_image_help' => get_template_directory_uri() . '/images/our_projects.jpg',
                        )
                    )
                )
            )
        );

        acf_register_block(
            array(
                'name' => 'contact_us',
                'title' => __('Contact Us'),
                'description' => __('A custom Contact Us block.'),
                'render_callback' => 'my_acf_block_render_callback',
                'category' => 'formatting',
                'icon' => 'admin-comments',
                'keywords' => array('Contact Us'),
                'example' => array(
                    'attributes' => array(
                        'mode' => 'preview',
                        'data' => array(
                            'preview_image_help' => get_template_directory_uri() . '/images/contact_us.jpg',
                        )
                    )
                )
            )
        );

        acf_register_block(
            array(
                'name' => 'text_and_title',
                'title' => __('Text And Title'),
                'description' => __('A custom Text And Title block.'),
                'render_callback' => 'my_acf_block_render_callback',
                'category' => 'formatting',
                'icon' => 'admin-comments',
                'keywords' => array('Text And Title'),
                'example' => array(
                    'attributes' => array(
                        'mode' => 'preview',
                        'data' => array(
                            'preview_image_help' => get_template_directory_uri() . '/images/text_and_title.jpg',
                        )
                    )
                )
            )
        );

    endif;

}