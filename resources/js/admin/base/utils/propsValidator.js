export default {


  /**
   *
   *
   * @param {Array} array
   * @param {any} value
   * @returns
   */
  indexOf(array, value) {
    const result = array.indexOf(value) !== -1

    if (!result) {
      console.error(`${value} is not include in ${array}`)
    }

    return result
  }
}
