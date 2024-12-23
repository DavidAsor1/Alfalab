<?php 
$contact_us_repeater = isset($args['contact_us_repeater']) ? $args['contact_us_repeater'] : [];
if (!empty($contact_us_repeater)): ?>
    <?php foreach ($contact_us_repeater as $item):
        $icon = $item['icon'] ?? [];
        $icon_id = $icon['id'] ?? 0;
        ?>
        <div class="d-flex gap-4 mb-3">
            <div class="contact-us-icon bg-primary">
                <?= load_image($icon_id); ?>
            </div>
            <div class="text-end">
                <h5 class="mb-0"><?= $item['title'] ?? '' ?></h5>
                <p class="mb-0"><?= $item['paragraph'] ?? '' ?></p>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>