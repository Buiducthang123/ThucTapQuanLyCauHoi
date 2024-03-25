
function PostAjax(url, arr = {}) {
    // console.log(JSON.stringify(arr));
    var data = {
        'data': JSON.stringify(arr),
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(data) {
            console.log('ok')
            console.log(data)
        },
        error: function(xhr, status, error) {
            console.log("XHR Status: " + xhr.status);
            console.log("Status: " + status);
            console.log("Error: " + error);
        }
    });
}

