jQuery('.user-login-form').on('submit', function(event) {
    event.preventDefault();

    var userEmail = jQuery('.user-email').val().trim(),
        userPassword = jQuery('.user-password').val().trim();

    if (userEmail == "") {
        showMessage('Account Login','Please enter user email', 'warning');
    } else if (userPassword == "") {
        showMessage('Account Login','Please enter user password', 'warning');
    } else {
        jQuery('.auth-btn').html('Logging in...').attr('disabled', true);
        var data = {
            '_token': jQuery('meta[name=csrf-token]').attr('content'),
            userEmail: userEmail,
            userPassword: userPassword
        }

        jQuery.ajax({
            url: CONSTANTS.USER_LOGIN_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                console.log(response);
                jQuery('.auth-btn').html('Log In').attr('disabled', false);
                if (response.success) {
                    showMessage('Account Login',response.message, 'success');
                    setTimeout(function() {
                        switch (response.userType) {
                            case 'admin':
                                window.location.href = baseUrl + '/admin/dashboard';
                                break;
                            case 'publisher':
                                window.location.href = baseUrl + '/publisher/publisher-articles';
                                break;
                            case 'anonymous':
                                window.location.href = baseUrl + '/user/questions';
                                break;
                            case 'known':
                                window.location.href = baseUrl + '/user/questions';
                                break;
                            case 'doctor':
                                window.location.href = baseUrl + '/doctor/questions';
                                break;
                            default:
                                break;
                        }

                    }, 2000);
                } else {
                    showMessage('Account Login',response.message, 'danger');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery('.auth-btn').html('Log In').attr('disabled', false);
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
})



jQuery('.anonymous-user-signup-form').on('submit', function(event) {
    event.preventDefault();

    var username = jQuery('.username').val().trim(),
        userPassword = jQuery('.user-password').val().trim(),
        userPasswordConf = jQuery('.user-password-conf').val().trim();

    if (username == "") {
        showMessage('Account Signup','Please enter username', 'warning');
    } else if (userPassword == "") {
        showMessage('Account Signup','Please enter user password', 'warning');
    } else if (userPassword != userPasswordConf) {
        showMessage('Account Signup','Provided passwords do not match', 'warning');
    } else if (userPassword.length < 8) {
        showMessage('Account Signup','Password must be at least 8 characters long', 'warning');
    } else {
        jQuery('.auth-btn').html('Signing up...').attr('disabled', true);
        var data = {
            '_token': jQuery('meta[name=csrf-token]').attr('content'),
            username: username,
            userPassword: userPassword
        }

        jQuery.ajax({
            url: CONSTANTS.ANONYMOUS_USER_SIGNUP_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                console.log(response);
                jQuery('.auth-btn').html('Signup').attr('disabled', false);
                if (response.success) {
                    showMessage('Account Signup',response.message, 'success');
                    setTimeout(function() {
                        window.location.href = baseUrl + '/user/questions';
                    }, 2000);
                } else {
                    showMessage('Account Signup',response.message, 'danger');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery('.auth-btn').html('Signup').attr('disabled', false);
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
})


jQuery('.user-signup-form').on('submit', function(event) {
    event.preventDefault();

    var userFirstName = jQuery('.user-first-name').val().trim(),
        userLastName = jQuery('.user-last-name').val().trim(),
        userGender = jQuery('.user-gender').val(),
        userDateofBirth = jQuery('.user-dob').val().trim(),
        username = jQuery('.username').val().trim(),
        userCountry = jQuery('#user-country').val(),
        userEmail = jQuery('.user-email').val().trim(),
        userPhone = jQuery('.user-phone').val().trim(),
        userPassword = jQuery('.user-password').val().trim(),
        userPasswordConf = jQuery('.user-password-conf').val().trim();

    if (userFirstName == "") {
        showMessage('Account Signup','Please enter first name', 'warning');
    } else if (userLastName == "") {
        showMessage('Account Signup','Please enter last name', 'warning');
    } else if (userGender == -1 || userGender == null || userGender == undefined) {
        showMessage('Account Signup','Please select user gender', 'warning');
    } else if (userDateofBirth == "") {
        showMessage('Account Signup','Please select date of birth', 'warning');
    } else if (username == "") {
        showMessage('Account Signup','Please enter username', 'warning');
    } else if (userCountry == -1 || userCountry == null || userCountry == undefined) {
        showMessage('Account Signup','Please select country', 'warning');
    } else if (userEmail == "") {
        showMessage('Account Signup','Please enter email', 'warning');
    }  else if (userPhone == "") {
        showMessage('Account Signup','Please enter phone number', 'warning');
    } else if (userPassword == "") {
        showMessage('Account Signup','Please enter user password', 'warning');
    } else if (userPassword != userPasswordConf) {
        showMessage('Account Signup','Provided passwords do not match', 'warning');
    } else if (userPassword.length < 8) {
        showMessage('Account Signup','Password must be at least 8 characters long', 'warning');
    } else {
        jQuery('.auth-btn').html('Signing up...').attr('disabled', true);
        var data = {
            '_token': jQuery('meta[name=csrf-token]').attr('content'),
            userFirstName: userFirstName,
            userLastName: userLastName,
            userGender: userGender,
            userCountry: userCountry,
            userDateofBirth: userDateofBirth,
            username: username,
            userEmail: userEmail,
            userPhone: userPhone,
            userPassword: userPassword,
        }

        jQuery.ajax({
            url: CONSTANTS.USER_SIGNUP_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                jQuery('.auth-btn').html('Signup').attr('disabled', false);
                if (response.success) {
                    showMessage('Account Signup',response.message, 'success');
                    setTimeout(function() {
                        window.location.href = baseUrl + '/user/questions';
                    }, 2000);
                } else {
                    showMessage('Account Signup',response.message, 'danger');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery('.auth-btn').html('Signup').attr('disabled', false);
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
})


jQuery(".forgot-password-form").on("submit", function(event) {
    event.preventDefault();

    var userEmail = jQuery(".user-email").val().trim();

    if (userEmail == "") {
        showMessage("Forgot Password","Please enter your email address", 'warning');
    } else {
        jQuery(".submit-btn").html("Submitting...").prop('disabled', true);
        var data = {
            '_token': jQuery('meta[name=csrf-token]').attr('content'),
            userEmail: userEmail
        }

        jQuery.ajax({
            url: CONSTANTS.USER_PASSWORD_CHANGE_REQUEST_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                jQuery(".submit-btn").html("Submit").prop('disabled', false);

                console.log(response);
                jQuery('.auth-btn').html('Signup').attr('disabled', false);
                if (response.success) {
                    jQuery(".forgot-password-res").html(response.message).addClass("text-success").removeClass("text-danger");
                    setTimeout(function() {
                        window.location.href = baseUrl + '/';
                    }, 3000);
                } else {
                    jQuery(".forgot-password-res").html(response.message).addClass("text-danger").removeClass("text-success");
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery(".submit-btn").html("Submit").prop('disabled', false);
                console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
});


jQuery(".reset-password-form").on("submit", function(event) {
    event.preventDefault();

    var resetCode = jQuery(".reset-new-password-code").val().trim(),
        resetPassword = jQuery(".reset-new-password").val().trim(),
        resetPasswordConf = jQuery(".reset-new-password-conf").val().trim();

    if (resetPassword == "") {
        showMessage("Password Reset","Please password", 'warning');
    } else if(resetPassword.length < 8) {
        showMessage("Password Reset","Password must be at least eight characters long", 'warning');
    } else if (resetPassword != resetPasswordConf) {
        showMessage("Password Reset","Provided passwords do not match", 'warning');
    } else {
        jQuery('.auth-btn').html('Updating...').attr('disabled', true);
        var data = {
            '_token': jQuery('meta[name=csrf-token]').attr('content'),
            resetPassword: resetPassword,
            resetCode: resetCode,
            resetPasswordConf: resetPasswordConf
        }

        jQuery.ajax({
            url: CONSTANTS.RESET_PASSWORD_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                jQuery('.auth-btn').html('Update').attr('disabled', false);
                if (response.success) {
                    showMessage('Password Reset',response.message, 'success');
                    setTimeout(function() {
                        window.location.href = baseUrl + '/';
                    }, 2000);
                } else {
                    showMessage('Password Reset',response.message, 'danger');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery('.auth-btn').html('Update').attr('disabled', false);
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }

})
