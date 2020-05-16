
const errorMessageClass = 'form-control-error-message';

const createError = (elementId, message) => {
  message = message || 'Please fill out this field.';
  const element = document.createElement('p');
  element.setAttribute('id', `${elementId}-error`);
  element.classList.add(errorMessageClass);
  element.innerHTML = message;
  return element;
}

const validateField = (elementId, message) => {
  const element = document.getElementById(elementId);
  const value = element.value;
  const errorMessage = createError(elementId, message);
  const existingErrorElement = document.getElementById(errorMessage.id);
  
  // This is a simple dumb rule, ideally you'd create rules for inputs and use the specification pattern to choose the appropriate implementation
  if (element.hasAttribute('required') && value == '') {
    element.classList.add('error');
    if (!existingErrorElement) {
      element.insertAdjacentElement('afterend', errorMessage);
    }
  } else {
    element.classList.remove('error');
    if (existingErrorElement) {
      existingErrorElement.remove();
    }
  }
  return value;
}

class Validator {
  static validateElements(collectionOfIds) {
  
    let values = {};
    collectionOfIds.forEach(elementId => {
      values[elementId] = validateField(elementId);
    })
    
    const isValid = document.querySelectorAll(`.${errorMessageClass}`).length == 0;
  
    return {
      isValid,
      values
    };
  }
}

module.exports = Validator