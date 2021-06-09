// function to truncate the length of a given string, after a desired length is acheived
function truncateString(defaultString="", maxStringLength, expectedStringLength) {
	if (defaultString.length >= maxStringLength) {
		return defaultString.substring(0, expectedStringLength) + '...';
	}

	return defaultString;
}

// function to show success messages
function showSuccessMessage(message, title){
    swal({
        title: title,
        text: message,
        icon: "success"
    })
}

// function to show warning messages
function showWarningMessage(message, title){
    swal({
        title: title,
        text: message,
        icon: "warning"
    })
}

// function to show error messages
function showErrorMessage(message, title){
    swal({
        title: title,
        text: message,
        icon: "error"
    })
}

//function to set User token
function setUserToken(token) {
	localStorage.setItem('qwiqspace_admin_token', token);
}

//function to get User token
function getUserToken() {
	return localStorage.getItem('qwiqspace_admin_token');
}

//function to clear User token
function clearUserToken() {
	localStorage.removeItem('qwiqspace_admin_token');
}

//function to verify user token
function verifyUserToken() {
	userToken = getUserToken();

	if (!userToken) {
		clearUserToken();
		return false;
	}

	return true;
}

// function to redirect user if the token has expired
function redirectExpiredUserToken() {
	alert('Your session has expired');
	clearUserToken();
	window.location.href = "/admin";
}


function openNav() {
    $('.sidenav').addClass('side-bar-enter-animation').removeClass('side-bar-leave-animation');
    $('main').addClass('main-content-leave-animation').removeClass('main-content-enter-animation');
    $('.sidenav').show();
}


function closeNav() {
    $('.sidenav').addClass('side-bar-leave-animation').removeClass('side-bar-enter-animation');
    $('main').addClass('main-content-enter-animation').removeClass('main-content-leave-animation');
    setTimeout(() => {
        $('.sidenav').hide();
    }, 500);
}
