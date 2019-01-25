import Vue from 'vue'

export default {
  /**
   * auto bind component by name.
   * all component must has name.
   *
   * example:
   *
   * export default {
   *   name: 'componentName',
   *   props: {...},
   *   data: {...}
   * }
   *
   * @param {*} components
   */
  bindComponents(components, prefix = '') {
    for (let key in components) {
      if (components[key].prototype) {
        Vue.component(
          `${prefix}${components[key].prototype.constructor.options.name}`,
          components[key]
        )
      } else {
        Vue.component(`${prefix}${components[key].name}`, components[key])
      }
    }
  }
}
