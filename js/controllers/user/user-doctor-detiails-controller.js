getDoctorAccounts();

function getDoctorAccounts() {
    jQuery.ajax({
        url: CONSTANTS.GET_DOCTOR_DETAILS_URL,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            if (response.success) {
            	var template = '';
            	var counter = 1;

            	if (response.data.length > 0) {
                    jQuery(".user-res-title").show();
            		response.data.forEach(function(item) {
            			var itemObj = JSON.stringify(item);

                        template += `
                            <div class="col-md-3">

                                <div class="user-doctor-details-div">
                                    <img src="${item.thumbnail}" class="user-doctor-detail-img rounded-circle img-fluid">
                                    <h5><b>${item.title + " " + item.first_name + " " + item.last_name}</b></h5>
                                    <p><small>${item.country}</small></p>

                                    <button class="btn btn-sm btn-default" onclick='viewDoctorDetails(${itemObj})'>view</button>
                                </div>
                            </div>
            			`;
            		});

            	} else {
            		template += `
            			<div class='jumbotron'>
            				<h5 class='text-center'>No doctors available</h5>
            			</div>
            		`;

            	}

                jQuery('.doctors-res').html(template);
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}


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
    jQuery(".doctor-details-thumbnail").prop("src", itemObj.thumbnail);
    jQuery("#view-doctor-modal").modal("show");
}
