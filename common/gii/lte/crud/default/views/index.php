<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator \common\gii\lte\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = '<?= $generator->titleIndex ?>';
$this->params['pageTitle']     = $this->title;
$this->params['breadcrumbs'][] = $this->title;

$this->params['content-fixed'] = false;
$this->params['pageIcon'] = '<?= $generator->generalIcon ?>';
$this->params['place']    = '<?= $generator->menuPlace ?>';
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index card card-primary card-outline">

    <?= $generator->enablePjax ? "    <?php Pjax::begin(); ?>\n" : '' ?>
    <?php if(!empty($generator->searchModelClass)): ?>
        <?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php endif; ?>

    <div class="card-header">
        <?= "<?= " ?>Html::a('<i class="fa fa-plus"></i> Добавить', ['create'], ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="card-body no-padding">
    <?php if ($generator->indexWidgetType === 'grid'): ?>
        <?= "<?= " ?>GridView::widget([
        'dataProvider' => $dataProvider,
        <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>

        <?php
        $count = 0;
        if (($tableSchema = $generator->getTableSchema()) === false) {
            foreach ($generator->getColumnNames() as $name) {
                if (++$count < 6) {
                    echo "            '" . $name . "',\n";
                } else {
                    echo "            // '" . $name . "',\n";
                }
            }
        } else {
            foreach ($tableSchema->columns as $column) {
                $format = $generator->generateColumnFormat($column);
                if (++$count < 6) {
                    echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                } else {
                    echo "            // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                }
            }
        }
        ?>
        [
            'class' => \yii\grid\ActionColumn::class,
            'template' => '{view} {update} {delete}',
        ],
    ],
]); ?>
    <?php else: ?>
        <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
        return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
        },
        ]) ?>
    <?php endif; ?>
    </div>
    <?= $generator->enablePjax ? "    <?php Pjax::end(); ?>\n" : '' ?>
</div>
