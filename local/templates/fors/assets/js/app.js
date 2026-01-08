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
    initPriceTabs();
    initDistrictTabs();
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

  function initDistrictTabs() {
    const groups = document.querySelectorAll('.js-district-tabs');
    groups.forEach((group) => {
      const triggers = Array.from(group.querySelectorAll('[data-district-tab]'));
      const panels = Array.from(group.querySelectorAll('.js-district-panel'));
      const mapContainer = group.querySelector('.js-district-map');
      let markersOverlay = null;
      let activeMapSrc = '';
      let activeCoords = [];
      let resizeRequestId = null;
      if (triggers.length === 0 || panels.length === 0) return;

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

      const getMapSrc = (districtId) => {
        if (!mapContainer) return '';
        return mapContainer.getAttribute(`data-map-${districtId}`) || '';
      };

      const getCoordsList = (districtId) => {
        if (!mapContainer) return [];
        const raw = mapContainer.getAttribute(`data-coords-${districtId}`) || '';
        if (!raw) return [];
        let parsed = [];
        try {
          parsed = JSON.parse(raw);
        } catch (error) {
          return [];
        }
        return parsed
          .map((item) => {
            if (!item) return null;
            const rawCoords = typeof item === 'string' ? item : item.coords;
            if (!rawCoords) return null;
            const parts = rawCoords.split(',').map((value) => parseFloat(String(value).trim()));
            if (parts.length < 2 || parts.some((value) => Number.isNaN(value))) return null;
            return {
              coords: [parts[0], parts[1]],
              title: typeof item === 'object' && item !== null ? item.title || '' : '',
              subtitle: typeof item === 'object' && item !== null ? item.subtitle || '' : '',
            };
          })
          .filter(Boolean);
      };

      const destroyYandexMap = () => {
        if (markersOverlay) {
          markersOverlay.innerHTML = '';
        }
      };

      const renderMap = (mapSrc) => {
        if (!mapContainer) return;
        destroyYandexMap();
        if (!mapSrc) {
          mapContainer.innerHTML = '';
          return;
        }
        const iframe = document.createElement('iframe');
        iframe.src = mapSrc;
        iframe.loading = 'lazy';
        iframe.setAttribute('allowfullscreen', '');
        mapContainer.innerHTML = '';
        mapContainer.appendChild(iframe);
      };

      const parseMapParams = (mapSrc) => {
        if (!mapSrc) return null;
        let url;
        try {
          url = new URL(mapSrc, window.location.origin);
        } catch (error) {
          return null;
        }
        const ll = url.searchParams.get('ll');
        const zoomValue = url.searchParams.get('z');
        if (!ll || !zoomValue) return null;
        const [lon, lat] = ll.split(',').map((value) => parseFloat(value.trim()));
        const zoom = parseInt(zoomValue, 10);
        if ([lat, lon].some((value) => Number.isNaN(value)) || Number.isNaN(zoom)) return null;
        return { center: [lat, lon], zoom };
      };

      const projectPoint = ([lat, lon], zoom) => {
        const sin = Math.sin((lat * Math.PI) / 180);
        const scale = 256 * Math.pow(2, zoom);
        const x = ((lon + 180) / 360) * scale;
        const y = (0.5 - Math.log((1 + sin) / (1 - sin)) / (4 * Math.PI)) * scale;
        return { x, y };
      };

      const noteContainerPosition = () => {
        if (!mapContainer) return;
        const computed = window.getComputedStyle(mapContainer);
        if (computed.position === 'static') {
          mapContainer.style.position = 'relative';
        }
      };

      const lockMapInteractions = () => {
        if (!mapContainer || mapContainer.dataset.zoomLocked === 'true') return;
        mapContainer.dataset.zoomLocked = 'true';
        const prevent = (event) => event.preventDefault();
        mapContainer.addEventListener('wheel', prevent, { passive: false });
        mapContainer.addEventListener('dblclick', prevent);
        mapContainer.addEventListener('gesturestart', prevent);
        mapContainer.addEventListener('gesturechange', prevent);
        mapContainer.addEventListener('gestureend', prevent);
        mapContainer.addEventListener('touchmove', prevent, { passive: false });
      };

      const ensureMarkersOverlay = () => {
        if (!mapContainer) return null;
        if (!markersOverlay) {
          markersOverlay = document.createElement('div');
          markersOverlay.className = 'office-map__markers';
          markersOverlay.style.position = 'absolute';
          markersOverlay.style.inset = '0';
          markersOverlay.style.pointerEvents = 'none';
          markersOverlay.style.zIndex = '2';
        }
        if (!mapContainer.contains(markersOverlay)) {
          mapContainer.appendChild(markersOverlay);
        }
        noteContainerPosition();
        lockMapInteractions();
        return markersOverlay;
      };

      const renderMarkers = (mapSrc, coordsList) => {
        if (!mapContainer) return;
        const overlay = ensureMarkersOverlay();
        if (!overlay) return;
        overlay.innerHTML = '';
        if (!mapSrc || coordsList.length === 0) return;
        const mapParams = parseMapParams(mapSrc);
        if (!mapParams) return;
        const { center, zoom } = mapParams;
        const rect = mapContainer.getBoundingClientRect();
        if (rect.width === 0 || rect.height === 0) return;
        const centerPoint = projectPoint(center, zoom);
        const markerIcon = mapContainer.getAttribute('data-marker-icon') || '';
        if (!markerIcon) return;
        const markerSize = 24;
        const hideTooltips = () => {
          overlay.querySelectorAll('[data-tooltip]').forEach((tooltip) => {
            tooltip.style.display = 'none';
          });
        };
        if (mapContainer && mapContainer.dataset.tooltipBound !== 'true') {
          mapContainer.dataset.tooltipBound = 'true';
          mapContainer.addEventListener('click', () => hideTooltips());
        }
        coordsList.forEach((item) => {
          const point = projectPoint(item.coords, zoom);
          const left = Math.round(point.x - centerPoint.x + rect.width / 2 - markerSize / 2);
          const top = Math.round(point.y - centerPoint.y + rect.height / 2 - markerSize);
          const marker = document.createElement('button');
          marker.type = 'button';
          marker.className = 'office-map__marker';
          const tooltipText = [item.title, item.subtitle].filter(Boolean).join(' — ');
          marker.title = tooltipText;
          marker.style.position = 'absolute';
          marker.style.left = `${left}px`;
          marker.style.top = `${top}px`;
          marker.style.width = `${markerSize}px`;
          marker.style.height = `${markerSize}px`;
          marker.style.padding = '0';
          marker.style.border = '0';
          marker.style.background = 'transparent';
          marker.style.pointerEvents = 'auto';
          const markerImage = document.createElement('img');
          markerImage.src = markerIcon;
          markerImage.alt = '';
          markerImage.setAttribute('aria-hidden', 'true');
          markerImage.style.display = 'block';
          markerImage.style.width = '100%';
          markerImage.style.height = '100%';
          marker.appendChild(markerImage);
          if (tooltipText) {
            const tooltip = document.createElement('span');
            tooltip.textContent = tooltipText;
            tooltip.dataset.tooltip = 'true';
            tooltip.style.position = 'absolute';
            tooltip.style.bottom = '100%';
            tooltip.style.left = '50%';
            tooltip.style.transform = 'translate(-50%, -8px)';
            tooltip.style.background = '#ffffff';
            tooltip.style.color = '#000000';
            tooltip.style.borderRadius = '6px';
            tooltip.style.padding = '6px 10px';
            tooltip.style.whiteSpace = 'nowrap';
            tooltip.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
            tooltip.style.display = 'none';
            tooltip.style.pointerEvents = 'none';
            marker.appendChild(tooltip);
            marker.addEventListener('click', (event) => {
              event.stopPropagation();
              const isVisible = tooltip.style.display === 'block';
              hideTooltips();
              tooltip.style.display = isVisible ? 'none' : 'block';
            });
          }
          overlay.appendChild(marker);
        });
      };

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

        // Обновление карты
        const districtId = nextId.replace('district-', '');
        const mapSrc = getMapSrc(districtId);
        const coordsList = getCoordsList(districtId);
        renderMap(mapSrc);
        activeMapSrc = mapSrc;
        activeCoords = coordsList;
        renderMarkers(mapSrc, coordsList);

        activeId = nextId;
        if (focus) {
          trigger.focus({ preventScroll: true });
        }
      }

      setActive(activeId);
      window.addEventListener('resize', () => {
        if (!activeMapSrc || activeCoords.length === 0) return;
        if (resizeRequestId) {
          cancelAnimationFrame(resizeRequestId);
        }
        resizeRequestId = requestAnimationFrame(() => renderMarkers(activeMapSrc, activeCoords));
      });

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
