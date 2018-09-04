window.onload = function() {
    var height = 769 - $('#header').height() -6;
    // var sideHeight = $('#side_wrap').height() + $('#main_title').height();

    // alert($(window).height())
    // console.log(sideHeight);

    $('#body').height(height);
}

$(document).ready(function(){

    //alert($('#header').height());
    //var height = 769 - $('#header').height() -5;
    // var sideHeight = $('#side_wrap').height() + $('#main_title').height();

    // console.log(sideHeight);

    //$('#body').height(height);
    //$('#side_wrap').height(sideHeight)

    // 画像比率
    //var resize = 1.02;
    //$('.box img').height($('.box img').height() * resize);
    //$('.box img').width($('.box img').width() * resize);

    $('.favo').click(function(){

        var favoObj = {
            'book_id': $(this).prop('id').replace('book_id', ''),
            'favo_flg': $(this).prop('src').match('favo-ok.png') ? 0 : 1
        }

        updateFavoFlg(favoObj, $(this));
    });

    // TOP表示セレクト数が変更されたとき
    $('#displayNum').change(function(){
        $('#book_index-form').submit();
    });

    $('#header').click(function(){
        location.href = '/newDesign/book_index.php';
    });
});

function updateFavoFlg (data, elm) {

    // console.log(data);

    var img = 'images/favo-no.png';
    if (data['favo_flg']) {
        var img = 'images/favo-ok.png';
    }

    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: data,
    }).done(function(data, textStatus, jqXHR){

      elm.prop('src', img);
    }).fail(function(jqXHR, textStatus, errorThrown){
      // エラーの場合処理
    });
}
