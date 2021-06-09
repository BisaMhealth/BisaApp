function getHealthInfoByCategory(articleCategory) {
    var data = {
        '_token': jQuery('meta[name=csrf-token]').attr('content'),
        articleCategory: articleCategory
    }
    jQuery.ajax({
        url: CONSTANTS.GET_ARTICLES_BY_TITLE,
        type: 'POST',
        data: data,
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            if (response.success) {
            	var template = '';
            	var counter = 1;

            	if (response.data.length > 0) {

            		response.data.forEach(function(item) {
            			var itemObj = JSON.stringify(item);

            			template += `

                            <div class="col-md-4">
                                <div class="user-health-info-div">
                                    <img src="${item.article_thumbnail}" class="user-health-info-img img-fluid">
                                    <div class="user-health-info-content-div">
                                        <h5><b>${truncateString(item.article_title, 22, 7)}</b></h5>
                                        <small>${truncateString(item.article_content, 30, 28)}</small><br><br>

                                        <a class='text-info' href='${baseUrl + '/user/article/' + item.article_title}'><small>read article</small></a>
                                    </div>
                                </div>
                            </div>
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
            				<h5 class='text-center'>No articles available for this category</h5>
            			</div>
            		`;
            	}

                jQuery('.articles-res').html(template);
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}


function upvote_article(article_id){
    var data = {
        '_token': jQuery('meta[name=csrf-token]').attr('content'),
        articleId: article_id
    }
    jQuery.ajax({
        url: CONSTANTS.UPVOTE_ARTICLE_URL,
        type: 'POST',
        data: data,
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            if (response.success) {
                jQuery(".upvote-num").html(response.num_of_upvotes)
            } else {
                showMessage("User Action", response.message, 'danger');
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}


function downvote_article(article_id) {
    var data = {
        '_token': jQuery('meta[name=csrf-token]').attr('content'),
        articleId: article_id
    }
    jQuery.ajax({
        url: CONSTANTS.DOWNVOTE_ARTICLE_URL,
        type: 'POST',
        data: data,
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            if (response.success) {
                jQuery(".downvote-num").html(response.num_of_downvotes)
            } else {
                showMessage("User Action", response.message, 'danger');
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}
