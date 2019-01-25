import Errors from './Errors'

class Form {
  /**
   * Creates an instance of Form.
   *
   * @param {object} data
   * @memberof Form
   */
  constructor(data) {
    this.originalData = data

    for (let field in data) {
      this[field] = data[field]
    }

    this.errors = new Errors()
  }

  /**
   * Fetch all relevant data for the form.
   *
   * @returns {object}
   * @memberof Form
   */
  data() {
    let data = {}

    for (let property in this.originalData) {
      data[property] = this[property]
    }

    return data
  }

  /**
   * Reset the form fields and Errors.
   * @memberof Form
   */
  reset() {
    for (let field in this.originalData) {
      this[field] = ''
    }

    this.errors.clear()
  }

  /**
   * Send a POST request to the given URL.
   *
   * @param {string} url
   * @returns
   * @memberof Form
   */
  post(url) {
    return this.submit('post', url)
  }

  /**
   * Send a PUT request to the given URL.
   *
   * @param {string} url
   * @returns
   * @memberof Form
   */
  put(url) {
    return this.submit('put', url)
  }

  /**
   * Send a PATCH request to the given URL.
   *
   * @param {string} url
   * @returns
   * @memberof Form
   */
  patch(url) {
    return this.submit('patch', url)
  }

  /**
   * Send a DELETE request to the given URL.
   *
   * @param {string} url
   * @returns
   * @memberof Form
   */
  delete(url) {
    return this.submit('delete', url)
  }

  /**
   * Submit the form.
   *
   * @param {string} requestType
   * @param {string} url
   * @memberof Form
   */
  submit(requestType, url) {
    return new Promise((resolve, reject) => {
      axios[requestType](url, this.data())
        .then(response => {
          this.onSuccess(response.data)

          resolve(response.data)
        })
        .catch(error => {
          this.onFail(error.response.data.errors)

          reject(error.response.data.errors)
        })
    })
  }

  /**
   * Handle a successful form submission.
   *
   * @param {object} data
   * @memberof Form
   */
  onSuccess(data) {
    alert(data.message)

    this.reset()
  }

  /**
   * Handle a failed form submission.
   *
   * @param {Object} errors
   * @memberof Form
   */
  onFail(errors) {
    this.errors.record(errors)
  }
}

export default Form
