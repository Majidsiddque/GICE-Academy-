/* ============================================
   GICE Academy - main.js
   All interactive functionality
============================================ */

(function () {
    'use strict';

    // ====== Header height -> CSS variable (keeps banners below the fixed header) ======
    (function setHeaderHeight() {
        const hdr = document.querySelector('.header-area');
        if (!hdr) return;
        function measure() {
            const top = hdr.querySelector('.header-top');
            const row = hdr.querySelector('.nav-row');
            let h = 0;
            if (top && top.offsetParent !== null) h += top.getBoundingClientRect().height;
            h += row ? row.getBoundingClientRect().height : hdr.getBoundingClientRect().height;
            if (h > 0) document.documentElement.style.setProperty('--header-h', Math.round(h) + 'px');
        }
        measure();
        window.addEventListener('load', measure);
        window.addEventListener('resize', measure);
        if (document.fonts && document.fonts.ready) document.fonts.ready.then(measure);
        if (window.ResizeObserver) new ResizeObserver(measure).observe(hdr);
    })();

    // ====== Sticky Navigation ======
    const navigation = document.getElementById('navigation');
    const sliderArea = document.querySelector('.slider-area');

    function handleSticky() {
        if (window.scrollY > 50) {
            navigation.classList.add('sticky');
        } else {
            navigation.classList.remove('sticky');
        }
    }
    window.addEventListener('scroll', handleSticky);
    handleSticky();

    // ====== Mobile Nav Toggle ======
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');

    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function () {
            navToggle.classList.toggle('open');
            navMenu.classList.toggle('open');
            document.body.style.overflow = navMenu.classList.contains('open') ? 'hidden' : '';
        });

        // Mobile dropdown toggles
        const menuItems = navMenu.querySelectorAll('.nav-menu > li');
        menuItems.forEach(function (item) {
            const link = item.querySelector(':scope > a');
            const dropdown = item.querySelector('.nav-dropdown');
            if (link && dropdown) {
                link.addEventListener('click', function (e) {
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        item.classList.toggle('open');
                        const chevron = link.querySelector('i');
                        if (chevron) {
                            chevron.style.transform = item.classList.contains('open') ? 'rotate(180deg)' : '';
                        }
                    }
                });
            }
        });

        // Close nav when clicking outside
        document.addEventListener('click', function (e) {
            if (!navToggle.contains(e.target) && !navMenu.contains(e.target)) {
                navToggle.classList.remove('open');
                navMenu.classList.remove('open');
                document.body.style.overflow = '';
            }
        });
    }

    // ====== Hero Slider ======
    const slides = document.querySelectorAll('.single-slider');
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.getElementById('sliderPrev');
    const nextBtn = document.getElementById('sliderNext');
    const ctaSlides = document.querySelectorAll('.hero-cta-slide');
    let currentSlide = 0;
    let sliderInterval = null;

    function goToSlide(index) {
        slides[currentSlide].classList.remove('active');
        if (dots[currentSlide]) dots[currentSlide].classList.remove('active');
        if (ctaSlides[currentSlide]) ctaSlides[currentSlide].classList.remove('active');
        currentSlide = (index + slides.length) % slides.length;
        slides[currentSlide].classList.add('active');
        if (dots[currentSlide]) dots[currentSlide].classList.add('active');
        if (ctaSlides[currentSlide]) ctaSlides[currentSlide].classList.add('active');
    }

    function nextSlide() { goToSlide(currentSlide + 1); }
    function prevSlide() { goToSlide(currentSlide - 1); }

    function startSlider() {
        sliderInterval = setInterval(nextSlide, 5000);
    }
    function stopSlider() {
        clearInterval(sliderInterval);
    }

    if (slides.length > 0) {
        if (prevBtn) prevBtn.addEventListener('click', function () { stopSlider(); prevSlide(); startSlider(); });
        if (nextBtn) nextBtn.addEventListener('click', function () { stopSlider(); nextSlide(); startSlider(); });
        dots.forEach(function (dot, i) {
            dot.addEventListener('click', function () { stopSlider(); goToSlide(i); startSlider(); });
        });
        startSlider();
    }

    // ====== Toppers Carousel ======
    const toppersSlider = document.getElementById('toppersSlider');
    const topperPrev = document.getElementById('topperPrev');
    const topperNext = document.getElementById('topperNext');
    let toppersOffset = 0;

    function getVisibleToppersCount() {
        if (window.innerWidth <= 540) return 1;
        if (window.innerWidth <= 768) return 2;
        if (window.innerWidth <= 900) return 3;
        return 4;
    }

    function slideToppersTo(offset) {
        if (!toppersSlider) return;
        const slides = toppersSlider.querySelectorAll('.topper-slide');
        if (!slides.length) return;
        const visible = getVisibleToppersCount();
        const max = Math.max(0, slides.length - visible);
        toppersOffset = Math.min(Math.max(0, offset), max);

        const gap = parseFloat(getComputedStyle(toppersSlider).gap) || 0;
        const slideWidth = slides[0].getBoundingClientRect().width + gap;
        toppersSlider.style.transform = 'translateX(-' + (toppersOffset * slideWidth) + 'px)';
    }

    if (toppersSlider) {
        toppersSlider.style.display = 'flex';
        toppersSlider.style.transition = 'transform 0.5s ease';

        if (topperPrev) topperPrev.addEventListener('click', function () { slideToppersTo(toppersOffset - 1); });
        if (topperNext) topperNext.addEventListener('click', function () { slideToppersTo(toppersOffset + 1); });

        // Auto-slide toppers
        setInterval(function () {
            const slides = toppersSlider.querySelectorAll('.topper-slide');
            const visible = getVisibleToppersCount();
            const max = Math.max(0, slides.length - visible);
            if (toppersOffset >= max) {
                slideToppersTo(0);
            } else {
                slideToppersTo(toppersOffset + 1);
            }
        }, 3500);
    }
    
    
    // ===== Testimonials Slider =====
const testimonials = document.querySelectorAll('.single-testimonial-content');
const testimonialDots = document.querySelectorAll('.t-dot');

let currentTestimonial = 0;

function goToTestimonial(index) {
    testimonials.forEach(function(testimonial) {
        testimonial.classList.remove('active');
    });

    testimonialDots.forEach(function(dot) {
        dot.classList.remove('active');
    });

    currentTestimonial = index % testimonials.length;

    // Show 3 testimonials
    for (let i = 0; i < 3; i++) {
        testimonials[(currentTestimonial + i) % testimonials.length].classList.add('active');
    }

    if (testimonialDots[currentTestimonial]) {
        testimonialDots[currentTestimonial].classList.add('active');
    }
}

if (testimonials.length > 0) {
    testimonialDots.forEach(function(dot, i) {
        dot.addEventListener('click', function() {
            goToTestimonial(i);
        });
    });

    goToTestimonial(0);

    setInterval(function() {
        currentTestimonial = (currentTestimonial + 3) % testimonials.length;
        goToTestimonial(currentTestimonial);
    }, 5000);
}

    // ====== Counter Animation ======
    function animateCounter(el) {
        const target = parseInt(el.getAttribute('data-count'), 10);
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const timer = setInterval(function () {
            current += step;
            if (current >= target) {
                el.textContent = target.toLocaleString();
                clearInterval(timer);
            } else {
                el.textContent = Math.floor(current).toLocaleString();
            }
        }, 16);
    }

    // ====== Intersection Observer (animate on scroll) ======
    const observerOptions = { threshold: 0.15, rootMargin: '0px 0px -50px 0px' };

    // For count animations
    const counterObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll('.count');
                counters.forEach(function (c) { animateCounter(c); });
                counterObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const counterArea = document.querySelector('.counter-area');
    if (counterArea) counterObserver.observe(counterArea);

    // For animate-up elements
    const animateObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry, i) {
            if (entry.isIntersecting) {
                setTimeout(function () {
                    entry.target.classList.add('visible');
                }, i * 80);
                animateObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-up').forEach(function (el) {
        animateObserver.observe(el);
    });

    // Generic fade-in for sections
    const fadeObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                fadeObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    const sections = document.querySelectorAll('.about-area, .toppers-area, .testimonials-area, .newsletter-area');
    sections.forEach(function (s) {
        s.style.opacity = '0';
        s.style.transform = 'translateY(20px)';
        s.style.transition = 'opacity 0.7s ease, transform 0.7s ease';
        fadeObserver.observe(s);
    });

    // ====== Back to Top ======
    const backToTop = document.getElementById('backToTop');
    if (backToTop) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 300) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });
        backToTop.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ====== Smooth scroll for anchor links ======
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        if (anchor.getAttribute('href') === '#') return;
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const headerHeight = document.querySelector('.header-area').offsetHeight;
                const targetPos = target.getBoundingClientRect().top + window.scrollY - headerHeight - 20;
                window.scrollTo({ top: targetPos, behavior: 'smooth' });
                // Close mobile menu
                if (navMenu && navMenu.classList.contains('open')) {
                    navToggle.classList.remove('open');
                    navMenu.classList.remove('open');
                    document.body.style.overflow = '';
                }
            }
        });
    });

    // ====== Resize handler ======
    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            if (navMenu) navMenu.classList.remove('open');
            if (navToggle) navToggle.classList.remove('open');
            document.body.style.overflow = '';
        }
    });

    // ====== Slider pause on hover ======
    if (sliderArea) {
        sliderArea.addEventListener('mouseenter', stopSlider);
        sliderArea.addEventListener('mouseleave', startSlider);
    }

    // ====== Courses hover effect - stagger ======
    const courseCards = document.querySelectorAll('.single-courses');
    courseCards.forEach(function (card, i) {
        card.style.transitionDelay = (i % 4) * 0.07 + 's';
    });

    console.log('GICE Academy - Loaded successfully');
})();

/* ===== Keep page banners below the fixed header ===== */
(function () {
    const hdr = document.querySelector('.header-area');
    if (!hdr) return;
    function fixBanner() {
        const top = hdr.querySelector('.header-top');
        const row = hdr.querySelector('.nav-row');
        let h = 0;
        if (top && top.offsetParent !== null) h += top.getBoundingClientRect().height;
        h += row ? row.getBoundingClientRect().height : hdr.getBoundingClientRect().height;
        h = Math.round(h);
        if (h <= 0) return;
        document.documentElement.style.setProperty('--header-h', h + 'px');
        document.querySelectorAll('.page-banner').forEach(function (b) {
            b.style.setProperty('padding-top', (h + 40) + 'px', 'important');
        });
    }
    fixBanner();
    window.addEventListener('load', fixBanner);
    window.addEventListener('resize', fixBanner);
    if (document.fonts && document.fonts.ready) document.fonts.ready.then(fixBanner);
    if (window.ResizeObserver) new ResizeObserver(fixBanner).observe(hdr);
})();
