app.factory('Utils', ['Restangular', 'Auth', function(Restangular, Auth) {

  function Base64EncodeUrl(str){
    return str.replace(/\+/g, '-').replace(/\//g, '_').replace(/\=+$/, '');
  }

  function Base64DecodeUrl(str){
    str = (str + '==').slice(0, str.length + (str.length % 4));
    return str.replace(/-/g, '+').replace(/_/g, '/');
  }

  function saveDate(date){
    return  moment(date, "DD/MM/YYYY").format("YYYY-MM-DD");
  }

  function displayDate(date){
    return  moment(date).format("DD/MM/YYYY");
  }

  function dateFilter(option) {
    var result = {
      start: moment().startOf('month').format("DD/MM/YYYY"),
      end: moment().endOf('month').format("DD/MM/YYYY")
    }
    switch (option) {
      case 'today':
        result.start = moment().startOf('day').format("DD/MM/YYYY");
        result.end = moment().endOf('day').format("DD/MM/YYYY");
        break;
      case 'yesterday':
        result.start = moment().startOf('day').subtract(1, "day").format("DD/MM/YYYY");
        result.end = moment().endOf('day').subtract(1, "day").format("DD/MM/YYYY");
        break;
      case 'last_month':
        result.start = moment().startOf('month').subtract(1, "month").format("DD/MM/YYYY");
        result.end = moment().endOf('month').subtract(1, "month").format("DD/MM/YYYY");
        break;
      case 'this_month':
        result.start = moment().startOf('month').format("DD/MM/YYYY");
        result.end = moment().endOf('month').format("DD/MM/YYYY");
        break;
      case 'next_month':
        result.start = moment().startOf('month').add(1, 'month').format("DD/MM/YYYY");
        result.end = moment().endOf('month').add(1, 'month').format("DD/MM/YYYY");
        break;
      case 'custom':
        break;
      default:
          result.start = moment().startOf('month').format("DD/MM/YYYY");
          result.end =  moment().endOf('month').format("DD/MM/YYYY");
          break;
    }

    return result;

  }

  Restangular.setDefaultHeaders({ 'Authorization' : 'Bearer ' + Auth.getCurrentToken() });

  return {
    Base64EncodeUrl:Base64EncodeUrl,
    Base64DecodeUrl:Base64DecodeUrl,
    saveDate:saveDate,
    displayDate:displayDate,
    dateFilter:dateFilter
  }

}]);
