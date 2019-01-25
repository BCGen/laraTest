class Errors {
  /**
   * Creates an instance of Errors.
   *
   * @memberof Errors
   */
  constructor() {
    this.errors = {}
  }

  /**
   * Determine if we have any errors.
   *
   * @returns {boolean}
   * @memberof Errors
   */
  any() {
    return Object.keys(this.errors).length > 0
  }

  /**
   * Clear one or all error fields.
   *
   * @param {?string} field
   * @memberof Errors
   */
  clear(field = null) {
    if (field) {
      delete this.errors[field]
      return
    }

    this.errors = {}
  }

  /**
   * Retrieve the error message for a field.
   *
   * @param {string} field
   * @returns {string|undefined}
   * @memberof Errors
   */
  get(field) {
    if (this.errors[field]) {
      return this.errors[field][0]
    }
  }

  /**
   * Determine if an errors exists for the given field.
   *
   * @param {string} field
   * @returns {boolean}
   * @memberof Errors
   */
  has(field) {
    return this.errors.hasOwnProperty(field)
  }

  /**
   * Record the new errors.
   *
   * @param {object} errors
   * @memberof Errors
   */
  record(errors) {
    this.errors = errors
  }
}

export default Errors
