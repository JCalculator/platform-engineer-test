const axios = require('axios');


class ProductionsManager {
  static getTimestampFromDate(dateString) {
    return new Date(dateString).getTime();
  }
  static getProductions(startShootDateString, endShootDateString) {
    return axios.post('/api/productions/locations', {
      timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
      shoot_date_from: ProductionsManager.getTimestampFromDate(startShootDateString),
      shoot_date_to: ProductionsManager.getTimestampFromDate(endShootDateString)
    }).then((response) => {
      return response.data;
    })
  }
}

module.exports = ProductionsManager