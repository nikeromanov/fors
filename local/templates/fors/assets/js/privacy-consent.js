(function () {
  'use strict';

  var STORAGE_KEY = 'forsazh_cookie_consent';
  var CONSENT_VERSION = '2026-08-26';
  var state = readState();
  var lastFocusedElement = null;
  var analyticsLoaded = false;

  function readState() {
    try {
      var value = JSON.parse(window.localStorage.getItem(STORAGE_KEY));
      return value && value.version === CONSENT_VERSION ? value : null;
    } catch (error) {
      return null;
    }
  }

  function createState(analytics, marketing) {
    return {
      version: CONSENT_VERSION,
      necessary: true,
      analytics: Boolean(analytics),
      marketing: Boolean(marketing),
      updatedAt: new Date().toISOString()
    };
  }

  function saveState(nextState) {
    var mustReload = Boolean(state) && (
      (state.analytics && !nextState.analytics) ||
      (state.marketing && !nextState.marketing)
    );

    state = nextState;
    window.localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
    applyState();
    hideBanner();
    closeSettings();

    if (mustReload) {
      window.location.reload();
    }
  }

  function loadScript(src, id, attributes) {
    if (id && document.getElementById(id)) return;
    var script = document.createElement('script');
    script.src = src;
    script.async = true;
    if (id) script.id = id;
    Object.keys(attributes || {}).forEach(function (name) {
      script.setAttribute(name, attributes[name]);
    });
    document.head.appendChild(script);
  }

  function loadYandexMetrika() {
    if (typeof window.ym !== 'function') {
      window.ym = function () {
        (window.ym.a = window.ym.a || []).push(arguments);
      };
      window.ym.l = Number(new Date());
    }
    loadScript('https://mc.yandex.ru/metrika/tag.js', 'forsazh-yandex-metrika', {'data-skip-moving': 'true'});
    window.ym(11787892, 'init', {webvisor: true, clickmap: true, accurateTrackBounce: true, trackLinks: true});
  }

  function loadTopMailRu() {
    window._tmr = window._tmr || [];
    window._tmr.push({id: '3727875', type: 'pageView', start: Number(new Date())});
    loadScript('https://top-fwz1.mail.ru/js/code.js', 'tmr-code');
  }

  function loadAnalytics() {
    if (analyticsLoaded) return;
    analyticsLoaded = true;
    loadYandexMetrika();
    loadTopMailRu();
    loadScript('https://analytics.alloka.ru/script/5b458697c149d1a7', 'forsazh-alloka', {'data-skip-moving': 'true'});
    persistUtmParameters();
  }

  function persistUtmParameters() {
    var params = new URLSearchParams(window.location.search);
    ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term'].forEach(function (name) {
      var value = params.get(name);
      if (!value) return;
      var expires = new Date(Date.now() + 86400000).toUTCString();
      document.cookie = name + '=' + encodeURIComponent(value) + '; expires=' + expires + '; path=/; SameSite=Lax';
    });
  }

  function applyState() {
    if (!state) return;
    if (state.analytics) loadAnalytics();
    window.dispatchEvent(new CustomEvent('forsazh:privacy-consent', {detail: state}));
  }

  function showBanner() {
    var banner = document.querySelector('[data-cookie-consent]');
    if (banner) banner.hidden = false;
  }

  function hideBanner() {
    var banner = document.querySelector('[data-cookie-consent]');
    if (banner) banner.hidden = true;
  }

  function openSettings() {
    var dialog = document.querySelector('[data-cookie-settings-dialog]');
    if (!dialog) return;
    lastFocusedElement = document.activeElement;
    var analytics = dialog.querySelector('[data-cookie-category="analytics"]');
    var marketing = dialog.querySelector('[data-cookie-category="marketing"]');
    analytics.checked = Boolean(state && state.analytics);
    marketing.checked = Boolean(state && state.marketing);
    dialog.hidden = false;
    document.body.classList.add('cookie-settings-open');
    var close = dialog.querySelector('[data-cookie-settings-close]');
    if (close) close.focus();
  }

  function closeSettings() {
    var dialog = document.querySelector('[data-cookie-settings-dialog]');
    if (!dialog || dialog.hidden) return;
    dialog.hidden = true;
    document.body.classList.remove('cookie-settings-open');
    if (lastFocusedElement && typeof lastFocusedElement.focus === 'function') lastFocusedElement.focus();
  }

  function bindEvents() {
    document.querySelectorAll('[data-cookie-accept-all]').forEach(function (button) {
      button.addEventListener('click', function () { saveState(createState(true, true)); });
    });
    document.querySelectorAll('[data-cookie-reject], [data-cookie-settings-reject]').forEach(function (button) {
      button.addEventListener('click', function () { saveState(createState(false, false)); });
    });
    document.querySelectorAll('[data-cookie-settings], [data-cookie-preferences-open]').forEach(function (button) {
      button.addEventListener('click', openSettings);
    });
    document.querySelectorAll('[data-cookie-settings-close]').forEach(function (button) {
      button.addEventListener('click', closeSettings);
    });
    var save = document.querySelector('[data-cookie-save]');
    if (save) {
      save.addEventListener('click', function () {
        var dialog = document.querySelector('[data-cookie-settings-dialog]');
        saveState(createState(
          dialog.querySelector('[data-cookie-category="analytics"]').checked,
          dialog.querySelector('[data-cookie-category="marketing"]').checked
        ));
      });
    }
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') closeSettings();
    });
  }

  function init() {
    bindEvents();
    if (state) applyState();
    else showBanner();
  }

  window.ForsazhConsent = {
    getState: function () { return state ? Object.assign({}, state) : null; },
    openSettings: openSettings
  };

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
  else init();
})();
