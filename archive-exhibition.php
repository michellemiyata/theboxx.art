<?php get_header(); ?>

  <!-- Page Header -->
  <section class="exhibits-header" style="background-image: url('<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/exhibition_train.jpg');">
    <div class="container">
      <h1 class="section-title" style="color: #ffffff; margin-bottom: 0;">Our Exhibitions</h1>
      <p style="color: rgba(255, 255, 255, 0.8); font-size: 1.1rem; margin-top: 0.5rem; letter-spacing: 1px; text-transform: uppercase;">Discover Curated Visual Arts at The Boxx</p>
    </div>
  </section>

  <!-- Main Exhibitions Grid -->
  <section class="section container">
    <div class="exhibition-grid-header" style="margin-top: 0; margin-bottom: 4rem;">
      <h2 class="grid-title">All Exhibitions</h2>
      <p class="grid-subtitle">Click on any card to view detailed showtimes, curator profiles, and featured artworks.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 3rem;">
      
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
          $artist_name = get_post_meta( get_the_ID(), 'artist_name', true );
          $sub_badge = get_post_meta( get_the_ID(), 'sub_badge', true ) ?: 'Showcase';
          ?>
          <div class="past-exhibit-card" style="background: #ffffff; border: 1px solid var(--border-color); padding: 0.75rem; display: flex; flex-direction: column; cursor: pointer; transition: var(--transition-smooth);" onclick="location.href='<?php the_permalink(); ?>'">
            <div style="position: relative; overflow: hidden; height: 320px; border-bottom: 1px solid var(--border-color); margin-bottom: 1.25rem;">
              <?php if ( has_post_thumbnail() ) : ?>
                  <?php the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: 100%; object-fit: cover;' ) ); ?>
              <?php else : ?>
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/exhibition_train.jpg" alt="<?php the_title_attribute(); ?>">
              <?php endif; ?>
              <span style="position: absolute; top: 1rem; left: 1rem; background: var(--primary-color); color: #ffffff; padding: 0.4rem 0.8rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;"><?php echo esc_html( $sub_badge ); ?></span>
            </div>
            <div style="padding: 0.5rem; text-align: left; flex-grow: 1; display: flex; flex-direction: column;">
              <h3 style="font-size: 1.5rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;"><?php the_title(); ?></h3>
              <?php if ( $artist_name ) : ?>
                  <p style="font-weight: 700; color: var(--primary-color); text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px; margin-bottom: 1rem;"><?php echo esc_html( $artist_name ); ?></p>
              <?php endif; ?>
              <p style="font-size: 0.95rem; line-height: 1.6; color: var(--text-light); margin-bottom: 1.5rem; flex-grow: 1;"><?php the_excerpt(); ?></p>
              <span class="btn-primary" style="text-align: center; display: block; width: 100%;">View Details</span>
            </div>
          </div>
      <?php endwhile; else : ?>
          <p><?php esc_html_e( 'No exhibitions found.', 'theboxx' ); ?></p>
      <?php endif; ?>

    </div>
  </section>

<?php get_footer(); ?>
