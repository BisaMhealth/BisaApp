getArticleCategories();

/**
 * Show article thumbnail when it is selected
 */
jQuery(".article-thumbnail").on("change", function(){
    var imageSizeLimit = 3 * 1024 * 1024;
    var file = document.getElementById('article-thumbnail').files;
    var fileLength = file.length;

    if (fileLength > 0) {
		if (file[0].size > imageSizeLimit) {
			showWarningMessage("Image cannot be greater than 3MB", "Admin Action");
		}  else {
            jQuery(".article-thumbnail-label small").html("Article Thumbnail Selected");

            var reader = new FileReader();
            reader.onload = function (e) {
                jQuery(".article-thumbnail-res").attr('src', e.target.result);
            }

            reader.readAsDataURL(file[0]);
		}
	}
});

jQuery(".edit-article-thumbnail").on("change", function(){
    var imageSizeLimit = 3 * 1024 * 1024;
    var file = document.getElementById('edit-article-thumbnail').files;
    var fileLength = file.length;

    if (fileLength > 0) {
        if (file[0].size > imageSizeLimit) {
            showWarningMessage("Image cannot be greater than 3MB", "Admin Action");
        }  else {
            jQuery(".edit-article-thumbnail-label small").html("Article Thumbnail Selected");

            var reader = new FileReader();
            reader.onload = function (e) {
                jQuery(".edit-article-thumbnail-res").attr('src', e.target.result);
            }

            reader.readAsDataURL(file[0]);
        }
    }
});


/**
 * Submit article category addition form
 */
jQuery(".add-article-category-form").on("submit", function(event) {
    event.preventDefault();

    var articleCategoryName = jQuery(".add-article-category-name").val().trim();
    if (articleCategoryName == "") {
        showMessage("Admin Action", "Please enter category name", "warning");
    } else {
        jQuery(".add-btn").html("Adding...").prop("disabled", true);
        var data = {
			'_token': jQuery('meta[name=csrf-token]').attr('content'),
			articleCategoryName: articleCategoryName
		}

		jQuery.ajax({
            url: ADMIN_CONSTANTS.ADD_ARTICLE_CATEGORY_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                jQuery(".add-btn").html("Add").prop("disabled", false);
                if (response.success) {
                	showMessage("Admin Action", response.message, "success")
                	getArticleCategories();
                	setTimeout(function() {
                        jQuery('#add-article-category-modal').modal('hide');
                        jQuery(".add-article-category-form").trigger('reset');
                    }, 2000);
                } else {
                	showMessage("Admin Action", response.message, "danger")
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
 * Submit article category edition form
 */
jQuery(".edit-article-category-form").on("submit", function(event) {
    event.preventDefault();

    var articleCategoryName = jQuery(".edit-article-category-name").val().trim();
    var articleCategoryId = jQuery(".edit-article-category-id").val();

    if (articleCategoryName == "") {
        showMessage("Admin Action", "Please enter category name", "warning");
    } else {
        jQuery(".edit-btn").html("Updateing...").prop("disabled", true);
        var data = {
			'_token': jQuery('meta[name=csrf-token]').attr('content'),
            articleCategoryName: articleCategoryName,
            articleCategoryId: articleCategoryId
		}

		jQuery.ajax({
            url: ADMIN_CONSTANTS.EDIT_ARTICLE_CATEGORY_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                jQuery(".edit-btn").html("Update").prop("disabled", false);
                if (response.success) {
                	showMessage("Admin Action", response.message, "success")
                	getArticleCategories();
                	setTimeout(function() {
                		jQuery('#edit-article-category-modal').modal('hide');
                    }, 2000);
                } else {
                    console.log(response.message)
                	showMessage("Admin Action", response.message, "danger")
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
 * Show article catgory edition form
 */
function showEditCategoryForm(itemObj) {
    jQuery(".edit-article-category-id").val(itemObj.category_id);
    jQuery(".edit-article-category-name").val(itemObj.category_name);
    jQuery("#edit-article-category-modal").modal("show");
}


/**
 * Handle article deletion
 */
function deleteCategory(itemObj) {
    var confirmDelete = confirm("Are you sure you want to delete this item ?")
    if (confirmDelete) {
        var data = {
			'_token': jQuery('meta[name=csrf-token]').attr('content'),
            articleCategoryId: itemObj.category_id
		}
        jQuery.ajax({
            url: ADMIN_CONSTANTS.DELETE_ARTICLE_CATEGORY_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                if (response.success) {
                	showMessage("Admin Action", response.message, "success")
                	getArticleCategories();
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
 * Get all article categories from database
 */
function getArticleCategories() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_ARTICLE_CATEGORIES_URL,
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
            		    <h5 class='text-center'><b>List of Article Categories</b></h5><br>
            			<table class="table table-striped data-table table-hover table-sm">
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
            				<h5 class='text-center'>No article categories available</h5>
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
 * Get all article categories to be used form dropdown
 */
function getArticleCategoriesForForm() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_ARTICLE_CATEGORIES_URL,
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
                        <option disabled selected>Select Category</option>
            		`;

            		response.data.forEach(function(item) {

            			template += `
            				<option value="${item.category_id}">${item.category_name}</option>
            			`;
            		});

            	} else {
            		template += `
                        <option disabled selected>No Category Available</option>
                    `;
                }

                jQuery('.publish-article-select').html(template);
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
 * Submit article addition form
 */
jQuery(".publish-article-form").on("submit", function (event) {
    event.preventDefault();
    var imageSizeLimit = 3 * 1024 * 1024;

    var articleTitle = jQuery(".add-article-title").val().trim(),
        articleCategory = jQuery(".add-article-cateogory").val(),
        articleContent = jQuery(".add-article-content").val().trim(),
        articleThumbnail = file = document.getElementById('article-thumbnail').files;

    if (articleTitle == "") {
        showMessage("Admin Action","Please enter article title", "warning");
    } else if (articleCategory == null || articleCategory == -1 || articleCategory == undefined) {
        showMessage("Admin Action","Please select article category", "warning");
    } else if (articleContent == "") {
        showMessage("Admin Action","Please enter article content", "warning");
    } else if(articleThumbnail.length <= 0) {
        showMessage("Admin Action","Please select article thumbnail", "warning");
    } else if (articleThumbnail[0].size > imageSizeLimit) {
        showMessage("Admin Action","Article thumbnail cannot be freater than 3MB", "warning");
    }  else {
        jQuery(".add-btn").html("Publishing...").prop("disabled", true);
        var formData = new FormData();
        formData.append('_token', jQuery('meta[name=csrf-token]').attr('content'))
        formData.append('articleTitle', articleTitle);
        formData.append('articleCategory', articleCategory);
        formData.append('articleContent', articleContent);
        formData.append('articleThumbnail', articleThumbnail[0]);

        jQuery.ajax({
            url: ADMIN_CONSTANTS.PUBLISH_ARTICLE_URL,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                jQuery(".add-btn").html("Publish").prop("disabled", false);

                if (response.success) {
                    showMessage("Admin Action",response.message, "success");
                    setTimeout(() => {
                        window.history.back();
                    }, 1500);
                } else {
                    showMessage("Admin Action",response.message, "error")
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                jQuery(".add-btn").html("Publish").prop("disabled", false);
            }
        });
    }
})


/**
 * Submit article edition form
 */
jQuery(".edit-article-form").on("submit", function (event) {
    event.preventDefault();
    var imageSizeLimit = 3 * 1024 * 1024;

    var articleTitle = jQuery(".edit-article-title").val().trim(),
        articleCategory = jQuery(".edit-article-cateogory").val(),
        articleContent = jQuery(".edit-article-content").val().trim(),
        articleId = jQuery(".edit-article-id").val(),
        articleThumbnail = file = document.getElementById('edit-article-thumbnail').files;

    if (articleTitle == "") {
        showMessage("Admin Action","Please enter article title", "warning");
    } else if (articleCategory == null || articleCategory == -1 || articleCategory == undefined) {
        showMessage("Admin Action","Please select article category", "warning");
    } else if (articleContent == "") {
        showMessage("Admin Action","Please enter article content", "warning");
    } else {
        jQuery(".edit-btn").html("Updating...").prop("disabled", true);
        var formData = new FormData();
        formData.append('_token', jQuery('meta[name=csrf-token]').attr('content'))
        formData.append('articleTitle', articleTitle);
        formData.append('articleCategory', articleCategory);
        formData.append('articleContent', articleContent);
        formData.append('articleId', articleId);

        if (articleThumbnail.length > 0) {
            formData.append('editArticleThumbnail', articleThumbnail[0]);
        }

        jQuery.ajax({
            url: ADMIN_CONSTANTS.EDIT_ARTICLE_URL,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response)
                jQuery(".edit-btn").html("Update").prop("disabled", false);

                if (response.success) {
                    showMessage("Admin Action",response.message, "success");
                    setTimeout(() => {
                        window.location.href = baseUrl + '/admin/articles';
                    }, 1500);
                } else {
                    showMessage("Admin Action",response.message, "error")
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                jQuery(".edit-btn").html("Update").prop("disabled", false);
            }
        });
    }
})


/**
 * Get all published articles from the database
 */
function getAllArticles() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_ARTICLE_URL,
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
            		    <h5 class='text-center'><b>List of Articles</b></h5><br>
            			<table class="table table-striped data-table table-hover table-sm">
						  	<thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Image</th>
							      <th scope="col">Title</th>
							      <th scope="col">Category</th>
							      <th scope="col">Author</th>
							      <th scope="col">Content</th>
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
						      <td><img src="${item.article_thumbnail}" class="article-thumbnail-sm img-fluid"> </td>
						      <td>${truncateString(item.article_title, 10, 8)}</td>
						      <td>${truncateString(item.article_category, 10, 8)}</td>
						      <td>${truncateString(item.article_author, 10, 8)}</td>
						      <td>${truncateString(item.article_content, 15, 15)}</td>
						      <td>${truncateString(item.article_publication_date, 8, 8)}</td>
                              <td>
                                <a class='text-warning action-btn' onclick='viewArticle(${itemObj})'><i class='fa fa-eye'></i> view</a>&nbsp;&nbsp;&nbsp;
						      	<a class='text-info action-btn' onclick='showEditArticleForm(${itemObj})'><i class='fa fa-pencil'></i> edit</a>&nbsp;&nbsp;&nbsp;
						      	<a class='text-danger action-btn'  onclick='deleteArticle(${itemObj})'><i class='fa fa-trash-o'></i> delete</button>
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
            				<h5 class='text-center'>No articles available</h5>
            			</div>
            		`;
            	}

                jQuery('.articles-res').html(template);
                jQuery(".data-table").DataTable();
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}

function viewArticle(itemObj) {
    jQuery(".article-detail-title").html(itemObj.article_title);
    jQuery(".article-detail-img").prop("src", itemObj.article_thumbnail);
    jQuery(".article-detail-category").html(itemObj.article_category);
    jQuery(".article-detail-author").html(itemObj.article_author);
    jQuery(".article-detail-date-published").html(itemObj.article_publication_date);
    jQuery(".article-detail-upvotes").html(itemObj.article_upvotes);
    jQuery(".article-detail-downvotes").html(itemObj.article_downvotes);
    jQuery(".article-detail-views").html(itemObj.article_views);
    jQuery(".article-detail-content").html(itemObj.article_content);
    jQuery("#article-details-modal").modal("show");
}


function showEditArticleForm(itemObj) {
    jQuery(".edit-article-thumbnail-res").prop("src", itemObj.article_thumbnail);
    jQuery(".edit-article-title").val(itemObj.article_title);
    jQuery(".edit-article-cateogory").val(itemObj.article_category);
    jQuery(".edit-article-content").val(itemObj.article_content);
    jQuery(".edit-article-id").val(itemObj.article_id);
    jQuery("#edit-article-modal").modal("show");
}


function deleteArticle(itemObj) {
    var confirmDelete = confirm("Are you sure you want to delete this article ?")
    if (confirmDelete) {
        var data = {
            '_token': jQuery('meta[name=csrf-token]').attr('content'),
            articleId: itemObj.article_id
        }
        jQuery.ajax({
            url: ADMIN_CONSTANTS.DELETE_ARTICLE_URL,
            type: 'POST',
            data: data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer ")
            },
            success: function(response) {
                if (response.success) {
                    showMessage("Admin Action", response.message, "success")
                    getArticleCategories();
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
