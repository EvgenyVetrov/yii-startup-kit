<?php

use common\components\ActiveForm;

/**
 * Вьюха для отображения содержимого модального окна загрузки аватарки пользователя
 */

?>
<?php $form = ActiveForm::begin([
    'id'      => 'avatar-form',
    'action'  => 'users/default/save-avatar',
    'options' => ['enctype' => 'multipart/form-data']
]); ?>
<div class="row">

    <div class="col-sm-5">

        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
            <div class="fileinput-new thumbnail width-200">

                <div class="svg-container-200 svg-999">
                    <?= $model->getBlankAvatar(); ?>
                </div>
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail"></div>
            <div>
                <span class="btn btn-success btn-round btn-file">
                    <span class="fileinput-new">Выбрать изображение</span>
                    <span class="fileinput-exists">Изменить</span>
                    <input type="file" name="Users[image_avatar]" accept="image/png,image/jpeg,image/jpg">
                </span>
                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> &nbsp;Убрать</a>
            </div>
        </div>

    </div>
    <div class="col-sm-7">
        <strong>Правила загрузки:</strong>
        <ul>
            <li>Загружается только собственная фотография</li>
            <li>Минимальные размеры - 500х500px (до 1 мб)</li>
            <li>Разрешенные форматы: .jpg, .png</li>
            <li>Фотография должна быть квадратной, иначе автоматически обрежется до квадратного состояния. Обработка фото онлайн еще в разработке.</li>
            <li>После сохранения возможно понадобится некоторое время для обновления фото во всех местах</li>
        </ul>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <button type="submit" class="btn btn-primary btn-round pull-right">Сохранить</button>
        <div id="upload-avatar-result"></div>
    </div>
</div>
<?php ActiveForm::end(); ?>