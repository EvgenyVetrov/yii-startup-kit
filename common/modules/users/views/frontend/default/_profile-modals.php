<?php
/**
 * Модальные окна в профиле юзера
 * Запрашивается при рендринге первичном.
 * Вынесенов отдельную вьюху для чистоты кода
 *
 * @var $this \yii\web\View
 */


?>

<!-- Модальное окно -->
<div class="modal fade" id="avatar-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close text-24" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Фото профиля</h4>
            </div>
            <div class="modal-body">
                <br>
                <?= \modules\main\components\Common::getLoader() ?>
                <br>
            </div>
        </div>
    </div>
</div>


<?php


$script = <<<JS
    function refreshProfileAvatarContainer() {
        $.ajax({
            type: 'get',
            url: '/users/default/refresh-avatar-container',
            success: function(data) {
                 $('#avatar-image-container').html(data);
            },
            error: function(xhr) {
                ajaxError(xhr, 'refreshProfileAvatarContainer()');
            }
        });
    }



    $(document).on('click', '#avatar-modal-btn', function(event) {
        $('#avatar-modal .modal-body').html('<br>' + window.defaultLoader + '<br>');
        
        $.ajax({
            type: 'GET',
            url: '/users/default/user-avatar-modal',
            success: function(data){
                $('#avatar-modal .modal-body').html(data);
            },
            error: function (data) {
                ajaxError(data, '#avatar-modal-btn');
            }
        });
    });

    
    $(document).on('submit', '#avatar-form', function(event) {
        event.preventDefault();
        clearTimeout(window.resultTimerId);
        var formData = new FormData($(this)[0]);
        var url = $(event.target).attr('action');
        var result;
        
        $.ajax({
            type: 'post',
            url: url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                 if (data.status == 'success') {
                     refreshProfileAvatarContainer();
                     result = '<p class="text-success"><strong>'+ data.text +'</strong></p>';
                     $(document).find('#upload-avatar-result').html(result);
                 } 
                 if (data.status == 'error') {
                     result = '<p class="text-danger"><strong>Что-то пошло не так:</strong></p>';
                     result = result + '<ul><li>' + data.errors_list.image_avatar.join('</li><li>') + '</li></ul>';
                     $(document).find('#upload-avatar-result').html(result);
                 }
                 
                 window.resultTimerId = setTimeout(function() {
                     $(document).find('#upload-avatar-result').html('');
                 }, 10000)
            },
            error: function(xhr) {
                ajaxError(xhr);
            }
        });
        
        return false;
    });



JS;

$this->registerJs($script);