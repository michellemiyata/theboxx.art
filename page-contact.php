<?php get_header(); ?>

<!-- Page Header -->
  <section class="exhibits-header" style="background-image: url('<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/hero_gallery_4.png');">
    <div class="container">
      <h1 class="section-title" style="color: #ffffff; margin-bottom: 0;">Contact &amp; Location</h1>
      <p style="color: rgba(255, 255, 255, 0.8); font-size: 1.1rem; margin-top: 0.5rem; letter-spacing: 1px; text-transform: uppercase;">Connect with The Boxx</p>
    </div>
  </section>

  <!-- Main Contact Section -->
  <section class="section container">
    <div class="contact-layout">
      
      <!-- Left Column: Location, Hours, Map -->
      <div class="contact-info-col">
        <span class="floating-badge">Locate The Studio</span>
        <h2 class="section-title" style="margin-bottom: 1rem;">Find Us</h2>
        <p style="font-size: 1.1rem; color: var(--text-light); margin-bottom: 3rem; line-height: 1.8;">We are conveniently situated in the heart of Vaughan's creative business hub. Drop by during opening hours or book a private viewing.</p>
        
        <div class="contact-info-details">
          
          <div class="contact-info-block">
            <h4>Gallery Location</h4>
            <p>207 Edgeley Blvd, Unit #8<br>Concord, Vaughan, ON L4K 4B5</p>
          </div>

          <div class="contact-info-block">
            <h4>General Inquiries</h4>
            <p>Email: info@theboxx.art</p>
          </div>

          <div class="contact-info-block">
            <h4>Gallery Hours</h4>
            <p>Tue – Thu: 9:00 AM – 7:00 PM</p>
            <p>Fri – Sat: 9:00 AM – 5:00 PM</p>
            <p>Sun: 8:00 AM – 6:00 PM</p>
            <p style="color: var(--primary-color); font-weight: 600;">Monday: Closed</p>
          </div>

        </div>

        <!-- Google Maps Embed -->
        <div class="map-container">
          <iframe 
            src="https://maps.google.com/maps?q=207%20Edgeley%20Blvd%2C%20Unit%20%238%20Concord%2C%20ON%20L4K%204B5&amp;t=m&amp;z=14&amp;output=embed&amp;iwloc=near" 
            title="207 Edgeley Blvd, Unit #8 Concord, ON L4K 4B5" 
            aria-label="207 Edgeley Blvd, Unit #8 Concord, ON L4K 4B5"
            allowfullscreen="" 
            loading="lazy">
          </iframe>
        </div>
      </div>

      <!-- Right Column: Outlined Contact Form -->
      <div class="contact-form-col">
        <div class="contact-form-box">
          <h3 style="font-size: 1.8rem; font-weight: 800; text-transform: uppercase; margin-bottom: 2rem;">Send a Message</h3>
          
          <form id="theboxx-contact-form">
            
            <!-- First & Last Name at the Top -->
            <div class="contact-form-row">
              <div class="form-group">
                <label for="first-name">First Name *</label>
                <input type="text" id="first-name" class="form-control" placeholder="John" required>
              </div>
              <div class="form-group">
                <label for="last-name">Last Name *</label>
                <input type="text" id="last-name" class="form-control" placeholder="Doe" required>
              </div>
            </div>

            <!-- Email -->
            <div class="form-group">
              <label for="email">Email Address *</label>
              <input type="email" id="email" class="form-control" placeholder="john.doe@example.com" required>
            </div>

            <!-- Subject -->
            <div class="form-group">
              <label for="subject">Subject</label>
              <input type="text" id="subject" class="form-control" placeholder="Gallery Rental / Artist Submission">
            </div>

            <!-- Message -->
            <div class="form-group" style="margin-bottom: 2.5rem;">
              <label for="message">Message or Comments *</label>
              <textarea id="message" class="form-control" placeholder="Write your message here..." required></textarea>
            </div>

            <!-- Submit Button (Highly Rounded and Bold Text) -->
            <button type="submit" class="btn-submit">Submit Message</button>

          </form>
        </div>
      </div>

    </div>
  </section>

  <!-- High-Contrast Vertical Footer -->
  
<?php get_footer(); ?>
