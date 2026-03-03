document.addEventListener("DOMContentLoaded", () => {

    // Register GSAP plugins
    gsap.registerPlugin(ScrollTrigger);

    // Prevent iOS Safari auto-refresh loops when URL bar hides/shows
    ScrollTrigger.config({ ignoreMobileResize: true });

    // --- Preloader Animation ---
    const tlPreloader = gsap.timeline();
    tlPreloader.to('.preloader-logo', { opacity: 1, duration: 1, ease: "power2.out" })
        .to('.preloader-logo', { scale: 1.1, duration: 2, ease: "power2.inOut" }, "-=1")
        .to('.preloader', { yPercent: -100, duration: 1.2, ease: "expo.inOut", delay: 0.5 })
        .from('.hero-content > *', { y: 50, opacity: 0, duration: 1, stagger: 0.2, ease: "power3.out" }, "-=0.5");

    // --- Mobile Menu Toggle ---
    const menuToggle = document.querySelector('.menu-toggle');
    const menuClose = document.querySelector('.menu-close');
    const mobileNav = document.querySelector('.mobile-nav');
    const mobileLinks = document.querySelectorAll('.mobile-nav .nav-link');

    if (menuToggle && menuClose) {
        menuToggle.addEventListener('click', () => mobileNav.classList.add('active'));
        menuClose.addEventListener('click', () => mobileNav.classList.remove('active'));
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => mobileNav.classList.remove('active'));
        });
    }

    // --- Header Scrolled State + Floating Language Toggle ---
    const header = document.querySelector('.site-header');
    const langFloat = document.getElementById('lang-float');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        // Show sticky language button when scrolled past top bar area
        if (langFloat) {
            if (window.scrollY > 200) {
                langFloat.classList.add('visible');
            } else {
                langFloat.classList.remove('visible');
            }
        }
    });

    // --- Hero Slider Logic ---
    const slides = document.querySelectorAll('.hero-slider .slide');
    if (slides.length > 1) {
        let currentSlide = 0;
        setInterval(() => {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }, 6000); // Change slide every 6 seconds
    }

    // --- GSAP Scroll Animations ---

    // Parallax effect on Hero Video/Image
    gsap.to('.hero-slider', {
        yPercent: 30,
        ease: "none",
        scrollTrigger: {
            trigger: ".hero",
            start: "top top",
            end: "bottom top",
            scrub: true
        }
    });

    // Story Section Hover Animation (Cinematic Video feel)
    const storyWrapper = document.querySelector('.cinematic-wrapper');
    const cinematicSlides = document.querySelectorAll('.story-cinematic-img');
    const cinematicTexts = document.querySelectorAll('.story-text-slide');

    if (storyWrapper && cinematicSlides.length > 0) {
        let currentSlide = 0;

        // Automatic slow crossfade loop
        setInterval(() => {
            cinematicSlides[currentSlide].style.opacity = '0';
            cinematicSlides[currentSlide].style.transform = 'scale(1)';

            if (cinematicTexts[currentSlide]) {
                cinematicTexts[currentSlide].style.opacity = '0';
            }

            currentSlide = (currentSlide + 1) % cinematicSlides.length;

            cinematicSlides[currentSlide].style.opacity = '1';
            cinematicSlides[currentSlide].style.transform = 'scale(1.05)';

            if (cinematicTexts[currentSlide]) {
                cinematicTexts[currentSlide].style.opacity = '1';
            }
        }, 5000); // Crossfade every 5 seconds

        // Hover Effect
        storyWrapper.addEventListener('mouseenter', () => {
            cinematicSlides[currentSlide].style.filter = 'brightness(0.5)';
        });
        storyWrapper.addEventListener('mouseleave', () => {
            cinematicSlides[currentSlide].style.filter = 'brightness(0.7)';
        });
    }

    // Fade up texts
    const fadeTexts = document.querySelectorAll('.fade-up');
    fadeTexts.forEach(text => {
        gsap.from(text, {
            y: 50,
            opacity: 0,
            duration: 1,
            ease: "power3.out",
            scrollTrigger: {
                trigger: text,
                start: "top 85%",
            }
        });
    });

    // Individual Category Cards Fade up
    const categoryCards = document.querySelectorAll('.category-card');
    categoryCards.forEach(card => {
        gsap.from(card, {
            y: 30,
            opacity: 0,
            duration: 0.7,
            ease: "power2.out",
            scrollTrigger: {
                trigger: card,
                start: "top 85%",
                toggleActions: "play none none none"
            },
            onComplete: () => {
                gsap.set(card, { clearProps: "all" });
            }
        });
    });

    // Smooth Scroll utility for links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            if (this.getAttribute('href') !== '#') {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

});
