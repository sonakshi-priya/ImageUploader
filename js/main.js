$(document).ready (function() {
    // $('#uploadImageButton').click (function() {

    // });
});

function imageUpload(username) {
    var description = $('#description').val();
    var file = $('#imageFile')[0].files[0];
    var fd = new FormData ();
    fd.append ('username', username);
    fd.append ('image', file);
    fd.append ('text', description);
    fd.append ('uploadImage', 1);
    console.log(username);
    console.log(description);
    console.log (file);

    $.post("img_upload.php",
    {
        username: username,
        image: file,
        text: description,
        uploadImage: 1
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
    });

    // $.ajax ({
    //     url: 'img_upload.php',
    //     type: 'post',
    //     data: fd,
    //     success: function (data) {
    //         if (data['status'] == 0) {
    //             // not uploaded
    //             alert (data);
    //         } else {
    //             // uploaded
    //             alert (data);
    //         }
    //     }
    // });
}
