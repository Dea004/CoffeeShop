$(document).ready(function () {
    $('#forgotPasswordForm').on('submit', function (e) {
        e.preventDefault(); // Mencegah form reload halaman
        let formData = $(this).serialize();

        $.ajax({
            url: '/send-verification-code', // Endpoint untuk mengirim OTP
            type: 'POST',
            data: formData,
            success: function (response) {
                alert(response.message); // Menampilkan pesan di modal
            },
            error: function (xhr) {
                alert('Error: ' + xhr.responseJSON.message);
            }
        });
    });
});
