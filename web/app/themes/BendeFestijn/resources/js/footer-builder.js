import domReady from '@wordpress/dom-ready';
import { removeEndSeperators } from './admin/clean-up';
import { initFooterBuilder, buttonTranslation } from './admin/footer-builder';

domReady(() => {
  removeEndSeperators();
  initFooterBuilder();
  buttonTranslation();

  document.addEventListener('newBlock', () => {
    setTimeout(() => {
      removeEndSeperators();
      buttonTranslation();
    }, 100);
  });
});
