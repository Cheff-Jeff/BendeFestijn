import { createModal, initAddBlockToPage } from './block-selector';

export const initFooterBuilder = () => {
  const carbonFieldsComplexFieldType = document.querySelector('.cf-complex');
  const pageBuilderBox = document.querySelector(
    '#postbox-container-1 #major-publishing-actions'
  );
  const carbonFieldsInserter = document.querySelector('.cf-complex__inserter');

  if (
    !window.footerBlockList ||
    !Array.isArray(window.footerBlockList) ||
    !carbonFieldsComplexFieldType
  ) {
    console.error('Custom block list is not available or invalid.');
    return;
  }

  const triggerTop = createTrigger();
  const triggerBottom = createTrigger();

  pageBuilderBox.appendChild(triggerTop);
  carbonFieldsInserter.appendChild(triggerBottom);

  const modal = createModal(window.footerBlockList);
  document.body.appendChild(modal);

  initModalTriggers(triggerTop, triggerBottom, modal);

  initAddBlockToPage(modal, carbonFieldsComplexFieldType);
};

const createTrigger = () => {
  const trigger = document.createElement('button');
  trigger.innerHTML = `
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M192 104.8c0-9.2-5.8-17.3-13.2-22.8C167.2 73.3 160 61.3 160 48c0-26.5 28.7-48 64-48s64 21.5 64 48c0 13.3-7.2 25.3-18.8 34c-7.4 5.5-13.2 13.6-13.2 22.8c0 12.8 10.4 23.2 23.2 23.2l56.8 0c26.5 0 48 21.5 48 48l0 56.8c0 12.8 10.4 23.2 23.2 23.2c9.2 0 17.3-5.8 22.8-13.2c8.7-11.6 20.7-18.8 34-18.8c26.5 0 48 28.7 48 64s-21.5 64-48 64c-13.3 0-25.3-7.2-34-18.8c-5.5-7.4-13.6-13.2-22.8-13.2c-12.8 0-23.2 10.4-23.2 23.2L384 464c0 26.5-21.5 48-48 48l-56.8 0c-12.8 0-23.2-10.4-23.2-23.2c0-9.2 5.8-17.3 13.2-22.8c11.6-8.7 18.8-20.7 18.8-34c0-26.5-28.7-48-64-48s-64 21.5-64 48c0 13.3 7.2 25.3 18.8 34c7.4 5.5 13.2 13.6 13.2 22.8c0 12.8-10.4 23.2-23.2 23.2L48 512c-26.5 0-48-21.5-48-48L0 343.2C0 330.4 10.4 320 23.2 320c9.2 0 17.3 5.8 22.8 13.2C54.7 344.8 66.7 352 80 352c26.5 0 48-28.7 48-64s-21.5-64-48-64c-13.3 0-25.3 7.2-34 18.8C40.5 250.2 32.4 256 23.2 256C10.4 256 0 245.6 0 232.8L0 176c0-26.5 21.5-48 48-48l120.8 0c12.8 0 23.2-10.4 23.2-23.2z"/></svg>
    <span>Blok toevoegen</span>
  `;
  trigger.className = 'button button-primary page-block-trigger';

  return trigger;
};

const initModalTriggers = (triggerTop, triggerBottom, modal) => {
  // Show modal
  triggerTop.addEventListener('click', (event) => {
    event.preventDefault();
    modal.classList.add('active');
  });

  triggerBottom.addEventListener('click', (event) => {
    event.preventDefault();
    modal.classList.add('active');
  });

  // Hide modal
  modal.querySelector('#close-modal').addEventListener('click', () => {
    modal.classList.remove('active');
  });

  document
    .querySelector('#BlockSelecBackground')
    .addEventListener('click', () => {
      modal.classList.remove('active');
    });
};

export const buttonTranslation = () => {
  const gallery = 'selecteer content';
  const useGallery = 'gebruik content';
  const afbeeldingSelectie = 'selecteer afbeelding';

  const mediaGallerybutton = document.querySelectorAll(
    '.cf-media-gallery__actions button.cf-media-gallery__browse'
  );
  const useMediaButton = document.querySelectorAll(
    '.media-modal-content button.media-button-select'
  );
  const afbeeldingSelectiebutton = document.querySelectorAll(
    'button.cf-file__browse'
  );

  if (mediaGallerybutton) {
    mediaGallerybutton.forEach((button) => {
      button.textContent = gallery;
    });
  }

  if (useMediaButton) {
    useMediaButton.forEach((button) => {
      button.textContent = useGallery;
    });
  }

  if (afbeeldingSelectiebutton) {
    afbeeldingSelectiebutton.forEach((button) => {
      button.textContent = afbeeldingSelectie;
    });
  }
};
