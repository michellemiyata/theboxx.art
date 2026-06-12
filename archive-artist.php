<?php get_header(); ?>

  <!-- Page Header -->
  <section class="exhibits-header" style="background-image: url('<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/leadership-banner.jpeg');">
    <div class="container">
      <h1 class="section-title" style="color: #ffffff; margin-bottom: 0;">Featured Artists</h1>
      <p style="color: rgba(255, 255, 255, 0.8); font-size: 1.1rem; margin-top: 0.5rem; letter-spacing: 1px; text-transform: uppercase;">Meet the Creators &amp; Curators of The Boxx</p>
    </div>
  </section>

  <!-- Main Artists Grid -->
  <section class="section container">
    <div class="exhibition-grid-header" style="margin-top: 0; margin-bottom: 4rem;">
      <h2 class="grid-title">Featured Artists</h2>
      <p class="grid-subtitle">Explore biographies, design quotes, and recent showcases by our roster of creators.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 3rem;">
      
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
          $artist_style = get_post_meta( get_the_ID(), 'artist_style', true ) ?: 'Visual Artist';
          $artist_medium = get_post_meta( get_the_ID(), 'artist_medium', true ) ?: 'Mixed Media';
          ?>
          <div class="past-exhibit-card" style="background: #ffffff; border: 1px solid var(--border-color); padding: 0.75rem; display: flex; flex-direction: column; cursor: pointer; transition: var(--transition-smooth);" onclick="location.href='<?php the_permalink(); ?>'">
            <div style="overflow: hidden; height: 350px; border-bottom: 1px solid var(--border-color); position: relative;">
              <?php if ( has_post_thumbnail() ) : ?>
                  <?php the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: 100%; object-fit: cover; filter: grayscale(100%); transition: var(--transition-smooth);' ) ); ?>
              <?php else : ?>
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/abballe_portrait.jpg" alt="<?php the_title_attribute(); ?>" style="width: 100%; height: 100%; object-fit: cover; filter: grayscale(100%);">
              <?php endif; ?>
              <span style="position: absolute; bottom: 1rem; left: 1rem; background: #000000; color: #ffffff; padding: 0.4rem 0.8rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;"><?php echo esc_html( $artist_medium ); ?></span>
            </div>
            <div style="padding: 1.5rem 0.5rem 0.5rem 0.5rem;">
              <h3 style="font-size: 1.5rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;"><?php the_title(); ?></h3>
              <p style="font-style: italic; font-size: 0.9rem; margin-bottom: 1rem; color: var(--primary-color);"><?php echo esc_html( $artist_style ); ?></p>
              <p style="font-size: 0.95rem; line-height: 1.6; color: var(--text-light); margin-bottom: 1.5rem;"><?php the_excerpt(); ?></p>
              <span class="btn-primary" style="display: inline-block; padding: 0.6rem 1.2rem; font-size: 0.8rem; border-color: var(--text-dark); background: transparent; color: var(--text-dark); text-align: center; width: 100%;">View Artist Profile</span>
            </div>
          </div>
      <?php endwhile; else : ?>
          <p><?php esc_html_e( 'No artists found.', 'theboxx' ); ?></p>
      <?php endif; ?>

    </div>
  </section>

<?php get_footer(); ?>
