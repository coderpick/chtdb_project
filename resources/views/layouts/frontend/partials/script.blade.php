    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple counter animation
        const counters = document.querySelectorAll('.counter');
        const speed = 200;

        const animateCounters = () => {
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const updateCount = () => {
                    const count = +counter.innerText;
                    const inc = target / speed;
                    if (count < target) {
                        counter.innerText = Math.ceil(count + inc);
                        setTimeout(updateCount, 1);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCount();
            });
        }

        // Reveal on scroll
        const reveal = () => {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 150;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }
            }
        }

        window.addEventListener("scroll", reveal);
        window.onload = () => {
            reveal();
            animateCounters();
        }

        // Contact form submission
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerHTML;

                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-2"></span>প্রক্রিয়াকরণ হচ্ছে...';

                const formData = new FormData(this);

                fetch('{{ route('contact.store') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            contactForm.reset();
                        } else {
                            alert(data.message || 'কিছু সমস্যা হয়েছে। আবার চেষ্টা করুন।');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('দুঃখিত, সংযোগ বিচ্ছিন্ন হয়েছে। আবার চেষ্টা করুন।');
                    })
                    .finally(() => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnText;
                    });
            });
        }

        // Success stories filter
        const filterBtns = document.querySelectorAll('.filter-btns .btn');
        const storyItems = document.querySelectorAll('.story-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const filter = btn.getAttribute('data-filter');

                storyItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-district') === filter) {
                        item.classList.remove('d-none');
                    } else {
                        item.classList.add('d-none');
                    }
                });
            });
        });

        // Load more success stories
        function loadMore() {
            const moreStories = document.querySelectorAll('.more-story');
            moreStories.forEach(story => story.classList.remove('d-none'));
            document.getElementById('loadMoreBtn').style.display = 'none';
        }

        // Load more testimonials
        function loadMoreTestimonials() {
            document.getElementById('moreTestimonials').style.display = 'flex';
            document.getElementById('loadMoreTestimonialsBtn').style.display = 'none';
        }

        // Toggle password visibility
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }

        // Auth modal switching
        function switchToRegister() {
            bootstrap.Modal.getInstance(document.getElementById('loginModal')).hide();
            new bootstrap.Modal(document.getElementById('registerModal')).show();
        }

        function switchToLogin() {
            bootstrap.Modal.getInstance(document.getElementById('registerModal')).hide();
            new bootstrap.Modal(document.getElementById('loginModal')).show();
        }

        // Gallery Lightbox
        let currentLightboxIndex = 0;
        const galleryImages = Array.from(document.querySelectorAll('.gallery-item img'));

        function openLightbox(index) {
            currentLightboxIndex = index;
            const img = galleryImages[index];
            document.getElementById('lightboxImg').src = img.getAttribute('data-fullsize') || img.src;
            document.getElementById('lightboxCaption').innerText = img.alt;
            document.getElementById('lightboxCounter').innerText = `${index + 1} / ${galleryImages.length}`;
            document.getElementById('galleryLightbox').style.display = 'flex';
        }

        function closeLightbox() {
            document.getElementById('galleryLightbox').style.display = 'none';
        }

        function navigateLightbox(step) {
            currentLightboxIndex = (currentLightboxIndex + step + galleryImages.length) % galleryImages.length;
            openLightbox(currentLightboxIndex);
        }

        // Navbar interaction
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('mainNav');
            if (window.scrollY > 50) {
                nav.classList.add('navbar-scrolled');
            } else {
                nav.classList.remove('navbar-scrolled');
            }
        });
    </script>
