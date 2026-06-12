<?php get_header(); ?>

  <!-- Hero Slider -->
  <section class="hero-slider">
    <div class="hero-slides">
      
      <!-- Slide 1: Welcome -->
      <div class="hero-slide active">
        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/exhibition-with-copy-up-top.png" alt="The Boxx Art Space" class="hero-slide-img" style="object-position: center;">
        <div class="container">
          <div class="hero-slide-content">
            <div class="hero-slide-num">01 / 03</div>
            <h1 class="hero-slide-title">The Boxx <br>Art Gallery</h1>
            <p class="hero-slide-desc">A premium, contemporary art gallery and creative event space located in Vaughan, Ontario.</p>
            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
              <a href="<?php echo esc_url( get_post_type_archive_link( 'exhibition' ) ); ?>" class="btn-primary">View Exhibitions</a>
              <a href="<?php echo esc_url( home_url( '/rates' ) ); ?>" class="btn-primary" style="background: transparent; border-color: #ffffff; color: #ffffff;">Rent the Studio</a>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Slide 2: Exhibitions -->
      <div class="hero-slide">
        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/leadership-banner.jpeg" alt="Portraits of Transit Exhibition" class="hero-slide-img">
        <div class="container">
          <div class="hero-slide-content">
            <div class="hero-slide-num">02 / 03</div>
            <h1 class="hero-slide-title">Contemplate <br>New Visions</h1>
            <p class="hero-slide-desc">Step into curated showcases featuring boundaries-pushing physical, mixed-media, and digital art installations.</p>
            <a href="<?php echo esc_url( get_post_type_archive_link( 'exhibition' ) ); ?>" class="btn-primary">Explore Exhibitions</a>
          </div>
        </div>
      </div>
      
      <!-- Slide 3: Rentals -->
      <div class="hero-slide">
        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/banner-his.jpeg" alt="Contemporary art installation" class="hero-slide-img">
        <div class="container">
          <div class="hero-slide-content">
            <div class="hero-slide-num">03 / 03</div>
            <h1 class="hero-slide-title">Unbound <br>Creative Space</h1>
            <p class="hero-slide-desc">High ceilings, clean white walls, and dimmable track lighting form the perfect canvas for your next event or show.</p>
            <a href="<?php echo esc_url( home_url( '/rates' ) ); ?>" class="btn-primary">Studio Rates</a>
          </div>
        </div>
      </div>

    </div>

    <!-- Hero Controls -->
    <button class="hero-arrow prev" aria-label="Previous Slide"><i class="fa-solid fa-chevron-left"></i></button>
    <button class="hero-arrow next" aria-label="Next Slide"><i class="fa-solid fa-chevron-right"></i></button>

    <div class="hero-pagination">
      <span class="hero-dot active"></span>
      <span class="hero-dot"></span>
      <span class="hero-dot"></span>
    </div>
  </section>

  <!-- Welcome / Intro Section -->
  <section class="section container" style="text-align: center; max-width: 800px; padding-top: 6rem; padding-bottom: 4rem;">
    <span style="font-weight: 700; text-transform: uppercase; color: var(--primary-color); letter-spacing: 2px; font-size: 0.9rem;">Contemporary Excellence</span>
    <h2 style="font-size: 2.5rem; margin-top: 1rem; margin-bottom: 1.5rem; text-transform: uppercase;">A Space for Art &amp; Community</h2>
    <p style="font-size: 1.15rem; line-height: 1.8; color: var(--text-light);">
      The Boxx is Vaughan's premier destination for fine art and creative productions. We host boundary-pushing physical exhibitions, showcase rising Canadian visual artists, and provide modular studio space for custom events, shoots, and corporate receptions.
    </p>
  </section>

  <!-- Dynamic Exhibitions Preview -->
  <section class="section section-alt">
    <div class="container">
      <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 3rem; flex-wrap: wrap; gap: 1rem;">
        <div>
          <h2 class="section-title" style="margin-bottom: 0.5rem; text-align: left;">Featured Exhibitions</h2>
          <p class="section-subtitle" style="margin-left: 0; text-align: left; margin-bottom: 0;">Discover current, past, and upcoming showcases at The Boxx.</p>
        </div>
        <a href="<?php echo esc_url( get_post_type_archive_link( 'exhibition' ) ); ?>" class="btn-primary" style="margin-bottom: 0.5rem;">View All Exhibitions <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i></a>
      </div>

      <div class="past-exhibits-container" style="margin-bottom: 2rem;">
        <div class="past-exhibits-slider">
          
          <?php
          $exhibitions_query = new WP_Query( array(
              'post_type'      => 'exhibition',
              'posts_per_page' => 3,
          ) );

          if ( $exhibitions_query->have_posts() ) :
              while ( $exhibitions_query->have_posts() ) : $exhibitions_query->the_post();
                  $excerpt = get_the_excerpt();
                  $artist_name = get_post_meta( get_the_ID(), 'artist_name', true );
                  $sub_badge = get_post_meta( get_the_ID(), 'sub_badge', true ) ?: 'Showcase';
                  ?>
                  <div class="past-exhibit-slide">
                      <div class="past-exhibit-img">
                          <?php if ( has_post_thumbnail() ) : ?>
                              <?php the_post_thumbnail( 'large' ); ?>
                          <?php else : ?>
                              <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/exhibition_train.jpg" alt="<?php the_title_attribute(); ?>">
                          <?php endif; ?>
                      </div>
                      <div class="past-exhibit-text">
                          <span class="floating-badge" style="display: inline-block; font-size: 0.75rem; margin-bottom: 1rem;"><?php echo esc_html( $sub_badge ); ?></span>
                          <h3 style="font-weight: 800; text-transform: uppercase; font-size: 1.8rem;"><?php the_title(); ?></h3>
                          <?php if ( $artist_name ) : ?>
                              <p style="font-weight: 600; color: var(--primary-color); text-transform: uppercase; font-size: 0.9rem; margin-bottom: 1.25rem;"><?php echo esc_html( $artist_name ); ?></p>
                          <?php endif; ?>
                          <p><?php echo esc_html( wp_trim_words( $excerpt, 12 ) ); ?></p>
                          <a href="<?php the_permalink(); ?>" class="btn-primary" style="display: inline-block; margin-top: 1rem;">Explore Exhibit</a>
                      </div>
                  </div>
                  <?php
              endwhile;
              wp_reset_postdata();
          else :
              // Fallback placeholder static layouts if no CPT posts entered yet
              ?>
              <!-- Exhibit 1: Moka Amore -->
              <div class="past-exhibit-slide">
                  <div class="past-exhibit-img">
                      <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/mokaamore_1080x1080.jpeg" alt="Moka Amore Exhibition">
                  </div>
                  <div class="past-exhibit-text">
                      <span class="floating-badge" style="display: inline-block; font-size: 0.75rem; margin-bottom: 1rem;">Featured Exhibit</span>
                      <h3 style="font-weight: 800; text-transform: uppercase; font-size: 1.8rem;">Moka Amore</h3>
                      <p style="font-weight: 600; color: var(--primary-color); text-transform: uppercase; font-size: 0.9rem; margin-bottom: 1.25rem;">Solo Exhibition by Louie Chiaino</p>
                      <p>An exhibition mapping the geometric history and cultural legacy of Italian stovetop coffee makers.</p>
                      <a href="<?php echo esc_url( home_url( '/exhibitions/moka-amore' ) ); ?>" class="btn-primary" style="display: inline-block; margin-top: 1rem;">Explore Exhibit</a>
                  </div>
              </div>

              <!-- Exhibit 2: Abballe Exhibition -->
              <div class="past-exhibit-slide">
                  <div class="past-exhibit-img">
                      <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/abballe_promo.jpg" alt="ABBALLE Art Exhibition">
                  </div>
                  <div class="past-exhibit-text">
                      <span class="floating-badge" style="display: inline-block; font-size: 0.75rem; margin-bottom: 1rem;">Spotlight</span>
                      <h3 style="font-weight: 800; text-transform: uppercase; font-size: 1.8rem;">ABBALLE Art Exhibition</h3>
                      <p style="font-weight: 600; color: var(--primary-color); text-transform: uppercase; font-size: 0.9rem; margin-bottom: 1.25rem;">Solo Showcase by Andrew Abballe</p>
                      <p>A collision of classical master craftsmanship with urban pop flair.</p>
                      <a href="<?php echo esc_url( home_url( '/exhibitions/abballe' ) ); ?>" class="btn-primary" style="display: inline-block; margin-top: 1rem;">Explore Exhibit</a>
                  </div>
              </div>

              <!-- Exhibit 3: Infinite Dreams -->
              <div class="past-exhibit-slide">
                  <div class="past-exhibit-img">
                      <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/Infinite-Dreams-scaled.jpg" alt="Infinite Dreams Exhibition">
                  </div>
                  <div class="past-exhibit-text">
                      <span class="floating-badge" style="display: inline-block; font-size: 0.75rem; margin-bottom: 1rem;">Group Exhibition</span>
                      <h3 style="font-weight: 800; text-transform: uppercase; font-size: 1.8rem;">Infinite Dreams</h3>
                      <p style="font-weight: 600; color: var(--primary-color); text-transform: uppercase; font-size: 0.9rem; margin-bottom: 1.25rem;">Mixed-Media Abstract Group</p>
                      <p>An abstract visual exploration of human consciousness and spatial reflections.</p>
                      <a href="<?php echo esc_url( home_url( '/exhibitions/infinite-dreams' ) ); ?>" class="btn-primary" style="display: inline-block; margin-top: 1rem;">Explore Exhibit</a>
                  </div>
              </div>
          <?php endif; ?>

        </div>
      </div>

      <div class="past-exhibits-controls">
        <div class="past-exhibits-pagination">01 / 03</div>
        <div class="past-exhibits-arrows">
          <button class="past-exhibits-arrow" id="past-prev" aria-label="Previous Slide"><i class="fa-solid fa-chevron-left"></i></button>
          <button class="past-exhibits-arrow" id="past-next" aria-label="Next Slide"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
      </div>
    </div>
  </section>

  <!-- Dynamic Artists Preview -->
  <section class="section container">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 3.5rem; flex-wrap: wrap; gap: 1rem;">
      <div>
        <h2 class="section-title" style="margin-bottom: 0.5rem; text-align: left;">Featured Artists</h2>
        <p class="section-subtitle" style="margin-left: 0; text-align: left; margin-bottom: 0;">The curators, creators, and visual voices behind our showcases.</p>
      </div>
      <a href="<?php echo esc_url( get_post_type_archive_link( 'artist' ) ); ?>" class="btn-primary" style="margin-bottom: 0.5rem;">Meet All Artists <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i></a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2.5rem;">

      <?php
      $artists_query = new WP_Query( array(
          'post_type'      => 'artist',
          'posts_per_page' => 3,
      ) );

      if ( $artists_query->have_posts() ) :
          while ( $artists_query->have_posts() ) : $artists_query->the_post();
              $excerpt = get_the_excerpt();
              $artist_style = get_post_meta( get_the_ID(), 'artist_style', true ) ?: 'Visual Artist';
              $artist_medium = get_post_meta( get_the_ID(), 'artist_medium', true ) ?: 'Mixed Media';
              ?>
              <div class="past-exhibit-card" style="background: #ffffff; border: 1px solid var(--border-color); padding: 0.75rem; display: flex; flex-direction: column; cursor: pointer; transition: var(--transition-smooth);" onclick="location.href='<?php the_permalink(); ?>'">
                  <div style="overflow: hidden; height: 260px; border-bottom: 1px solid var(--border-color); position: relative;">
                      <?php if ( has_post_thumbnail() ) : ?>
                          <?php the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: 100%; object-fit: cover; filter: grayscale(100%); transition: var(--transition-smooth);' ) ); ?>
                      <?php else : ?>
                          <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/abballe_portrait.jpg" alt="<?php the_title_attribute(); ?>" style="width: 100%; height: 100%; object-fit: cover; filter: grayscale(100%);">
                      <?php endif; ?>
                      <span style="position: absolute; bottom: 1rem; left: 1rem; background: #000000; color: #ffffff; padding: 0.4rem 0.8rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;"><?php echo esc_html( $artist_medium ); ?></span>
                  </div>
                  <div style="padding: 1.2rem 0.5rem 0.5rem 0.5rem;">
                      <h3 style="font-size: 1.4rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.25rem;"><?php the_title(); ?></h3>
                      <p style="font-style: italic; font-size: 0.85rem; margin-bottom: 0.75rem; color: var(--primary-color);"><?php echo esc_html( $artist_style ); ?></p>
                      <p style="font-size: 0.9rem; line-height: 1.5; color: var(--text-light); margin-bottom: 0.5rem;"><?php echo esc_html( wp_trim_words( $excerpt, 12 ) ); ?></p>
                  </div>
              </div>
              <?php
          endwhile;
          wp_reset_postdata();
      else :
          // Fallback placeholders
          ?>
          <!-- Artist 1: Andrew Abballe -->
          <div class="past-exhibit-card" style="background: #ffffff; border: 1px solid var(--border-color); padding: 0.75rem; display: flex; flex-direction: column; cursor: pointer; transition: var(--transition-smooth);" onclick="location.href='<?php echo esc_url( home_url( '/artists/andrew-abballe' ) ); ?>'">
              <div style="overflow: hidden; height: 260px; border-bottom: 1px solid var(--border-color); position: relative;">
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/abballe_portrait.jpg" alt="Andrew Abballe" style="width: 100%; height: 100%; object-fit: cover; filter: grayscale(100%);">
                  <span style="position: absolute; bottom: 1rem; left: 1rem; background: #000000; color: #ffffff; padding: 0.4rem 0.8rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Oil &amp; Mixed Media</span>
              </div>
              <div style="padding: 1.2rem 0.5rem 0.5rem 0.5rem;">
                  <h3 style="font-size: 1.4rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.25rem;">Andrew Abballe</h3>
                  <p style="font-style: italic; font-size: 0.85rem; margin-bottom: 0.75rem; color: var(--primary-color);">Contemporary Realism &amp; Urban Pop</p>
                  <p style="font-size: 0.9rem; line-height: 1.5; color: var(--text-light); margin-bottom: 0.5rem;">Bridging classical oil painting traditions with urban pop textures.</p>
              </div>
          </div>

          <!-- Artist 2: Louie Chiaino -->
          <div class="past-exhibit-card" style="background: #ffffff; border: 1px solid var(--border-color); padding: 0.75rem; display: flex; flex-direction: column; cursor: pointer; transition: var(--transition-smooth);" onclick="location.href='<?php echo esc_url( home_url( '/artists/louie-chiaino' ) ); ?>'">
              <div style="overflow: hidden; height: 260px; border-bottom: 1px solid var(--border-color); position: relative;">
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/artist_louie_chiaino.png" alt="Louie Chiaino" style="width: 100%; height: 100%; object-fit: cover; filter: grayscale(100%);">
                  <span style="position: absolute; bottom: 1rem; left: 1rem; background: #000000; color: #ffffff; padding: 0.4rem 0.8rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Curator &amp; Design Collector</span>
              </div>
              <div style="padding: 1.2rem 0.5rem 0.5rem 0.5rem;">
                  <h3 style="font-size: 1.4rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.25rem;">Louie Chiaino</h3>
                  <p style="font-style: italic; font-size: 0.85rem; margin-bottom: 0.75rem; color: var(--primary-color);">Design History &amp; Collectibles</p>
                  <p style="font-size: 0.9rem; line-height: 1.5; color: var(--text-light); margin-bottom: 0.5rem;">Mapping the emotional resonance and history of everyday items.</p>
              </div>
          </div>

          <!-- Artist 3: Sofia Vieri -->
          <div class="past-exhibit-card" style="background: #ffffff; border: 1px solid var(--border-color); padding: 0.75rem; display: flex; flex-direction: column; cursor: pointer; transition: var(--transition-smooth);" onclick="location.href='<?php echo esc_url( home_url( '/artists/sofia-vieri' ) ); ?>'">
              <div style="overflow: hidden; height: 260px; border-bottom: 1px solid var(--border-color); position: relative;">
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/hero_gallery_3.png" alt="Sofia Vieri" style="width: 100%; height: 100%; object-fit: cover; filter: grayscale(100%);">
                  <span style="position: absolute; bottom: 1rem; left: 1rem; background: #000000; color: #ffffff; padding: 0.4rem 0.8rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Sculpture &amp; Ceramics</span>
              </div>
              <div style="padding: 1.2rem 0.5rem 0.5rem 0.5rem;">
                  <h3 style="font-size: 1.4rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.25rem;">Sofia Vieri</h3>
                  <p style="font-style: italic; font-size: 0.85rem; margin-bottom: 0.75rem; color: var(--primary-color);">Abstract Space &amp; Tension</p>
                  <p style="font-size: 0.9rem; line-height: 1.5; color: var(--text-light); margin-bottom: 0.5rem;">Challenging spatial boundaries with concrete and steel sculptures.</p>
              </div>
          </div>
      <?php endif; ?>
      
    </div>
  </section>

  <!-- Rentals Preview -->
  <section class="section section-alt">
    <div class="container" style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; flex-wrap: wrap;">
      <div>
        <span style="font-weight: 700; text-transform: uppercase; color: var(--primary-color); letter-spacing: 2px; font-size: 0.85rem; display: block; margin-bottom: 1rem;">Modular Gallery Rentals</span>
        <h2 style="font-size: 2.5rem; text-transform: uppercase; margin-bottom: 1.5rem;">Plan Your Event <br>At The Boxx</h2>
        <p style="font-size: 1.1rem; line-height: 1.8; color: var(--text-light); margin-bottom: 2rem;">
          Customize our versatile, high-ceilinged white-wall studio environments to suit your exhibition, workshop, reception, or commercial shoot. We provide professional dimmable track lighting, integrated surround sound, and security support.
        </p>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2.5rem;">
          <div style="border-left: 2px solid var(--primary-color); padding-left: 1rem;">
            <h4 style="font-size: 1.1rem; margin-bottom: 0.25rem;">Space A (400 sq/ft)</h4>
            <p style="font-weight: 700; color: var(--primary-color); font-size: 1.2rem; margin-top: 0.25rem;">$500 <span style="font-size: 0.8rem; font-weight: 400; color: var(--text-light);">/ Day</span></p>
          </div>
          <div style="border-left: 2px solid var(--primary-color); padding-left: 1rem;">
            <h4 style="font-size: 1.1rem; margin-bottom: 0.25rem;">Space B (900 sq/ft)</h4>
            <p style="font-weight: 700; color: var(--primary-color); font-size: 1.2rem; margin-top: 0.25rem;">$800 <span style="font-size: 0.8rem; font-weight: 400; color: var(--text-light);">/ Day</span></p>
          </div>
        </div>
        <a href="<?php echo esc_url( home_url( '/rates' ) ); ?>" class="btn-primary">View Space Rates &amp; Details</a>
      </div>
      <div>
        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/klee_painting.jpg" alt="Mit dem Ei by Paul Klee" style="width: 100%; border-radius: 4px; box-shadow: 0 15px 40px rgba(0,0,0,0.05);">
      </div>
    </div>
  </section>

  <!-- Contact Preview -->
  <section class="section container" style="text-align: center; padding: 7rem 2rem;">
    <div style="max-width: 650px; margin: 0 auto;">
      <span style="font-weight: 700; text-transform: uppercase; color: var(--primary-color); letter-spacing: 2px; font-size: 0.85rem;">Connect With Us</span>
      <h2 style="font-size: 2.5rem; text-transform: uppercase; margin-top: 1rem; margin-bottom: 1.5rem;">Host, Showcase, or Visit</h2>
      <p style="font-size: 1.1rem; line-height: 1.8; color: var(--text-light); margin-bottom: 2.5rem;">
        Whether you are an artist ready to submit your collection, a brand looking to launch a pop-up, or a visitor seeking gallery hours, our curatorial team is ready to welcome you.
      </p>
      <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-primary" style="padding: 1rem 2.5rem; font-size: 1rem; border-radius: 50px;">Inquire / Get In Touch</a>
    </div>
  </section>

  <!-- The Boxx Feed (Social Grid) -->
  <section class="section section-alt container" style="padding-left: 0; padding-right: 0; max-width: 100%;">
    <div class="container" style="text-align: center; margin-bottom: 3rem;">
      <h2 class="section-title">The Boxx Feed</h2>
      <p class="section-subtitle" style="margin-left: auto; margin-right: auto;">Follow our social galleries across Instagram, Facebook, and X.</p>
    </div>

    <div class="social-gallery-container" style="padding: 0 2rem;">
      <div class="social-slider">
        <!-- Social Slide 1 -->
        <a href="https://www.instagram.com/theboxx.art" target="_blank" class="social-slide">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/instagram_1.png" alt="Exhibition Gold Foil Painting">
          <div class="social-overlay">
            <i class="fab fa-instagram"></i>
            <span>Instagram Post</span>
          </div>
        </a>

        <!-- Social Slide 2 -->
        <a href="https://www.instagram.com/theboxx.art" target="_blank" class="social-slide">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/instagram_2.png" alt="Green Light Gallery Installation">
          <div class="social-overlay">
            <i class="fab fa-instagram"></i>
            <span>Instagram Post</span>
          </div>
        </a>

        <!-- Social Slide 3 -->
        <a href="https://www.instagram.com/theboxx.art" target="_blank" class="social-slide">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/instagram_3.png" alt="Industrial Sculpture Exhibition Room">
          <div class="social-overlay">
            <i class="fab fa-instagram"></i>
            <span>Instagram Post</span>
          </div>
        </a>

        <!-- Social Slide 4 -->
        <a href="https://www.instagram.com/theboxx.art" target="_blank" class="social-slide">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/instagram_4.png" alt="Painting of Reclining Woman">
          <div class="social-overlay">
            <i class="fab fa-instagram"></i>
            <span>Instagram Post</span>
          </div>
        </a>

        <!-- Social Slide 5 -->
        <a href="https://www.instagram.com/theboxx.art" target="_blank" class="social-slide">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/instagram_5.png" alt="Abstract Black and White Print Canvas">
          <div class="social-overlay">
            <i class="fab fa-instagram"></i>
            <span>Instagram Post</span>
          </div>
        </a>
      </div>

      <div class="social-controls">
        <button class="social-arrow" id="social-prev" aria-label="Previous Social Photo"><i class="fa-solid fa-arrow-left"></i></button>
        <button class="social-arrow" id="social-next" aria-label="Next Social Photo"><i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>
  </section>

<?php get_footer(); ?>
