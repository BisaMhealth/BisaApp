getHealthResources();

function getHealthResources() {
    jQuery.ajax({
        url: CONSTANTS.GET_HEALTH_RESOURCES_URL,
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
                            <div class="col-md-4">

                                <div class="user-health-resource-div">
                                    <img src="${item.thumbnail}" class="user-health-resource-img img-fluid">
                                    <h5><b>${truncateString(item.name, 22, 7)}</b></h5>
                                    <h5><b>(${truncateString(item.type, 10, 7)})</b></h5>
                                    <p><small>${item.country}</small></p>

                                    <button class="btn btn-sm btn-default" onclick='viewResourceDetails(${itemObj})'>view details</button>
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

                jQuery('.health-resources-res').html(template);
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}


function viewResourceDetails(itemObj) {
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
