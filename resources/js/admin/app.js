import './bootstrap'
import Vue from 'vue'
import Base from './base'
import * as antd from './antd'
import * as views from './views'
import Antd from 'ant-design-vue'

// require('quasar-framework/dist/quasar.mat.css')

Vue.config.productionTip = false

window.Vue = Vue

Vue.use(Base)
Vue.use(Antd)

// Vue.use(iView)
bindComponents(views)
bindComponents(antd)

const app = new Vue({
  el: '#app'
})
