<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <script>
    // Prevent FOUC: if they have seen the intro, don't apply loading-active
    if (!sessionStorage.getItem('theboxx_intro_seen')) {
      document.body.classList.add('loading-active');
    }
  </script>

  <!-- Preloader Screen -->
  <div id="preloader" class="preloader">
    <div class="preloader-content">
      <div class="preloader-logo-wrapper">
        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/logo.png" alt="The Boxx Logo" class="preloader-logo-img">
      </div>
      <h1 class="preloader-title">THE BOXX</h1>
      <div class="preloader-line-separator"></div>
      <p class="preloader-subtitle">ART GALLERY</p>
    </div>
  </div>

  <!-- Navigation Bar -->
  <header class="navbar">
    <div class="container">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-brand">
        <!-- Official Logo Integrated -->
        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/logo.png" alt="The Boxx Logo" class="nav-logo" style="height: 45px; width: auto; object-fit: contain;">
      </a>
      
      <!-- Nav Menu -->
      <nav>
        <ul class="nav-menu">
          <li class="nav-item <?php echo is_front_page() ? 'active' : ''; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
          <li class="nav-item <?php echo is_post_type_archive('exhibition') || is_singular('exhibition') ? 'active' : ''; ?>"><a href="<?php echo esc_url( get_post_type_archive_link( 'exhibition' ) ); ?>">Exhibitions</a></li>
          <li class="nav-item <?php echo is_post_type_archive('artist') || is_singular('artist') ? 'active' : ''; ?>"><a href="<?php echo esc_url( get_post_type_archive_link( 'artist' ) ); ?>">Artists</a></li>
          <li class="nav-item <?php echo is_page('rates') ? 'active' : ''; ?>"><a href="<?php echo esc_url( home_url( '/rates' ) ); ?>">Rentals & Rates</a></li>
          <li class="nav-item <?php echo is_page('contact') ? 'active' : ''; ?>"><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
          
          <!-- Mobile Social Links -->
          <li class="nav-socials mobile-only">
            <a href="https://www.facebook.com/theboxx" class="nav-social-icon" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/theboxx.art" class="nav-social-icon" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="https://x.com/theboxx" class="nav-social-icon" target="_blank" aria-label="X"><i class="fab fa-x-twitter"></i></a>
          </li>
        </ul>
      </nav>

      <!-- Desktop Socials -->
      <div class="nav-socials desktop-only">
        <a href="https://www.facebook.com/theboxx" class="nav-social-icon" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/theboxx.art" class="nav-social-icon" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="https://x.com/theboxx" class="nav-social-icon" target="_blank" aria-label="X"><i class="fab fa-x-twitter"></i></a>
      </div>

      <!-- Hamburger Menu (Mobile Toggle) -->
      <button class="nav-hamburger" aria-label="Toggle Navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </header>
