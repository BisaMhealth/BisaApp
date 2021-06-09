var url = 'http://localhost:8091';
// var url = 'http://www.bisa.fr:3000';
var socket = io(url);


// when a user posts a question
socket.on('receiveUserChat', function(data) {
    console.log(data);
    if (data.questionId == window.localStorage.getItem('questionId')) {
        var template = "";
        template += `
            <div class="alert alert-warning">
                <small><b>${data.username}<b></small><br>
                <small>${data.questionContent}</small><br>
        `;

        if (data.questionMedia.trim() != "n/a") {
            template += `<a href="${data.questionMedia}" class="text-primary" download><small>Télécharger le support attaché</small></a><br>`;
        }

        template += `
                <i><small>${data.createdAt.substr(0,10)}</small></i>
            </div><br>`;

        jQuery('.user-questions-details-res').append(template);
        scrollToBottom();
    }
})

// function to scroll to the bottom of the page
function scrollToBottom() {
    jQuery("html, body").animate({ scrollTop: jQuery(document).height() }, 'slow');
}

jQuery(".reply-question-thumbnail").on("change", function(){
    var imageSizeLimit = 3 * 1024 * 1024;
    var file = document.getElementById('reply-question-thumbnail').files;
    var fileLength = file.length;

    if (fileLength > 0) {
		if (file[0].size > imageSizeLimit) {
			showWarningmessage("Image cannot exceed 3MB", "Admin Action");
		}  else {
            jQuery(".reply-question-thumbnail-label small").html("Question Media selected");
		}
	}
});


jQuery(".reply-question-form").on("submit", function(event) {
    event.preventDefault();

    var questionContent= jQuery(".reply-question-content").val().trim(),
        thumbnail = document.getElementById('reply-question-thumbnail').files,
        questionId = jQuery(".question_id").val(),
        questionClosed = jQuery(".question_closed").val();

    if (questionContent == "") {
        showMessage("Admin Action", "Please enter the content of the question", "warning");
    }  else {
        jQuery(".reply-btn").html("Submitting...").prop("disabled", true);
        var formData = new FormData();
        formData.append('_token', jQuery('meta[name=csrf-token]').attr('content'))
        formData.append('questionContent',questionContent);
        formData.append('questionId',questionId);
        if (thumbnail.length > 0) {
            formData.append('questionMedia', thumbnail[0]);
        }


		jQuery.ajax({
            url: CONSTANTS.DOCTOR_REPLY_QUESTION_URL,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                //console.log(response);
                jQuery(".reply-btn").html("submit").prop("disabled", false);
                if (response.success) {
                	showMessage("Admin Action", response.message, "success")
                	setTimeout(function() {
                        jQuery("#reply-question-modal").modal('hide');
                        socket.emit('notifyDoctorReply', response.data);
                        getQuestionDetails(window.localStorage.getItem('questionCode'));
                        scrollToBottom();
                    }, 2000);
                } else {
                	showMessage('Admin action',response.message, 'error');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery(".reply-btn").html("submit").prop("disabled", false);
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
})


jQuery(".close-question").on("click", function(event) {
    event.preventDefault();

    confirmClose = confirm("Are you sure you want to close this question?");
    if (confirmClose) {
        var questionId = jQuery(".question_id").val();

        var data = {
            _token: jQuery('meta[name=csrf-token]').attr('content'),
            questionId: questionId
        }
        console.log(data)

        jQuery.ajax({
            url: CONSTANTS.DOCTOR_CLOSE_QUESTION_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                if (response.success) {
                    showMessage("Admin Action", response.message, "success")
                    setTimeout(function() {
                        // jQuery('#reply-question-modal').modal('hide');
                        // jQuery(".reply-question-form").trigger('reset');
                        window.location.reload()
                    }, 2000);
                } else {
                    showMessage('Admin action',response.message, 'error');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery(".reply-btn").html("submit").prop("disabled", false);
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
})

/**
 * Get all questions from the database
 */
function getDoctorsQuestions() {
    jQuery.ajax({
        url: CONSTANTS.GET_DOCTORS_QUESTIONS_URL,
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
            		    <h5 class='text-center'><b>New Questions</b></h5><br>
            			<table class="table data-table .cs-datable dynamic-paging table-hover">
						  	<thead>
							    <tr>
							         <th scope="col">#</th>
                                      <th scope="col">Question</th>
                                      <th scope="col">Sick</th>
                                      <th scope="col">Category</th>
                                      <th scope="col">Date</th>
                                      <th scope="col">Actions</th>
							    </tr>
						  	</thead>
						  	<tbody>
            		`;

            		response.data.forEach(function(item) {
            			var itemObj = JSON.stringify(item,['question_code','question_answered','created_at','patient_username','question_category']);
                         
                         //console.log(itemObj)
            			template += `
                        <tr>
                          <th scope="row">${counter}</th>
                          <td>${truncateString(item.question_content, 50, 50)}</td>
                          <td>${truncateString(item.patient_username, 10, 7)}</td>
                          <td>${truncateString(item.question_category, 10, 7)}</td>
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

/**
  * Escape slashes
*/

  function escapeacentedstring(data){
      if (data.match(/[^a-zA-ZÀ-ÿ]/g)) {
            data = data.replace(/[^a-zA-Z0-9 ]/g, '');
        }

        return (data)
    }

/**
 * Get all doctor answered questions from the database
 */
function getDoctorAnsweredQuestions() {
    jQuery.ajax({
        url: CONSTANTS.GET_DOCTOR_ANSWERED_QUESTIONS_URL,
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
            		    <h5 class='text-center'><b>Answered Questions</b></h5><br>
            			<table class="table table-striped data-table table-hover table-sm">
						  	<thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Question</th>
							      <th scope="col">Sick</th>
							      <th scope="col">Category</th>
							      <th scope="col">Date</th>
							      <th scope="col">Action</th>
							    </tr>
						  	</thead>
						  	<tbody>
            		`;

            		response.data.forEach(function(item) {
            			//var itemObj = JSON.stringify(item);
                        var itemObj = JSON.stringify(item,['question_code','question_answered','created_at','patient_username','question_category']);
            			template += `
                        <tr>
                          <th scope="row">${counter}</th>
                          <td>${truncateString(item.question_content, 40, 35)}</td>
                          <td>${truncateString(item.patient_username, 10, 7)}</td>
                          <td>${truncateString(item.question_category, 10, 7)}</td>
                          <td>${item.created_at.substr(0,10)}</td>
                          <td>
                            <a class='text-success action-btn' onclick='redirectQuestionDetailsPage(${itemObj})'><i class='fa fa-eye'></i> view</a>&nbsp;&nbsp;&nbsp;
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
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}


function redirectQuestionDetailsPage(itemObj) {
    window.location.href = baseUrl + '/doctor/question/' + itemObj.question_code;
}


function getQuestionDetails(questionCode) {
    var data = {
        _token: jQuery('meta[name=csrf-token]').attr('content'),
        questionCode: questionCode
    }
    jQuery.ajax({
        url: CONSTANTS.GET_QUESTION_DETAILS_URL,
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
                        jQuery(".doctor-question-closed-notice small").html("La question a été fermée");
                    }

            		response.data.question_threads.forEach(function(item) {
            			var itemObj = JSON.stringify(item);

                        if (item.creator == 'Moi') {
                            template += `
                                <div class="alert alert-secondary">
                                    <small><b>Moi<b></small><br>
                                    <small>${item.question_content}</small><br>
                            `;

                            if (item.question_media_url.trim() != "n/a") {
                                template += `<a href="${item.question_media_url}" class="text-primary" download><small>Download the attached support</small></a><br>`;
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

                            if (item.question_media_url.trim() != "n/a") {
                                template += `<a href="${item.question_media_url}" class="text-primary" download><small>Download the attached support</small></a><br>`;
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
