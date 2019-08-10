Vue.component('hotel-row', {
  template: '#hotel-row',
  props: ['h']
})

var app = new Vue({
  el: '.container',
  data: {
    hotels: []
  },
  created: function() {
    //Ajaxリクエスト
    axios
      .post('api/hotel_list.php')
      .then(function(res) {
        console.log(res.data)
        res.data.forEach((value, i) => {
          app.hotels.push({
            id: value['id'],
            name: value['name'],
            address: value['address'],
            phone: value['phone'],
            mapcode: value['mapcode'],
            lat: value['lat'],
            lon: value['lon'],
            credit_card: value['credit_card'],
            created_at: value['created_at'],
            updated_at: value['updated_at']
          })
        })
      })
      .catch(function(error) {
        console.log(error.data)
      })
  }
})
