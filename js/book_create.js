$(document).ready(function(){

  if (! $('#update_flg').val()) {
    $('#delete').prop('disabled', true);
    $('#delete').addClass('disabled');
  }

  // クリアボタンをクリックした時
  $('.reset').click(function(){
    $('#title').val('無題');
    $('#preview-title').html('無題');
    $('#folder_path').val('');
    $('#preview-img').prop('src', 'images/no-image.png');
    $('#thumbnail').val('');
    $('#html').val('');
    $('#category').val('');
    $('#genre').val('');
    $('#genre').html('<option>選択してください</option>');
  });

  // 削除ボタンをクリックした時
  $('#delete').click(function(){

    if(!confirm('本当に削除しますか？')){
      /* キャンセルの時の処理 */
      return false;
    }else{
      /*　OKの時の処理 */
      $('#delete_flg').val($('#update_flg').val());
      $('#form').submit();
    }
  });
});
