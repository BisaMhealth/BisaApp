getAllUserRequests();

function getAllUserRequests() {
	jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_USER_REQUESTS_URL,
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
            		    <h5 class='text-center'><b>Your requests</b></h5><br>
            			<table class="table data-table table-hover table-sm">
						  	<thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Token</th>
							      <th scope="col">Specialization</th>
							      <th scope="col">Comments</th>
							      <th scope="col">Submission Date</th>
							      <th scope="col">Approved</th>
							      <th scope="col">Cancelled</th>
							      <th scope="col">Actions</th>
							    </tr>
						  	</thead>
						  	<tbody>
            		`;

            		response.data.forEach(function(item) {
                        var itemObj = JSON.stringify(item);
                        var fulfilledString = '';
                        var fulfilledStringClass = '';
                        if (item.request_approved == 'No') {
                            fulfilledStringClass = 'text-danger';
                        } else if (item.request_approved == 'Yes') {
                            fulfilledStringClass = 'text-success';
                        }

                        var cancelButtonText = '';
                        var cancelStringClass = '';
                        var cancelString = '';
                        var cancelStatusClass = '';

                        if (item.request_canceled == 'No') {
                            cancelButtonText = 'cancel';
                            cancelStringClass = 'btn-danger';
                            cancelStatusClass = 'text-success';
                        } else if(item.request_canceled == 'Yes') {
                            cancelButtonText = 'uncancel';
                            cancelStringClass = 'btn-success';
                            cancelStatusClass = 'text-danger';
                        }

            			template += `
            				<tr>
						      <th scope="row">${counter}</th>
						      <td>${item.request_token}</td>
						      <td>${truncateString(item.request_specialization, 10, 12)}</td>
						      <td>${truncateString(item.request_comments, 10, 12)}</td>
						      <td>${item.submitted_on.date.substring(0,10)}</td>
						      <td class='${fulfilledStringClass}'>${item.request_approved}</td>
						      <td class='${cancelStatusClass}'>${item.request_canceled}</td>
						      <td>
						      	<button class='btn btn-sm btn-info' onclick='viewRequestDetails(${itemObj})'>view</button>
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
            				<h5 class='text-center'>There are no incoming requests</h5>
            			</div>
            		`;

            	}

                jQuery('.requests-res').html(template);
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}

function viewRequestDetails(itemObj) {
    jQuery(".request-detail-token").html(itemObj.request_token);
    jQuery(".request-detail-specialization").html(itemObj.request_specialization);
    jQuery(".request-detail-comments").html(itemObj.request_comments);
    jQuery(".request-detail-fulfilled").html(itemObj.request_approved);
    jQuery(".request-detail-cancelled").html(itemObj.request_canceled);
    jQuery(".request-detail-date").html(itemObj.submitted_on.date.substring(0,10));

    if (itemObj.request_approved == 'Yes') {
        jQuery(".request-approved-doctor-name").html(itemObj.request_approved_doctor_name);
        jQuery(".request-approved-doctor-phone").html(itemObj.request_approved_doctor_phone);
        jQuery(".request-approved-doctor-email").html(itemObj.request_approved_doctor_email);
        jQuery(".request-approval-date").html(itemObj.request_approved_date.date.substring(0,10));
        jQuery(".request-doctor-details-div").css("visibility", "visible");
    } else if(itemObj.request_approved == 'No') {
        jQuery(".request-approved-doctor-name").html('n/a');
        jQuery(".request-approved-doctor-phone").html('n/a');
        jQuery(".request-approved-doctor-email").html('n/a');
        jQuery(".request-approval-date").html('n/a');
        jQuery(".request-doctor-details-div").css("visibility", "visible");
        jQuery(".request-doctor-details-div").css("visibility", "hidden");
    }

    jQuery("#request-details-modal").modal('show');
}

// function toggleRequestStatus(itemObj) {
//     var deleteRequestConfirmation = confirm(`Are you sure you want to change the stauts of this request?`);

// 	if (deleteRequestConfirmation) {
// 		var data = {
// 			'_token': jQuery('meta[name=csrf-token]').attr('content'),
//             requestId: itemObj.request_id,
//             requestStatus: itemObj.request_fulfilled
//         }

// 		jQuery.ajax({
//             url: ADMIN_CONSTANTS.TOGGLE_REQUEST_STATUS_URL,
//             type: 'POST',
//             data: data,
//             beforeSend: function (xhr) {
//                 xhr.setRequestHeader ("Authorization", "Bearer ")
//             },
//             success: function(response) {
//                 if (response.success) {
//                 	showSuccessMessage(response.message, 'Admin action');
//                 	setTimeout(function() {
//                         window.location.reload();
//                     }, 1500);
//                 } else {
//                 	showErrorMessage(response.message, 'Admin action');
//                 }
//             },
//             error: function(XMLHttpRequest, textStatus, errorThrown) {
//                console.log(XMLHttpRequest, textStatus, errorThrown);
//             }
//         });
// 	}
// }