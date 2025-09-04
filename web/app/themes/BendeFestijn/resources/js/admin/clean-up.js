export const removeEndSeperators = () => {
  const seperators = document.querySelectorAll('.cf-field.cf-separator');

  seperators.forEach((elm) => {
    const text = elm.querySelector('h3');

    if (text.textContent.includes('einde ')) {
      elm.style.display = 'none';
    }
  });
};
