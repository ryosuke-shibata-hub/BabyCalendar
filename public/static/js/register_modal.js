$(function () {
    $('.confirmButton').prop("disabled", true);

    $('input:required').change(function () {
        let flg = true;
        console.log(flg);
        $('input:required').each(function (e) {
            if ($('input:required').eq(e).val() === "") {
                flg = false;
            }
        });
        if (flg) {
            $('.confirmButton').prop("disabled", false);
        } else {
            $('.confirmButton').prop("disabled", true);
        }
    });
});

$('.form-btn').click(function () {
    const name = $('input[name="loginId"]').val();
    const email = $('input[name="email"]').val();
    const accountName = $('input[name="accountName"]').val();
    const password = $('input[name="password"]').val();
    const confirmPassword = $('input[name="confirmPassword"]').val();

    $('.form-btn').attr('data-bs-toggle', 'modal');
    $('.form-btn').attr('data-bs-target', '#registerModal');

    $('.modal-login-id').text(name).val(name);
    $('.modal-email').text(email).val(email);
    $('.modal-accountName').text(accountName).val(accountName);
    $('.modal-password').text(password).val(password);
    $('.modal-password-confirm').text(confirmPassword).val(confirmPassword);

    $(function() {
        $('.toggle-pass').on('click', function() {
            $(this).toggleClass('fa-eye fa-eye-slash');
            var input = $(this).prev('input');
            if (input.attr('type') == 'text') {
            input.attr('type','password');
            } else {
            input.attr('type','text');
            }
        });
        });
});
