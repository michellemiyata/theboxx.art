<?php get_header(); ?>

<!-- Page Header -->
  <section class="exhibits-header" style="background-image: url('<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/hero_gallery_2.png');">
    <div class="container">
      <h1 class="section-title" style="color: #ffffff; margin-bottom: 0;">Rental &amp; Show Rates</h1>
      <p style="color: rgba(255, 255, 255, 0.8); font-size: 1.1rem; margin-top: 0.5rem; letter-spacing: 1px; text-transform: uppercase;">A Full Service Art Exhibit Space</p>
    </div>
  </section>

  <!-- Base Space Rates Grid -->
  <section class="section container">
    <div class="rates-section-header">
      <h2>Base Day Rates</h2>
      <p class="rates-hero-desc">Choose from our premium, versatile physical spaces. Each base day rate includes access to our professional track lighting, climate control, and digital augmentations.</p>
    </div>

    <div class="rates-grid">
      
      <!-- Space A -->
      <div class="rate-card">
        <div class="rate-card-header">
          <span class="floating-badge" style="font-size: 0.65rem; margin-bottom: 0.8rem; padding: 0.35rem 0.9rem; letter-spacing: 1.5px;">Studio Space</span>
          <h3 style="color: var(--primary-color);">Space A</h3>
          <p style="font-weight: 600; font-size: 1.1rem; margin-bottom: 0.5rem;">400 sq/ft</p>
          <p>Perfect for intimate solo showcases, local artist features, or boutique pop-up exhibitions.</p>
        </div>
        <button class="rate-price-btn" onclick="location.href='<?php echo esc_url( home_url( '/contact' ) ); ?>'">$500 / Day</button>
      </div>

      <!-- Space B -->
      <div class="rate-card">
        <div class="rate-card-header">
          <span class="floating-badge" style="font-size: 0.65rem; margin-bottom: 0.8rem; padding: 0.35rem 0.9rem; letter-spacing: 1.5px;">Gallery Hall</span>
          <h3 style="color: var(--primary-color);">Space B</h3>
          <p style="font-weight: 600; font-size: 1.1rem; margin-bottom: 0.5rem;">900 sq/ft</p>
          <p>Ideal for mid-sized exhibitions, collaborative group shows, and private cocktail receptions.</p>
        </div>
        <button class="rate-price-btn" onclick="location.href='<?php echo esc_url( home_url( '/contact' ) ); ?>'">$800 / Day</button>
      </div>

      <!-- Space C -->
      <div class="rate-card">
        <div class="rate-card-header">
          <span class="floating-badge" style="font-size: 0.65rem; margin-bottom: 0.8rem; padding: 0.35rem 0.9rem; letter-spacing: 1.5px;">Premier Pavilion</span>
          <h3 style="color: var(--primary-color);">Space C</h3>
          <p style="font-weight: 600; font-size: 1.1rem; margin-bottom: 0.5rem;">1,400 sq/ft</p>
          <p>Our largest footprint, designed for expansive multi-sensory displays, large audiences, and high-profile events.</p>
        </div>
        <button class="rate-price-btn" onclick="location.href='<?php echo esc_url( home_url( '/contact' ) ); ?>'">$1,200 / Day</button>
      </div>

    </div>
  </section>

  <!-- Space Capacity Specs & Event Styling Section -->
  <section class="section container" style="border-top: 1px solid var(--border-color); padding-top: 5rem; padding-bottom: 5rem;">
    <!-- Specs Table -->
    <div class="specs-table-container" style="margin-top: 0;">
      <h3 style="font-family: var(--font-title); font-size: 1.6rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; text-align: left;">Space Capacity Specs</h3>
      <p style="color: var(--text-light); font-size: 0.95rem; margin-bottom: 1.5rem; text-align: left;">Compare our spatial footprints to find the right container for your guest count</p>
      
      <div style="overflow-x: auto;">
        <table class="specs-table">
          <thead>
            <tr>
              <th>Gallery Footprint</th>
              <th>Dimensions</th>
              <th>Standing Capacity</th>
              <th>Seated Capacity</th>
              <th>Base Day Rate</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="font-weight: 700;">Space A</td>
              <td>400 sq/ft</td>
              <td>35 Guests</td>
              <td>20 Guests</td>
              <td style="font-weight: 700; color: var(--primary-color);">$500</td>
            </tr>
            <tr>
              <td style="font-weight: 700;">Space B</td>
              <td>900 sq/ft</td>
              <td>80 Guests</td>
              <td>50 Guests</td>
              <td style="font-weight: 700; color: var(--primary-color);">$800</td>
            </tr>
            <tr>
              <td style="font-weight: 700;">Space C</td>
              <td>1,400 sq/ft</td>
              <td>120 Guests</td>
              <td>80 Guests</td>
              <td style="font-weight: 700; color: var(--primary-color);">$1,200</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Event Styling / Types Grid -->
    <div class="exhibition-grid-header" style="margin-top: 5rem; margin-bottom: 3rem; text-align: center;">
      <h2 class="grid-title">Versatile Event Styling</h2>
      <p class="grid-subtitle">We accommodate a wide variety of custom formats and bookings</p>
    </div>

    <div class="event-types-grid">
      <!-- Art Exhibitions -->
      <div class="event-type-card">
        <div class="event-icon-wrapper"><i class="fa-solid fa-palette"></i></div>
        <h3>Art Exhibitions</h3>
        <p>Curated solo shows, local collection launches, or group retrospectives. We offer high-quality track lighting, digital augmentations, and curatorial advisement.</p>
      </div>

      <!-- Cocktail Receptions -->
      <div class="event-type-card">
        <div class="event-icon-wrapper"><i class="fa-solid fa-martini-glass-citrus"></i></div>
        <h3>Cocktail Receptions</h3>
        <p>Celebrate in a contemporary environment. Ideal for private networking receptions, corporate mixers, anniversary celebrations, and holiday parties.</p>
      </div>

      <!-- Brand Pop-Ups -->
      <div class="event-type-card">
        <div class="event-icon-wrapper"><i class="fa-solid fa-tags"></i></div>
        <h3>Brand Pop-Ups</h3>
        <p>Launch your product in a premium showroom. Perfect for boutique retail placements, luxury release presentations, fashion shows, and creative workshops.</p>
      </div>

      <!-- Shoots & Filming -->
      <div class="event-type-card">
        <div class="event-icon-wrapper"><i class="fa-solid fa-camera-retro"></i></div>
        <h3>Shoots &amp; Filming</h3>
        <p>A minimalist white-wall backdrop with spacious proportions, suitable for editorial portrait shoots, promotional filming campaigns, and music video sets.</p>
      </div>
    </div>
  </section>

  <!-- Plan Your Own Show (Borderless / Outlines Removed) -->
  <section class="section section-alt">
    <div class="section-divider section-divider-top section-divider-curve">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,1,321.39,56.44Z" class="shape-fill"></path>
      </svg>
    </div>
    <div class="container">
      
      <div class="plan-show-layout">
        
        <!-- Left Side Text -->
        <div class="plan-show-text">
          <h2 style="font-size: 2.5rem; font-weight: 800; text-transform: uppercase; margin-bottom: 1.5rem;">Plan Your Own Show</h2>
          <p class="rates-hero-desc">Customize your exhibition or event at The Boxx with our full-service media, curatorial, and logistical packages. We handle the details so you can focus on the art.</p>
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/klee_painting.jpg" alt="Mit dem Ei by Paul Klee" style="width: 100%; border-radius: 4px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); margin-top: 2rem;">
        </div>

        <!-- Right Side List (No border outlines or containers) -->
        <ul class="plan-show-list">
          
          <li class="plan-show-item">
            <span class="plan-show-name">Live Webcasting Options</span>
            <span class="plan-show-price">$1,000 – $2,500</span>
          </li>
          
          <li class="plan-show-item">
            <span class="plan-show-name">Artistic Director Services</span>
            <span class="plan-show-price">$150 / hr</span>
          </li>

          <li class="plan-show-item">
            <span class="plan-show-name">Project Management Support</span>
            <span class="plan-show-price">$150 / hr</span>
          </li>

          <li class="plan-show-item">
            <span class="plan-show-name">1 Minute Exhibition Sizzle Video</span>
            <span class="plan-show-price">$1,500</span>
          </li>

          <li class="plan-show-item">
            <span class="plan-show-name">30 Second Promotional Video</span>
            <span class="plan-show-price">$1,500</span>
          </li>

          <li class="plan-show-item">
            <span class="plan-show-name">Audio Package (PA System + Speakers &amp; Mic)</span>
            <span class="plan-show-price">$500</span>
          </li>

          <li class="plan-show-item">
            <span class="plan-show-name">Liability Insurance Coverage</span>
            <span class="plan-show-price">$500</span>
          </li>

          <li class="plan-show-item">
            <span class="plan-show-name">Professional Emcee / Host</span>
            <span class="plan-show-price">$1,000</span>
          </li>

          <li class="plan-show-item">
            <span class="plan-show-name">Website Spotlight Feature</span>
            <span class="plan-show-price">$500</span>
          </li>

          <li class="plan-show-item">
            <span class="plan-show-name">Curating Options</span>
            <span class="plan-show-price">From $600</span>
          </li>

          <li class="plan-show-item">
            <span class="plan-show-name">Design and Display Packages</span>
            <span class="plan-show-price">From $500</span>
          </li>

          <li class="plan-show-item">
            <span class="plan-show-name">Lighting Options</span>
            <span class="plan-show-price">From $900</span>
          </li>

          <li class="plan-show-item">
            <span class="plan-show-name">Decor Options</span>
            <span class="plan-show-price">From $750</span>
          </li>

        </ul>

      </div>

    </div>
  </section>

  <!-- Booking Inquiries Section -->
  <section class="section container" style="padding-top: 5rem; padding-bottom: 5rem; border-top: 1px solid var(--border-color);">
    <div class="booking-section-layout">
      <!-- Info Column -->
      <div class="booking-info-box">
        <h3>Inquire About Booking</h3>
        <p>Host your next event in our fully customizable, white-wall environment. Let our team handle setup, safety, and logistical details so you can focus on making a statement.</p>
        
        <h4 style="font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1.5rem; color: var(--text-dark);">Included Amenities</h4>
        <ul class="booking-amenities-list">
          <li><i class="fa-solid fa-circle-check"></i> High-Speed Professional Wi-Fi</li>
          <li><i class="fa-solid fa-circle-check"></i> Modular Dimmable Gallery Spotlighting</li>
          <li><i class="fa-solid fa-circle-check"></i> Accessible Ground Floor Load-In Access</li>
          <li><i class="fa-solid fa-circle-check"></i> Integrated Sonos Surround Sound Speakers</li>
          <li><i class="fa-solid fa-circle-check"></i> Central HVAC Climate Controls</li>
          <li><i class="fa-solid fa-circle-check"></i> On-site Gallery Attendant &amp; Security Support</li>
        </ul>
      </div>

      <!-- Form Column -->
      <div class="booking-form-wrapper">
        <form id="host-booking-form">
          <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="booking-name">Your Full Name *</label>
            <input type="text" id="booking-name" class="form-control" placeholder="John Doe" required>
          </div>
          
          <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="booking-email">Email Address *</label>
            <input type="email" id="booking-email" class="form-control" placeholder="john@example.com" required>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div class="form-group">
              <label for="booking-date">Event Date *</label>
              <input type="date" id="booking-date" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="booking-guests">Estimated Guests *</label>
              <select id="booking-guests" class="form-control" required>
                <option value="" disabled selected>Select count...</option>
                <option value="Under 30">Under 30 Guests</option>
                <option value="30 - 60">30 - 60 Guests</option>
                <option value="60 - 100">60 - 100 Guests</option>
                <option value="100+">100+ Guests</option>
              </select>
            </div>
          </div>

          <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="booking-space">Desired Footprint *</label>
            <select id="booking-space" class="form-control" required>
              <option value="" disabled selected>Choose a space...</option>
              <option value="Space A">Space A (400 sq/ft &bull; Solo Showcase)</option>
              <option value="Space B">Space B (900 sq/ft &bull; Medium Event)</option>
              <option value="Space C">Space C (1,400 sq/ft &bull; Large Showcase)</option>
              <option value="Multiple Spaces">Multiple Spaces (Combined / Custom Layout)</option>
            </select>
          </div>

          <div class="form-group" style="margin-bottom: 2rem;">
            <label for="booking-message">Event Details &amp; Requirements</label>
            <textarea id="booking-message" class="form-control" rows="4" placeholder="Tell us about your catering, AV requirements, or curatorial vision..."></textarea>
          </div>

          <button type="submit" class="waitlist-submit-btn" style="width: 100%; border: none;">
            <span>Submit Booking Request</span>
            <i class="fa-solid fa-paper-plane"></i>
          </button>
        </form>

        <!-- Form Success State -->
        <div class="form-success-message" id="booking-success" style="display: none;">
          <div class="success-icon"><i class="fa-solid fa-circle-check"></i></div>
          <h4 style="text-transform: uppercase; font-size: 1.5rem; margin-bottom: 1rem;">Request Submitted!</h4>
          <p style="color: var(--text-light); line-height: 1.6;">Thank you. Your event request has been received. Our booking curator will contact you at <strong id="success-email-display"></strong> within 24 hours to confirm availability and discuss logistics.</p>
          <button type="button" class="modal-success-close-btn" id="booking-success-reset" style="margin-top: 1rem;">Inquire About Another Date</button>
        </div>
      </div>
    </div>
  </section>

  <!-- High-Contrast Vertical Footer -->
  
<?php get_footer(); ?>
