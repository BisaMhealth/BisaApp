getUserSummaryStats();
getDoctorsSummaryStats();
getAdminsStats();
getUserSignupStats();
getQuestionsStats();
getArticleMiscStats();
getTopUsersStat();
getTopDoctorsStat();
getDoctorsStats();

function printStats() {
    jQuery.print(".stats-container");
}

function getUserSummaryStats() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_USER_STATISTICS_URL,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            if (response.success) {
                var ctx = document.getElementById('usersChart').getContext('2d');
                jQuery(".userChartTitle").html(response.data.title);
                drawPieChart(ctx, response.data.label, response.data.data, "User Statistics");
            } else {
                
            }            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            jQuery(".add-btn").html("Add").prop("disabled", false);
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}

function getDoctorsSummaryStats() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_DOCTOR_STATISTICS_URL,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            if (response.success) {
                var ctx = document.getElementById('doctorsChart').getContext('2d');
                jQuery(".doctorChartTitle").html(response.data.title);
                drawPieChart(ctx, response.data.label, response.data.data, "Doctor Statisticss");
            } else {
                
            }            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            jQuery(".add-btn").html("Add").prop("disabled", false);
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}

function getAdminsStats() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_ADMIN_STATISTICS_URL,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            if (response.success) {
                var ctx = document.getElementById('adminsChart').getContext('2d');
                jQuery(".adminChartTitle").html(response.data.title);
                drawPieChart(ctx, response.data.label, response.data.data, "Admin Statisticss");
            } else {
                
            }            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            jQuery(".add-btn").html("Add").prop("disabled", false);
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}

function getTopUsersStat() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_TOP_USERS_STATISTICS_URL,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            if (response.success) {
                var ctx = document.getElementById('topUsersChart').getContext('2d');
                jQuery(".topUserChartTitle").html(response.data.title);
                drawBarChart(ctx, response.data.label, response.data.data, "Top User");
            } else {
                
            }            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            jQuery(".add-btn").html("Add").prop("disabled", false);
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}

function getTopDoctorsStat() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_TOP_DOCTORS_STATISTICS_URL,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            if (response.success) {
                var ctx = document.getElementById('topDoctorsChart').getContext('2d');
                jQuery(".topDoctorChartTitle").html(response.data.title);
                drawBarChart(ctx, response.data.label, response.data.data, "Top Doctor");
            } else {
                
            }            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            jQuery(".add-btn").html("Add").prop("disabled", false);
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}

function getUserSignupStats() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_USER_SIGNUP_STATISTICS_URL,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {            
            if (response.success) {
               jQuery(".new-users-today-res").html(response.data.numberOfUsersToday);
               jQuery(".new-users-this-week-res").html(response.data.numberOfUsersThisWeek);
               jQuery(".new-users-this-month-res").html(response.data.numberOfUsersThisMonth);
               jQuery(".new-users-this-year-res").html(response.data.numberOfUsersThisYear);
            } else {
                
            }            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            jQuery(".add-btn").html("Add").prop("disabled", false);
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}

function getQuestionsStats() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_QUESTIONS_STATISTICS_URL,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) { 
            if (response.success) {
               jQuery(".total-questions-res").html(response.data.numberOfQuestions);
               jQuery(".questions-today-res").html(response.data.numberOfQuestionsToday);
               jQuery(".questions-this-week-res").html(response.data.numberOfQuestionsThisWeek);
               jQuery(".questions-this-month-res").html(response.data.numberOfQuestionsThisMonth);
               jQuery(".questions-this-month-res").html(response.data.numberOfQuestionsThisYear);
               jQuery(".open-questions-res").html(response.data.numberOfOpenQuestions);
               jQuery(".closed-questions-res").html(response.data.numberOfClosedQuestions);
               jQuery(".unanswered-questions-res").html(response.data.numberOfNewQuestions);
               jQuery(".answered-questions-res").html(response.data.numberOfAnsweredQuestions);
            } else {
                
            }            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            jQuery(".add-btn").html("Add").prop("disabled", false);
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}

function getArticleMiscStats() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_ARTICLE_MISC_STATISTICS_URL,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            if (response.success) {
                jQuery(".health-resources-res").html(response.data.numberOfHealthResources);
                jQuery(".pharmacies-res").html(response.data.numberOfPharmacies);
                jQuery(".article-categories-res").html(response.data.numberOfArticleCategories);
                jQuery(".articles-res").html(response.data.numberOfArticles);
                jQuery(".ariticle-views-res").html(response.data.numberOfArticleViews);
                jQuery(".article-upvotes-res").html(response.data.numberOfArticleUpvotes);
                jQuery(".article-downvotes-res").html(response.data.numberOfArticleDownvotes);
            } else {
                
            }            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            jQuery(".add-btn").html("Add").prop("disabled", false);
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}

function getDoctorsStats() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_DOCTORS_ALL_STATISTICS_URL,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            console.log(response);    
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            jQuery(".add-btn").html("Add").prop("disabled", false);
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}