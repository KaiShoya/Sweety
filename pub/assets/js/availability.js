var app = new Vue({
  el: ".container",
  data: {
    available: availables
  },
  methods: {
    onClick: function (hotelId, available, id) {
      this.$set(this.available, id, available)
      axios.post(topPath + "/api/availability.php?hotel_id=" + hotelId + "&available=" + available)
    }
  }
})
