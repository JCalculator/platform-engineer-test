require('./bootstrap');

import ProductionsManager from './productionsManager.js';
import Validator from './validator.js';
import { TemplateRenderer, Templates } from './templateRenderer.js';

const button = document.getElementById('fetchProductions');
const container = document.getElementById('productionsContainer');

button.addEventListener('click', () => {
  
  const { isValid, values: {startDate, endDate} } = Validator.validateElements(['startDate', 'endDate']);
  if (isValid) {
    container.innerHTML = '<div class="lds-hourglass"></div>';
    ProductionsManager.getProductions(`${startDate} 00:00:00`, `${endDate} 23:59:59`).then(data => {
      if (data.count) {
        TemplateRenderer.render(Templates.production, data.productions, container);
      } else {
        TemplateRenderer.render(Templates.emptyProductions, [], container);
      }
      
    });
  }
});



/*
TODO: beautify scrollbar
*/

// AWS PASSWORD
// SkBIR)hxc7x]
// Welc0me1!123456