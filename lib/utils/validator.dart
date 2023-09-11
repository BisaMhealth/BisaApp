class Validator {
  static String? emailValidator(String? email) {
// Regex to check if an email is valid
    Pattern pattern =
        r"[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?";
    RegExp regex = RegExp(pattern as String);

    if (email!.isEmpty) return "Enter Email!";
    if (!regex.hasMatch(email)) {
      return 'This is not a valid email!';
    }
    return null;
  }

  static String? phoneNumberValidator(String? phoneNumber) {
// Regex to check if an phone number is valid
    Pattern pattern =
        r'^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$';
    RegExp regex = RegExp(pattern as String);

    if (phoneNumber!.isEmpty) return "Enter phone number!";
    if (!regex.hasMatch(phoneNumber)) {
      return 'This is not a valid phone number!';
    }
    return null;
  }

// Validator to check if a text field is not empty
  static String? textValidator(String? text) {
    if (text!.isEmpty) return 'This field is required!';
    return null;
  }

// Validator to check if password is greater than 7 characters
  static String? passwordValidator(String? password) {
    if (password!.isEmpty) return 'This field is required!';
    // if (password.length < 7) return "Password must be greater than 7";
    return null;
  }

// Validator to check if password is greater than 7 characters
  static String? passwordConfirm(String? password, String? confirm) {
    if (password!.isEmpty && confirm!.isEmpty) {
      return 'This field is required!';
    } else if (!password.contains(confirm!)) {
      return 'This field is required!';
    }
    // if (password!.contains(confirm)) return 'This field is required!';
    // if (password.length < 7) return "Password must be greater than 7";
    return null;
  }
}
