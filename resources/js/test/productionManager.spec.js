import axios from 'axios';
import ProductionsManager from '../productionsManager.js';

jest.mock('axios');

const startDateString = '2015-04-01';
const endDateString = '2016-04-01';


test('it converts a date to timestamp', () => {
  const date = new Date(startDateString);
  expect(ProductionsManager.getTimestampFromDate(startDateString)).toBe(date.getTime())

});

test('it retrieves filtered productions', () => {
  const apiResult = {count: 1, productions: [
    {
      title: 'Preacher',
      type: 'TV Series',
      sites: [
        {
            name: 'Gertrude Zachary',
            shoot_date: 'May 13, 2015'
        },
        {
            name: 'Bea\'s Mexican Restaurant 2',
            shoot_date: 'May 25, 2015'
        }
      ]
    }
  ]};
  axios.post.mockResolvedValue({data: apiResult});
  ProductionsManager.getProductions(startDateString, endDateString).then(data => expect(data).toEqual(apiResult))
})
