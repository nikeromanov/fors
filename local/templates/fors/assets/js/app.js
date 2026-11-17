// Theme toggle (light/dark) with icon swap
(function () {
  const THEME_KEY = 'theme';
  const root = document.documentElement; // use class on <html>

  function applyTheme(theme) {
    const isDark = theme === 'dark';
    root.classList.toggle('theme-dark', isDark);

    // aria state
    const toggleBtn = document.querySelector('[data-action="toggle-theme"]');
    if (toggleBtn) toggleBtn.setAttribute('aria-checked', String(isDark));

    // Toggle switch теперь работает через CSS и aria-checked - смена состояния автоматическая

    document.querySelectorAll('.js-site-logo').forEach((logo) => {
      const darkSrc = logo.getAttribute('data-logo-dark');
      const lightSrc = logo.getAttribute('data-logo-light');
      if (!darkSrc || !lightSrc) return;
      logo.setAttribute('src', isDark ? darkSrc : lightSrc);
    });
    updateThemeAwareAssets(isDark);
  }

  function getPreferredTheme() {
    const saved = localStorage.getItem(THEME_KEY);
    if (saved === 'dark' || saved === 'light') return saved;
    // Учитываем системные настройки пользователя
    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
  }

  // Слушаем изменения системной темы (если пользователь не выбрал тему вручную)
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
    if (!localStorage.getItem(THEME_KEY)) {
      applyTheme(e.matches ? 'dark' : 'light');
    }
  });

  document.addEventListener('DOMContentLoaded', () => {
    // init
    applyTheme(getPreferredTheme());

    // bind
    const toggle = document.querySelector('[data-action="toggle-theme"]');
    if (toggle) {
      toggle.addEventListener('click', () => {
        const isDark = root.classList.contains('theme-dark');
        const next = isDark ? 'light' : 'dark';
        localStorage.setItem(THEME_KEY, next);
        applyTheme(next);
      });
    }

    initSiteMenu();
    initSocialPopover();
    initPriceTabs();
    initDistrictTabs();
    initContactsMap();
    initScheduleTabs();
    initReviewsTabs();
    initRouteButtons();
    initSwiperSliders();
    initFancybox();
  });

  // Fancybox initialization
  function initFancybox() {
    // Ждем загрузки Fancybox
    const checkFancybox = setInterval(() => {
      if (typeof Fancybox !== 'undefined') {
        clearInterval(checkFancybox);

        Fancybox.bind('[data-fancybox]', {
          // Настройки Fancybox
          /*Toolbar: {
            display: {
              left: ['infobar'],
              middle: [],
              right: ['slideshow', 'thumbs', 'close'],
            },
          },*/
          Thumbs: {
            autoStart: false,
          },
          closeButton: 'auto',
          animated: true,
          hideScrollbar: true,
          dragToClose: true,
          closeClickOutside: true,
          keyboard: {
            Escape: 'close',
          },
        });

        console.log('Fancybox initialized');
      }
    }, 100);

    // Таймаут на случай, если библиотека не загрузится
    setTimeout(() => {
      clearInterval(checkFancybox);
      if (typeof Fancybox === 'undefined') {
        console.warn('Fancybox library not loaded');
      }
    }, 5000);
  }

  function initSiteMenu() {
    const menu = document.querySelector('#site-menu');
    if (!menu) return;

    const panel = menu.querySelector('.site-menu__panel');
    if (!panel) return;

    const openers = document.querySelectorAll('[data-action="toggle-menu"]');
    const closers = menu.querySelectorAll('[data-action="close-menu"]');
    const focusableSelector =
      'a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])';
    let previousFocus = null;
    let closingFallback = null;
    let pendingTransitionHandler = null;
    let openAnimationFrame = null;

    openers.forEach((button) => {
      button.setAttribute('aria-expanded', 'false');
      button.addEventListener('click', () => {
        if (menu.dataset.state === 'open') {
          closeMenu();
        } else {
          openMenu(button);
        }
      });
    });

    closers.forEach((button) => {
      button.addEventListener('click', closeMenu);
    });

    menu.addEventListener('click', (event) => {
      if (event.target === menu) {
        closeMenu();
      }
    });

    function openMenu(trigger) {
      if (menu.dataset.state === 'open' || menu.dataset.state === 'opening') return;
      if (menu.dataset.state === 'closing') {
        finalizeClose({ restoreFocus: false });
      }
      if (openAnimationFrame) {
        window.cancelAnimationFrame(openAnimationFrame);
        openAnimationFrame = null;
      }

      menu.dataset.state = 'opening';
      previousFocus = trigger instanceof HTMLElement ? trigger : document.activeElement;
      menu.hidden = false;
      document.body.classList.add('is-menu-open');
      openers.forEach((btn) => btn.setAttribute('aria-expanded', 'true'));
      openAnimationFrame = window.requestAnimationFrame(() => {
        menu.classList.add('site-menu--visible');
        menu.dataset.state = 'open';
        openAnimationFrame = null;
      });
      document.addEventListener('keydown', handleKeydown);
      menu.addEventListener('keydown', trapFocus);
      const focusable = getFocusable();
      const focusTarget = focusable[0] || panel;
      if (focusTarget) {
        focusTarget.focus({ preventScroll: true });
      }
    }

    function closeMenu() {
      if (menu.dataset.state !== 'open' && menu.dataset.state !== 'opening') return;
      if (openAnimationFrame) {
        window.cancelAnimationFrame(openAnimationFrame);
        openAnimationFrame = null;
      }
      menu.dataset.state = 'closing';
      menu.classList.remove('site-menu--visible');
      document.body.classList.remove('is-menu-open');
      openers.forEach((btn) => btn.setAttribute('aria-expanded', 'false'));

      if (pendingTransitionHandler) {
        menu.removeEventListener('transitionend', pendingTransitionHandler);
        pendingTransitionHandler = null;
      }

      const handleTransitionEnd = (event) => {
        if (event.target !== menu) return;
        finalizeClose();
      };

      pendingTransitionHandler = handleTransitionEnd;
      menu.addEventListener('transitionend', handleTransitionEnd, { once: true });
      closingFallback = window.setTimeout(() => finalizeClose(), 450);
    }

    function finalizeClose({ restoreFocus = true } = {}) {
      if (menu.dataset.state === 'closed') return;
      menu.hidden = true;
      menu.dataset.state = 'closed';
      document.removeEventListener('keydown', handleKeydown);
      menu.removeEventListener('keydown', trapFocus);
      if (restoreFocus && previousFocus instanceof HTMLElement) {
        previousFocus.focus({ preventScroll: true });
      }
      previousFocus = null;

      if (closingFallback) {
        window.clearTimeout(closingFallback);
        closingFallback = null;
      }

      if (pendingTransitionHandler) {
        menu.removeEventListener('transitionend', pendingTransitionHandler);
        pendingTransitionHandler = null;
      }

      if (openAnimationFrame) {
        window.cancelAnimationFrame(openAnimationFrame);
        openAnimationFrame = null;
      }
    }

    function handleKeydown(event) {
      if (event.key === 'Escape') {
        event.preventDefault();
        closeMenu();
      }
    }

    function trapFocus(event) {
      if (event.key !== 'Tab') return;
      const focusable = getFocusable();
      if (focusable.length === 0) {
        event.preventDefault();
        panel.focus({ preventScroll: true });
        return;
      }

      const first = focusable[0];
      const last = focusable[focusable.length - 1];
      const active = document.activeElement;

      if (event.shiftKey && active === first) {
        event.preventDefault();
        last.focus({ preventScroll: true });
      } else if (!event.shiftKey && active === last) {
        event.preventDefault();
        first.focus({ preventScroll: true });
      }
    }

    function getFocusable() {
      return Array.from(menu.querySelectorAll(focusableSelector)).filter((element) => {
        if (!(element instanceof HTMLElement)) return false;
        if (element.hasAttribute('disabled') || element.getAttribute('aria-hidden') === 'true') return false;
        const rect = element.getBoundingClientRect();
        return rect.width > 0 && rect.height > 0;
      });
    }
  }

  function initSocialPopover() {
    const popovers = document.querySelectorAll('[data-social-popover]');
    if (!popovers.length) return;

    popovers.forEach((popover) => {
      const trigger = popover.querySelector('[data-social-trigger]');
      const panel = popover.querySelector('[data-social-panel]');
      if (!trigger || !panel) return;

      let previousFocus = null;

      function setOpen(isOpen, { restoreFocus = true } = {}) {
        trigger.setAttribute('aria-expanded', String(isOpen));
        if (isOpen) {
          previousFocus = document.activeElement;
          panel.hidden = false;
          const firstLink = panel.querySelector('a[href]');
          if (firstLink) firstLink.focus({ preventScroll: true });
        } else {
          panel.hidden = true;
          if (restoreFocus && previousFocus instanceof HTMLElement) {
            previousFocus.focus({ preventScroll: true });
          }
          previousFocus = null;
        }
      }

      trigger.addEventListener('click', () => {
        setOpen(trigger.getAttribute('aria-expanded') !== 'true');
      });

      document.addEventListener('click', (event) => {
        if (trigger.getAttribute('aria-expanded') === 'true' && !popover.contains(event.target)) {
          setOpen(false, { restoreFocus: false });
        }
      });

      document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && trigger.getAttribute('aria-expanded') === 'true') {
          event.preventDefault();
          setOpen(false);
        }
      });
    });
  }

  function initPriceTabs() {
    const groups = document.querySelectorAll('.js-price-tabs');
    groups.forEach((group) => {
      const triggers = Array.from(group.querySelectorAll('.js-price-tab'));
      const panels = Array.from(group.querySelectorAll('.js-price-panel'));
      if (triggers.length === 0 || panels.length === 0) return;

      const panelMap = new Map();
      panels.forEach((panel) => {
        if (panel.id) {
          panelMap.set(panel.id, panel);
        }
      });

      const selectedTrigger = triggers.find((btn) => btn.getAttribute('aria-selected') === 'true');
      let activeId =
        (selectedTrigger && selectedTrigger.dataset.priceTab) ||
        (panels[0] && panels[0].id) ||
        (triggers[0] && triggers[0].dataset.priceTab);

      function setActive(nextId, { focus = false } = {}) {
        if (!nextId) return;
        const trigger = triggers.find((btn) => btn.dataset.priceTab === nextId);
        const panel = panelMap.get(nextId) || panels.find((node) => node.id === nextId);
        if (!trigger || !panel) return;

        triggers.forEach((btn) => {
          const isCurrent = btn === trigger;
          btn.classList.toggle('price-tabs__trigger--active', isCurrent);
          btn.setAttribute('aria-selected', String(isCurrent));
          btn.setAttribute('tabindex', isCurrent ? '0' : '-1');
        });

        panels.forEach((node) => {
          const isCurrent = node === panel;
          if (isCurrent) {
            node.removeAttribute('hidden');
            node.setAttribute('tabindex', '0');
          } else {
            if (!node.hasAttribute('hidden')) {
              node.setAttribute('hidden', '');
            }
            node.removeAttribute('tabindex');
          }
        });

        activeId = nextId;
        if (focus) {
          trigger.focus({ preventScroll: true });
        }
      }

      setActive(activeId);

      function handleKeydown(event, current) {
        const { key } = event;
        if (
          !['ArrowRight', 'ArrowLeft', 'ArrowUp', 'ArrowDown', 'Home', 'End', 'Enter', ' ', 'Spacebar'].includes(key)
        ) {
          return;
        }
        event.preventDefault();
        if (key === 'Enter' || key === ' ' || key === 'Spacebar') {
          setActive(current.dataset.priceTab);
          return;
        }

        let nextIndex;
        const currentIndex = triggers.indexOf(current);
        if (key === 'Home') {
          nextIndex = 0;
        } else if (key === 'End') {
          nextIndex = triggers.length - 1;
        } else if (key === 'ArrowRight' || key === 'ArrowDown') {
          nextIndex = (currentIndex + 1) % triggers.length;
        } else if (key === 'ArrowLeft' || key === 'ArrowUp') {
          nextIndex = (currentIndex - 1 + triggers.length) % triggers.length;
        }

        const nextTrigger = triggers[nextIndex];
        if (nextTrigger) {
          setActive(nextTrigger.dataset.priceTab, { focus: true });
        }
      }

      triggers.forEach((trigger) => {
        trigger.addEventListener('click', () => setActive(trigger.dataset.priceTab, { focus: true }));
        trigger.addEventListener('keydown', (event) => handleKeydown(event, trigger));
      });
    });
  }

  function createLocationMap(container) {
    if (!container || !window.L) return null;

    const leaflet = window.L;
    const map = leaflet.map(container, { scrollWheelZoom: false });
    leaflet.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);
    map.attributionControl.setPrefix(false);

    const icon = leaflet.divIcon({
      className: 'location-map__marker',
      iconSize: [28, 32],
      iconAnchor: [14, 31],
      popupAnchor: [0, -30],
    });
    const markers = leaflet.featureGroup().addTo(map);

    return (pointsJson) => {
      markers.clearLayers();
      const points = JSON.parse(pointsJson || '[]');
      points.forEach(({ coords, title, subtitle }) => {
        if (typeof coords !== 'string') return;
        const parts = coords.split(',').map((value) => value.trim());
        if (parts.length !== 2 || parts.some((value) => value === '')) return;
        const [lat, lng] = parts.map(Number);
        if (!Number.isFinite(lat) || !Number.isFinite(lng) || Math.abs(lat) > 90 || Math.abs(lng) > 180) return;

        const label = [title, subtitle].filter(Boolean).join(' — ');
        const marker = leaflet.marker([lat, lng], { icon, title: label });
        if (label) {
          const popup = document.createElement('span');
          popup.textContent = label;
          marker.bindPopup(popup);
        }
        markers.addLayer(marker);
      });

      map.invalidateSize({ pan: false });
      const bounds = markers.getBounds();
      if (bounds.isValid()) {
        map.fitBounds(bounds, { padding: [40, 40], maxZoom: 16, animate: false });
      } else {
        map.setView([51.672, 39.184], 12, { animate: false });
      }
    };
  }

  function initContactsMap() {
    const container = document.querySelector('.js-contacts-map');
    const renderPoints = createLocationMap(container);
    renderPoints?.(container.dataset.coords);
  }

  function initDistrictTabs() {
    const groups = document.querySelectorAll('.js-district-tabs');
    groups.forEach((group) => {
      const triggers = Array.from(group.querySelectorAll('[data-district-tab]'));
      const panels = Array.from(group.querySelectorAll('.js-district-panel'));
      const mapContainer = group.querySelector('.js-district-map');
      if (triggers.length === 0 || panels.length === 0) return;
      const renderPoints = createLocationMap(mapContainer);

      const panelMap = new Map();
      panels.forEach((panel) => {
        if (panel.id) {
          panelMap.set(panel.id, panel);
        }
      });

      const selectedTrigger = triggers.find((btn) => btn.getAttribute('aria-selected') === 'true');
      let activeId =
        (selectedTrigger && selectedTrigger.dataset.districtTab) ||
        (panels[0] && panels[0].id) ||
        (triggers[0] && triggers[0].dataset.districtTab);

      function setActive(nextId, { focus = false } = {}) {
        if (!nextId) return;
        const trigger = triggers.find((btn) => btn.dataset.districtTab === nextId);
        const panel = panelMap.get(nextId) || panels.find((node) => node.id === nextId);
        if (!trigger || !panel) return;

        triggers.forEach((btn) => {
          const isCurrent = btn === trigger;
          btn.classList.toggle('tabs__button--active', isCurrent);
          btn.setAttribute('aria-selected', String(isCurrent));
          btn.setAttribute('tabindex', isCurrent ? '0' : '-1');
        });

        panels.forEach((node) => {
          const isCurrent = node === panel;
          if (isCurrent) {
            node.removeAttribute('hidden');
            node.setAttribute('tabindex', '0');
          } else {
            if (!node.hasAttribute('hidden')) {
              node.setAttribute('hidden', '');
            }
            node.removeAttribute('tabindex');
          }
        });

        const districtId = nextId.replace('district-', '');
        renderPoints?.(mapContainer.getAttribute(`data-coords-${districtId}`));

        activeId = nextId;
        if (focus) {
          trigger.focus({ preventScroll: true });
        }
      }

      setActive(activeId);

      function handleKeydown(event, current) {
        const { key } = event;
        if (
          !['ArrowRight', 'ArrowLeft', 'ArrowUp', 'ArrowDown', 'Home', 'End', 'Enter', ' ', 'Spacebar'].includes(key)
        ) {
          return;
        }
        event.preventDefault();
        if (key === 'Enter' || key === ' ' || key === 'Spacebar') {
          setActive(current.dataset.districtTab);
          return;
        }

        let nextIndex;
        const currentIndex = triggers.indexOf(current);
        if (key === 'Home') {
          nextIndex = 0;
        } else if (key === 'End') {
          nextIndex = triggers.length - 1;
        } else if (key === 'ArrowRight' || key === 'ArrowDown') {
          nextIndex = (currentIndex + 1) % triggers.length;
        } else if (key === 'ArrowLeft' || key === 'ArrowUp') {
          nextIndex = (currentIndex - 1 + triggers.length) % triggers.length;
        }

        const nextTrigger = triggers[nextIndex];
        if (nextTrigger) {
          setActive(nextTrigger.dataset.districtTab, { focus: true });
        }
      }

      triggers.forEach((trigger) => {
        trigger.addEventListener('click', () => setActive(trigger.dataset.districtTab, { focus: true }));
        trigger.addEventListener('keydown', (event) => handleKeydown(event, trigger));
      });
    });
  }

  function initReviewsTabs() {
    const groups = document.querySelectorAll('.js-reviews-tabs');
    groups.forEach((group) => {
      const triggers = Array.from(group.querySelectorAll('[data-reviews-tab]'));
      const panels = Array.from(group.querySelectorAll('.js-reviews-panel'));
      if (triggers.length === 0 || panels.length === 0) return;

      const panelMap = new Map();
      panels.forEach((panel) => {
        if (panel.id) {
          panelMap.set(panel.id, panel);
        }
      });

      const selectedTrigger = triggers.find((btn) => btn.getAttribute('aria-selected') === 'true');
      let activeId =
        (selectedTrigger && selectedTrigger.dataset.reviewsTab) ||
        (panels[0] && panels[0].id) ||
        (triggers[0] && triggers[0].dataset.reviewsTab);

      function setActive(nextId, { focus = false } = {}) {
        if (!nextId) return;
        const trigger = triggers.find((btn) => btn.dataset.reviewsTab === nextId);
        const panel = panelMap.get(nextId) || panels.find((node) => node.id === nextId);
        if (!trigger || !panel) return;

        triggers.forEach((btn) => {
          const isCurrent = btn === trigger;
          btn.classList.toggle('tabs__button--active', isCurrent);
          btn.setAttribute('aria-selected', String(isCurrent));
          btn.setAttribute('tabindex', isCurrent ? '0' : '-1');
        });

        panels.forEach((node) => {
          const isCurrent = node === panel;
          if (isCurrent) {
            node.removeAttribute('hidden');
            node.setAttribute('tabindex', '0');
          } else {
            if (!node.hasAttribute('hidden')) {
              node.setAttribute('hidden', '');
            }
            node.removeAttribute('tabindex');
          }
        });

        activeId = nextId;
        if (focus) {
          trigger.focus({ preventScroll: true });
        }
      }

      setActive(activeId);

      function handleKeydown(event, current) {
        const { key } = event;
        if (
          !['ArrowRight', 'ArrowLeft', 'ArrowUp', 'ArrowDown', 'Home', 'End', 'Enter', ' ', 'Spacebar'].includes(key)
        ) {
          return;
        }
        event.preventDefault();
        if (key === 'Enter' || key === ' ' || key === 'Spacebar') {
          setActive(current.dataset.reviewsTab);
          return;
        }

        let nextIndex;
        const currentIndex = triggers.indexOf(current);
        if (key === 'Home') {
          nextIndex = 0;
        } else if (key === 'End') {
          nextIndex = triggers.length - 1;
        } else if (key === 'ArrowRight' || key === 'ArrowDown') {
          nextIndex = (currentIndex + 1) % triggers.length;
        } else if (key === 'ArrowLeft' || key === 'ArrowUp') {
          nextIndex = (currentIndex - 1 + triggers.length) % triggers.length;
        }

        const nextTrigger = triggers[nextIndex];
        if (nextTrigger) {
          setActive(nextTrigger.dataset.reviewsTab, { focus: true });
        }
      }

      triggers.forEach((trigger) => {
        trigger.addEventListener('click', () => setActive(trigger.dataset.reviewsTab, { focus: true }));
        trigger.addEventListener('keydown', (event) => handleKeydown(event, trigger));
      });
    });
  }

  function initRouteButtons() {
    const buttons = document.querySelectorAll('.js-build-route');
    buttons.forEach((button) => {
      button.addEventListener('click', () => {
        const coords = button.getAttribute('data-coords');
        if (!coords) return;

        // Формат: https://yandex.ru/maps/?rtext=~lat,lon&rtt=auto
        // ~ означает "от моего местоположения"
        const url = `https://yandex.ru/maps/?rtext=~${coords}&rtt=auto`;
        window.open(url, '_blank', 'noopener,noreferrer');
      });
    });
  }

  function initScheduleTabs() {
    const groups = document.querySelectorAll('.js-schedule-tabs');
    groups.forEach((group) => {
      const triggers = Array.from(group.querySelectorAll('[data-schedule-tab]'));
      const panels = Array.from(group.querySelectorAll('.schedule-district'));
      if (triggers.length === 0 || panels.length === 0) return;

      const panelMap = new Map();
      panels.forEach((panel) => {
        if (panel.id) {
          panelMap.set(panel.id, panel);
        }
      });

      const selectedTrigger = triggers.find((btn) => btn.getAttribute('aria-selected') === 'true');
      let activeId =
        (selectedTrigger && selectedTrigger.dataset.scheduleTab) ||
        (panels[0] && panels[0].id) ||
        (triggers[0] && triggers[0].dataset.scheduleTab);

      function setActive(nextId, { focus = false } = {}) {
        if (!nextId) return;
        const trigger = triggers.find((btn) => btn.dataset.scheduleTab === nextId);
        const panel = panelMap.get(nextId) || panels.find((node) => node.id === nextId);
        if (!trigger || !panel) return;

        triggers.forEach((btn) => {
          const isCurrent = btn === trigger;
          // Support both schedule-nav and driving-sidebar classes
          btn.classList.toggle('schedule-nav__link--current', isCurrent);
          btn.classList.toggle('driving-sidebar__link--active', isCurrent);
          btn.setAttribute('aria-selected', String(isCurrent));
          btn.setAttribute('tabindex', isCurrent ? '0' : '-1');
        });

        panels.forEach((node) => {
          const isCurrent = node === panel;
          if (isCurrent) {
            node.removeAttribute('hidden');
            node.classList.add('schedule-district--active');
          } else {
            if (!node.hasAttribute('hidden')) {
              node.setAttribute('hidden', '');
            }
            node.classList.remove('schedule-district--active');
          }
        });

        activeId = nextId;
        if (focus) {
          trigger.focus({ preventScroll: true });
        }
      }

      setActive(activeId);

      function handleKeydown(event, current) {
        const { key } = event;
        if (
          !['ArrowRight', 'ArrowLeft', 'ArrowUp', 'ArrowDown', 'Home', 'End', 'Enter', ' ', 'Spacebar'].includes(key)
        ) {
          return;
        }
        event.preventDefault();
        if (key === 'Enter' || key === ' ' || key === 'Spacebar') {
          setActive(current.dataset.scheduleTab);
          return;
        }

        let nextIndex;
        const currentIndex = triggers.indexOf(current);
        if (key === 'Home') {
          nextIndex = 0;
        } else if (key === 'End') {
          nextIndex = triggers.length - 1;
        } else if (key === 'ArrowRight' || key === 'ArrowDown') {
          nextIndex = (currentIndex + 1) % triggers.length;
        } else if (key === 'ArrowLeft' || key === 'ArrowUp') {
          nextIndex = (currentIndex - 1 + triggers.length) % triggers.length;
        }

        const nextTrigger = triggers[nextIndex];
        if (nextTrigger) {
          setActive(nextTrigger.dataset.scheduleTab, { focus: true });
        }
      }

      triggers.forEach((trigger) => {
        trigger.addEventListener('click', () => setActive(trigger.dataset.scheduleTab, { focus: true }));
        trigger.addEventListener('keydown', (event) => handleKeydown(event, trigger));
      });
    });
  }
  function updateThemeAwareAssets(isDark) {
    const themedNodes = document.querySelectorAll('[data-theme-light][data-theme-dark]');
    themedNodes.forEach((node) => {
      const lightSrc = node.getAttribute('data-theme-light');
      const darkSrc = node.getAttribute('data-theme-dark');
      if (!lightSrc || !darkSrc) return;

      if (node instanceof HTMLImageElement) {
        node.src = isDark ? darkSrc : lightSrc;
      } else if (node instanceof HTMLSourceElement) {
        node.srcset = isDark ? darkSrc : lightSrc;
      }
    });
  }

  function initSwiperSliders() {
    if (typeof Swiper === 'undefined') {
      console.warn('Swiper library not loaded');
      return;
    }

    // Инициализация слайдера категорий
    const categoriesSlider = document.querySelector('.categories__slider');
    if (categoriesSlider) {
      const progressLine = document.querySelector('.categories__progress-line');
      const currentPage = document.querySelector('.categories__page-current');
      const totalPages = document.querySelector('.categories__page-total');
      const prevBtn = document.querySelector('.categories__nav-btn--prev');
      const nextBtn = document.querySelector('.categories__nav-btn--next');
      const hideSwipeHint = () => {
        categoriesSlider.classList.add('is-hint-hidden');
      };

      const swiper = new Swiper(categoriesSlider, {
        slidesPerView: 3,
        spaceBetween: 32,
        speed: 600,
        centeredSlides: false,
        autoHeight: false,
        navigation: {
          nextEl: nextBtn,
          prevEl: prevBtn,
          disabledClass: 'disabled',
        },
        breakpoints: {
          320: {
            slidesPerView: 1,
            spaceBetween: 20,
            centeredSlides: true,
          },
          768: {
            slidesPerView: 2,
            spaceBetween: 28,
            centeredSlides: false,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 32,
            centeredSlides: false,
          },
        },
      });

      // Обновление кастомной навигации
      if (progressLine && currentPage && totalPages) {
        const updateNavigation = () => {
          const index = swiper.activeIndex;
          const total = swiper.slides.length;
          const perPage = swiper.params.slidesPerView;
          const pageCount = Math.ceil(total / perPage);
          const currentPageNum = Math.floor(index / perPage) + 1;

          currentPage.textContent = currentPageNum;
          totalPages.textContent = pageCount;

          const progress = pageCount > 1 ? ((currentPageNum - 1) / (pageCount - 1)) * 100 : 0;
          progressLine.style.width = `${progress}%`;
        };

        swiper.on('slideChange', updateNavigation);
        swiper.on('init', updateNavigation);
        updateNavigation();
      }

      swiper.on('touchStart', hideSwipeHint);
      swiper.on('slideChange', hideSwipeHint);
      if (prevBtn) {
        prevBtn.addEventListener('click', hideSwipeHint);
      }
      if (nextBtn) {
        nextBtn.addEventListener('click', hideSwipeHint);
      }
    }

    // Инициализация слайдера инструкторов
    const instructorsSlider = document.querySelector('.instructors__slider');
    if (instructorsSlider) {
      const progressLine = document.querySelector('.instructors__progress-line');
      const currentPage = document.querySelector('.instructors__page-current');
      const totalPages = document.querySelector('.instructors__page-total');
      const prevBtn = document.querySelector('.instructors__nav-btn--prev');
      const nextBtn = document.querySelector('.instructors__nav-btn--next');

      const swiper = new Swiper(instructorsSlider, {
        slidesPerView: 4,
        slidesPerGroup: 4,
        spaceBetween: 32,
        speed: 600,
        navigation: {
          nextEl: nextBtn,
          prevEl: prevBtn,
          disabledClass: 'disabled',
        },
        breakpoints: {
          320: {
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 20,
          },
          768: {
            slidesPerView: 2,
            slidesPerGroup: 2,
            spaceBetween: 28,
          },
          1024: {
            slidesPerView: 3,
            slidesPerGroup: 3,
            spaceBetween: 32,
          },
          1280: {
            slidesPerView: 4,
            slidesPerGroup: 4,
            spaceBetween: 32,
          },
        },
      });

      // Обновление кастомной навигации для инструкторов
      if (progressLine && currentPage && totalPages) {
        const updateNavigation = () => {
          const index = swiper.activeIndex;
          const total = swiper.slides.length;
          const perPage = swiper.params.slidesPerView;
          const pageCount = Math.ceil(total / perPage);
          const currentPageNum = Math.floor(index / perPage) + 1;

          currentPage.textContent = currentPageNum;
          totalPages.textContent = pageCount;

          const progress = pageCount > 1 ? ((currentPageNum - 1) / (pageCount - 1)) * 100 : 0;
          progressLine.style.width = `${progress}%`;
        };

        swiper.on('slideChange', updateNavigation);
        swiper.on('init', updateNavigation);
        swiper.on('breakpoint', updateNavigation);
        updateNavigation();
      }
    }

    // Инициализация слайдера отзывов на странице инструктора
    const reviewsSliders = document.querySelectorAll('.reviews-slider');
    reviewsSliders.forEach((reviewsSlider) => {
      const reviewsSection = reviewsSlider.closest('.reviews-section');
      if (!reviewsSection) return;

      const prevBtn = reviewsSection.querySelector('.reviews-slider__nav-btn--prev');
      const nextBtn = reviewsSection.querySelector('.reviews-slider__nav-btn--next');
      const progressLine = reviewsSection.querySelector('.reviews-slider__progress-line');
      const currentPage = reviewsSection.querySelector('.reviews-slider__page-current');
      const totalPages = reviewsSection.querySelector('.reviews-slider__page-total');

      if (typeof Swiper !== 'undefined') {
        const swiper = new Swiper(reviewsSlider, {
          slidesPerView: 4,
          slidesPerGroup: 4,
          spaceBetween: 20,
          navigation: {
            nextEl: nextBtn,
            prevEl: prevBtn,
            disabledClass: 'disabled',
          },
          breakpoints: {
            320: {
              slidesPerView: 1,
              slidesPerGroup: 1,
              spaceBetween: 10,
            },
            768: {
              slidesPerView: 2,
              slidesPerGroup: 2,
              spaceBetween: 12,
            },
            1024: {
              slidesPerView: 3,
              slidesPerGroup: 3,
              spaceBetween: 16,
            },
            1280: {
              slidesPerView: 4,
              slidesPerGroup: 4,
              spaceBetween: 20,
            },
          },
        });

        // Обновление кастомной пагинации
        if (progressLine && currentPage && totalPages) {
          const updateNavigation = () => {
            const perPage = swiper.params.slidesPerView;
            const total = swiper.slides.length;
            const index = swiper.activeIndex;

            const pageCount = Math.ceil(total / perPage);
            const currentPageNum = Math.floor(index / perPage) + 1;

            currentPage.textContent = currentPageNum;
            totalPages.textContent = pageCount;

            if (pageCount > 1) {
              const progress = ((currentPageNum - 1) / (pageCount - 1)) * 100;
              progressLine.style.width = `${progress}%`;
            }
          };

          swiper.on('slideChange', updateNavigation);
          swiper.on('init', updateNavigation);
          swiper.on('breakpoint', updateNavigation);
          updateNavigation();
        }
      } else {
        console.warn('Swiper library not loaded for reviews slider');
      }
    });

    // Инициализация слайдера галереи с центрированием и эффектами
    const gallerySliders = document.querySelectorAll('.gallery-slider__slider');
    gallerySliders.forEach((slider) => {
      const gallerySection = slider.closest('.gallery-slider');
      if (!gallerySection) return;

      const prevBtn = gallerySection.querySelector('.slider__nav-btn--prev');
      const nextBtn = gallerySection.querySelector('.slider__nav-btn--next');
      const progressLine = gallerySection.querySelector('.slider__progress-line');
      const currentCounter = gallerySection.querySelector('.slider__page-current');
      const totalCounter = gallerySection.querySelector('.slider__page-total');

      const swiper = new Swiper(slider, {
        slidesPerView: 'auto',
        spaceBetween: 40,
        speed: 600,
        centeredSlides: true,
        initialSlide: 1,
        loop: true,
        watchSlidesProgress: true,
        navigation: {
          nextEl: nextBtn,
          prevEl: prevBtn,
          disabledClass: 'disabled',
        },
        breakpoints: {
          320: {
            slidesPerView: 1,
            spaceBetween: 10,
            centeredSlides: true,
          },
          576: {
            slidesPerView: 'auto',
            spaceBetween: 15,
            centeredSlides: true,
          },
          768: {
            slidesPerView: 'auto',
            spaceBetween: 20,
            centeredSlides: true,
          },
          1024: {
            slidesPerView: 'auto',
            spaceBetween: 40,
            centeredSlides: true,
          },
        },
      });

      // Обновление кастомной навигации
      if (progressLine && currentCounter && totalCounter) {
        const updateNavigation = () => {
          const realIndex = swiper.realIndex;
          const total = swiper.slides.filter((slide) => !slide.classList.contains('swiper-slide-duplicate')).length;

          currentCounter.textContent = realIndex + 1;
          totalCounter.textContent = total;

          const progress = total > 1 ? (realIndex / (total - 1)) * 100 : 0;
          progressLine.style.width = `${progress}%`;
        };

        swiper.on('slideChange', updateNavigation);
        swiper.on('init', updateNavigation);
        updateNavigation();
      }
    });

    const promoHeroSliders = document.querySelectorAll('.promo-hero-slider__slider');
    promoHeroSliders.forEach((slider) => {
      const sliderSection = slider.closest('.promo-hero-slider');
      const heroSection = slider.closest('.promo-hero');
      const heroContainer = slider.closest('.promo-hero__container');
      if (!sliderSection) return;

      const prevBtn = sliderSection.querySelector('.promo-hero-slider__nav--prev');
      const nextBtn = sliderSection.querySelector('.promo-hero-slider__nav--next');
      const pagination = sliderSection.querySelector('.promo-hero-slider__pagination');
      const slidesCount = slider.querySelectorAll('.swiper-slide').length;
      const syncHeroHeight = () => {
        if (!heroSection || !heroContainer) return;
        heroSection.style.minHeight = `${heroContainer.offsetHeight}px`;
      };

      const swiper = new Swiper(slider, {
        slidesPerView: 1,
        speed: 700,
        loop: slidesCount > 2,
        watchOverflow: true,
        autoplay: slidesCount > 1
          ? {
              delay: 5000,
              disableOnInteraction: false,
            }
          : false,
        navigation: {
          nextEl: nextBtn,
          prevEl: prevBtn,
          disabledClass: 'disabled',
        },
        pagination: {
          el: pagination,
          clickable: true,
        },
        on: {
          init: syncHeroHeight,
          imagesReady: syncHeroHeight,
          resize: syncHeroHeight,
        },
      });

      if (slidesCount <= 1) {
        prevBtn?.setAttribute('disabled', 'disabled');
        nextBtn?.setAttribute('disabled', 'disabled');
      }

      slider.querySelectorAll('img').forEach((img) => {
        if (img.complete) return;
        img.addEventListener('load', syncHeroHeight, { once: true });
      });

      if (typeof ResizeObserver !== 'undefined' && heroContainer) {
        const observer = new ResizeObserver(syncHeroHeight);
        observer.observe(heroContainer);
      }

      window.addEventListener('load', syncHeroHeight, { once: true });
      window.addEventListener('resize', syncHeroHeight);
      syncHeroHeight();
    });

    // Инициализация слайдера документов
    const documentsSliders = document.querySelectorAll('.documents-slider__slider');
    documentsSliders.forEach((slider) => {
      const documentsSection = slider.closest('.documents-slider');
      if (!documentsSection) return;

      const prevBtn = documentsSection.querySelector('.documents-slider__nav-btn--prev');
      const nextBtn = documentsSection.querySelector('.documents-slider__nav-btn--next');
      const progressLine = documentsSection.querySelector('.documents-slider__progress-line');
      const currentCounter = documentsSection.querySelector('.documents-slider__page-current');
      const totalCounter = documentsSection.querySelector('.documents-slider__page-total');

      const swiper = new Swiper(slider, {
        slidesPerView: 3,
        slidesPerGroup: 3,
        spaceBetween: 30,
        speed: 600,
        centeredSlides: false,
        navigation: {
          nextEl: nextBtn,
          prevEl: prevBtn,
          disabledClass: 'disabled',
        },
        breakpoints: {
          320: {
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 15,
            centeredSlides: true,
          },
          768: {
            slidesPerView: 2,
            slidesPerGroup: 2,
            spaceBetween: 20,
            centeredSlides: false,
          },
          1200: {
            slidesPerView: 3,
            slidesPerGroup: 3,
            spaceBetween: 30,
            centeredSlides: false,
          },
        },
      });

      // Обновление кастомной навигации для постраничной прокрутки
      if (progressLine && currentCounter && totalCounter) {
        const updateNavigation = () => {
          const totalSlides = swiper.slides.length;
          const slidesPerView = swiper.params.slidesPerView;
          const totalPages = Math.ceil(totalSlides / slidesPerView);
          const currentPage = Math.floor(swiper.activeIndex / slidesPerView) + 1;

          currentCounter.textContent = currentPage;
          totalCounter.textContent = totalPages;

          const progress = totalPages > 1 ? ((currentPage - 1) / (totalPages - 1)) * 100 : 0;
          progressLine.style.width = `${progress}%`;
        };

        swiper.on('slideChange', updateNavigation);
        swiper.on('init', updateNavigation);
        updateNavigation();
      }
    });
  }
})();

// FAQ Accordion
(function () {
  document.addEventListener('DOMContentLoaded', () => {
    const accordionItems = document.querySelectorAll('.faq-accordion__item');

    accordionItems.forEach((item) => {
      const button = item.querySelector('.faq-accordion__question');
      const answers = item.querySelector('.faq-accordion__answers');

      if (!button || !answers) return;

      button.addEventListener('click', () => {
        const isExpanded = button.getAttribute('aria-expanded') === 'true';

        // Toggle state
        button.setAttribute('aria-expanded', String(!isExpanded));
        item.setAttribute('data-expanded', String(!isExpanded));

        // Set max-height for smooth animation
        if (!isExpanded) {
          answers.style.maxHeight = answers.scrollHeight + 20 + 'px';
          answers.style.paddingBottom = '20px';
        } else {
          answers.style.maxHeight = '0';
          answers.style.paddingBottom = '0';
        }
      });

      // Initialize first item as open (optional)
      if (item === accordionItems[0]) {
        button.setAttribute('aria-expanded', 'true');
        item.setAttribute('data-expanded', 'true');
        answers.style.maxHeight = answers.scrollHeight + 20 + 'px';
        answers.style.paddingBottom = '20px';
      }
    });
  });
})();

// Cars Gallery Toggle Forms
(function () {
  document.addEventListener('DOMContentLoaded', () => {
    const carForms = document.querySelectorAll('[data-car-form]');

    carForms.forEach((form) => {
      const toggle = form.querySelector('[data-car-toggle]');
      if (!toggle) return;

      toggle.addEventListener('click', () => {
        const isExpanded = toggle.getAttribute('aria-expanded') === 'true';

        // Close all other forms
        carForms.forEach((otherForm) => {
          if (otherForm !== form) {
            const otherToggle = otherForm.querySelector('[data-car-toggle]');
            if (otherToggle) {
              otherToggle.setAttribute('aria-expanded', 'false');
              otherForm.setAttribute('data-expanded', 'false');
            }
          }
        });

        // Toggle current form
        toggle.setAttribute('aria-expanded', String(!isExpanded));
        form.setAttribute('data-expanded', String(!isExpanded));
      });
    });
  });
})();

// Heading scale classes (content + section headings only)
(function () {
  document.addEventListener('DOMContentLoaded', () => {
    const headings = document.querySelectorAll('h1, h2, h3, h4, h5, h6');
    const headingLevelClasses = [
      'heading-level--h1',
      'heading-level--h2',
      'heading-level--h3',
      'heading-level--h4',
      'heading-level--h5',
      'heading-level--h6',
    ];
    const designHeadingClasses = new Set([
      'advantages__item-title',
      'why-list__title',
      'steps__title',
      'news-card__title',
      'office-map__label',
      'about-highlights__card-title',
      'instructors__name',
      'instructors__with-subtitle',
      'cars-gallery__car-name',
      'schedule-card__location',
      'docs__card-title',
      'faq-card__author',
      'fast-benefit__card-title',
    ]);
    const contentSelectors = [
      '.detail_content',
      '.policy__document',
      '.article-detail__article',
      '.driving-content',
      '.text-page',
    ];
    const aboveBlockHeadingClasses = new Set([
      'page-section__title',
      'section-title',
      'also__title',
      'categories__title',
      'u-text-center',
    ]);

    const hasDesignHeadingClass = (heading) =>
      Array.from(heading.classList).some((className) => designHeadingClasses.has(className));
    const isContentHeading = (heading) =>
      contentSelectors.some((selector) => heading.closest(selector) !== null);
    const isAboveBlockHeading = (heading) =>
      Array.from(heading.classList).some((className) => aboveBlockHeadingClasses.has(className));

    headings.forEach((heading) => {
      const level = heading.tagName.toLowerCase();
      const shouldUseUnifiedScale =
        (isContentHeading(heading) || isAboveBlockHeading(heading)) && !hasDesignHeadingClass(heading);

      heading.classList.remove('heading-level', ...headingLevelClasses);

      if (shouldUseUnifiedScale) {
        heading.classList.add('heading-level', `heading-level--${level}`);
      }
    });
  });
})();
