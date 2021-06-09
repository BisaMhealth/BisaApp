getAllPharmacies();

/**
 * Show health resource thumbnail when  it is selected
 */
jQuery(".add-pharmacy-thumbnail").on("change", function(){
    var imageSizeLimit = 3 * 1024 * 1024;
    var file = document.getElementById('add-pharmacy-thumbnail').files;
    var fileLength = file.length;

    if (fileLength > 0) {
		if (file[0].size > imageSizeLimit) {
			showWarningMessage("Image cannot be greater than 3MB", "Admin Action");
		}  else {
            jQuery(".add-pharmacy-thumbnail-label small").html("Resource Thumbnail Selected");

            var reader = new FileReader();
            reader.onload = function (e) {
                jQuery(".add-pharmacy-thumbnail-res").attr('src', e.target.result);
            }

            reader.readAsDataURL(file[0]);
		}
	}
});

// show thumbnail when thumbnail is selected for edition
jQuery(".edit-pharmacy-thumbnail").on("change", function(){
    var imageSizeLimit = 3 * 1024 * 1024;
    var file = document.getElementById('edit-pharmacy-thumbnail').files;
    var fileLength = file.length;

    if (fileLength > 0) {
		if (file[0].size > imageSizeLimit) {
			showWarningMessage("Image cannot be greater than 3MB", "Admin Action");
		}  else {
            jQuery(".edit-pharmacy-thumbnail-label small").html("Resource Thumbnail Selected");

            var reader = new FileReader();
            reader.onload = function (e) {
                jQuery(".edit-pharmacy-thumbnail-res").attr('src', e.target.result);
            }

            reader.readAsDataURL(file[0]);
		}
	}
});


jQuery(".add-pharmacy-form").on("submit", function(event) {
    event.preventDefault();

    var resourceName = jQuery(".add-pharmacy-name").val().trim(),
        resourceCountry = jQuery("#add-pharmacy-country").val(),
        resourceAddress = jQuery(".add-pharmacy-address").val(),
        resourcePhone = jQuery(".add-pharmacy-contact").val(),
        resourceEmail = jQuery(".add-pharmacy-email").val(),
        resourceLongitude = jQuery(".add-pharmacy-longitude").val(),
        resourceLatitude = jQuery(".add-pharmacy-latitude").val(),
        resourceDescription = jQuery(".add-pharmacy-description").val(),
        thumbnail = document.getElementById('add-pharmacy-thumbnail').files;

    if (resourceName == "") {
        showMessage("Admin Action", "Please enter name", "warning");
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
    }  else {
        jQuery(".add-btn").html("Adding...").prop("disabled", true);
        var formData = new FormData();
        formData.append('_token', jQuery('meta[name=csrf-token]').attr('content'))
        formData.append('resourceName',resourceName);
        formData.append('resourceCountry',resourceCountry);
        formData.append('resourceAddress',resourceAddress);
        formData.append('resourcePhone',resourcePhone);
        formData.append('resourceEmail', resourceEmail);
        formData.append('resourceLatitude',resourceLatitude);
        formData.append('resourceLongitude',resourceLongitude);
        formData.append('resourceDescription',resourceDescription);
        formData.append('resourceThumbnail', thumbnail[0]);

		jQuery.ajax({
            url: ADMIN_CONSTANTS.ADD_PHARMACY_URL,
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
                	getAllPharmacies();
                	setTimeout(function() {
                        jQuery('#add-pharmacy-modal').modal('hide');
                        jQuery(".add-pharmacy-form").trigger('reset');
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

// event to update pharmacy details
jQuery(".edit-pharmacy-form").on("submit", function(event) {
    event.preventDefault();

    var resourceName = jQuery(".edit-pharmacy-name").val().trim(),
        resourceCountry = jQuery("#edit-pharmacy-country").val(),
        resourceAddress = jQuery(".edit-pharmacy-address").val(),
        resourcePhone = jQuery(".edit-pharmacy-contact").val(),
        resourceEmail = jQuery(".edit-pharmacy-email").val(),
        resourceLongitude = jQuery(".edit-pharmacy-longitude").val(),
        resourceLatitude = jQuery(".edit-pharmacy-latitude").val(),
        resourceDescription = jQuery(".edit-pharmacy-description").val(),
        resourceId = jQuery(".edit-pharmacy-id").val(),
        thumbnail = document.getElementById('edit-pharmacy-thumbnail').files;

        console.log('res id', resourceId);
        

    if (resourceName == "") {
        showMessage("Admin Action", "Please enter name", "warning");
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
    }  else {
        jQuery(".edit-btn").html("Adding...").prop("disabled", true);
        var formData = new FormData();
        formData.append('_token', jQuery('meta[name=csrf-token]').attr('content'))
        formData.append('resourceName',resourceName);
        formData.append('resourceCountry',resourceCountry);
        formData.append('resourceAddress',resourceAddress);
        formData.append('resourcePhone',resourcePhone);
        formData.append('resourceEmail', resourceEmail);
        formData.append('resourceLatitude',resourceLatitude);
        formData.append('resourceLongitude',resourceLongitude);
        formData.append('resourceDescription',resourceDescription);
        formData.append('resourceId', resourceId);
        
        if (thumbnail.length > 0) {
            formData.append('resourceThumbnail', thumbnail[0]);
        }

		jQuery.ajax({
            url: ADMIN_CONSTANTS.EDIT_PHARMACY_URL,
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
                	getAllPharmacies();
                	setTimeout(function() {
                        jQuery('#add-pharmacy-modal').modal('hide');
                        jQuery(".add-pharmacy-form").trigger('reset');
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
});


function getAllPharmacies() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_PHARMACIES_RESOURCES_URL,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            console.log(response);
            
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

                jQuery('.pharmacy-resources-res').html(template);
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
    jQuery(".pharmacy-name").html(itemObj.name);
    jQuery(".pharmacy-country").html(itemObj.country);
    jQuery(".pharmacy-address").html(itemObj.address);
    jQuery(".pharmacy-phone").html(itemObj.phone);
    jQuery(".pharmacy-email").html(itemObj.email);
    jQuery(".pharmacy-longitude").html(itemObj.longitude);
    jQuery(".pharmacy-latitude").html(itemObj.latitude);
    jQuery(".pharmacy-description").html(itemObj.description);
    jQuery(".pharmacy-thumbnail").prop("src", itemObj.thumbnail);
    jQuery("#view-pharmacy-modal").modal("show");
}

function showEditResourceForm(itemObj) {
    jQuery(".edit-pharmacy-thumbnail-res").prop('src', itemObj.thumbnail);
    jQuery(".edit-pharmacy-id").val(itemObj.id);
    jQuery(".edit-pharmacy-name").val(itemObj.name);
    jQuery("#edit-pharmacy-country").val(itemObj.country);
    jQuery(".edit-pharmacy-address").val(itemObj.address);
    jQuery(".edit-pharmacy-contact").val(itemObj.phone);
    jQuery(".edit-pharmacy-email").val(itemObj.email);
    jQuery(".edit-pharmacy-longitude").val(itemObj.longitude);
    jQuery(".edit-pharmacy-latitude").val(itemObj.latitude);
    jQuery(".edit-pharmacy-description").val(itemObj.description);
    jQuery("#edit-pharmacy-modal").modal("show");
}

function deleteResource(itemObj) {
    var confirmDelete = confirm("Are you sure you want to delete this resource ?")
    if (confirmDelete) {
        var data = {
            '_token': jQuery('meta[name=csrf-token]').attr('content'),
            pharmacyId: itemObj.id
        }
        jQuery.ajax({
            url: ADMIN_CONSTANTS.DELETE_PHARMACY_RESOURCE_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                if (response.success) {
                    showMessage("Admin Action", response.message, "success")
                    getAllPharmacies();
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
