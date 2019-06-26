import _ from 'lodash'

export class RequestError {
  constructor(message, formErrors = null) {
    this.message = message;
    this.formErrors = formErrors;
  }

  getMessage() {
    return this.message;
  }

  hasFormErrors() {
    return (this.formErrors != null);
  }

  getFormErrors(field = null) {
    if (this.formErrors != null) {
      if (field == null) {
        return this.formErrors;
      }
      if (this.formErrors.indexOf(field) !== -1)
        return this.formErrors[field];
      return null;
    }
    return null;
  };

  getFormErrorMessages() {
    if (this.formErrors != null) {
      let errors = this.getFormErrors();
      let errorsArray = Object.keys(errors).map((key) => {
        if (errors.indexOf(key) !== -1)
          return errors[key];
        return null;
      });

      return _.flatten(errorsArray);
    }
    return null;
  }
}