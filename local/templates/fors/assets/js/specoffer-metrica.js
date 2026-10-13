(function () {
  'use strict';

  if (window.forsSpecofferMetricaInstalled) return;
  window.forsSpecofferMetricaInstalled = true;

  var siteId = 'ste_c3def60146ab9eed';
  var endpoint = 'https://leads.sellergpt.ru/api/v1/lead';
  var requests = new WeakMap();
  var originalOpen = XMLHttpRequest.prototype.open;
  var originalSend = XMLHttpRequest.prototype.send;

  function markButton() {
    var button = document.querySelector('.ll-overlay .ll-cta');
    if (button) button.id = 'form_specoffer';
  }

  function observeButton() {
    markButton();
    new MutationObserver(markButton).observe(document.body, {childList: true, subtree: true});
  }

  if (document.body) observeButton();
  else document.addEventListener('DOMContentLoaded', observeButton, {once: true});

  // The vendor's sellerlidy:lead event precedes the request, and its success
  // screen also appears on failed requests. Observe only this site's lead API.
  XMLHttpRequest.prototype.open = function (method, url) {
    requests.delete(this);
    try {
      var address = new URL(url, document.baseURI);
      if (String(method).toUpperCase() === 'POST' && address.origin + address.pathname === endpoint) {
        requests.set(this, true);
      }
    } catch (error) {}
    return originalOpen.apply(this, arguments);
  };

  XMLHttpRequest.prototype.send = function (body) {
    var lead;
    if (requests.has(this) && typeof body === 'string') {
      try { lead = JSON.parse(body); } catch (error) {}
    }
    if (lead && lead.site === siteId) {
      this.addEventListener('load', function () {
        if (this.status < 200 || this.status >= 300) return;
        // Some APIs return an application error with HTTP 200.
        if (this.responseText) {
          var result;
          try { result = JSON.parse(this.responseText); } catch (error) { return; }
          if (!result || result.ok === false || result.error) return;
        }
        if (typeof window.ym === 'function') {
          window.ym(11787892, 'reachGoal', 'form_specoffer');
        }
      }, {once: true});
    }
    return originalSend.apply(this, arguments);
  };
})();
