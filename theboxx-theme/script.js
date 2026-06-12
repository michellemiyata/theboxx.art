document.addEventListener('DOMContentLoaded', () => {
  
  // ==========================================
  // 0. INTRO PRELOADER ANIMATION
  // ==========================================
  const preloader = document.getElementById('preloader');
  
  if (preloader) {
    const hasSeenIntro = sessionStorage.getItem('theboxx_intro_seen');
    
    if (hasSeenIntro) {
      preloader.style.display = 'none';
      document.body.classList.remove('loading');
      document.body.classList.remove('loading-active');
    } else {
      // Add loading scroll-lock
      document.body.classList.add('loading');
      
      const hidePreloader = () => {
        if (!preloader.classList.contains('fade-out')) {
          preloader.classList.add('fade-out');
          document.body.classList.remove('loading');
          
          // Trigger the page contents transition
          document.body.classList.add('loaded-content');
          
          // Save session state
          sessionStorage.setItem('theboxx_intro_seen', 'true');
          
          // Remove from layout after animation runs
          setTimeout(() => {
            preloader.style.display = 'none';
          }, 1000); // matches CSS transition duration
        }
      };
      
      // Auto-dismiss after 2.8s (giving animations time to complete)
      const dismissTimeout = setTimeout(hidePreloader, 2800);
      
      // Check if page already loaded, otherwise bind to load event
      if (document.readyState === 'complete') {
        setTimeout(hidePreloader, 2500);
      } else {
        window.addEventListener('load', () => {
          clearTimeout(dismissTimeout);
          setTimeout(hidePreloader, 2500);
        });
      }
    }
  }

  // ==========================================
  // 1. MOBILE NAVIGATION HAMBURGER MENU
  // ==========================================
  const hamburger = document.querySelector('.nav-hamburger');
  const navMenu = document.querySelector('.nav-menu');
  
  if (hamburger && navMenu) {
    hamburger.addEventListener('click', () => {
      hamburger.classList.toggle('active');
      navMenu.classList.toggle('active');
    });

    // Close menu when clicking a link
    document.querySelectorAll('.nav-item a').forEach(link => {
      link.addEventListener('click', () => {
        hamburger.classList.remove('active');
        navMenu.classList.remove('active');
      });
    });
  }

  // ==========================================
  // 2. 5-IMAGE HERO CAROUSEL (HOMEPAGE)
  // ==========================================
  const heroSlides = document.querySelectorAll('.hero-slide');
  const heroDots = document.querySelectorAll('.hero-dot');
  const heroPrev = document.querySelector('.hero-arrow.prev');
  const heroNext = document.querySelector('.hero-arrow.next');
  const heroSlidesContainer = document.querySelector('.hero-slides');
  let currentHeroIndex = 0;
  let heroInterval;

  if (heroSlides.length > 0) {
    const showHeroSlide = (index) => {
      heroSlides.forEach(slide => slide.classList.remove('active'));
      heroDots.forEach(dot => dot.classList.remove('active'));
      
      currentHeroIndex = (index + heroSlides.length) % heroSlides.length;
      
      // Perform horizontal sliding transition
      if (heroSlidesContainer) {
        heroSlidesContainer.style.transform = `translateX(-${currentHeroIndex * 100}%)`;
      }
      
      // Keep active class to trigger internal fade/slide text animations
      heroSlides[currentHeroIndex].classList.add('active');
      if (heroDots[currentHeroIndex]) {
        heroDots[currentHeroIndex].classList.add('active');
      }
    };

    const nextHeroSlide = () => {
      showHeroSlide(currentHeroIndex + 1);
    };

    const prevHeroSlide = () => {
      showHeroSlide(currentHeroIndex - 1);
    };

    const startHeroAutoPlay = () => {
      stopHeroAutoPlay();
      heroInterval = setInterval(nextHeroSlide, 6000);
    };

    const stopHeroAutoPlay = () => {
      if (heroInterval) clearInterval(heroInterval);
    };

    if (heroNext) {
      heroNext.addEventListener('click', () => {
        nextHeroSlide();
        startHeroAutoPlay();
      });
    }

    if (heroPrev) {
      heroPrev.addEventListener('click', () => {
        prevHeroSlide();
        startHeroAutoPlay();
      });
    }

    heroDots.forEach((dot, idx) => {
      dot.addEventListener('click', () => {
        showHeroSlide(idx);
        startHeroAutoPlay();
      });
    });

    // Touch & Mouse Drag Swipe support
    let startX = 0;
    let endX = 0;
    const threshold = 50;

    const heroSlider = document.querySelector('.hero-slider');
    if (heroSlider) {
      // Touch events
      heroSlider.addEventListener('touchstart', (e) => {
        startX = e.changedTouches[0].screenX;
        stopHeroAutoPlay();
      }, { passive: true });

      heroSlider.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].screenX;
        handleSwipe();
        startHeroAutoPlay();
      }, { passive: true });

      // Mouse events for desktop drag preview
      heroSlider.addEventListener('mousedown', (e) => {
        startX = e.screenX;
        stopHeroAutoPlay();
      });

      heroSlider.addEventListener('mouseup', (e) => {
        endX = e.screenX;
        handleSwipe();
        startHeroAutoPlay();
      });

      const handleSwipe = () => {
        const diff = startX - endX;
        if (Math.abs(diff) > threshold) {
          if (diff > 0) {
            nextHeroSlide();
          } else {
            prevHeroSlide();
          }
        }
      };
    }

    // Initialize autoplay
    startHeroAutoPlay();
  }

  // ==========================================
  // 3. FEATURED EXHIBITS SLIDER (HOMEPAGE)
  // ==========================================
  const featSlides = document.querySelectorAll('.featured-exhibit-slide');
  const featPrev = document.getElementById('feat-prev');
  const featNext = document.getElementById('feat-next');
  let currentFeatIndex = 0;

  if (featSlides.length > 0) {
    const showFeatSlide = (index) => {
      featSlides.forEach(slide => slide.classList.remove('active'));
      currentFeatIndex = (index + featSlides.length) % featSlides.length;
      featSlides[currentFeatIndex].classList.add('active');
    };

    if (featNext) {
      featNext.addEventListener('click', () => showFeatSlide(currentFeatIndex + 1));
    }
    if (featPrev) {
      featPrev.addEventListener('click', () => showFeatSlide(currentFeatIndex - 1));
    }
  }

  // ==========================================
  // 4. SOCIAL MEDIA FEED CAROUSEL (FOOTER TEASER)
  // ==========================================
  const socialSlider = document.querySelector('.social-slider');
  const socialSlides = document.querySelectorAll('.social-slide');
  const socialPrev = document.getElementById('social-prev');
  const socialNext = document.getElementById('social-next');
  let currentSocialIndex = 0;

  if (socialSlider && socialSlides.length > 0) {
    const getVisibleSlidesCount = () => {
      if (window.innerWidth < 768) return 1;
      if (window.innerWidth < 992) return 2;
      return 3; // 3 items carousel as requested
    };

    const updateSocialSlider = () => {
      const visibleCount = getVisibleSlidesCount();
      const maxIndex = Math.max(0, socialSlides.length - visibleCount);
      
      if (currentSocialIndex > maxIndex) {
        currentSocialIndex = maxIndex;
      }
      
      const slideWidth = socialSlides[0].getBoundingClientRect().width;
      const gap = 32; // Gap of 2rem
      const offset = currentSocialIndex * (slideWidth + gap);
      
      socialSlider.style.transform = `translateX(-${offset}px)`;
    };

    const nextSocialSlide = () => {
      const visibleCount = getVisibleSlidesCount();
      if (currentSocialIndex < socialSlides.length - visibleCount) {
        currentSocialIndex++;
        updateSocialSlider();
      } else {
        // Loop back to start
        currentSocialIndex = 0;
        updateSocialSlider();
      }
    };

    const prevSocialSlide = () => {
      if (currentSocialIndex > 0) {
        currentSocialIndex--;
        updateSocialSlider();
      } else {
        // Loop to end
        const visibleCount = getVisibleSlidesCount();
        currentSocialIndex = Math.max(0, socialSlides.length - visibleCount);
        updateSocialSlider();
      }
    };

    if (socialNext) {
      socialNext.addEventListener('click', nextSocialSlide);
    }

    if (socialPrev) {
      socialPrev.addEventListener('click', prevSocialSlide);
    }

    // Touch & Mouse Drag Swipe support
    let socialStartX = 0;
    let socialEndX = 0;
    const socialThreshold = 50;

    const socialGalleryContainer = document.querySelector('.social-gallery-container');
    if (socialGalleryContainer) {
      socialGalleryContainer.addEventListener('touchstart', (e) => {
        socialStartX = e.changedTouches[0].screenX;
      }, { passive: true });

      socialGalleryContainer.addEventListener('touchend', (e) => {
        socialEndX = e.changedTouches[0].screenX;
        handleSocialSwipe();
      }, { passive: true });

      socialGalleryContainer.addEventListener('mousedown', (e) => {
        socialStartX = e.screenX;
      });

      socialGalleryContainer.addEventListener('mouseup', (e) => {
        socialEndX = e.screenX;
        handleSocialSwipe();
      });

      const handleSocialSwipe = () => {
        const diff = socialStartX - socialEndX;
        if (Math.abs(diff) > socialThreshold) {
          if (diff > 0) {
            nextSocialSlide();
          } else {
            prevSocialSlide();
          }
        }
      };
    }

    window.addEventListener('resize', updateSocialSlider);
    updateSocialSlider();
  }

  // ==========================================
  // 5. PAST EXHIBITIONS SLIDER (EXHIBITS PAGE)
  // ==========================================
  const pastSlider = document.querySelector('.past-exhibits-slider');
  const pastSlides = document.querySelectorAll('.past-exhibit-slide');
  const pastPrev = document.getElementById('past-prev');
  const pastNext = document.getElementById('past-next');
  const pastPagination = document.querySelector('.past-exhibits-pagination');
  let currentPastIndex = 0;

  if (pastSlider && pastSlides.length > 0) {
    const updatePastSlider = () => {
      const offset = currentPastIndex * 100;
      pastSlider.style.transform = `translateX(-${offset}%)`;
      
      if (pastPagination) {
        const currentStr = String(currentPastIndex + 1).padStart(2, '0');
        const totalStr = String(pastSlides.length).padStart(2, '0');
        pastPagination.textContent = `${currentStr} / ${totalStr}`;
      }
    };

    const nextPastSlide = () => {
      currentPastIndex = (currentPastIndex + 1) % pastSlides.length;
      updatePastSlider();
    };

    const prevPastSlide = () => {
      currentPastIndex = (currentPastIndex - 1 + pastSlides.length) % pastSlides.length;
      updatePastSlider();
    };

    if (pastNext) {
      pastNext.addEventListener('click', nextPastSlide);
    }

    if (pastPrev) {
      pastPrev.addEventListener('click', prevPastSlide);
    }

    // Touch & Mouse Drag Swipe support
    let pastStartX = 0;
    let pastEndX = 0;
    const pastThreshold = 50;

    const pastExhibitsContainer = document.querySelector('.past-exhibits-container');
    if (pastExhibitsContainer) {
      pastExhibitsContainer.addEventListener('touchstart', (e) => {
        pastStartX = e.changedTouches[0].screenX;
      }, { passive: true });

      pastExhibitsContainer.addEventListener('touchend', (e) => {
        pastEndX = e.changedTouches[0].screenX;
        handlePastSwipe();
      }, { passive: true });

      pastExhibitsContainer.addEventListener('mousedown', (e) => {
        pastStartX = e.screenX;
      });

      pastExhibitsContainer.addEventListener('mouseup', (e) => {
        pastEndX = e.screenX;
        handlePastSwipe();
      });

      const handlePastSwipe = () => {
        const diff = pastStartX - pastEndX;
        if (Math.abs(diff) > pastThreshold) {
          if (diff > 0) {
            nextPastSlide();
          } else {
            prevPastSlide();
          }
        }
      };
    }

    updatePastSlider();
  }

  // ==========================================
  // 6. INTERACTIVE CALENDAR BOOKING WIDGET
  // ==========================================
  const calendarDates = document.querySelectorAll('.calendar-date:not(.disabled)');
  const bookingPanel = document.getElementById('booking-panel');
  const selectedDateText = document.getElementById('selected-date-text');
  const slotsContainer = document.querySelector('.booking-slots');
  const reserveBtn = document.getElementById('confirm-reservation-btn');
  let selectedDate = null;
  let selectedSlot = null;

  if (calendarDates.length > 0) {
    calendarDates.forEach(dateElement => {
      dateElement.addEventListener('click', () => {
        calendarDates.forEach(d => d.classList.remove('active'));
        dateElement.classList.add('active');
        
        selectedDate = dateElement.getAttribute('data-date');
        selectedDateText.textContent = selectedDate;
        
        // Populate slots based on date
        slotsContainer.innerHTML = '';
        const slots = ['12:00 PM - 2:00 PM', '3:00 PM - 5:00 PM', '6:00 PM - 8:00 PM'];
        
        slots.forEach(slotText => {
          const slotElement = document.createElement('div');
          slotElement.className = 'booking-slot';
          slotElement.textContent = slotText;
          slotElement.addEventListener('click', () => {
            document.querySelectorAll('.booking-slot').forEach(s => s.classList.remove('selected'));
            slotElement.classList.add('selected');
            selectedSlot = slotText;
            
            if (reserveBtn) {
              reserveBtn.disabled = false;
            }
          });
          slotsContainer.appendChild(slotElement);
        });
        
        if (bookingPanel) {
          bookingPanel.classList.add('active');
          // Smooth scroll to panel on mobile
          if (window.innerWidth < 768) {
            bookingPanel.scrollIntoView({ behavior: 'smooth' });
          }
        }
      });
    });

    if (reserveBtn) {
      reserveBtn.addEventListener('click', () => {
        if (selectedDate && selectedSlot) {
          alert(`Success! Your invitation request for ${selectedDate} at ${selectedSlot} has been received. We look forward to seeing you at The Boxx!`);
          
          // Reset
          calendarDates.forEach(d => d.classList.remove('active'));
          if (bookingPanel) bookingPanel.classList.remove('active');
          selectedDate = null;
          selectedSlot = null;
          reserveBtn.disabled = true;
        }
      });
    }
  }

  // ==========================================
  // 7. CLIENT SIDE CONTACT FORM SUBMISSION
  // ==========================================
  const contactForm = document.getElementById('theboxx-contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const firstName = document.getElementById('first-name').value;
      const lastName = document.getElementById('last-name').value;
      const email = document.getElementById('email').value;
      
      alert(`Thank you, ${firstName} ${lastName}! Your message has been sent successfully. We will contact you at ${email} within 24 hours.`);
      contactForm.reset();
    });
  }

  const homepageContactForm = document.getElementById('homepage-contact-form');
  if (homepageContactForm) {
    homepageContactForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const firstName = document.getElementById('home-first-name').value;
      const lastName = document.getElementById('home-last-name').value;
      const email = document.getElementById('home-email').value;
      
      alert(`Thank you, ${firstName} ${lastName}! Your message has been sent successfully. We will contact you at ${email} within 24 hours.`);
      homepageContactForm.reset();
    });
  }

  // ==========================================
  // 8. VIP TICKET WAITLIST MODAL
  // ==========================================
  const ticketsBtn = document.getElementById('tickets-btn');
  const ticketsModal = document.getElementById('tickets-modal');
  const modalCloseBtn = document.getElementById('modal-close-btn');
  const waitlistForm = document.getElementById('waitlist-form');
  const modalSuccess = document.getElementById('modal-success');
  const modalSuccessCloseBtn = document.getElementById('modal-success-close-btn');

  if (ticketsBtn && ticketsModal) {
    const openModal = () => {
      ticketsModal.classList.add('active');
      document.body.classList.add('loading');
    };

    const closeModal = () => {
      ticketsModal.classList.remove('active');
      document.body.classList.remove('loading');
      // Reset form and success state after animation finishes
      setTimeout(() => {
        if (waitlistForm) waitlistForm.style.display = 'flex';
        if (modalSuccess) modalSuccess.style.display = 'none';
        if (waitlistForm) waitlistForm.reset();
      }, 400);
    };

    ticketsBtn.addEventListener('click', openModal);
    if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeModal);
    if (modalSuccessCloseBtn) modalSuccessCloseBtn.addEventListener('click', closeModal);

    // Close on backdrop click
    ticketsModal.addEventListener('click', (e) => {
      if (e.target === ticketsModal) {
        closeModal();
      }
    });

    if (waitlistForm) {
      waitlistForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const nameVal = document.getElementById('waitlist-name').value;
        const emailVal = document.getElementById('waitlist-email').value;
        const dateVal = document.getElementById('waitlist-date').value;

        // Populate success screen
        const successDate = document.getElementById('success-date-val');
        const successEmail = document.getElementById('success-email-val');
        if (successDate) successDate.textContent = dateVal;
        if (successEmail) successEmail.textContent = emailVal;

        // Switch states
        waitlistForm.style.display = 'none';
        if (modalSuccess) modalSuccess.style.display = 'block';
      });
    }
  }

  // ==========================================
  // 9. CUSTOM ARTWORK LIGHTBOX GALLERY
  // ==========================================
  const artworkCards = document.querySelectorAll('.artwork-card');
  const lightboxModal = document.getElementById('lightbox-modal');
  const lightboxImg = document.getElementById('lightbox-img');
  const lightboxTitle = document.getElementById('lightbox-title');
  const lightboxArtist = document.getElementById('lightbox-artist');
  const lightboxClose = document.getElementById('lightbox-close');
  const lightboxPrev = document.getElementById('lightbox-prev');
  const lightboxNext = document.getElementById('lightbox-next');

  let currentArtworkIndex = 0;

  if (artworkCards.length > 0 && lightboxModal) {
    const updateLightbox = (index) => {
      currentArtworkIndex = index;
      const card = artworkCards[index];
      const img = card.querySelector('img');
      const title = card.querySelector('.artwork-meta h4');
      const artist = card.querySelector('.artwork-meta p');

      if (img && lightboxImg) {
        lightboxImg.src = img.src;
        lightboxImg.alt = img.alt || 'Artwork';
      }
      if (title && lightboxTitle) {
        lightboxTitle.textContent = title.textContent;
      }
      if (artist && lightboxArtist) {
        lightboxArtist.textContent = artist.textContent;
      }
    };

    const openLightbox = (index) => {
      updateLightbox(index);
      lightboxModal.classList.add('active');
      document.body.classList.add('loading');
    };

    const closeLightbox = () => {
      lightboxModal.classList.remove('active');
      document.body.classList.remove('loading');
    };

    artworkCards.forEach((card, idx) => {
      card.addEventListener('click', () => {
        openLightbox(idx);
      });
    });

    if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);

    const showNextArtwork = () => {
      let nextIdx = (currentArtworkIndex + 1) % artworkCards.length;
      updateLightbox(nextIdx);
    };

    const showPrevArtwork = () => {
      let prevIdx = (currentArtworkIndex - 1 + artworkCards.length) % artworkCards.length;
      updateLightbox(prevIdx);
    };

    if (lightboxNext) lightboxNext.addEventListener('click', showNextArtwork);
    if (lightboxPrev) lightboxPrev.addEventListener('click', showPrevArtwork);

    // Close on background click
    lightboxModal.addEventListener('click', (e) => {
      if (e.target === lightboxModal) {
        closeLightbox();
      }
    });

    // Keyboard support
    document.addEventListener('keydown', (e) => {
      if (!lightboxModal.classList.contains('active')) return;

      if (e.key === 'Escape') {
        closeLightbox();
      } else if (e.key === 'ArrowRight') {
        showNextArtwork();
      } else if (e.key === 'ArrowLeft') {
        showPrevArtwork();
      }
    });
  }

  // ==========================================
  // 10. HOST EVENT BOOKING FORM
  // ==========================================
  const hostBookingForm = document.getElementById('host-booking-form');
  const bookingSuccess = document.getElementById('booking-success');
  const successEmailDisplay = document.getElementById('success-email-display');
  const bookingSuccessReset = document.getElementById('booking-success-reset');

  if (hostBookingForm) {
    hostBookingForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const emailVal = document.getElementById('booking-email').value;
      if (successEmailDisplay) successEmailDisplay.textContent = emailVal;
      
      hostBookingForm.style.display = 'none';
      if (bookingSuccess) bookingSuccess.style.display = 'block';
    });

    if (bookingSuccessReset) {
      bookingSuccessReset.addEventListener('click', () => {
        if (bookingSuccess) bookingSuccess.style.display = 'none';
        hostBookingForm.style.display = 'block';
        hostBookingForm.reset();
      });
    }
  }
});
