<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \modules\rbac\models\PermissionsForm */
/* @var $form yii\widgets\ActiveForm */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?php $form = ActiveForm::begin(); ?>
    <div class="card card-outline card-primary">
        <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'rule')->textInput([
                            'maxlength' => 50,
                            'disabled' => $model->scenario == 'update' ? true : false
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>

        </div>
    </div>
<?php ActiveForm::end(); ?>