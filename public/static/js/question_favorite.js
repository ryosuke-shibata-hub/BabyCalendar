$(function () {
    //連続でボタン押下の制御
    function stop_process(click_execution) {
        click_execution.css('pointer-events', 'none');
        setTimeout(function () {
            click_execution.css('pointer-events', '');
        }, 500);
    }
    //いいねの設定
    $('.questionFavoriteFlg').on('click', function () {
        var questionId = $(this).attr("questionId");
        var favoriteFlg = $(this).attr("questoinFlg");
        var clickQuestionFavorite = $(this);

        stop_process(clickQuestionFavorite);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/FirstBaby/Question/favorite',
            type: 'POST',
            data: {'questionId':questionId, 'favoriteFlg':favoriteFlg},
        })
        .done(function (data) {
            $('#questionFavoriteCount' + questionId).text(data[1].change());

            if (data[0] == 0) {
                clickQuestionFavorite.attr('favoriteFlg', '1');
                clickQuestionFavorite.children().attr('class', 'fa-regular fa-heart');
            }
            if (data[0] == 1) {
                clickQuestionFavorite.attr('favoriteFlg', '0');
                clickQuestionFavorite.children().attr('class', 'fa-solid fa-heart');
            }
        })
        .fail(function (data) {
            alert('いいね処理が失敗しました。');
        })
    })
})
