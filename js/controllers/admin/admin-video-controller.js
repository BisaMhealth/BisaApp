getVideos();

/**
 * Show notify user when video file is selected
 */
jQuery(".add-video-thumbnail").on("change", function(){
    var videoSizeLimit = 50 * 1024 * 1024;
    var file = document.getElementById('add-video-thumbnail').files;
    var fileLength = file.length;

    if (fileLength > 0) {
		if (file[0].size > videoSizeLimit) {
			showWarningMessage("Video cannot be greater than 50MB", "Admin Action");
		}  else {
            jQuery(".add-video-thumbnail-label small").html("Video File Selected");
		}
	}
});


/**
 * Upload the video
 */
jQuery(".add-video-form").on("submit", function(event) {
    event.preventDefault();

    var title = jQuery(".add-video-title").val().trim(),
        description = jQuery(".add-video-description").val().trim(),
        video = document.getElementById('add-video-thumbnail').files;

    if (title == "") {
        showMessage("Admin Action", "Please enter video title", "warning");
    }else if (video.length < 1){
        showMessage("Admin Action", "Please select video file", "warning");
    } else {

        if (description == "") {
           description = "n/a";
        }

        jQuery(".add-btn").html("Adding...").prop("disabled", true);
        var formData = new FormData();
        formData.append('_token', jQuery('meta[name=csrf-token]').attr('content'))
        formData.append('title',title);
        formData.append('description',description);
        formData.append('video', video[0]);

		jQuery.ajax({
            url: ADMIN_CONSTANTS.ADD_VIDEO_URL,
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
                    showMessage("Admin Action", response.message, "success");
                    getVideos();
                	setTimeout(function() {
                        jQuery('#add-video-modal').modal('hide');
                        jQuery(".add-video-form").trigger('reset');
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
})


/**
 * Edit video details
 */
jQuery(".edit-video-form").on("submit", function(event) {
    event.preventDefault();

    var title = jQuery(".edit-video-title").val().trim(),
        description = jQuery(".edit-video-description").val().trim(),
        videoId = jQuery(".edit-video-id").val();

    if (title == "") {
        showMessage("Admin Action", "Please enter video title", "warning");
    } else {

        if (description == "") {
           description = "n/a";
        }

        jQuery(".edit-btn").html("Updating...").prop("disabled", true);
        var formData = new FormData();
        formData.append('_token', jQuery('meta[name=csrf-token]').attr('content'))
        formData.append('title',title);
        formData.append('description',description);
        formData.append('videoId',videoId);

		jQuery.ajax({
            url: ADMIN_CONSTANTS.EDIT_VIDEO_DETAILS_URL,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                jQuery(".edit-btn").html("Update").prop("disabled", false);
                if (response.success) {
                    showMessage("Admin Action", response.message, "success");
                    getVideos();
                	setTimeout(function() {
                        jQuery('#edit-video-modal').modal('hide');
                        jQuery(".edit-video-form").trigger('reset');
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
})


/**
 * Get all videos
 */
function getVideos() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_VIDEOS_URL,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            var template = "";
            if (response.success) {
                if (response.data.length > 0) {
                    jQuery(".videos-res-title").html(`<h5 class="text-center'><b>Videos</b></h5><br>`);

                    response.data.forEach(function(item) {
                        var itemObj = JSON.stringify(item);
        
                        template += `
                           <div class="col-md-3">
                                <div class="video-div">
                                    <video class="video-item" controls>
                                        <source src="${item.video_url}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                
                                    <div class="video-stats-div">
                                        <div class="video-stat-item">
                                            <p><small><b><i class="fa fa-thumbs-up"></i></b> <span>${item.downvotes}</span></small></p>
                                        </div>
                
                                        <div class="video-stat-item">
                                            <p><small><b><i class="fa fa-thumbs-down"></i></b> <span>${item.upvotes}</span></small></p>
                                        </div>
                
                                        <div class="video-stat-item">
                                            <p><small><b><i class="fa fa-eye"></i></b> <span>${item.views}</span></small></p>
                                        </div>
                                    </div>
                
                                    <div class="video-action-div">
                                        <a onclick='viewVideo(${itemObj})' class="text-success">view</i></a>
                                        <a onclick='editVideoDetails(${itemObj})' class="text-info">edit</a>
                                        <a onclick='deleteVideo(${itemObj})' class="text-danger">delete</a>
                                    </div>
                                </div>
                
                            </div>
                        `;
                    });
                } else {
                    template += `
                        <div class="jumbotron">
                            <h5 class="text-center">No Videos Uploaded Yet</h5>
                        </div>
                    `
                }
            } else {
                
            }
            
            jQuery(".videos-res").html(template);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            jQuery(".add-btn").html("Add").prop("disabled", false);
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}

function editVideoDetails(itemObj) {
    jQuery(".edit-video-title").val(itemObj.title);
    jQuery(".edit-video-description").val(itemObj.description);
    jQuery(".edit-video-id").val(itemObj.video_id);
    jQuery("#edit-video-modal").modal("show");
}

function viewVideo(itemObj) {
    jQuery(".view-vidoe-src").prop("src", itemObj.video_url);
    jQuery(".view-video-title").html(itemObj.title);
    jQuery(".view-video-description").html(itemObj.description);
    jQuery(".view-video-upvotes").html(itemObj.upvotes);
    jQuery(".view-video-downvotes").html(itemObj.downvotes);
    jQuery(".view-video-views").html(itemObj.views);
    jQuery("#view-video-modal").modal("show");
}


function deleteVideo(itemObj) {
    var confirmDelete = confirm("Are you sure you want to delete this video ?")
    if (confirmDelete) {
        var data = {
            '_token': jQuery('meta[name=csrf-token]').attr('content'),
            videoId: itemObj.video_id
        }
        jQuery.ajax({
            url: ADMIN_CONSTANTS.DELETE_VIDEO_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                if (response.success) {
                    showMessage("Admin Action", response.message, "success")
                    getVideos();
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