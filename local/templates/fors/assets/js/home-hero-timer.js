document.addEventListener('DOMContentLoaded', () => {
  function parseDateDMYHMS(str) {
    if (!str) return null;
    const [dmy, hms = '00:00:00'] = String(str).trim().split(/\s+/);
    const [d, m, y] = dmy.split('.').map(Number);
    const [hh, mm, ss] = hms.split(':').map(Number);
    if (!y || !m || !d) return null;
    return new Date(y, m - 1, d, hh || 0, mm || 0, ss || 0);
  }

  const pad2 = (n) => String(n).padStart(2, '0');

  document.querySelectorAll('.home-hero__timer[data-date][data-curdate]').forEach((timer) => {
    const target = parseDateDMYHMS(timer.dataset.date);
    const serverNow = parseDateDMYHMS(timer.dataset.curdate);

    if (!target || isNaN(target.getTime()) || !serverNow || isNaN(serverNow.getTime())) {
      return;
    }

    const offerBlock = timer.closest('.home-hero__offer') || timer;

    const times = timer.querySelectorAll('time');
    const tDays = times[0];
    const tHours = times[1];
    const tMins = times[2];
    const tSecs = times[3];

    const startBrowserNowMs = Date.now();
    const startServerNowMs = serverNow.getTime();

    const tick = () => {
      const nowMs = startServerNowMs + (Date.now() - startBrowserNowMs);
      const diffMs = target.getTime() - nowMs;

      if (diffMs <= 0) {
        offerBlock.remove();
        clearInterval(intervalId);
        return;
      }

      const totalSec = Math.floor(diffMs / 1000);
      const days = Math.floor(totalSec / 86400);
      const hours = Math.floor((totalSec % 86400) / 3600);
      const mins = Math.floor((totalSec % 3600) / 60);
      const secs = totalSec % 60;

      if (tDays) { tDays.textContent = String(days); tDays.setAttribute('datetime', `P${days}D`); }
      if (tHours) { tHours.textContent = String(hours); tHours.setAttribute('datetime', `PT${hours}H`); }
      if (tMins) { tMins.textContent = pad2(mins); tMins.setAttribute('datetime', `PT${mins}M`); }
      if (tSecs) { tSecs.textContent = pad2(secs); tSecs.setAttribute('datetime', `PT${secs}S`); }
    };

    const intervalId = setInterval(tick, 1000);
  });
});
