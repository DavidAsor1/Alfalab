<div class="d-flex gap-2">
    <?php
    $icons = isset($args['icons']) ? $args['icons'] : [];
    if (!empty($icons)):
        foreach ($icons as $icon):
            $icon_image = $icon['icon'] ?? 0;
            $icon_link = $icon['link'] ?? '';
            ?>
            <div class="contact-us-icon social-icons bg-primary">
                <a href="<?= $icon_link ?>">
                    <?= load_image($icon_image); ?>
                </a>
            </div>
            <?php
        endforeach; 
    endif;
    ?>
</div>