<?php get_header(); ?>

<div class="single-post-content">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile;
    else : ?>
        <p>No content found.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
