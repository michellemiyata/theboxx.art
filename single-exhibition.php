<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
    $hero_subtitle = get_post_meta( get_the_ID(), 'hero_subtitle', true ) ?: 'More than just art';
    $artist_name = get_post_meta( get_the_ID(), 'artist_name', true );
    $sub_badge = get_post_meta( get_the_ID(), 'sub_badge', true ) ?: 'Spotlight';
    $show_time_fri = get_post_meta( get_the_ID(), 'show_time_fri', true ) ?: '6:00 PM – 9:00 PM';
    $show_time_sat = get_post_meta( get_the_ID(), 'show_time_sat', true ) ?: '12:00 PM – 8:00 PM';
    $show_time_sun = get_post_meta( get_the_ID(), 'show_time_sun', true ) ?: '12:00 PM – 4:00 PM';
?>
  <!-- Immersive Page Hero Banner -->
  <section class="exhibitions-hero-section" style="background-image: url('<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : esc_url( get_stylesheet_directory_uri() . '/assets/exhibition_train.jpg' ); ?>');">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <span class="hero-badge"><?php echo esc_html( $sub_badge ); ?></span>
      <h1 class="hero-title"><?php the_title(); ?></h1>
      <p class="hero-subtitle"><?php echo esc_html( $hero_subtitle ); ?></p>
      <div class="hero-divider"></div>
    </div>
  </section>

  <!-- Main Content Area -->
  <section class="section container" style="padding-top: 3rem; padding-bottom: 2rem;">
    <!-- Main Poster & Showtimes Box -->
    <div class="exhibit-main-box">
      <div class="exhibit-poster-column">
        <div class="exhibit-poster-img-wrapper" style="border: 1px solid var(--border-color);">
          <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'large' ); else : ?>
              <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/moka_amore_poster.jpg" alt="Exhibition Poster">
          <?php endif; ?>
        </div>
      </div>
      
      <div class="exhibit-details-column">
        <div class="showtimes-details-box">
          <h3 class="details-box-title">Show Times</h3>
          <ul class="showtimes-list">
            <li>
              <span class="day-badge">Friday</span>
              <span class="time-detail"><i class="fa-regular fa-clock"></i> <?php echo esc_html( $show_time_fri ); ?></span>
            </li>
            <li>
              <span class="day-badge">Saturday</span>
              <span class="time-detail"><i class="fa-regular fa-clock"></i> <?php echo esc_html( $show_time_sat ); ?></span>
            </li>
            <li>
              <span class="day-badge">Sunday</span>
              <span class="time-detail"><i class="fa-regular fa-clock"></i> <?php echo esc_html( $show_time_sun ); ?></span>
            </li>
          </ul>
          
          <div class="tickets-cta-wrapper">
            <p class="cta-label">Reserve Your Invitation</p>
            <button class="tickets-status-btn-interactive" id="tickets-btn">
              <span>Tickets Available Soon - Get Notified</span>
              <i class="fa-solid fa-arrow-right-long"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- About this event -->
    <div class="about-event-section" style="margin-top: 4rem;">
      <h3 class="about-event-title">About this event</h3>
      <div class="about-event-desc" style="font-size: 1.15rem; line-height: 1.8; color: var(--text-light); margin-top: 1rem;">
          <?php the_content(); ?>
      </div>
    </div>

    <!-- Associated Artist Box -->
    <?php
    $artist_id = get_post_meta( get_the_ID(), 'associated_artist_id', true );
    if ( $artist_id ) :
        $artist_post = get_post( $artist_id );
        if ( $artist_post ) :
            $artist_style = get_post_meta( $artist_id, 'artist_style', true );
            $artist_quote = get_post_meta( $artist_id, 'artist_quote', true );
            ?>
            <div class="artist-section-container" style="margin-top: 4rem;">
              <div class="artist-main-box">
                <div class="artist-portrait-column">
                  <div class="artist-portrait-img-wrapper">
                    <?php if ( has_post_thumbnail( $artist_id ) ) : echo get_the_post_thumbnail( $artist_id, 'medium' ); else : ?>
                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/artist_louie_chiaino.png" alt="Artist Portrait">
                    <?php endif; ?>
                    <span class="artist-label-badge">Featured Creator</span>
                  </div>
                </div>
                <div class="artist-details-column">
                  <h3 class="artist-title">About the Creator</h3>
                  <div class="artist-bio-text">
                    <p><strong><?php echo esc_html( $artist_post->post_title ); ?></strong><?php if ( $artist_style ) : ?> - <?php echo esc_html( $artist_style ); ?><?php endif; ?></p>
                    <p><?php echo esc_html( $artist_post->post_excerpt ); ?></p>
                    <?php if ( $artist_quote ) : ?>
                        <blockquote class="artist-quote">
                          <p>"<?php echo esc_html( $artist_quote ); ?>"</p>
                          <cite>&mdash; <?php echo esc_html( $artist_post->post_title ); ?></cite>
                        </blockquote>
                    <?php endif; ?>
                  </div>
                  <a href="<?php echo esc_url( get_permalink( $artist_id ) ); ?>" class="btn-primary" style="display: inline-block; margin-top: 1rem; border-color: var(--text-dark); background: transparent; color: var(--text-dark);">View Full Biography</a>
                </div>
              </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Exhibition Pieces Grid -->
    <div class="exhibition-grid-header" style="margin-top: 6rem; border-top: 1px solid var(--border-color); padding-top: 4rem;">
      <h3 class="grid-title">Featured Pieces</h3>
      <p class="grid-subtitle">Click on any piece to view in full resolution</p>
    </div>
    
    <div class="image-grid" style="margin-top: 2rem; margin-bottom: 4rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
      <?php
      // 1. Try to fetch dynamic artworks for this exhibition using the custom post type 'artwork'
      $artwork_query = new WP_Query( array(
          'post_type'      => 'artwork',
          'posts_per_page' => -1,
          'meta_query'     => array(
              array(
                  'key'     => 'associated_exhibition_id',
                  'value'   => get_the_ID(),
                  'compare' => '='
              )
          )
      ) );

      if ( $artwork_query->have_posts() ) {
          $idx = 0;
          while ( $artwork_query->have_posts() ) {
              $artwork_query->the_post();
              $art_id = get_the_ID();
              $art_medium = get_post_meta( $art_id, 'artwork_medium', true ) ?: 'Mixed Media';
              $art_year = get_post_meta( $art_id, 'artwork_year', true ) ?: get_the_date('Y');
              $art_dimensions = get_post_meta( $art_id, 'artwork_dimensions', true ) ?: 'Custom';
              $art_price = get_post_meta( $art_id, 'artwork_price', true ) ?: '';
              $art_artist = get_post_meta( $art_id, 'artwork_artist', true );
              if ( ! $art_artist ) {
                  $art_artist = $artist_name ?: 'Featured Artist';
              }
              $img_url = has_post_thumbnail() ? get_the_post_thumbnail_url( $art_id, 'large' ) : esc_url( get_stylesheet_directory_uri() . '/assets/moka_1.png' );
              ?>
              <div class="image-grid-item-boxed artwork-card" data-index="<?php echo $idx; ?>" data-medium="<?php echo esc_attr( $art_medium ); ?>" data-year="<?php echo esc_attr( $art_year ); ?>" data-dimensions="<?php echo esc_attr( $art_dimensions ); ?>" data-price="<?php echo esc_attr( $art_price ); ?>" data-description="<?php echo esc_attr( get_the_excerpt() ?: get_the_content() ); ?>">
                <div class="artwork-image-wrapper">
                  <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>">
                  <div class="artwork-hover-overlay">
                    <span class="view-artwork-btn"><i class="fa-solid fa-expand"></i> View Details</span>
                  </div>
                </div>
                <div class="artwork-meta">
                  <h4><?php the_title(); ?></h4>
                  <p><?php echo esc_html( $art_artist ); ?></p>
                </div>
              </div>
              <?php
              $idx++;
          }
          wp_reset_postdata();
      } else {
          // 2. Otherwise fall back to pre-populated static metadata
          $post_slug = $post->post_name;
          if ( strpos( $post_slug, 'moka' ) !== false ) {
              // Moka Amore Artworks
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
          } elseif ( strpos( $post_slug, 'abballe' ) !== false ) {
              // Abballe Artworks
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
              <?php
          } elseif ( strpos( $post_slug, 'dream' ) !== false || strpos( $post_slug, 'infinite' ) !== false ) {
              // Infinite Dreams Artworks
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
          } elseif ( strpos( $post_slug, 'mito' ) !== false || strpos( $post_slug, 'ritratti' ) !== false ) {
              // EOS Ritratti del Mito Artworks
              ?>
              <div class="image-grid-item-boxed artwork-card" data-index="0" data-medium="Mixed Media on Plywood" data-year="2017" data-dimensions="21cm x 30cm (8.3&quot; x 11.8&quot;)" data-price="$400" data-description="An evocative miniature mixed media piece on plywood from the &quot;Ritratti del Mito&quot; collection, layering gesso, oil wash, and graphite to evoke classical mythological figures.">
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
          } else {
              // Fallback dynamic gallery based on post attachments/featured image if custom
              $attachments = get_posts( array(
                  'post_type'      => 'attachment',
                  'posts_per_page' => 12,
                  'post_parent'    => get_the_ID(),
                  'post_mime_type' => 'image',
              ) );
              if ( $attachments ) {
                  $idx = 0;
                  foreach ( $attachments as $attachment ) {
                      $img_url = wp_get_attachment_image_url( $attachment->ID, 'large' );
                      $title = $attachment->post_title;
                      $desc = $attachment->post_content ?: $attachment->post_excerpt;
                      ?>
                      <div class="image-grid-item-boxed artwork-card" data-index="<?php echo $idx; ?>" data-medium="Mixed Media" data-year="<?php echo get_the_date('Y'); ?>" data-dimensions="Custom" data-description="<?php echo esc_attr($desc); ?>">
                        <div class="artwork-image-wrapper">
                          <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>">
                          <div class="artwork-hover-overlay">
                            <span class="view-artwork-btn"><i class="fa-solid fa-expand"></i> View Details</span>
                          </div>
                        </div>
                        <div class="artwork-meta">
                          <h4><?php echo esc_html($title); ?></h4>
                          <p><?php echo esc_html($artist_name ?: 'Featured Artist'); ?></p>
                        </div>
                      </div>
                      <?php
                      $idx++;
                  }
              } elseif ( has_post_thumbnail() ) {
                  // Fallback to the single featured image
                  ?>
                  <div class="image-grid-item-boxed artwork-card" data-index="0" data-medium="Mixed Media" data-year="<?php echo get_the_date('Y'); ?>" data-dimensions="Custom" data-description="Exhibition showcase piece.">
                    <div class="artwork-image-wrapper">
                      <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>" alt="<?php the_title_attribute(); ?>">
                      <div class="artwork-hover-overlay">
                        <span class="view-artwork-btn"><i class="fa-solid fa-expand"></i> View Details</span>
                      </div>
                    </div>
                    <div class="artwork-meta">
                      <h4><?php the_title(); ?> Showcase</h4>
                      <p><?php echo esc_html($artist_name ?: 'Featured Artist'); ?></p>
                    </div>
                  </div>
                  <?php
              }
          }
      }
      ?>
    </div>
  </section>

  <!-- VIP Ticket Waitlist Modal -->
  <div id="tickets-modal" class="modal-backdrop">
    <div class="modal-card">
      <button class="modal-close-btn" id="modal-close-btn" aria-label="Close modal">&times;</button>
      <div class="modal-header">
        <span class="modal-accent-badge">VIP Request</span>
        <h3 class="modal-title">Join The Waiting List</h3>
        <p class="modal-subtitle">Reserve your entry for <?php the_title(); ?> at The Boxx</p>
      </div>
      <form id="waitlist-form">
        <div class="form-group">
          <label for="waitlist-name">Your Full Name</label>
          <input type="text" id="waitlist-name" placeholder="John Doe" required>
        </div>
        <div class="form-group">
          <label for="waitlist-email">Email Address</label>
          <input type="email" id="waitlist-email" placeholder="john@example.com" required>
        </div>
        <div class="form-group">
          <label for="waitlist-date">Preferred Exhibition Date</label>
          <select id="waitlist-date" required>
            <option value="" disabled selected>Choose a session...</option>
            <option value="Friday Session">Friday Session</option>
            <option value="Saturday Session">Saturday Session</option>
            <option value="Sunday Session">Sunday Session</option>
          </select>
        </div>
        <button type="submit" class="waitlist-submit-btn">
          <span>Join waiting list</span>
          <i class="fa-solid fa-paper-plane"></i>
        </button>
      </form>
      
      <div class="modal-success-state" id="modal-success" style="display: none;">
        <div class="success-icon"><i class="fa-solid fa-circle-check"></i></div>
        <h4>You are registered!</h4>
        <p>Thank you. We have registered your request.</p>
        <button type="button" class="modal-success-close-btn" id="modal-success-close-btn">Close Window</button>
      </div>
  </div>

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
