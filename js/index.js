// function to truncate the length of a given string, after a desired length is acheived
function truncateString(defaultString="", maxStringLength, expectedStringLength) {
	if (defaultString.length >= maxStringLength) {
		return defaultString.substring(0, expectedStringLength) + '...';
	}

	return defaultString;
}


jQuery(window).load(function() {
    jQuery(".pre-loader").fadeOut(500);
    jQuery(".btn").addClass("ripple");
});


// function to show messages
function showMessage(title, message, type){
    var icon = "";
    switch (type) {
        case 'info':
            icon = 'fa fa-info';
            break;
        case 'success':
            icon = 'fa fa-check';
            break;
        case 'warning':
            icon = 'fa fa-warning';
            break;
        case 'danger':
            icon = 'fa fa-ban';
            break;
        case 'error':
            type = 'danger';
            icon = 'fa fa-ban';
            break;
        default:
            icon = '';
            break;
    }

    jQuery.notify({
        icon: icon,
        title: "<b>Bisa Fr > </b>",
        message: message,
    },{
        element: 'body',
        position: null,
        type: type,
        allow_dismiss: true,
        newest_on_top: true,
        showProgressbar: false,
        placement: {
            from: "top",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 5000,
        timer: 1000,
        url_target: '_blank',
        mouse_over: null,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        }
    });   
}


// function to show warning messages
function showWarningMessage(message, name){
    jQuery.notify({
        icon: 'fa fa-warning',
        title: "<b>Bisa Fr > </b>",
        message: message,
    },{
        element: 'body',
        position: null,
        type: 'warning',
        allow_dismiss: true,
        newest_on_top: true,
        showProgressbar: false,
        placement: {
            from: "top",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 5000,
        timer: 1000,
        url_target: '_blank',
        mouse_over: null,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        }
    });   
}

// function to show success messages
function showSuccessMessage(message, name){
    jQuery.notify({
        icon: 'fa fa-check',
        title: "<b>Bisa Fr > </b>",
        message: message,
    },{
        element: 'body',
        position: null,
        type: 'success',
        allow_dismiss: true,
        newest_on_top: true,
        showProgressbar: false,
        placement: {
            from: "top",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 5000,
        timer: 1000,
        url_target: '_blank',
        mouse_over: null,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        }
    });   
}

// function to show error messages
function showErrorMessage(message, name){
    jQuery.notify({
        icon: 'fa fa-ban',
        title: "<b>Bisa Fr > </b>",
        message: message,
    },{
        element: 'body',
        position: null,
        type: 'danger',
        allow_dismiss: true,
        newest_on_top: true,
        showProgressbar: false,
        placement: {
            from: "top",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 5000,
        timer: 1000,
        url_target: '_blank',
        mouse_over: null,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        }
    });   
}