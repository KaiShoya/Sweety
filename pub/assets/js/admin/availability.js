var app = new Vue({
  el: '.container',
  data: {
    available: availables,
    delete: deletes
  },
  methods: {
    onClickDeleted: function(hotelId) {
      let deleteFlg = 0
      if (this.delete[hotelId] === 0) {
        deleteFlg = 1
      }
      this.$set(this.delete, hotelId, deleteFlg)
      // console.log(this.delete[hotelId])
      // console.log(this.delete[hotelId] === '1')
      axios.post(
        topPath +
          '/api/deleted.php?hotel_id=' +
          hotelId +
          '&delete_flg=' +
          deleteFlg
      )
    },
    onClick: function(hotelId, available) {
      this.$set(this.available, hotelId, available)
      axios.post(
        topPath +
          '/api/availability.php?hotel_id=' +
          hotelId +
          '&available=' +
          available
      )
    }
  }
})
