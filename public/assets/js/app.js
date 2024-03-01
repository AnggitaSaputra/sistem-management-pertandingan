const BASE_URL ='http://127.0.0.1:8000/'
function ajaxRequest(url, method, data, successCallback, errorCallback) {
    if (typeof data === '') {
        data = null;
    }

    $.ajax({
        url: BASE_URL + url,
        method: method,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        processData: false,
        contentType: false,
        success: successCallback,
        error: errorCallback
    });
}
function performLogout() {
    $.ajax({
        type: 'GET',
        url: BASE_URL + 'logout',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                window.location.href = BASE_URL;
            } else {
                alert('Logout gagal')
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
}