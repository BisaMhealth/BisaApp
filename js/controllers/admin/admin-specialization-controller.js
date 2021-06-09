getAllSpecializations();

// event to submit specialization addition / creation form
jQuery('.add-specialization-form').on('submit', function(event) {
	event.preventDefault();

	var specializationName = jQuery('.add-specialization-name').val().trim();

	if (specializationName == "") {
		showWarningMessage('Please enter specialization name', 'Admin action');
	} else {
		var data = {
			'_token': jQuery('meta[name=csrf-token]').attr('content'),
			specializationName: specializationName
		}

		jQuery.ajax({
            url: ADMIN_CONSTANTS.ADD_SPECIALIZATION_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                if (response.success) {
                	showSuccessMessage(response.message, 'Admin action');
                	getAllSpecializations();
                	setTimeout(function() {
                		jQuery('#add-specialization-modal').modal('hide');
                    }, 2000);
                    jQuery(".add-specialization-form").trigger('reset');
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
jQuery('.edit-specialization-form').on('submit', function(event) {
	event.preventDefault();

	var specializationName = jQuery('.edit-specialization-name').val().trim();
	var specializationId = jQuery('.edit-specialization-id').val().trim();

    if (specializationName == "") {
		showWarningMessage('Please enter specialization name', 'Admin action');
	} else {
		var data = {
			'_token': jQuery('meta[name=csrf-token]').attr('content'),
			specializationName: specializationName,
			specializationId: specializationId
		}

		jQuery.ajax({
            url: ADMIN_CONSTANTS.EDIT_SPECIALIZATION_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                if (response.success) {
                	showSuccessMessage(response.message, 'Admin action');
                	getAllSpecializations();
                	setTimeout(function() {
                		jQuery('#edit-specialization-modal').modal('hide');
                	}, 2000);
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
function getAllSpecializations() {
	jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_SPECIALIZATIONS_URL,
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
            		    <h5 class='text-center'><b>List of Specializations</b></h5><br>
            			<table class="table table-striped data-table table-hover table-sm">
						  	<thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Specialization Name</th>
							      <th scope="col">Actions</th>
							    </tr>
						  	</thead>
						  	<tbody>
            		`;

            		response.data.forEach(function(item) {
            			var itemObj = JSON.stringify(item);

            			template += `
            				<tr>
						      <th scope="row">${counter}</th>
						      <td>${item.specialization_name}</td>
						      <td>
						      	<button class='btn btn-sm btn-info' onclick='showEditSpecializationForm(${itemObj})'>edit</button>&nbsp;&nbsp;&nbsp;
						      	<button class='btn btn-sm btn-danger'  onclick='deleteSpecialization(${itemObj})'>delete</button>
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
            				<h5 class='text-center'>No specializations available</h5>
            			</div>
            		`;

            	}

                jQuery('.specializations-res').html(template);
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
function showEditSpecializationForm(itemObj) {
	jQuery('.edit-specialization-name').val(itemObj.specialization_name);
	jQuery('.edit-specialization-id').val(itemObj.specialization_id);
	
	jQuery('#edit-specialization-modal').modal('show');
}


// function to show delete country warning
function deleteSpecialization(itemObj) {
	var deleteCountryConfirmation = confirm('Are you sure you want to delete this specialization from the database?');

	if (deleteCountryConfirmation) {
		var data = {
			'_token': jQuery('meta[name=csrf-token]').attr('content'),
			specializationId: itemObj.specialization_id
		}

		jQuery.ajax({
            url: ADMIN_CONSTANTS.DELETE_SPECIALIZATION_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                if (response.success) {
                	showSuccessMessage(response.message, 'Admin action');
                	getAllSpecializations();
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