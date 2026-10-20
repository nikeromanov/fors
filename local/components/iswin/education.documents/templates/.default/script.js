(() => {
  const init = () => {
    const desktop = window.matchMedia('(min-width: 64rem)');
    document.querySelectorAll('.education-documents__navigation').forEach((navigation) => {
      navigation.open = desktop.matches;
      desktop.addEventListener('change', (event) => {
        navigation.open = event.matches;
      });
    });
  };
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init, { once: true });
  } else {
    init();
  }
})();
