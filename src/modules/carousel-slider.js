"use strict";

export default function carousel($refs, config = {}) {
    return {
        slider: $refs.slider,
        cards: $refs.slider.querySelectorAll('.card'),
        index: 0,
        offset: 0,
        gap: 0,
        slidesPerView: 1,

        breakpoints: config.breakpoints ?? {},
        autoScroll: config.autoScroll ?? true,
        autoScrollFrequency: config.autoScrollFrequency ?? 3500,
        pauseOnHover: config.pauseOnHover ?? true,

        autoScrollInterval: null,
        autoScrollListenersAdded: false,

        init() {
            this.recalculate();

            if (this.autoScroll) {
                this.startAutoScroll();
            }

            this.handleManualScrolling();

            this.addMouseInteraction();
        },

        recalculate() {
            this.updateSlidesPerView();
            const cardWidth = (this.slider.offsetWidth - (this.gap * (this.slidesPerView - 1))) / this.slidesPerView;
            for (const card of this.cards) {
                card.style.minWidth = cardWidth + 'px';
            }
            this.slider.style.gap = this.gap + 'px';
            this.offset = cardWidth;
        },

        updateSlidesPerView() {
            if (Object.keys(this.breakpoints).length === 0) {
                this.breakpoints = {
                    0: { slidesPerView: 1, gap: 0 },
                    425: { slidesPerView: 2, gap: 12 },
                    768: { slidesPerView: 3, gap: 12 },
                    1024: { slidesPerView: 4, gap: 12 },
                    1440: { slidesPerView: 5, gap: 12 }
                };
            }
            const w = window.innerWidth;
            const currentBreakpoint = Object.keys(this.breakpoints)
                .sort((a, b) => b - a)
                .find(key => w >= key);

            this.slidesPerView = currentBreakpoint ? this.breakpoints[currentBreakpoint].slidesPerView : 1;
            this.gap = currentBreakpoint ? this.breakpoints[currentBreakpoint].gap : 0;
        },

        slideBack() {
            const isAtStart = this.slider.scrollLeft <= 0;

            if (isAtStart) {
                // At the beginning, go to the last slide
                const lastCard = this.cards[this.cards.length - 1].offsetLeft;
                this.slider.scrollTo({ left: lastCard, behavior: 'smooth' });
            } else {
                this.slider.scrollBy({ left: -(this.offset), behavior: 'smooth' });
            }

            this.index = this.index === 0 ? this.cards.length - 1 : this.index - 1;
        },

        slideForw() {
            const maxScroll = this.slider.scrollWidth - this.slider.clientWidth;
            const isAtEnd = Math.ceil(this.slider.scrollLeft) >= maxScroll;

            if (isAtEnd) {
                // At the end, go back to the first slide
                this.slider.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                this.slider.scrollBy({ left: this.offset, behavior: 'smooth' });
            }

            this.index = this.index === this.cards.length - 1 ? 0 : this.index + 1;
        },

        startAutoScroll() {
            if (!this.autoScroll) return;

            this.setupAutoScrollListeners();

            clearInterval(this.autoScrollInterval);
            this.autoScrollInterval = setInterval(() => this.slideForw(), this.autoScrollFrequency);
        },

        setupAutoScrollListeners() {
            if (!this.pauseOnHover || this.autoScrollListenersAdded) return;

            this.slider.addEventListener('mouseenter', () => clearInterval(this.autoScrollInterval));
            this.slider.addEventListener('mouseleave', () => this.startAutoScroll());
            this.autoScrollListenersAdded = true;
        },

        handleManualScrolling() {
            let isScrolling;
            this.slider.addEventListener('scroll', () => {
                clearTimeout(isScrolling);
                isScrolling = setTimeout(() => {
                    clearInterval(this.autoScrollInterval);
                    this.updateIndexOnScroll();
                    if (this.autoScroll) {
                        this.startAutoScroll();
                    }
                }, 100);
            });
        },

        // Determine the current active slide based on user-initiated scrolling
        updateIndexOnScroll() {
            let closestCardIndex = 0;
            let smallestDistance = Infinity;

            for (let i = 0; i < this.cards.length; i++) {
                const distance = Math.abs(this.slider.scrollLeft - this.cards[i].offsetLeft);
                if (distance < smallestDistance) {
                    smallestDistance = distance;
                    closestCardIndex = i;
                }
            }
            if (this.index !== closestCardIndex) {
                this.index = closestCardIndex;
            }
        },

        /**
         * Add mouse interaction for desktop devices
         */
        startX: 0,
        isDragging: false,

        addMouseInteraction() {
            this.slider.addEventListener('mousedown', (e) => this.handleStart(e));
            this.slider.addEventListener('mousemove', (e) => this.handleMove(e));
            this.slider.addEventListener('mouseup', (e) => this.handleEnd(e));
            this.slider.addEventListener('mouseleave', (e) => this.handleEnd(e));
        },

        handleStart(e) {
            e.preventDefault();
            this.isDragging = true;
            this.startX = e.clientX;
        },

        handleMove(e) {
            e.preventDefault();
            if (!this.isDragging) return;
            for (const card of this.cards) {
                card.classList.remove('snap-start');
                card.classList.add('pointer-events-none');
            }
            const scroll = this.startX - e.clientX;
            this.slider.scrollBy({ left: scroll, behavior: 'auto' });
            this.startX = e.clientX;
        },

        handleEnd(e) {
            e.preventDefault();
            this.isDragging = false;

            // Find the closest card to snap to
            let closestCard = null;
            let smallestDistance = Infinity;
            for (const card of this.cards) {
                const distance = Math.abs(this.slider.scrollLeft - card.offsetLeft);
                if (distance < smallestDistance) {
                    smallestDistance = distance;
                    closestCard = card;
                }
            }
            // Smoothly scroll to the calculated snap position
            if (closestCard) {
                this.slider.scrollTo({
                    left: closestCard.offsetLeft,
                    behavior: 'smooth'
                });
            }
            // Restore card classes
            for (const card of this.cards) {
                card.classList.add('snap-start');
                card.classList.remove('pointer-events-none');
            }
        },
    };
}
