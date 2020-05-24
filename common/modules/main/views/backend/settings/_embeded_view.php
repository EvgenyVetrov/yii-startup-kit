<?php
/**
 * Встраиваемый блок настроек для конкретного модуля
 *
 *
 * User: vetrov
 * Date: 25.09.2019
 * Time: 10:50
 *
 * @var $general_settings_info array - \modules\main\models\backend\GeneralSettings::getModuleSettingsInfo()
 * @var $this \yii\web\View
 */

?>

<div class="card card-outline card-primary">
    <div class="card-header">
        Настройки модуля "<?= $general_settings_info['module_label'] ?>"
    </div>
    <div class="card-body ">
        <?php if ($general_settings_info['list']):
            $i = 0;
            foreach ($general_settings_info['list'] as $setting): ?>

                <?= $i ? '<hr>' : '' ?>
                <div class="row">
                    <div class="col-md-8">
                        <strong><?= $setting->name ?> &nbsp; (<?= $setting->alias ?>)</strong>

                        <p><?= nl2br($setting->description); ?></p>
                    </div>
                    <div class="col-md-4">
                        <strong>Значение:</strong>
                         <br>
                        <span class="text-lead">
                            <?= $setting->value ?>
                        </span>
                        <br>
                        <a class="btn btn-warning btn-xs pull-right"
                           href="<?= \yii\helpers\Url::to(['/main/settings/update', 'id' => $setting->id]) ?>" target="_blank">
                            <i class="fa fa-edit"></i> Изменить
                        </a>
                    </div>
                </div>
        <?php $i++;
            endforeach;
        else: ?>
            <p class="text-center text-muted">
                настройки не найдены.
                <a href="<?= \yii\helpers\Url::to(['/main/settings/create']) ?>" target="_blank">Заведем?</a>
            </p>
        <?php endif; ?>
    </div>
</div>
