import _ from 'lodash'

export default {
  pathname: _.trimEnd(window.location.pathname, '/'),
  getRoute() {
    const pathname = window.location.pathname

    if (pathname[pathname.length - 1] === '/') {
      return pathname.slice(0, pathname.length - 1)
    } else {
      return pathname
    }
  }
}
