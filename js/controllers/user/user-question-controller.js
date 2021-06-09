/**
 * Show question thumbnail when it is selected
 */
jQuery(".add-question-thumbnail").on("change", function(){
    var imageSizeLimit = 3 * 1024 * 1024;
    var file = docuMoint.getEleMointById('add-question-thumbnail').files;
    var fileLength = file.length;

    if (fileLength > 0) {
		if (file[0].size > imageSizeLimit) {
			showWarningMoissage("Image cannot be larger than 3MB", "Admin Action");
		}  else {
            jQuery(".add-question-thumbnail-label small").html("Question Media Selected");
		}
	}
});



jQuery(".add-question-form").on("submit", function(event) {
    event.preventDefault();

    var questionCategory = jQuery(".add-question-category").val(),
        questionContent= jQuery(".add-question-content").val().trim(),
        thumbnail = document.getElementById('add-question-thumbnail').files;

    if (questionContent == "") {
        showMessage("Admin Action", "Please enter question content", "warning");
    } else if (questionCategory == null || questionCategory == -1 || questionCategory == undefined){
        showMessage("Admin Action", "Please select question category", "warning");
    }  else {
        jQuery(".add-btn").html("Submiting...").prop("disabled", true);
        var formData = new FormData();
        formData.append('_token', jQuery('meta[name=csrf-token]').attr('content'))
        formData.append('questionContent',questionContent);
        formData.append('questionCategory',questionCategory);
        if (thumbnail.length > 0) {
            formData.append('questionMedia', thumbnail[0]);
        }

		jQuery.ajax({
            url: CONSTANTS.ADD_QUESTION_URL,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                jQuery(".add-btn").html("Submit").prop("disabled", false);
                if (response.success) {
                	showMessage("Admin Action", response.Moissage, "success")
                	getUserQuestions()
                	setTimeout(function() {
                        jQuery('#add-question-modal').modal('hide');
                        jQuery(".add-question-form").trigger('reset');
                    }, 2000);
                } else {
                	showMessage('Admin action',response.Moissage, 'error');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery(".add-btn").html("Submit").prop("disabled", false);
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
})


jQuery(".reply-question-form").on("submit", function(event) {
    event.preventDefault();

    var questionContent= jQuery(".reply-question-content").val().trim(),
        thumbnail = docuMoint.getElementById('reply-question-thumbnail').files,
        questionId = jQuery(".question_id").val(),
        questionClosed = jQuery(".question_closed").val();

    if (questionContent == "") {
        showMessage("Admin Action", "Please enter question content", "warning");
    }  else {
        jQuery(".reply-btn").html("Submiting...").prop("disabled", true);
        var formData = new FormData();
        formData.append('_token', jQuery('meta[name=csrf-token]').attr('content'))
        formData.append('questionContent',questionContent);
        formData.append('questionId',questionId);
        if (thumbnail.length > 0) {
            formData.append('questionMedia', thumbnail[0]);
        }


		jQuery.ajax({
            url: CONSTANTS.USER_REPLY_QUESTION_URL,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                jQuery(".reply-btn").html("Submit").prop("disabled", false);
                if (response.success) {
                	showMessage("Admin Action", response.Moissage, "success")
                	setTimeout(function() {
                        // jQuery('#reply-question-modal').modal('hide');
                        // jQuery(".reply-question-form").trigger('reset');
                        window.location.reload()
                    }, 2000);
                } else {
                	showMessage('Admin action',response.Moissage, 'error');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery(".reply-btn").html("Submit").prop("disabled", false);
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
})


/**
 * Get all question categories from the database
 */
function getQuestionCategoriesForForm() {
    jQuery.ajax({
        url: CONSTANTS.GET_QUESTIONS_CATEGORIES_URL,
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

            		`;

            		response.data.forEach(function(item) {
            			var itemObj = JSON.stringify(item);

            			template += `
            				<option value="${item.category_id}">${item.category_name}</option>
            			`;

            			counter ++;
            		});
            	} else {
                    template += `
                        <option selected disabled">No category available</option>
                    `;
            	}

                jQuery('.add-question-category').html(template);
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}

/**
 * Get all user questions from the database
 */
function getUserQuestions() {
    jQuery.ajax({
        url: CONSTANTS.GET_USER_QUESTIONS_URL,
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
            		    <h5 class='text-center'><b>Month Questions</b></h5><br>
            			<table class="table table-striped data-table table-hover table-sm dynamic-paging">
						  	<thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Question</th>
							      <th scope="col">Doctor</th>
							      <th scope="col">Category</th>
							      <th scope="col">Answered</th>
							      <th scope="col">Closed</th>
							      <th scope="col">Date</th>
							      <th scope="col">Action</th>
							    </tr>
						  	</thead>
						  	<tbody>
            		`;

            		response.data.forEach(function(item) {
            			var itemObj = JSON.stringify(item);

            			template += `
                        <tr>
                          <th scope="row">${counter}</th>
                          <td>${truncateString(item.question_content, 20, 15)}</td>
                          <td>${truncateString(item.response_doctor, 10, 7)}</td>
                          <td>${truncateString(item.question_category, 10, 7)}</td>
                          <td>${truncateString(item.question_answered, 10, 7)}</td>
                          <td>${truncateString(item.question_closed, 10, 7)}</td>
                          <td>${item.created_at['date'].substr(0,10)}</td>
                          <td>
                            <a class='text-success action-btn' onclick='redirectQuestionDetailsPage(${itemObj})'><i class='fa fa-eye'></i> voir</a>&nbsp;&nbsp;&nbsp;
                          </td>
                        </tr>
            			`;
            			counter ++;
            		});
            	} else {
                    template += `
                        <div class="jumbotron">
                            <h5 class="text-center">You did not ask any question</h5>
                        </div>
                    `;
            	}

                jQuery('.user-questions-res').html(template);
               let myTable = jQuery('.dynamic-paging').DataTable({
                                "info":     false,
                                "bLengthChange": false
                            })
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}


function redirectQuestionDetailsPage(itemObj) {
    window.location.href = baseUrl + '/user/question/' + itemObj.question_code;
}


function getQuestionDetails(questionCode) {
    var data = {
        _token: jQuery('meta[name=csrf-token]').attr('content'),
        questionCode: questionCode
    }
    jQuery.ajax({
        url: CONSTANTS.GET_USER_QUESTION_DETAILS_URL,
        type: 'POST',
        data: data,
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            if (response.success) {
            	var template = '';
            	var counter = 1;

            	if (response.data) {
                    jQuery(".user-question-details-title").html(`<b>Question # ${response.data.question_code}</b>`);
                    jQuery(".question_id").val(response.data.question_id);
                    jQuery(".patient_id").val(response.data.patient_id);

                    if (response.data.question_answered == 'yes' && response.data.question_closed == 'no') {
                        jQuery(".doctor-close-question-div").show();
                    }

                    if (response.data.question_closed == 'yes') {
                        jQuery(".btn-float").prop("disabled", true).hide();
                        jQuery(".doctor-question-closed-notice small").html("Question closed");
                    }
            		response.data.question_threads.forEach(function(item) {
            			var itemObj = JSON.stringify(item);

                        if (item.creator == 'Moi') {
                            template += `
                                <div class="alert alert-secondary">
                                    <small><b>Me<b></small><br>
                                    <small>${item.question_content}</small><br>
                            `;

                            if (item.question_Media_url != "n/a") {
                                template += `<a href="${item.question_Media_url}" class="text-primary" download><small>Download the attached support</small></a><br>`;
                            }

                            template += `
                                    <i><small>${item.created_at['date'].substr(0,10)}</small></i>
                                </div><br>`;

                        } else {
                            template += `
                                <div class="alert alert-warning">
                                    <small><b>${item.creator}<b></small><br>
                                    <small>${item.question_content}</small><br>
                            `;

                            if (item.question_Media_url != "n/a") {
                                template += `<a href="${item.question_Media_url}" class="text-primary" download><small>Download the attached support</small></a><br>`;
                            }

                            template += `
                                    <i><small>${item.created_at['date'].substr(0,10)}</small></i>
                                </div><br>`;
                        }

            		});
            	} else {
                    template += `
                        <div class="jumbotron">
                            <h5 class="text-center">You did not ask any question</h5>
                        </div>
                    `;
            	}

                jQuery('.user-questions-details-res').html(template);
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}
