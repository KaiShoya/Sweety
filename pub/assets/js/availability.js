var app = new Vue({
  el: ".container",
  data: {
    available: 0
  },
  watch: {
    available: function (val) {
      console.log(val)
    }
  }
})
