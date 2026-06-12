  <!-- High-Contrast Vertical Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        
        <!-- Col 1: Brand -->
        <div class="footer-col">
          <!-- Logo in Footer -->
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/logo.png" alt="The Boxx Logo" style="height: 60px; width: auto; object-fit: contain; margin-bottom: 1.5rem; filter: brightness(0) invert(1);">
          <p>A contemporary gallery hosting boundary-pushing physical exhibitions, augmented reality displays, and custom studio event rentals in Concord/Vaughan.</p>
          <div class="footer-socials">
            <a href="https://www.facebook.com/theboxx" class="footer-social-icon" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/theboxx.art" class="footer-social-icon" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="https://x.com/theboxx" class="footer-social-icon" target="_blank" aria-label="X"><i class="fab fa-x-twitter"></i></a>
          </div>
        </div>

        <!-- Col 2: Navigation Links -->
        <div class="footer-col">
          <h4>Explore</h4>
          <ul class="footer-links">
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
            <li><a href="<?php echo esc_url( get_post_type_archive_link( 'exhibition' ) ); ?>">Exhibitions</a></li>
            <li><a href="<?php echo esc_url( get_post_type_archive_link( 'artist' ) ); ?>">Artists</a></li>
            <li><a href="<?php echo esc_url( home_url( '/rates' ) ); ?>">Rentals &amp; Rates</a></li>
            <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact Us</a></li>
          </ul>
        </div>

        <!-- Col 3: Hours -->
        <div class="footer-col">
          <h4>Gallery Hours</h4>
          <p>Tue – Thu: 9:00 AM – 7:00 PM</p>
          <p>Fri – Sat: 9:00 AM – 5:00 PM</p>
          <p>Sun: 8:00 AM – 6:00 PM</p>
          <p style="color: var(--primary-color);">Monday: Closed</p>
        </div>

        <!-- Col 4: Location -->
        <div class="footer-col">
          <h4>Address</h4>
          <p>207 Edgeley Blvd, Unit #8<br>Concord, Vaughan, ON<br>L4K 4B5</p>
          <p><i class="fa-solid fa-envelope" style="margin-right: 8px;"></i>info@theboxx.art</p>
        </div>

      </div>

      <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> The Boxx Art Gallery. All rights reserved.</p>
        <p>Designed for Accessibility &amp; Contemporary Excellence</p>
      </div>
    </div>
  </footer>

  <?php wp_footer(); ?>
</body>
</html>
