// Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
  }, "Only Letters and Space is allowed");

  $("form[name='addUser']").validate({
    // Specify validation rules
    rules: {
      name: {
        required: true,
        lettersonly: true
      },
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    messages: {
      name: {
        required: "Please enter user name"
      },
      password: {
        required: "Please enter user password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
