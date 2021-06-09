getTopUsersStat();
getTopDoctorsStat();

function getDashboardUserSummaryGraph() {
    jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_DASHBOARD_USER_SUMMARY_GRAPH_DATA_URL,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            console.log(response);
            if (response.success) {
                var ctx = document.getElementById('monthlySignupsChart').getContext('2d');
                drawAreaChart(ctx, response.data.label, response.data.data);
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

function drawAreaChart(ctx, labels, data) {

    var options = {
        maintainAspectRatio: false,
        spanGaps: false,
        elements: {
            line: {
                tension: 0.000001
            }
        },
        plugins: {
            filler: {
                propagate: false
            }
        },
        scales: {
            xAxes: [{
                ticks: {
                    autoSkip: false,
                    maxRotation: 0
                }
            }]
        }
    };
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels:labels,
            datasets: [{
                backgroundColor: 'rgba(163,204,57,0.8)',
                borderColor: 'rgb(101, 138, 6)',
                data: data,
                label: 'Monthly Signup Rate',
                fill: 'start'
            }]
        },
        options: options
    });

    Chart.helpers.each(Chart.instances, function(chart) {
        chart.options.elements.line.tension =  0.4;
        chart.update();
    });
}
