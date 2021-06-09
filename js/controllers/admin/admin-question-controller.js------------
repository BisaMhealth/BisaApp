/**
 * Submit question category addition form
 */
jQuery(".add-question-category-form").on("submit", function(event) {
    event.preventDefault();

    var questionCategoryName = jQuery(".add-question-category-name").val().trim();
    if (questionCategoryName == "") {
        showMessage("Admin Action", "Please enter category name", "warning");
    } else {
        jQuery(".add-btn").html("Adding...").prop("disabled", true);
        var data = {
			'_token': jQuery('meta[name=csrf-token]').attr('content'),
			questionCategoryName: questionCategoryName
		}

		jQuery.ajax({
            url: ADMIN_CONSTANTS.ADD_QUESTION_CATEGORY_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                jQuery(".add-btn").html("Add").prop("disabled", false);
                if (response.success) {
                	showMessage("Admin Action", response.message, "success")
                	getQuestionCategories();
                	setTimeout(function() {
                        jQuery('#add-question-category-modal').modal('hide');
                        jQuery(".add-question-category-form").trigger('reset');
                    }, 2000);
                } else {
                	showErrorMessage(response.message, 'Admin action');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery(".add-btn").html("Add").prop("disabled", false);
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
})


/**
 * Submit question category edition form
 */
jQuery(".edit-question-category-form").on("submit", function(event) {
    event.preventDefault();

    var questionCategoryName = jQuery(".edit-question-category-name").val().trim();
    var questionCategoryId = jQuery(".edit-question-category-id").val();

    if (questionCategoryName == "") {
        showMessage("Admin Action", "Please enter category name", "warning");
    } else {
        jQuery(".edit-btn").html("Updateing...").prop("disabled", true);
        var data = {
			'_token': jQuery('meta[name=csrf-token]').attr('content'),
            questionCategoryName: questionCategoryName,
            questionCategoryId: questionCategoryId
		}

		jQuery.ajax({
            url: ADMIN_CONSTANTS.EDIT_QUESTION_CATEGORY_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                jQuery(".edit-btn").html("Update").prop("disabled", false);
                if (response.success) {
                	showMessage("Admin Action", response.message, "success")
                	getQuestionCategories();
                	setTimeout(function() {
                		jQuery('#edit-question-category-modal').modal('hide');
                    }, 2000);
                } else {
                	showErrorMessage(response.message, 'Admin action');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery(".edit-btn").html("Update").prop("disabled", false);
               console.log(XMLHttpRequest, textStatus, errorThrown);
            }
        });
    }
})


/**
 * Show question category edition form
 */
function showEditCategoryForm(itemObj) {
    jQuery(".edit-question-category-id").val(itemObj.category_id);
    jQuery(".edit-question-category-name").val(itemObj.category_name);
    jQuery("#edit-question-category-modal").modal("show");
}


/**
 * Handle category deletion
 */
function deleteCategory(itemObj) {
    var confirmDelete = confirm("Are you sure you want to delete this item ?")
    if (confirmDelete) {
        var data = {
			'_token': jQuery('meta[name=csrf-token]').attr('content'),
            questionCategoryId: itemObj.category_id
		}
        jQuery.ajax({
            url: ADMIN_CONSTANTS.DELETE_QUESTION_CATEGORY_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                if (response.success) {
                	showMessage("Admin Action", response.message, "success")
                	getQuestionCategories();
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


/**
 * Get all question categories from the database
 */
function getQuestionCategories() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_QUESTIONS_CATEGORIES_URL,
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
            		    <h5 class='text-center'><b>List of Question Categories</b></h5><br>
            			<table class="table table-striped data-table table-hover question-table">
						  	<thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Category Name</th>
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
						      <td>${item.category_name}</td>
						      <td>
						      	<a class='text-info action-btn' onclick='showEditCategoryForm(${itemObj})'><i class='fa fa-pencil'></i> edit</a>&nbsp;&nbsp;&nbsp;
						      	<a class='text-danger action-btn'  onclick='deleteCategory(${itemObj})'><i class='fa fa-trash-o'></i> delete</button>
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
            				<h5 class='text-center'>No categories available</h5>
            			</div>
            		`;

            	}

                jQuery('.categories-res').html(template);
                // jQuery(".data-table").DataTable();
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}


/**
 * Get all questions from the database
 */
function getUserQuestions() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_ALL_QUESTIONS_URL,
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
            		    <h5 class='text-center'><b>List of Questions</b></h5><br>
            			<table class="table data-table table-hover question-table">
						  	<thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Question</th>
							      <th scope="col">Patient</th>
							      <th scope="col">Category</th>
							      <th scope="col">Answered</th>
							      <th scope="col">Closed</th>
							      <th scope="col">Date</th>
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
                          <td>${truncateString(item.question_content, 70, 70)}</td>
                          <td>${truncateString(item.patient_username, 20, 15)}</td>
                          <td>${truncateString(item.question_category, 10, 7)}</td>
                          <td>${truncateString(item.question_answered, 10, 7)}</td>
                          <td>${truncateString(item.question_closed, 10, 7)}</td>
                          <td>${item.created_at['date'].substr(0,10)}</td>
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
                            <h5 class="text-center">No questions have been submitted</h5>
                        </div>
                    `;
            	}

                jQuery('.questions-res').html(template);
                jQuery(".data-table").DataTable();
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}


function redirectQuestionDetailsPage(itemObj) {
    window.location.href = baseUrl + '/admin/question/' + itemObj.question_code;
}

function getQuestionDetails(questionCode) {
    var data = {
        _token: jQuery('meta[name=csrf-token]').attr('content'),
        questionCode: questionCode
    }
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_QUESTION_DETAILS_URL,
        type: 'POST',
        data: data,
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            console.log(response)
            if (response.success) {
            	var template = '';
            	var counter = 1;

            	if (response.data) {
                    jQuery(".user-question-details-title").html(`<b>Question # ${response.data.question_code}</b>`);
                    jQuery(".question_id").val(response.data.question_id);
                    jQuery(".patient_id").val(response.data.patient_id);

                    if (response.data.question_closed == 'yes') {
                        jQuery(".question-details-title").html(`Question #${response.data.question_code} [closed]`);
                    } else {
                        jQuery(".question-details-title").html(`Question #${response.data.question_code}`);
                    }
                    
            		response.data.question_threads.forEach(function(item) {
            			var itemObj = JSON.stringify(item);

                        if (item.creator_type == 'user') {
                            template += `
                                <div class="alert alert-secondary">
                                    <small><b><i class="fa fa-user"></i> ${item.creator}<b></small><br>
                                    <small>${item.question_content}</small><br>
                            `;

                            if (item.question_media_url != "n/a") {
                                template += `<a href="${item.question_media_url}" class="text-primary" download><small>Download attached media</small></a><br>`;
                            }

                            template += `
                                    <i><small>${item.created_at['date'].substr(0,10)}</small></i>
                                </div><br>`;

                        } else {
                            template += `
                                <div class="alert alert-warning">
                                    <small><b><i class="fa fa-user-md"></i> ${item.creator}<b></small><br>
                                    <small>${item.question_content}</small><br>
                            `;

                            if (item.question_media_url != "n/a") {
                                template += `<a href="${item.question_media_url}" class="text-primary" download><small>Download attached media</small></a><br>`;
                            }

                            template += `
                                    <i><small>${item.created_at['date'].substr(0,10)}</small></i>
                                </div><br>`;
                        }

            		});
            	} else {
                    template += `
                        <div class="jumbotron">
                            <h5 class="text-center">No question submitted</h5>
                        </div>
                    `;
            	}

                jQuery('.questions-details-res').html(template);
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}