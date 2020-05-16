
import Validator from '../validator.js';

const requiredFieldId = 'requiredField';
const nonRequiredFieldId = 'nonRequiredField';
const expectedErrorFieldId = `${requiredFieldId}-error`;
const aRandomValue = 'A random value';

const buildHtml = () => {
  document.body.innerHTML = `
  <div>
    <input type="text" required id="${requiredFieldId}">
    <input type="text" id="${nonRequiredFieldId}">
  <div>
  `;
}

test('it tells wether fields are valid or not', () => {
  buildHtml();
  const { isValid, values: {requiredField} } = Validator.validateElements([requiredFieldId]);
  expect(isValid).toBeFalsy();
  expect(requiredField).toBe('');
});

test('it shows an error on an invalid required field', () => {
  buildHtml();
  Validator.validateElements([requiredFieldId]);
  const { values: {requiredField} } = Validator.validateElements([requiredFieldId]);
  expect(document.getElementById(expectedErrorFieldId)).toBeTruthy();
  expect(requiredField).toBe('');
});


test('it removes the error after field is valid', () => {
  buildHtml();
  Validator.validateElements([requiredFieldId]);
  
  expect(document.getElementById(expectedErrorFieldId)).toBeTruthy();

  document.getElementById(requiredFieldId).value = aRandomValue;
  Validator.validateElements([requiredFieldId]);
  let { isValid, values: {requiredField} } = Validator.validateElements([requiredFieldId]);
  
  expect(document.getElementById(expectedErrorFieldId)).toBeFalsy();
  expect(isValid).toBeTruthy();
  expect(requiredField).toBe(aRandomValue);
});

test('it does not show an error on an valid required field', () => {
  buildHtml();
  document.getElementById(requiredFieldId).value = aRandomValue;
  Validator.validateElements([requiredFieldId]);
  const { isValid, values: {requiredField} } = Validator.validateElements([requiredFieldId]);
  expect(document.getElementById(expectedErrorFieldId)).toBeFalsy();
});

test('it returns the field value after validating', () => {
  buildHtml();
  document.getElementById(requiredFieldId).value = aRandomValue;
  Validator.validateElements([requiredFieldId]);
  const { isValid, values: {requiredField} } = Validator.validateElements([requiredFieldId]);
  expect(document.getElementById(expectedErrorFieldId)).toBeFalsy();
  expect(requiredField).toBe(aRandomValue);
});

test('it does not show an error on field without validation rules', () => {
  buildHtml();
  Validator.validateElements([nonRequiredFieldId]);
  const { isValid, values: {nonRequiredField} } = Validator.validateElements([nonRequiredFieldId]);
  expect(isValid).toBeTruthy();
  expect(document.getElementById(`${nonRequiredFieldId}-error`)).toBeFalsy();
  expect(nonRequiredField).toBe('');
});
