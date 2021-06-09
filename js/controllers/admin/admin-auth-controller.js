// event to submit admin signup form
jQuery('.admin-signup-form').on('submit', function(event) {
    event.preventDefault();

    var adminUsername = jQuery('.admin-signup-username').val().trim(),
        adminEmail = jQuery('.admin-signup-email').val().trim(),
        adminPassword = jQuery('.admin-signup-password').val().trim(),
        adminPasswordConf = jQuery('.admin-signup-password-conf').val().trim();

    if (adminUsername == "") {
        showMessage('Admin Signup','Please enter admin username', 'warning');
    } else if (adminEmail == "") {
        showMessage('Admin Signup','Please enter admin email', 'warning');
    } else if (adminPassword == "") {
        showMessage('Admin Signup','Please enter admin password', 'warning');
    } else if (adminPasswordConf == "") {
        showMessage('Admin Signup','Please enter admin confirmation password', 'warning');
    } else if (adminPassword != adminPasswordConf) {
        showMessage('Admin Signup','Provided passwords do not match', 'warning');
    } else {
        jQuery('.auth-btn').html('Creating Account...').attr('disabled', true);
        var data = {
            '_token': jQuery('meta[name=csrf-token]').attr('content'),
            adminUsername: adminUsername,
            adminEmail: adminEmail,
            adminPassword: adminPassword,
            adminPasswordConf: adminPasswordConf
        }

        jQuery.ajax({
            url: ADMIN_CONSTANTS.ADMIN_SIGNUP_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                jQuery('.auth-btn').html('Create Account').attr('disabled', false);
                if (response.success) {
                    showMessage('Admin signup',response.message, 'success');
                    setTimeout(function() {
                        window.location.href = baseUrl + '/login';
                    }, 2000);
                } else {
                    showMessage('Admin signup',response.message, 'danger');
                }

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery('.auth-btn').html('Create Account').attr('disabled', false);
                console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
});