var app = new Vue({
  el: ".container",
  data: {
    available: 0,
    vacancies: 0
  },
  watch: {
    available: function (val) {
      console.log(val)
    },
    vacancies: function (val) {
      console.log(val)
    }
  }
})
