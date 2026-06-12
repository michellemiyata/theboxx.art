<?php
/**
 * Main fallback file
 */
get_header();
?>
<main class="container" style="padding: var(--header-height) 0 8rem 0;">
    <article style="max-width: 800px; margin: 4rem auto 0 auto;">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h1 class="section-title"><?php the_title(); ?></h1>
            <div class="entry-content" style="margin-top: 2rem; font-size: 1.1rem; line-height: 1.8;">
                <?php the_content(); ?>
            </div>
        <?php endwhile; else : ?>
            <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'theboxx' ); ?></p>
        <?php endif; ?>
    </article>
</main>
<?php
get_footer();
