getAllHealthResources()

/**
 * Show health resource thumbnail when  it is selected
 */
jQuery(".add-health-resource-thumbnail").on("change", function(){
    var imageSizeLimit = 3 * 1024 * 1024;
    var file = document.getElementById('add-health-resource-thumbnail').files;
    var fileLength = file.length;

    if (fileLength > 0) {
		if (file[0].size > imageSizeLimit) {
			showWarningMessage("Image cannot be greater than 3MB", "Admin Action");
		}  else {
            jQuery(".add-health-resource-thumbnail-label small").html("Resource Thumbnail Selected");

            var reader = new FileReader();
            reader.onload = function (e) {
                jQuery(".add-health-resource-thumbnail-res").attr('src', e.target.result);
            }

            reader.readAsDataURL(file[0]);
		}
	}
});

jQuery(".edit-health-resource-thumbnail").on("change", function(){
    var imageSizeLimit = 3 * 1024 * 1024;
    var file = document.getElementById('edit-health-resource-thumbnail').files;
    var fileLength = file.length;

    if (fileLength > 0) {
		if (file[0].size > imageSizeLimit) {
			showWarningMessage("Image cannot be greater than 3MB", "Admin Action");
		}  else {
            jQuery(".edit-health-resource-thumbnail-label small").html("Resource Thumbnail Selected");

            var reader = new FileReader();
            reader.onload = function (e) {
                jQuery(".edit-health-resource-thumbnail-res").attr('src', e.target.result);
            }

            reader.readAsDataURL(file[0]);
		}
	}
});

// event to add health resource
jQuery(".add-health-resource-form").on("submit", function(event) {
    event.preventDefault();

    var resourceName = jQuery(".add-health-resource-name").val().trim(),
        resourceType = jQuery(".add-health-resource-type").val(),
        resourceCountry = jQuery("#add-health-resource-country").val(),
        resourceAddress = jQuery(".add-health-resource-address").val(),
        resourcePhone = jQuery(".add-health-resource-contact").val(),
        resourceEmail = jQuery(".add-health-resource-email").val(),
        resourceLongitude = jQuery(".add-health-resource-longitude").val(),
        resourceLatitude = jQuery(".add-health-resource-latitude").val(),
        resourceDescription = jQuery(".add-health-resource-description").val(),
        resourceSpeciality = jQuery(".add-health-resource-speciality").val(),
        thumbnail = document.getElementById('add-health-resource-thumbnail').files;

    if (resourceName == "") {
        showMessage("Admin Action", "Please enter name", "warning");
    } else if (resourceType == null || resourceType == -1 || resourceType == undefined){
        showMessage("Admin Action", "Please enter type", "warning");
    } else if (resourceCountry == null || resourceCountry == -1 || resourceCountry == undefined){
        showMessage("Admin Action", "Please select country", "warning");
    } else if (resourceAddress == ""){
        showMessage("Admin Action", "Please enter address", "warning");
    }  else if (resourcePhone == ""){
        showMessage("Admin Action", "Please enter phone number", "warning");
    }  else if (resourceEmail == ""){
        showMessage("Admin Action", "Please enter email address", "warning");
    }  else if (resourceDescription == ""){
        showMessage("Admin Action", "Please enter description", "warning");
    }  else if (resourceSpeciality == ""){
        showMessage("Admin Action", "Please enter speciality", "warning");
    } else if (thumbnail.length < 1) {
        showMessage("Admin Action", "Please select health resource thumbnail", "warning");
    }  else {
        jQuery(".add-btn").html("Adding...").prop("disabled", true);
        var formData = new FormData();
        formData.append('_token', jQuery('meta[name=csrf-token]').attr('content'))
        formData.append('resourceName',resourceName);
        formData.append('resourceType',resourceType);
        formData.append('resourceCountry',resourceCountry);
        formData.append('resourceAddress',resourceAddress);
        formData.append('resourcePhone',resourcePhone);
        formData.append('resourceEmail', resourceEmail);
        formData.append('resourceLatitude',resourceLatitude);
        formData.append('resourceLongitude',resourceLongitude);
        formData.append('resourceDescription',resourceDescription);
        formData.append('resourceSpeciality',resourceSpeciality);
        formData.append('resourceThumbnail', thumbnail[0]);

		jQuery.ajax({
            url: ADMIN_CONSTANTS.ADD_HEALTH_RESOURCE_URL,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                jQuery(".add-btn").html("Add").prop("disabled", false);
                if (response.success) {
                	showMessage("Admin Action", response.message, "success")
                	getAllHealthResources();
                	setTimeout(function() {
                        jQuery('#add-health-resource-modal').modal('hide');
                        jQuery(".add-health-resource-form").trigger('reset');
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
});


// event to add health resource
jQuery(".edit-health-resource-form").on("submit", function(event) {
    event.preventDefault();

    var resourceName = jQuery(".edit-health-resource-name").val().trim(),
        resourceType = jQuery(".edit-health-resource-type").val(),
        resourceCountry = jQuery("#edit-health-resource-country").val(),
        resourceAddress = jQuery(".edit-health-resource-address").val(),
        resourcePhone = jQuery(".edit-health-resource-contact").val(),
        resourceEmail = jQuery(".edit-health-resource-email").val(),
        resourceLongitude = jQuery(".edit-health-resource-longitude").val(),
        resourceLatitude = jQuery(".edit-health-resource-latitude").val(),
        resourceDescription = jQuery(".edit-health-resource-description").val(),
        resourceSpeciality = jQuery(".edit-health-resource-speciality").val(),
        resourceId = jQuery(".edit-health-resource-id").val(),
        thumbnail = document.getElementById('edit-health-resource-thumbnail').files;

    if (resourceName == "") {
        showMessage("Admin Action", "Please enter name", "warning");
    } else if (resourceType == null || resourceType == -1 || resourceType == undefined){
        showMessage("Admin Action", "Please enter type", "warning");
    } else if (resourceCountry == null || resourceCountry == -1 || resourceCountry == undefined){
        showMessage("Admin Action", "Please select country", "warning");
    } else if (resourceAddress == ""){
        showMessage("Admin Action", "Please enter address", "warning");
    }  else if (resourcePhone == ""){
        showMessage("Admin Action", "Please enter phone number", "warning");
    }  else if (resourceEmail == ""){
        showMessage("Admin Action", "Please enter email address", "warning");
    }  else if (resourceDescription == ""){
        showMessage("Admin Action", "Please enter description", "warning");
    }  else if (resourceSpeciality == ""){
        showMessage("Admin Action", "Please enter speciality", "warning");
    }  else {
        jQuery(".edit-btn").html("Adding...").prop("disabled", true);
        var formData = new FormData();
        formData.append('_token', jQuery('meta[name=csrf-token]').attr('content'))
        formData.append('resourceName',resourceName);
        formData.append('resourceType',resourceType);
        formData.append('resourceCountry',resourceCountry);
        formData.append('resourceAddress',resourceAddress);
        formData.append('resourcePhone',resourcePhone);
        formData.append('resourceEmail', resourceEmail);
        formData.append('resourceLatitude',resourceLatitude);
        formData.append('resourceLongitude',resourceLongitude);
        formData.append('resourceDescription',resourceDescription);
        formData.append('resourceSpeciality',resourceSpeciality);
        formData.append('resourceId', resourceId);

        if (thumbnail.length > 0) {
            formData.append('resourceThumbnail', thumbnail[0]);
        }

		jQuery.ajax({
            url: ADMIN_CONSTANTS.EDIT_HEALTH_RESOURCE_URL,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                jQuery(".edit-btn").html("Add").prop("disabled", false);
                if (response.success) {
                	showMessage("Admin Action", response.message, "success")
                	getAllHealthResources();
                	setTimeout(function() {
                        jQuery('#add-health-resource-modal').modal('hide');
                        jQuery(".add-health-resource-form").trigger('reset');
                    }, 2000);
                } else {
                	showMessage('Admin action',response.message, 'error');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery(".edit-btn").html("Add").prop("disabled", false);
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
})

function getAllHealthResources() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_HEALTH_RESOURCES_URL,
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
            		    <h5 class='text-center'><b>Health Resources</b></h5><br>
            			<table class="table table-striped data-table table-hover table-sm">
						  	<thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Name</th>
							      <th scope="col">Type</th>
							      <th scope="col">Country</th>
							      <th scope="col">Address</th>
							      <th scope="col">Email</th>
							      <th scope="col">Phone</th>
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
						      <td>${item.name}</td>
						      <td>${item.type}</td>
						      <td>${truncateString(item.country, 10, 7)}</td>
						      <td>${truncateString(item.address, 10, 7)}</td>
						      <td>${truncateString(item.email, 10, 7)}</td>
						      <td>${truncateString(item.phone, 10, 7)}</td>
						      <td>
						      	<a class='text-warning action-btn' onclick='viewResource(${itemObj})'><i class='fa fa-eye'></i> view</a>&nbsp;&nbsp;&nbsp;
                                <a class='text-info action-btn' onclick='showEditResourceForm(${itemObj})'><i class='fa fa-pencil'></i> edit</a>&nbsp;&nbsp;&nbsp;
						      	<a class='text-danger action-btn'  onclick='deleteResource(${itemObj})'><i class='fa fa-trash-o'></i> delete</button>
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
            				<h5 class='text-center'>No health resource available</h5>
            			</div>
            		`;

            	}

                jQuery('.health-resources-res').html(template);
                jQuery(".data-table").DataTable();
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}

function viewResource(itemObj) {
    jQuery(".health-resource-name").html(itemObj.name);
    jQuery(".health-resource-type").html(itemObj.type);
    jQuery(".health-resource-country").html(itemObj.country);
    jQuery(".health-resource-address").html(itemObj.address);
    jQuery(".health-resource-phone").html(itemObj.phone);
    jQuery(".health-resource-email").html(itemObj.email);
    jQuery(".health-resource-longitude").html(itemObj.longitude);
    jQuery(".health-resource-latitude").html(itemObj.latitude);
    jQuery(".health-resource-description").html(itemObj.description);
    jQuery(".health-resource-speciality").html(itemObj.speciality);
    jQuery(".health-resource-thumbnail").prop("src", itemObj.thumbnail);
    jQuery("#view-health-resource-modal").modal("show");
}

function showEditResourceForm(itemObj) {
    jQuery(".edit-health-resource-thumbnail-res").prop('src', itemObj.thumbnail);
    jQuery(".edit-health-resource-id").val(itemObj.id);
    jQuery(".edit-health-resource-name").val(itemObj.name);
    jQuery(".edit-health-resource-type").val(itemObj.type);
    jQuery(".edit-doctor-country").val(itemObj.country);
    jQuery(".edit-health-resource-address").val(itemObj.address);
    jQuery(".edit-health-resource-contact").val(itemObj.phone);
    jQuery(".edit-health-resource-email").val(itemObj.email);
    jQuery(".edit-health-resource-longitude").val(itemObj.longitude);
    jQuery(".edit-health-resource-latitude").val(itemObj.latitude);
    jQuery(".edit-health-resource-description").val(itemObj.description);
    jQuery(".edit-health-resource-speciality").val(itemObj.speciality);
    jQuery("#edit-health-resource-modal").modal("show");
}

function deleteResource(itemObj) {
    var confirmDelete = confirm("Are you sure you want to delete this resource ?")
    if (confirmDelete) {
        var data = {
            '_token': jQuery('meta[name=csrf-token]').attr('content'),
            healthResourceId: itemObj.id
        }
        jQuery.ajax({
            url: ADMIN_CONSTANTS.DELETE_HEALTH_RESOURCE_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                if (response.success) {
                    showMessage("Admin Action", response.message, "success")
                    getAllHealthResources();
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
