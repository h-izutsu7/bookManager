$(document).ready(function(){

    //alert($('#header').height());
    var height = $('#body').height() - $('#header').height() -5;
    var sideHeight = $('#side_wrap').height() + $('#main_title').height();

    // console.log(sideHeight);

    $('#body').height(height);
    //$('#side_wrap').height(sideHeight)

    // 画像比率
    var resize = 1;
    $('.box img').height($('.box img').height() * resize);
    $('.box img').width($('.box img').width() * resize);

    console.log(imgHeight, imgWidth);
});
