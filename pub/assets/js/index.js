Vue.component('hotel-row', {
  template: '#hotel-row',
  props: ['h']
})

var app = new Vue({
  el: '.container',
  data: {
    hotels: []
  },
  methods: {
    selectedFile: function(e) {
      e.preventDefault()
      let files = e.target.files
      this.uploadFile = files[0]
    },
    post: function() {
      this.isLoading = true
      // パラメータ作成
      let formData = new FormData()
      formData.append('groupname', this.groupname)
      formData.append('file', this.uploadFile)
      //Ajaxリクエスト
      axios
        .post('api/facepp/group_list.php', formData)
        .then(function(res) {
          console.log(res.data)
          res.data['results'].forEach((value, i) => {
            app.hotels.push({
              faceset_token: value['faceset_token'],
              outer_id: value['outer_id'],
              display_name: value['display_name'],
              tags: value['tags']
            })
          })
          app.isLoading = false
        })
        .catch(function(error) {
          console.log(error.data)
          app.isLoading = false
        })
    }
  }
})
