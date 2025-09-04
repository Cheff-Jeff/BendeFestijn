export const createModal = (blockList) => {
  const modal = document.createElement('div');

  modal.className = 'custom-block-modal';
  modal.innerHTML = `
    <div id="BlockSelecBackground" class="custom-block-backdrop"></div>
    <div class="custom-block-content">
      <h2>Kies een blok</h2>
      <div class="block-grid">
        ${blockList
          .map(
            (block) => `
          <div class="block-card" data-key="${block.key}">
            <img src="${block.image}" alt="${block.label}">
            <h3>${block.label}</h3>
            <p>${block.description}</p>
          </div>
        `
          )
          .join('')}
      </div>
      <button class="button" id="close-modal">Sluiten</button>
    </div>
  `;

  return modal;
};

export const initAddBlockToPage = (modal, carbonFieldsComplexFieldType) => {
  modal.querySelectorAll('.block-card').forEach((card) => {
    card.addEventListener('click', () => {
      const key = card.dataset.key;
      const inserterBtn = carbonFieldsComplexFieldType.querySelector(
        '.cf-complex__inserter-button'
      );
      const menu = carbonFieldsComplexFieldType.querySelector(
        '.cf-complex__inserter-menu'
      );

      if (!inserterBtn || !menu) {
        return;
      }

      inserterBtn.click();

      setTimeout(() => {
        const match = [...menu.querySelectorAll('li')].find(
          (li) => li.textContent.trim().toLowerCase() === key.toLowerCase()
        );

        if (match) {
          match.click();
          modal.classList.remove('active');

          const event = new Event('newBlock');
          document.dispatchEvent(event);
        }
      }, 100);
    });
  });
};
