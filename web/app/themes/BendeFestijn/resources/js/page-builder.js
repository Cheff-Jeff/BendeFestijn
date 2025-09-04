import domReady from '@wordpress/dom-ready';
import { removeEndSeperators } from './admin/clean-up';
import { initPageBuilder, buttonTranslation } from './admin/page-builder';

domReady(() => {
  removeEndSeperators();
  initPageBuilder();
  buttonTranslation();

  document.addEventListener('newBlock', () => {
    setTimeout(() => {
      removeEndSeperators();
      buttonTranslation();
    }, 100);
  });
});
