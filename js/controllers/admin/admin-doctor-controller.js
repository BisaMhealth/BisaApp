getDoctorSpecializations();

getAllDoctors();

// event to submit specialization addition / creation form
jQuery('.add-doctor-form').on('submit', function(event) {
	event.preventDefault();

	var doctorFirstName = jQuery('.add-doctor-first-name').val().trim(),
	    doctorLastName = jQuery('.add-doctor-last-name').val().trim(),
	    doctorPhone = jQuery('.add-doctor-phone').val().trim(),
	    doctorEmail = jQuery('.add-doctor-email').val().trim(),
	    doctorResidence = jQuery('.add-doctor-residence').val().trim(),
	    doctorSpeciality = jQuery('.add-doctor-speciality').val();

	if (doctorFirstName == "") {
		showWarningMessage('Please enter first name', 'Admin action');
	} else if(doctorLastName == "") {
		showWarningMessage('Please enter last name', 'Admin action');
    } else if(doctorPhone == "") {
		showWarningMessage('Please enter phone number', 'Admin action');
    } else if(doctorEmail == "") {
		showWarningMessage('Please enter email address', 'Admin action');
    } else if(doctorResidence == "") {
		showWarningMessage('Please enter residence or work address', 'Admin action');
    } else if(doctorSpeciality == null || doctorSpeciality == -1) {
		showWarningMessage('Please select speciality', 'Admin action');
    } else {
		var data = {
			'_token': jQuery('meta[name=csrf-token]').attr('content'),
            doctorFirstName: doctorFirstName,
            doctorLastName: doctorLastName,
            doctorPhone: doctorPhone,
            doctorEmail: doctorEmail,
            doctorResidence: doctorResidence,
            doctorSpeciality: doctorSpeciality
		}

		jQuery.ajax({
            url: ADMIN_CONSTANTS.ADD_DOCTOR_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                if (response.success) {
                	showSuccessMessage(response.message, 'Admin action');
                	getAllDoctors();
                	setTimeout(function() {
                		jQuery('#add-doctor-modal').modal('hide');
                    }, 2000);
                    jQuery(".add-doctor-form").trigger('reset');
                } else {
                	showErrorMessage(response.message, 'Admin action');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
	}
});


// event to submit country update / edition form
jQuery('.edit-doctor-form').on('submit', function(event) {
	event.preventDefault();

	var doctorFirstName = jQuery('.edit-doctor-first-name').val().trim(),
	    doctorLastName = jQuery('.edit-doctor-last-name').val().trim(),
	    doctorPhone = jQuery('.edit-doctor-phone').val().trim(),
	    doctorEmail = jQuery('.edit-doctor-email').val().trim(),
	    doctorResidence = jQuery('.edit-doctor-residence').val().trim(),
        doctorSpeciality = jQuery('.edit-doctor-speciality').val(),
        doctorId = jQuery('.edit-doctor-id').val();

	if (doctorFirstName == "") {
		showWarningMessage('Please enter first name', 'Admin action');
	} else if(doctorLastName == "") {
		showWarningMessage('Please enter last name', 'Admin action');
    } else if(doctorPhone == "") {
		showWarningMessage('Please enter phone number', 'Admin action');
    } else if(doctorEmail == "") {
		showWarningMessage('Please enter email address', 'Admin action');
    } else if(doctorResidence == "") {
		showWarningMessage('Please enter residence or work address', 'Admin action');
    } else if(doctorSpeciality == null || doctorSpeciality == -1) {
		showWarningMessage('Please select speciality', 'Admin action');
    } else {
		var data = {
			'_token': jQuery('meta[name=csrf-token]').attr('content'),
            doctorFirstName: doctorFirstName,
            doctorLastName: doctorLastName,
            doctorPhone: doctorPhone,
            doctorEmail: doctorEmail,
            doctorResidence: doctorResidence,
            doctorSpeciality: doctorSpeciality,
            doctorId: doctorId
        }

		jQuery.ajax({
            url: ADMIN_CONSTANTS.EDIT_DOCTOR_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                if (response.success) {
                	showSuccessMessage(response.message, 'Admin action');
                	getAllDoctors();
                	setTimeout(function() {
                		jQuery('#edit-doctor-modal').modal('hide');
                    }, 2000);
                    jQuery(".edit-doctor-form").trigger('reset');
                } else {
                	showErrorMessage(response.message, 'Admin action');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
	}
});

// function to get all coutries
function getAllDoctors() {
	jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_DOCTORS_URL,
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
            		    <h5 class='text-center'><b>List of Doctors</b></h5><br>
            			<table class="table data-table table-hover table-sm">
						  	<thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">First Name</th>
							      <th scope="col">Last Name</th>
							      <th scope="col">Phone Number</th>
							      <th scope="col">Email Address</th>
							      <th scope="col">Country</th>
							      <th scope="col">State</th>
							      <!-- <th scope="col">Actions</th> -->
							    </tr>
						  	</thead>
						  	<tbody>
            		`;

            		response.data.forEach(function(item) {
            			var itemObj = JSON.stringify(item);

            			template += `
            				<tr>
						      <th scope="row">${counter}</th>
						      <td>${item.first_name}</td>
						      <td>${item.last_name}</td>
						      <td>${item.phone_number}</td>
						      <td>${truncateString(item.email_address, 10, 12)}</td>
						      <td>${truncateString(item.country, 10, 12)}</td>
						      <td>${truncateString(item.state, 10, 12)}</td>
						      <!-- <td>
						      	 <button class='btn btn-sm btn-info' onclick='viewDoctorDetails(${itemObj})'>view</button>&nbsp;&nbsp;&nbsp;
						      	<button class='btn btn-sm btn-danger' onclick='deleteDoctor(${itemObj})'>delete</button> 
						      </td> -->
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

                jQuery('.doctors-res').html(template);
                jQuery(".data-table").DataTable();
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}


// modal to show edit country form
function showEditDoctorForm(itemObj) {
    jQuery('.edit-doctor-id').val(itemObj.id);
	jQuery('.edit-doctor-first-name').val(itemObj.first_name);
	jQuery('.edit-doctor-last-name').val(itemObj.last_name);
	jQuery('.edit-doctor-phone').val(itemObj.phone_number);
	jQuery('.edit-doctor-email').val(itemObj.email_address);
	jQuery('.edit-doctor-residence').val(itemObj.residence);
	jQuery('.edit-doctor-speciality-res').html(itemObj.speciality);
	
	jQuery('#edit-doctor-modal').modal('show');
}


// function to show delete country warning
function deleteDoctor(itemObj) {
	var deleteCountryConfirmation = confirm('Are you sure you want to delete this doctor from the database?');

	if (deleteCountryConfirmation) {
		var data = {
			'_token': jQuery('meta[name=csrf-token]').attr('content'),
			doctorId: itemObj.id
        }

		jQuery.ajax({
            url: ADMIN_CONSTANTS.DELETE_DOCTOR_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                if (response.success) {
                	showSuccessMessage(response.message, 'Admin action');
                	getAllDoctors();
                } else {
                	showErrorMessage(response.message, 'Admin action');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
	}
}

function getDoctorSpecializations() {
    jQuery.get(ADMIN_CONSTANTS.GET_SPECIALIZATIONS_URL, function(response) {
        var template = '';
        if (response.success) {
            if (response.data.length > 0) {
                response.data.forEach(function(item) {
                    template += `
                        <option value='${item.specialization_id}'>${item.specialization_name}</option>
                    `;
                });
            } else {
                template += `
                    <option selected disabled>No specializatoins availabe</option>
                `;
            }
        } else {
            template += `
                <option selected disabled>No specializatoins availabe</option>
            `;
        }

        jQuery(".doctor-speciality").html(template);
    })
}