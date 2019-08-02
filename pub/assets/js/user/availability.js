var app = new Vue({
  el: ".container",
  data: {
    available: availables
  },
  methods: {
    onClick: function (hotelId, available) {
      this.$set(this.available, hotelId, available)
      axios.post(topPath + "/api/availability.php?hotel_id=" + hotelId + "&available=" + available)
    }
  }
})
