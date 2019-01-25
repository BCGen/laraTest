<script>

export default {
  name: 'JsxDemo',
  props: {
    blogTitle: {
      type: String,
      default: 'blog'
    }
  },
  render(createElement) {
    return createElement(
      'div',
      [
        'Some text comes first',
        createElement('h1', 'A headline'),
        createElement('base-card', {
          props: {
            title: 'Demo',
            subTitle: '管理'
          }
        })
      ]
    )
  }
}

</script>
