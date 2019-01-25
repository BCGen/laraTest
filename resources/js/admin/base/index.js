import utils from './utils/utils'
import helper from './utils/helper'

import * as components from './components'

export default {
  install(Vue) {
    try {
      window.bindComponents = utils.bindComponents
      window.clockpicker = require('clockpicker/dist/bootstrap-clockpicker.min.js')
      Vue.prototype.$_helper = helper
    } catch (e) {
      console.log(e)
    }

    Vue.use(
      {},
      false,
      require('./assets/plugins/vueTables2/themes/bootstrap4.js'),
      require('./assets/plugins/vueTables2/templates/default.js')
    )

    utils.bindComponents(components)
  }
}
