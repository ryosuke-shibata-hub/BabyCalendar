$('.edit-btn').click(function () {

    const accountName = $('input[name="accountName"]').val();
    const myComment = $('textarea[name="myComment"]').val();

    $('.modal-accountName').val(accountName);
    $('.modal-myComment').val(myComment);

    $('.edit-btn').attr('data-bs-toggle', 'modal');
    $('.edit-btn').attr('data-bs-target', '#editModal');
});
