Vue.component("price-row", {
  template: "#price-row",
  props: ["p"]
});

var app = new Vue({
  el: ".container",
  data: {
    activeDowId: dowId,
    startHour: "0",
    startTime: "00",
    utilizationTime: null,
    cardAccepted: false,
    isLoading: false,
    sortKey: "price",
    day_of_week: [
      {id: 0, name: "全曜日"},
      {id: 1, name: "月"},
      {id: 2, name: "火"},
      {id: 3, name: "水"},
      {id: 4, name: "木"},
      {id: 5, name: "金"},
      {id: 6, name: "土"},
      {id: 7, name: "日"},
      {id: 8, name: "祝日"},
      {id: 9, name: "祝前日"}
    ],
    hotels: [],
    prices: [],
  },
  created: function () {
    this.get_hosts()
    params = this.get_params()
    sh = (params.start_hour === undefined) ? "0" : params.start_hour
    st = (params.start_time === undefined) ? "00" : params.start_time
    ut = (params.utilization_time === undefined) ? null : params.utilization_time
    ca = "card_accepted" in params
    this.startHour = sh
    this.startTime = st
    this.utilizationTime = ut
    this.cardAccepted = ca
  },
  methods: {
    get_hosts: function(e) {
      // パラメータ作成
      // let formData = new FormData()
      // formData.append('groupname', this.groupname)
      // formData.append('file', this.uploadFile)
      //Ajaxリクエスト
      axios.post("api/hotel_list.php")
      .then(function (res) {
        console.log(res.data)
        res.data.forEach((value, i) => {
          app.hotels.push({
            id: value["id"],
            name: value["name"],
            address: value["address"],
            phone: value["phone"],
            mapcode: value["mapcode"],
            lat: value["lat"],
            lon: value["lon"],
            credit_card: value["credit_card"],
            created_at: value["created_at"],
            updated_at: value["updated_at"],
          })
        })
        app.get_prices()
      })
      .catch(function (error) {
        console.log(error.data)
      })
    },
    get_prices: function(e) {
      // パラメータ作成
      params = this.get_params()
      let formData = new FormData()
      Object.keys(params).forEach(function (key) {
        formData.append(key, params[key])
      })
      //Ajaxリクエスト
      axios.post("api/price_list.php", formData)
      .then(function (res) {
        console.log(res.data)
        res.data.forEach((value, i) => {
          app.prices.push({
            id: value.id,
            hotel_id: app.hotels[value.hotel_id - 1].name,
            // day_of_week: value.day_of_week,
            day_of_week: app.get_day_of_week_name(value.day_of_week),
            min_price: value.min_price,
            max_price: value.max_price,
            time_zone_start: value.time_zone_start.slice(0, -3),
            time_zone_end: value.time_zone_end.slice(0, -3),
            utilization_time: value.utilization_time,
            created_at: value.created_at,
            updated_at: value.updated_at,
            time_diff: value.time_diff.slice(0, -3),
            last_start_time: value.last_start_time.slice(0, -3),
          })
        })
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    get_day_of_week_name: function(e) {
      str = ""
      app.day_of_week.some(value => {
        if (String(value.id) === e) {
          str = value.name
          return true
        }
      })
      return str
    },
    get_day_of_week_id: function(e) {
      str = ""
      app.day_of_week.some(value => {
        if (value.name === e) {
          str = value.id
          return true
        }
      })
      return str
    },
    get_params: function(e) {
      arg = new Object
      pair=location.search.substring(1).split('&')
      for(i=0; pair[i]; i++) {
          kv = pair[i].split('=')
          arg[kv[0]]=kv[1]
      }
      return arg
    },
    create_params: function(label, value, params = this.get_params()) {
      params[label] = value
      tmp_arr = []
      Object.keys(params).forEach(function (key) {
        if (params[key] === null) {
        } else if (params[key] === undefined) {
          tmp_arr.push(key)
        } else {
          tmp_arr.push(key + "=" + params[key])
        }
      })
      return tmp_arr.join("&")
    },

    click_dow: function(e) {
      id = app.get_day_of_week_id(e.target.outerText)
      params = app.create_params("dow_id", id)
      window.location.href = window.location.pathname + "?" + params
    },

    change_start_hour: function(e) {
      params = this.get_params()
      params["start_hour"] = e.target.value
      params = app.create_params("start_time", app.startTime, params)
      window.location.href = window.location.pathname + "?" + params
    },
    change_start_time: function(e) {
      params = this.get_params()
      params["start_time"] = e.target.value
      params = app.create_params("start_hour", app.startHour, params)
      window.location.href = window.location.pathname + "?" + params
    },
    now_start_time: function(e) {
      date=new Date()
      h = date.getHours()
      m = date.getMinutes()

      params = this.get_params()
      params["start_hour"] = h
      if (m < 15) {
        params = app.create_params("start_time", "15", params)
      } else if (m < 30) {
        params = app.create_params("start_time", "30", params)
      } else if (m < 45) {
        params = app.create_params("start_time", "45", params)
      } else {
        params["start_hour"] = h+1
        params = app.create_params("start_time", "00", params)
      }
      window.location.href = window.location.pathname + "?" + params
    },
    reset_start_time: function(e) {
      params = this.get_params()
      params["start_hour"] = undefined
      params = app.create_params("start_time", undefined, params)
      window.location.href = window.location.pathname + "?" + params
    },

    change_utilization_time: function(e) {
      params = app.create_params("utilization_time", e.target.value)
      window.location.href = window.location.pathname + "?" + params
    },
    click_utilization_time: function(time) {
      params = app.create_params("utilization_time", time)
      window.location.href = window.location.pathname + "?" + params
    },

    change_card_accepted: function(e) {
      if (e.target.checked) {
        params = app.create_params("card_accepted", undefined)
      } else {
        params = app.create_params("card_accepted", null)
      }
      window.location.href = window.location.pathname + "?" + params
    },
  },
  computed: {
    orderedPrices: function () {
      return _.orderBy(this.prices, this.sortKey)
    }
  }
})
