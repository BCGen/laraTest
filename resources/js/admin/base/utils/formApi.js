export default class FormApi {
  constructor() {
    this.httpMethods = ['get', 'post', 'patch', 'put', 'delete']
    this.httpMainMethods = ['get', 'post']
    this.urlActions = ['create', 'edit']
  }

  csrf() {
    const token = document.head.querySelector(`meta[name="csrf-token"]`)

    if (token) {
      return token.content
    } else {
      console.error(
        'CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token'
      )
      return ''
    }
  }

  pathname() {
    return _.trimEnd(window.location.pathname, '/')
  }

  action() {
    if (['post', 'patch'].indexOf(this.method()) !== -1) {
      const list = this.pathname().split('/')
      list.pop()
      return list.join('/')
    }

    return this.pathname()
  }

  method() {
    const last = this.pathname()
      .split('/')
      .pop()

    if (last === 'create') {
      return 'post'
    } else if (last === 'edit') {
      return 'patch'
    }
    return 'hi'
  }
}
