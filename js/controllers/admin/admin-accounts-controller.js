/**
 * Show doctor thumbnail when it is selected
 */
jQuery(".add-doctor-thumbnail").on("change", function(){
    var imageSizeLimit = 3 * 1024 * 1024;
    var file = document.getElementById('add-doctor-thumbnail').files;
    var fileLength = file.length;

    if (fileLength > 0) {
		if (file[0].size > imageSizeLimit) {
			showWarningMessage("Image cannot be greater than 3MB", "Admin Action");
		}  else {
            jQuery(".add-doctor-thumbnail-label small").html("Doctor Thumbnail Selected");

            var reader = new FileReader();
            reader.onload = function (e) {
                jQuery(".add-doctor-thumbnail-res").attr('src', e.target.result);
            }

            reader.readAsDataURL(file[0]);
		}
	}
});


jQuery(".edit-doctor-thumbnail").on("change", function(){
    var imageSizeLimit = 3 * 1024 * 1024;
    var file = document.getElementById('edit-doctor-thumbnail').files;
    var fileLength = file.length;

    if (fileLength > 0) {
		if (file[0].size > imageSizeLimit) {
			showWarningMessage("Image cannot be greater than 3MB", "Admin Action");
		}  else {
            jQuery(".edit-doctor-thumbnail-label small").html("Doctor Thumbnail Selected");

            var reader = new FileReader();
            reader.onload = function (e) {
                jQuery(".edit-doctor-thumbnail-res").attr('src', e.target.result);
            }

            reader.readAsDataURL(file[0]);
		}
	}
});


jQuery(".add-doctor-form").on("submit", function(event) {
    event.preventDefault();

    var doctorTitle = jQuery(".add-doctor-title").val().trim(),
        doctorFirstName = jQuery(".add-doctor-first-name").val().trim(),
        doctorLastName = jQuery(".add-doctor-last-name").val().trim(),
        doctorCountry = jQuery("#add-doctor-country").val(),
        doctorAddress = jQuery(".add-doctor-address").val().trim(),
        doctorPhone = jQuery(".add-doctor-phone").val().trim(),
        doctorGender = jQuery(".add-doctor-gender").val(),
        doctorEmail = jQuery(".add-doctor-email").val().trim(),
        doctorUsername = jQuery(".add-doctor-username").val().trim(),
        doctorPassword = jQuery(".add-doctor-password").val().trim(),
        doctorBio = jQuery(".add-doctor-bio").val().trim(),
        thumbnail = document.getElementById('add-doctor-thumbnail').files;

    if (doctorFirstName == "") {
        showMessage("Admin Action", "Please first enter name", "warning");
    } else if (doctorLastName == "") {
        showMessage("Admin Action", "Please last enter name", "warning");
    } else if (doctorGender == null || doctorGender == -1 || doctorGender == undefined){
        showMessage("Admin Action", "Please enter type", "warning");
    } else if (doctorCountry == null || doctorCountry == -1 || doctorCountry == undefined){
        showMessage("Admin Action", "Please select country", "warning");
    } else if (doctorAddress == ""){
        showMessage("Admin Action", "Please enter address", "warning");
    }  else if (doctorPhone == ""){
        showMessage("Admin Action", "Please enter phone number", "warning");
    }  else if (doctorEmail == ""){
        showMessage("Admin Action", "Please enter email address", "warning");
    }  else if (doctorBio == ""){
        showMessage("Admin Action", "Please enter bio", "warning");
    }  else if (doctorUsername == ""){
        showMessage("Admin Action", "Please enter username", "warning");
    }   else if (doctorPhone == ""){
        showMessage("Admin Action", "Please enter password", "warning");
    } else {
        jQuery(".add-btn").html("Adding...").prop("disabled", true);
        var formData = new FormData();
        formData.append('_token', jQuery('meta[name=csrf-token]').attr('content'))
        formData.append('doctorTitle',doctorTitle);
        formData.append('doctorFirstName',doctorFirstName);
        formData.append('doctorLastName',doctorLastName);
        formData.append('doctorGender',doctorGender);
        formData.append('doctorCountry',doctorCountry);
        formData.append('doctorAddress', doctorAddress);
        formData.append('doctorPhone',doctorPhone);
        formData.append('doctorEmail',doctorEmail);
        formData.append('doctorUsername',doctorUsername);
        formData.append('doctorPassword',doctorPassword);
        formData.append('doctorBio',doctorBio);
        formData.append('doctorThumbnail', thumbnail[0]);

		jQuery.ajax({
            url: ADMIN_CONSTANTS.ADD_DOCTOR_DETAILS_URL,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                console.log('from server', response);
                jQuery(".add-btn").html("Add").prop("disabled", false);
                if (response.success) {
                	showMessage("Admin Action", response.message, "success")
                	getDoctorAccounts();
                	setTimeout(function() {
                        jQuery('#add-doctor-modal').modal('hide');
                        jQuery(".add-doctor-form").trigger('reset');
                    }, 2000);
                } else {
                	showMessage('Admin action',response.message, 'error');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery(".add-btn").html("Add").prop("disabled", false);
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
})


jQuery(".edit-doctor-form").on("submit", function(event) {
    event.preventDefault();

    var doctorTitle = jQuery(".edit-doctor-title").val().trim(),
        doctorFirstName = jQuery(".edit-doctor-first-name").val().trim(),
        doctorLastName = jQuery(".edit-doctor-last-name").val().trim(),
        doctorCountry = jQuery("#edit-doctor-country").val(),
        doctorAddress = jQuery(".edit-doctor-address").val().trim(),
        doctorPhone = jQuery(".edit-doctor-phone").val().trim(),
        doctorGender = jQuery(".edit-doctor-gender").val(),
        doctorEmail = jQuery(".edit-doctor-email").val().trim(),
        doctorUsername = jQuery(".edit-doctor-username").val().trim(),
        doctorBio = jQuery(".edit-doctor-bio").val().trim(),
        doctorId = jQuery(".edit-doctor-id").val();
        thumbnail = document.getElementById('edit-doctor-thumbnail').files;

    if (doctorFirstName == "") {
        showMessage("Admin Action", "Please first enter name", "warning");
    } else if (doctorLastName == "") {
        showMessage("Admin Action", "Please last enter name", "warning");
    } else if (doctorGender == null || doctorGender == -1 || doctorGender == undefined){
        showMessage("Admin Action", "Please enter type", "warning");
    } else if (doctorCountry == null || doctorCountry == -1 || doctorCountry == undefined){
        showMessage("Admin Action", "Please select country", "warning");
    } else if (doctorAddress == ""){
        showMessage("Admin Action", "Please enter address", "warning");
    }  else if (doctorPhone == ""){
        showMessage("Admin Action", "Please enter phone number", "warning");
    }  else if (doctorEmail == ""){
        showMessage("Admin Action", "Please enter email address", "warning");
    }  else if (doctorBio == ""){
        showMessage("Admin Action", "Please enter bio", "warning");
    }  else if (doctorUsername == ""){
        showMessage("Admin Action", "Please enter username", "warning");
    }   else if (doctorPhone == ""){
        showMessage("Admin Action", "Please enter password", "warning");
    } else {
        jQuery(".edit-btn").html("Updating...").prop("disabled", true);
        var formData = new FormData();
        formData.append('_token', jQuery('meta[name=csrf-token]').attr('content'))
        formData.append('doctorTitle',doctorTitle);
        formData.append('doctorFirstName',doctorFirstName);
        formData.append('doctorLastName',doctorLastName);
        formData.append('doctorGender',doctorGender);
        formData.append('doctorCountry',doctorCountry);
        formData.append('doctorAddress', doctorAddress);
        formData.append('doctorPhone',doctorPhone);
        formData.append('doctorEmail',doctorEmail);
        formData.append('doctorUsername',doctorUsername);
        formData.append('doctorBio',doctorBio);
        formData.append('doctorId',doctorId);
        if (thumbnail.length > 0) {
            formData.append('doctorThumbnail', thumbnail[0]);
        }

		jQuery.ajax({
            url: ADMIN_CONSTANTS.EDIT_DOCTOR_DETAILS_URL,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                console.log('from server', response);
                jQuery(".edit-btn").html("Update").prop("disabled", false);
                if (response.success) {
                	showMessage("Admin Action", response.message, "success")
                	getDoctorAccounts();
                	setTimeout(function() {
                        jQuery('#edit-doctor-modal').modal('hide');
                        jQuery(".edit-doctor-form").trigger('reset');
                    }, 2000);
                } else {
                	showMessage('Admin action',response.message, 'error');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery(".edit-btn").html("Update").prop("disabled", false);
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
})


function getDoctorAccounts() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_DOCTOR_ACCOUNTS_URL,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            if (response.success) {
            	var template = '';
            	var counter = 1;

            	if (response.data.length > 0) {
            		template += `
            		    <h5 class='text-center'><b>Doctors</b></h5><br>
            			<table class="table table-striped data-table table-hover table-sm">
						  	<thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">F Name</th>
							      <th scope="col">L Name</th>
							      <th scope="col">Username</th>
							      <th scope="col">Gender</th>
							      <th scope="col">Country</th>
							      <th scope="col">Phone</th>
							      <th scope="col">Email</th>
							      <th scope="col">Active</th>
							      <th scope="col">Actions</th>
							    </tr>
						  	</thead>
						  	<tbody>
            		`;

            		response.data.forEach(function(item) {
            			var itemObj = JSON.stringify(item);

                        var userActive = (item.active == 1) ? 'Yes' : 'No';

            			template += `
            				<tr>
						      <th scope="row">${counter}</th>
						      <td>${truncateString(item.first_name, 10, 7)}</td>
						      <td>${truncateString(item.last_name, 10, 7)}</td>
						      <td>${truncateString(item.username, 10, 7)}</td>
						      <td>${truncateString(item.gender, 10, 7)}</td>
						      <td>${truncateString(item.country, 10, 7)}</td>
						      <td>${truncateString(item.phone, 10, 7)}</td>
						      <td>${truncateString(item.email, 10, 7)}</td>
						      <td>${userActive}</td>
						      <td>
						      	<a class='text-success action-btn' onclick='viewDoctorDetails(${itemObj})'><i class='fa fa-eye'></i> view</a>&nbsp;&nbsp;&nbsp;

						      	<a class='text-info action-btn' onclick='showEditDoctorForm(${itemObj})'><i class='fa fa-pencil'></i> edit</a>&nbsp;&nbsp;&nbsp;

						      	<a class='text-danger action-btn' onclick='deleteDoctorDetails(${itemObj})'><i class='fa fa-trash-o'></i> delete</a>&nbsp;&nbsp;&nbsp;

						      	<a class='text-warning action-btn' onclick='toggleDoctorActiveStatus(${itemObj})'><i class='fa fa-toggle-on'></i> change status</a>
						      </td>
						    </tr>
            			`;
            			counter ++;
            		});

            		template += `
            			</tbody>
            			</table>
            		`;

            	} else {
            		template += `
            			<div class='jumbotron'>
            				<h5 class='text-center'>No doctors available</h5>
            			</div>
            		`;

            	}

                jQuery('.doctors-accounts-res').html(template);
                jQuery(".data-table").DataTable();
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}

/** View doctor details **/
function viewDoctorDetails(itemObj) {
    var doctorActive = (itemObj.active == 1) ? 'Yes' : 'No';
    jQuery(".doctor-name").html(itemObj.title + " " + itemObj.first_name + "  " + itemObj.last_name);
    jQuery(".doctor-username").html(itemObj.username);
    jQuery(".doctor-email").html(itemObj.email);
    jQuery(".doctor-phone").html(itemObj.phone);
    jQuery(".doctor-gender").html(itemObj.gender);
    jQuery(".doctor-country").html(itemObj.country);
    jQuery(".doctor-address").html(itemObj.address);
    jQuery(".doctor-type").html(itemObj.type);
    jQuery(".doctor-active").html(doctorActive);
    jQuery(".doctor-bio").html(itemObj.bio);
    jQuery(".doctor-detals-thumbnail").prop("src", itemObj.thumbnail);
    jQuery("#view-doctor-modal").modal("show");
}


/** show edit doctor form **/
function showEditDoctorForm(itemObj) {
    jQuery(".edit-doctor-title").val(itemObj.title)
    jQuery(".edit-doctor-first-name").val(itemObj.first_name)
    jQuery(".edit-doctor-last-name").val(itemObj.last_name)
    jQuery(".edit-doctor-country").val(itemObj.country)
    jQuery(".edit-doctor-address").val(itemObj.address)
    jQuery(".edit-doctor-phone").val(itemObj.phone)
    jQuery(".edit-doctor-gender").val(itemObj.gender)
    jQuery(".edit-doctor-email").val(itemObj.email)
    jQuery(".edit-doctor-username").val(itemObj.username)
    jQuery(".edit-doctor-bio").val(itemObj.bio)
    jQuery(".edit-doctor-id").val(itemObj.doctor_id);
    jQuery("#edit-doctor-modal").modal("show")
    jQuery(".edit-doctor-thumbnail-res").prop("src", itemObj.thumbnail)
}


/** delete doctor details **/
function deleteDoctorDetails(itemObj) {
    var confirmDelete = confirm("Are you sure you want to change doctor active status ?")
    if (confirmDelete) {
        var data = {
            '_token': jQuery('meta[name=csrf-token]').attr('content'),
            doctorId: itemObj.doctor_id
        }
        jQuery.ajax({
            url: ADMIN_CONSTANTS.DELETE_DOCTOR_DETAILS_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                console.log(response)
                if (response.success) {
                    showMessage("Admin Action", response.message, "success")
                    getDoctorAccounts();
                } else {
                    showMessage("Admin Action", response.message, 'danger');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
}

/** toggle doctor active status **/
function toggleDoctorActiveStatus(itemObj) {
    var confirmDelete = confirm("Are you sure you want to change doctor active status ?")
    if (confirmDelete) {
        var data = {
            '_token': jQuery('meta[name=csrf-token]').attr('content'),
            doctorId: itemObj.doctor_id,
            doctorStatus: itemObj.active
        }
        jQuery.ajax({
            url: ADMIN_CONSTANTS.TOGGLE_DOCTOR_ACTIVE_STATUS_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                console.log(response)
                if (response.success) {
                    showMessage("Admin Action", response.message, "success")
                    getDoctorAccounts();
                } else {
                    showMessage("Admin Action", response.message, 'danger');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
}


/*######################## for the admins accounts page #############################*/

/* add admin account */
jQuery('.add-admin-form').on('submit', function(event) {
    event.preventDefault();

    var adminUsername = jQuery('.add-admin-username').val().trim(),
        adminEmail = jQuery('.add-admin-email').val().trim(),
        adminType = jQuery('.add-admin-type').val(),
        adminPassword = jQuery('.add-admin-password').val().trim(),
        adminPasswordConf = jQuery('.add-admin-password-conf').val().trim();

    if (adminUsername == "") {
        showMessage('Admin Signup','Please enter admin username', 'warning');
    } else if (adminEmail == "") {
        showMessage('Admin Signup','Please enter admin email', 'warning');
    } else if (adminType == -1 || adminType == undefined || adminType == null) {
        showMessage('Admin Signup','Please select admin type', 'warning');
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
            adminType: adminType,
            adminPasswordConf: adminPasswordConf
        }

        jQuery.ajax({
            url: ADMIN_CONSTANTS.ADD_ADMIN_ACCOUNT_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                jQuery('.auth-btn').html('Create Account').attr('disabled', false);
                if (response.success) {
                    showMessage('Admin signup',response.message, 'success');
                    getAdminAccounts();
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

/* get all admins accounts */
function getAdminAccounts() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_ADMIN_ACCOUNTS_URL,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            if (response.success) {
            	var template = '';
            	var counter = 1;

            	if (response.data.length > 0) {
            		template += `
            		    <h5 class='text-center'><b>Admins</b></h5><br>
            			<table class="table table-striped data-table table-hover table-sm">
						  	<thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Username</th>
							      <th scope="col">Email</th>
							      <th scope="col">Type</th>
							      <th scope="col">Active</th>
							      <th scope="col">Actions</th>
							    </tr>
						  	</thead>
						  	<tbody>
            		`;

            		response.data.forEach(function(item) {
            			var itemObj = JSON.stringify(item);

                        var adminActive = (item.admin_active == 1) ? 'Yes' : 'No';

            			template += `
            				<tr>
						      <th scope="row">${counter}</th>
						      <td>${item.admin_username}</td>
						      <td>${truncateString(item.admin_email, 30, 25)}</td>
						      <td>${truncateString(item.admin_type, 10, 7)}</td>
						      <td>${adminActive}</td>
						      <td>
						      	<a class='text-info action-btn' onclick='toggleAdminActiveStatus(${itemObj})'><i class='fa fa-toggle-on'></i> change active status</a>
						      </td>
						    </tr>
            			`;

            			counter ++;
            		});

            		template += `
            			</tbody>
            			</table>
            		`;

            	} else {
            		template += `
            			<div class='jumbotron'>
            				<h5 class='text-center'>No admin details available</h5>
            			</div>
            		`;

            	}

                jQuery('.admin-accounts-res').html(template);
                jQuery(".data-table").DataTable();
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}


/** toggle admin active status **/
function toggleAdminActiveStatus(itemObj) {
    if (itemObj.admin_type == "admin") {
        showMessage("Admin action", "You cannot change active status of super admin", "warning");
    } else {
        var confirmDelete = confirm("Are you sure you want to change admin active status ?")
        if (confirmDelete) {
            var data = {
                '_token': jQuery('meta[name=csrf-token]').attr('content'),
                adminId: itemObj.admin_id,
                adminStatus: itemObj.admin_active
            }
            jQuery.ajax({
                url: ADMIN_CONSTANTS.TOGGLE_ADMIN_ACTIVE_STATUS_URL,
                type: 'POST',
                data: data,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", "Bearer ")
                },
                success: function(response) {
                    console.log(response)
                    if (response.success) {
                        showMessage("Admin Action", response.message, "success")
                        getAdminAccounts();
                    } else {
                        showMessage("Admin Action", response.message, 'danger');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                   console.log(XMLHttpRequest, textStatus, errorThrown);
                }
            });
        }
    }
}



/*######################## for the user accounts page #############################*/

function getUsersAccounts() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_USER_ACCOUNTS_URL,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            if (response.success) {
            	var template = '';
            	var counter = 1;

            	if (response.data.length > 0) {
            		template += `
            		    <h5 class='text-center'><b>Users</b></h5><br>
            			<table class="table table-striped data-table table-hover table-sm">
						  	<thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">F Name</th>
							      <th scope="col">L Name</th>
							      <th scope="col">Username</th>
							      <th scope="col">Gender</th>
							      <th scope="col">Type</th>
							      <th scope="col">Phone</th>
							      <th scope="col">Email</th>
							      <th scope="col">Active</th>
							      <th scope="col">Actions</th>
							    </tr>
						  	</thead>
						  	<tbody>
            		`;

            		response.data.forEach(function(item) {
            			var itemObj = JSON.stringify(item);

                        var userActive = (item.active == 1) ? 'Yes' : 'No';

            			template += `
            				<tr>
						      <th scope="row">${counter}</th>
						      <td>${truncateString(item.first_name, 10, 7)}</td>
						      <td>${truncateString(item.last_name, 10, 7)}</td>
						      <td>${truncateString(item.username, 10, 7)}</td>
						      <td>${truncateString(item.gender, 10, 7)}</td>
						      <td>${truncateString(item.type, 10, 7)}</td>
						      <td>${truncateString(item.phone, 10, 7)}</td>
						      <td>${truncateString(item.email, 10, 7)}</td>
						      <td>${userActive}</td>
						      <td>
						      	<a class='text-info action-btn' onclick='viewUserDetails(${itemObj})'><i class='fa fa-eye'></i> view</a>&nbsp;&nbsp;&nbsp;
						      	<a class='text-warning action-btn' onclick='toggleUserActiveStatus(${itemObj})'><i class='fa fa-toggle-on'></i> change active status</a>
						      </td>
						    </tr>
            			`;

            			counter ++;
            		});

            		template += `
            			</tbody>
            			</table>
            		`;

            	} else {
            		template += `
            			<div class='jumbotron'>
            				<h5 class='text-center'>No user details available</h5>
            			</div>
            		`;

            	}

                jQuery('.users-accounts-res').html(template);
                jQuery(".data-table").DataTable();
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}








function viewUserDetails(itemObj) {
    var userActive = (itemObj.active == 1) ? 'Yes' : 'No';
    jQuery(".user-name").html(itemObj.first_name + "  " + itemObj.last_name);
    jQuery(".user-username").html(itemObj.username);
    jQuery(".user-email").html(itemObj.email);
    jQuery(".user-phone").html(itemObj.phone);
    jQuery(".user-gender").html(itemObj.gender);
    jQuery(".user-date_of_birth").html(itemObj.date_of_birth);
    jQuery(".user-country").html(itemObj.country);
    jQuery(".user-address").html(itemObj.address);
    jQuery(".user-type").html(itemObj.type);
    jQuery(".user-active").html(userActive);
    jQuery("#view-user-modal").modal("show");
}

function toggleUserActiveStatus(itemObj) {
    var confirmDelete = confirm("Are you sure you want to change user active status ?")
    if (confirmDelete) {
        var data = {
            '_token': jQuery('meta[name=csrf-token]').attr('content'),
            userId: itemObj.user_id,
            userStatus: itemObj.active
        }
        jQuery.ajax({
            url: ADMIN_CONSTANTS.TOGGLE_USER_ACTIVE_STATUS_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                console.log(response)
                if (response.success) {
                    showMessage("Admin Action", response.message, "success")
                    getUsersAccounts();
                } else {
                    showMessage("Admin Action", response.message, 'danger');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
}
