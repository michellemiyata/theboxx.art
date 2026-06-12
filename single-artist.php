<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
    $artist_style = get_post_meta( get_the_ID(), 'artist_style', true ) ?: 'Visual Artist';
    $artist_medium = get_post_meta( get_the_ID(), 'artist_medium', true ) ?: 'Mixed Media';
    $artist_quote = get_post_meta( get_the_ID(), 'artist_quote', true );
?>
  <!-- Page Header -->
  <section class="exhibits-header" style="background-image: url('<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : esc_url( get_stylesheet_directory_uri() . '/assets/exhibition_train.jpg' ); ?>');">
    <div class="container">
      <h1 class="section-title" style="color: #ffffff; margin-bottom: 0;"><?php the_title(); ?></h1>
      <p style="color: rgba(255, 255, 255, 0.8); font-size: 1.1rem; margin-top: 0.5rem; letter-spacing: 1px; text-transform: uppercase;"><?php echo esc_html( $artist_medium ); ?> &bull; <?php echo esc_html( $artist_style ); ?></p>
    </div>
  </section>

  <!-- Bio Section -->
  <section class="section container">
    <div class="artist-main-box" style="margin-top: 0; box-shadow: none; border: none; padding: 0;">
      <div class="artist-portrait-column">
        <div class="artist-portrait-img-wrapper" style="border: 1px solid var(--border-color);">
          <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'large' ); else : ?>
              <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/abballe_portrait.jpg" alt="Artist Portrait">
          <?php endif; ?>
        </div>
      </div>
      <div class="artist-details-column" style="padding-left: 2rem;">
        <h2 style="font-family: var(--font-title); font-size: 2rem; text-transform: uppercase; margin-bottom: 1rem;">Biography</h2>
        <div class="artist-bio-text" style="font-size: 1.1rem; line-height: 1.8; color: var(--text-light);">
          <?php the_content(); ?>
          
          <?php if ( $artist_quote ) : ?>
              <blockquote class="artist-quote" style="margin-top: 2rem; margin-bottom: 2rem;">
                <p>"<?php echo esc_html( $artist_quote ); ?>"</p>
                <cite>&mdash; <?php the_title(); ?></cite>
              </blockquote>
          <?php endif; ?>
        </div>

        <!-- Dynamic Associated Exhibitions -->
        <?php
        $associated_exhibitions = new WP_Query( array(
            'post_type'      => 'exhibition',
            'meta_query'     => array(
                array(
                    'key'     => 'associated_artist_id',
                    'value'   => get_the_ID(),
                    'compare' => '=',
                ),
            ),
        ) );

        if ( $associated_exhibitions->have_posts() ) :
            ?>
            <div style="margin-top: 3rem; border-top: 1px solid var(--border-color); padding-top: 2rem;">
              <h3 style="font-family: var(--font-title); font-size: 1.2rem; text-transform: uppercase; margin-bottom: 1rem;">Showcases at The Boxx</h3>
              <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 1rem;">
                <?php while ( $associated_exhibitions->have_posts() ) : $associated_exhibitions->the_post(); ?>
                  <li>
                    <a href="<?php the_permalink(); ?>" style="font-weight: 700; color: var(--primary-color); text-transform: uppercase; text-decoration: none; font-size: 0.95rem; display: flex; align-items: center;">
                      <i class="fa-solid fa-circle-check" style="margin-right: 10px;"></i> <?php the_title(); ?> &rarr;
                    </a>
                  </li>
                <?php endwhile; ?>
              </ul>
            </div>
            <?php
            wp_reset_postdata();
        endif;
        ?>
      </div>
    </div>

    <!-- Artist Gallery Grid -->
    <div class="exhibition-grid-header" style="margin-top: 5rem; border-top: 1px solid var(--border-color); padding-top: 4rem;">
      <h3 class="grid-title">Artist's Gallery</h3>
      <p class="grid-subtitle">Click on any piece to view details in the lightbox</p>
    </div>
    
    <div class="image-grid" style="margin-top: 2rem; margin-bottom: 4rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
      <?php
      $artist_id = get_the_ID();
      // Find all exhibitions by this artist
      $artist_exhibitions = get_posts( array(
          'post_type'   => 'exhibition',
          'numberposts' => -1,
          'meta_key'    => 'associated_artist_id',
          'meta_value'  => $artist_id,
          'fields'      => 'ids',
      ) );

      $artwork_posts = array();
      if ( ! empty( $artist_exhibitions ) ) {
          $artwork_posts = get_posts( array(
              'post_type'      => 'artwork',
              'numberposts'    => -1,
              'meta_query'     => array(
                  array(
                      'key'     => 'associated_exhibition_id',
                      'value'   => $artist_exhibitions,
                      'compare' => 'IN',
                  ),
              ),
          ) );
      }

      if ( ! empty( $artwork_posts ) ) {
          $idx = 0;
          foreach ( $artwork_posts as $art_post ) {
              $art_id = $art_post->ID;
              $art_medium = get_post_meta( $art_id, 'artwork_medium', true ) ?: 'Mixed Media';
              $art_year = get_post_meta( $art_id, 'artwork_year', true ) ?: get_the_date('Y', $art_id);
              $art_dimensions = get_post_meta( $art_id, 'artwork_dimensions', true ) ?: 'Custom';
              $art_price = get_post_meta( $art_id, 'artwork_price', true ) ?: '';
              $art_artist = get_post_meta( $art_id, 'artwork_artist', true ) ?: get_the_title( $artist_id );
              $img_url = has_post_thumbnail( $art_id ) ? get_the_post_thumbnail_url( $art_id, 'large' ) : esc_url( get_stylesheet_directory_uri() . '/assets/moka_1.png' );
              ?>
              <div class="image-grid-item-boxed artwork-card" data-index="<?php echo $idx; ?>" data-medium="<?php echo esc_attr( $art_medium ); ?>" data-year="<?php echo esc_attr( $art_year ); ?>" data-dimensions="<?php echo esc_attr( $art_dimensions ); ?>" data-price="<?php echo esc_attr( $art_price ); ?>" data-description="<?php echo esc_attr( get_the_excerpt( $art_id ) ?: $art_post->post_content ); ?>">
                <div class="artwork-image-wrapper">
                  <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $art_post->post_title ); ?>">
                  <div class="artwork-hover-overlay">
                    <span class="view-artwork-btn"><i class="fa-solid fa-expand"></i> View Details</span>
                  </div>
                </div>
                <div class="artwork-meta">
                  <h4><?php echo esc_html( $art_post->post_title ); ?></h4>
                  <p><?php echo esc_html( $art_artist ); ?></p>
                </div>
              </div>
              <?php
              $idx++;
          }
      } else {
          // Fallback to static mock details based on artist post slug
          $artist_slug = $post->post_name;
          if ( strpos( $artist_slug, 'abballe' ) !== false ) {
              // Andrew Abballe Artworks
              ?>
              <div class="image-grid-item-boxed artwork-card" data-index="0" data-medium="Oil on Canvas" data-year="2022" data-dimensions="40&quot; x 50&quot;" data-price="$2,400" data-description="A stunning, layered cityscape capturing the visual noise and light trails of urban transit systems.">
                <div class="artwork-image-wrapper">
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/abballe_portrait.jpg" alt="Transit Reflections">
                  <div class="artwork-hover-overlay">
                    <span class="view-artwork-btn"><i class="fa-solid fa-expand"></i> View Details</span>
                  </div>
                </div>
                <div class="artwork-meta">
                  <h4>Transit Reflections</h4>
                  <p>Andrew Abballe</p>
                </div>
              </div>
              <div class="image-grid-item-boxed artwork-card" data-index="1" data-medium="Mixed Media on Wood Panel" data-year="2023" data-dimensions="36&quot; x 36&quot;" data-price="$1,850" data-description="An energetic combination of spray paint, acrylic, and collage elements representing structural tension and movement.">
                <div class="artwork-image-wrapper">
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/abballe_promo.jpg" alt="Collision and Rebellion">
                  <div class="artwork-hover-overlay">
                    <span class="view-artwork-btn"><i class="fa-solid fa-expand"></i> View Details</span>
                  </div>
                </div>
                <div class="artwork-meta">
                  <h4>Collision and Rebellion</h4>
                  <p>Andrew Abballe</p>
                </div>
              </div>
              <div class="image-grid-item-boxed artwork-card" data-index="2" data-medium="Mixed Media on Plywood" data-year="2017" data-dimensions="21cm x 30cm (8.3&quot; x 11.8&quot;)" data-price="$400" data-description="An evocative miniature mixed media piece on plywood from the &quot;Ritratti del Mito&quot; collection, layering gesso, oil wash, and graphite to evoke classical mythological figures.">
                <div class="artwork-image-wrapper">
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/EOS-Ritratti-del-Mito-2017-cm-21x30-tecnica-mista-su-compensato-E-350_400.jpeg" alt="Ritratti del Mito I">
                  <div class="artwork-hover-overlay">
                    <span class="view-artwork-btn"><i class="fa-solid fa-expand"></i> View Details</span>
                  </div>
                </div>
                <div class="artwork-meta">
                  <h4>Ritratti del Mito I</h4>
                  <p>Andrew Abballe</p>
                </div>
              </div>
              <?php
          } elseif ( strpos( $artist_slug, 'louie' ) !== false || strpos( $artist_slug, 'chiaino' ) !== false ) {
              // Louie Chiaino Artworks
              ?>
              <div class="image-grid-item-boxed artwork-card" data-index="0" data-medium="Screenprint on Canvas" data-year="2023" data-dimensions="24&quot; x 24&quot;" data-price="$450" data-description="An abstract geometric exploration of the iconic octagonal design, rendered in warm, sepia-toned screenprint layers.">
                <div class="artwork-image-wrapper">
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/moka_1.png" alt="Moka Amore Square Poster">
                  <div class="artwork-hover-overlay">
                    <span class="view-artwork-btn"><i class="fa-solid fa-expand"></i> View Details</span>
                  </div>
                </div>
                <div class="artwork-meta">
                  <h4>Moka Amore I</h4>
                  <p>Louie Chiaino</p>
                </div>
              </div>
              <div class="image-grid-item-boxed artwork-card" data-index="1" data-medium="Acrylic & Silkscreen on Wood Panel" data-year="2023" data-dimensions="30&quot; x 30&quot;" data-price="$600" data-description="Showcasing the distinct green moka pot with a stark red handle, contrasting vibrant kitchen tones against a dark minimalist background.">
                <div class="artwork-image-wrapper">
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/moka_2.png" alt="Moka Amore Green Pot Red Handle Poster">
                  <div class="artwork-hover-overlay">
                    <span class="view-artwork-btn"><i class="fa-solid fa-expand"></i> View Details</span>
                  </div>
                </div>
                <div class="artwork-meta">
                  <h4>Moka Amore II</h4>
                  <p>Louie Chiaino</p>
                </div>
              </div>
              <div class="image-grid-item-boxed artwork-card" data-index="2" data-medium="Mixed Media on Canvas" data-year="2024" data-dimensions="24&quot; x 36&quot;" data-price="$750" data-description="Highlighting the curved dome lid and textured aluminum surface of the classic Italian coffee maker.">
                <div class="artwork-image-wrapper">
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/moka_3.png" alt="Moka Amore Green Pot Dome Top Poster">
                  <div class="artwork-hover-overlay">
                    <span class="view-artwork-btn"><i class="fa-solid fa-expand"></i> View Details</span>
                  </div>
                </div>
                <div class="artwork-meta">
                  <h4>Moka Amore III</h4>
                  <p>Louie Chiaino</p>
                </div>
              </div>
              <div class="image-grid-item-boxed artwork-card" data-index="3" data-medium="Hand-pulled Serigraph" data-year="2024" data-dimensions="20&quot; x 20&quot;" data-price="$350" data-description="A stylized, clean geometric study of the clover-top knob, emphasizing industrial utility.">
                <div class="artwork-image-wrapper">
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/moka_4.png" alt="Moka Amore Silver Pot Clover Top Poster">
                  <div class="artwork-hover-overlay">
                    <span class="view-artwork-btn"><i class="fa-solid fa-expand"></i> View Details</span>
                  </div>
                </div>
                <div class="artwork-meta">
                  <h4>Moka Amore IV</h4>
                  <p>Louie Chiaino</p>
                </div>
              </div>
              <div class="image-grid-item-boxed artwork-card" data-index="4" data-medium="Oil & Collage on Canvas" data-year="2024" data-dimensions="36&quot; x 48&quot;" data-price="$1,200" data-description="A large-scale vertical study featuring the green pot against structured architectural lines.">
                <div class="artwork-image-wrapper">
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/moka_5.png" alt="Moka Amore Green Pot Vertical Poster">
                  <div class="artwork-hover-overlay">
                    <span class="view-artwork-btn"><i class="fa-solid fa-expand"></i> View Details</span>
                  </div>
                </div>
                <div class="artwork-meta">
                  <h4>Moka Amore V</h4>
                  <p>Louie Chiaino</p>
                </div>
              </div>
              <div class="image-grid-item-boxed artwork-card" data-index="5" data-medium="Silkscreen Ink and Charcoal" data-year="2024" data-dimensions="36&quot; x 48&quot;" data-price="$1,100" data-description="The final piece in the series, capturing the raw metallic texture and shadows of the classic silver pot in high contrast.">
                <div class="artwork-image-wrapper">
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/moka_6.png" alt="Moka Amore Silver Pot Vertical Poster">
                  <div class="artwork-hover-overlay">
                    <span class="view-artwork-btn"><i class="fa-solid fa-expand"></i> View Details</span>
                  </div>
                </div>
                <div class="artwork-meta">
                  <h4>Moka Amore VI</h4>
                  <p>Louie Chiaino</p>
                </div>
              </div>
              <?php
          } elseif ( strpos( $artist_slug, 'sofia' ) !== false || strpos( $artist_slug, 'vieri' ) !== false ) {
              // Sofia Vieri Artworks
              ?>
              <div class="image-grid-item-boxed artwork-card" data-index="0" data-medium="Mixed Media Sculptural Relief" data-year="2024" data-dimensions="48&quot; x 48&quot; x 6&quot;" data-price="$3,200" data-description="An immersive textural panel featuring layered plaster, wood veneer, and metallic pigments, creating deep shadows that shift with the light.">
                <div class="artwork-image-wrapper">
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/Infinite-Dreams-scaled.jpg" alt="Infinite Dreams I">
                  <div class="artwork-hover-overlay">
                    <span class="view-artwork-btn"><i class="fa-solid fa-expand"></i> View Details</span>
                  </div>
                </div>
                <div class="artwork-meta">
                  <h4>Infinite Dreams I</h4>
                  <p>Sofia Vieri</p>
                </div>
              </div>
              <div class="image-grid-item-boxed artwork-card" data-index="1" data-medium="Cast Concrete and Steel" data-year="2024" data-dimensions="18&quot; x 18&quot; x 36&quot;" data-price="$1,900" data-description="A free-standing structural sculpture exploring spatial division and gravity using raw concrete blocks bound by a rusted steel framework.">
                <div class="artwork-image-wrapper">
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/hero_gallery_3.png" alt="Concrete Boundaries">
                  <div class="artwork-hover-overlay">
                    <span class="view-artwork-btn"><i class="fa-solid fa-expand"></i> View Details</span>
                  </div>
                </div>
                <div class="artwork-meta">
                  <h4>Concrete Boundaries</h4>
                  <p>Sofia Vieri</p>
                </div>
              </div>
              <?php
          }
      }
      ?>
    </div>
  </section>

  <!-- Custom Fullscreen Lightbox -->
  <div id="lightbox-modal" class="lightbox-backdrop">
    <button class="lightbox-close-btn" id="lightbox-close" aria-label="Close gallery">&times;</button>
    <button class="lightbox-nav-btn prev" id="lightbox-prev" aria-label="Previous image">&#10094;</button>
    <div class="lightbox-content-wrapper">
      <div class="lightbox-img-col">
        <img id="lightbox-img" src="" alt="Enlarged Artwork Preview">
      </div>
      <div class="lightbox-info-col">
        <h3 id="lightbox-title"></h3>
        <p class="artist" id="lightbox-artist"></p>
        <ul class="lightbox-meta-list">
          <li><strong>Medium</strong><span id="lightbox-medium"></span></li>
          <li><strong>Year Created</strong><span id="lightbox-year"></span></li>
          <li><strong>Dimensions</strong><span id="lightbox-dimensions"></span></li>
          <li id="lightbox-price-item"><strong>Price</strong><span id="lightbox-price"></span></li>
        </ul>
        <p class="desc" id="lightbox-description"></p>
      </div>
    </div>
    <button class="lightbox-nav-btn next" id="lightbox-next" aria-label="Next image">&#10095;</button>
  </div>

<?php endwhile; endif; ?>
<?php get_footer(); ?>
