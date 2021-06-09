// user personnal info setting form
jQuery(".user-personal-details-form").on("submit", function(event) {
    event.preventDefault();

    var firstName = jQuery(".first-name").val().trim(),
        lastName = jQuery(".last-name").val().trim(),
        username = jQuery(".username").val().trim(),
        email = jQuery(".email").val().trim(),
        phone = jQuery(".phone").val().trim(),
        address = jQuery(".address").val().trim();

    if (firstName == "") {
        showMessage("Account Settings", "Please enter first name","warning");
    } else if (lastName == "") {
        showMessage("Account Settings", "Please enter last name","warning");
    } else if (username == "") {
        showMessage("Account Settings", "Please enter username","warning");
    } else if (email == "") {
        showMessage("Account Settings", "Please enter email","warning");
    } else{
        if (phone == "") {
            phone = "n/a";
        }

        if (address == "") {
            address = "n/a";
        }

        var data = {
            _token: jQuery('meta[name=csrf-token]').attr('content'),
            firstName: firstName,
            lastName: lastName,
            username: username,
            email: email,
            phone: phone,
            address: address
        }

        jQuery.ajax({
            url: CONSTANTS.RESET_USER_PERSONAL_INFO_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                console.log(response);
                
                jQuery(".health-info-reset-btn").html("Update").prop("disabled", false);
                if (response.success) {
                    showMessage("Account Settings", response.message, "success")
                } else {
                    showMessage('Account Settings',response.message, 'error');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery(".health-info-reset-btn").html("Update").prop("disabled", false);
                console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
})

// user health info setting form
jQuery(".user-health-info-settings-form").on("submit", function(event) {
    event.preventDefault();

    var weight = jQuery(".user-weight").val().trim(),
        height = jQuery('.user-height').val().trim(),
        allergies = jQuery('.user-allergies').val().trim(),
        healthConditions = jQuery('.user-health-condition').val().trim(),
        currentMedication = jQuery('.user-current-medication').val().trim(),
        otherNotes = jQuery('.user-health-notes').val().trim();
    
    if (weight == "") {
        weight = "n/a";
    } 
    
    if(height == "") {
        height = "n/a";
    }
    
    if(allergies == "") {
        allergies = "n/a";
    }

    if (healthConditions == "") {
        healthConditions = "n/a";
    }

    if (currentMedication =="") {
        currentMedication = "n/a";
    }

    if (otherNotes == "") {
        otherNotes = "n/a";
    }

    jQuery(".health-info-reset-btn").html("Updating...").prop("disabled", true);
    var data = {
        _token: jQuery('meta[name=csrf-token]').attr('content'),
        weight: weight,
        height: height,
        allergies: allergies,
        healthConditions: healthConditions,
        currentMedication: currentMedication,
        otherNotes: otherNotes
    }

    jQuery.ajax({
        url: CONSTANTS.RESET_USER_HEALTH_INFO_URL,
        type: 'POST',
        data: data,
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            jQuery(".health-info-reset-btn").html("Update").prop("disabled", false);
            if (response.success) {
                showMessage("Account Settings", response.message, "success")
            } else {
                showMessage('Account Settings',response.message, 'error');
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            jQuery(".health-info-reset-btn").html("Update").prop("disabled", false);
            console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
})

// user password settings form
jQuery(".user-password-reset-form").on("submit",function(event) {
    event.preventDefault();

    var currentPassword = jQuery(".current-password").val().trim(),
        newPassword = jQuery(".new-password").val().trim(),
        confirmNewPassword = jQuery(".new-password-conf").val().trim();

    if (currentPassword == "") {
        showMessage("Account Settings", "Please enter current password", "warning")
    } else if (newPassword == "") {
        showMessage("Account Settings", "Please enter new password", "warning")
    } else if (confirmNewPassword == "") {
        showMessage("Account Settings", "Please confirm new password", "warning")
    } else if (newPassword.length < 8) {
        showMessage("Account Settings", "New password must contain at least eight characters", "warning")
    } else if (newPassword != confirmNewPassword) {
        showMessage("Account Settings", "New password does not match confirmation password", "warning")
    } else {
        jQuery(".password-reset-btn").html("Resetting...").prop("disabled", true);
        var data = {
            _token: jQuery('meta[name=csrf-token]').attr('content'),
            currentPassword: currentPassword,
            newPassword: newPassword,
            confirmNewPassword: confirmNewPassword
        }

        jQuery.ajax({
            url: CONSTANTS.RESET_USER_PASSWORD_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                jQuery(".password-reset-btn").html("Submit").prop("disabled", false);
                if (response.success) {
                	showMessage("Account Settings", response.message, "success")
                	setTimeout(function() {
                        jQuery(".user-password-reset-form").trigger('reset');
                    }, 2000);
                } else {
                	showMessage('Account Settings',response.message, 'error');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery(".password-reset-btn").html("Submit").prop("disabled", false);
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
})
