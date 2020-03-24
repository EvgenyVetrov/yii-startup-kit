<?php
/**
 * Главная страница блога
 *
 * @var $this \yii\web\View
 * @var $dataProvider
 * @var $header_image
 * @var $header_h1
 * @var $title
 */

$this->title = $blog_title;

?>

<?= $this->render('_list_header', [
    'header_image' => $header_image,
    'header_h1' => $header_h1
]); ?>

<div class="main main-raised">
    <div class="container">
        <!--<div class="section">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <ul class="nav nav-pills nav-pills-primary">
                        <li class="nav-item">
                            <a class="nav-link active" href="#pill1" data-toggle="tab">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pill2" data-toggle="tab">World</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pill3" data-toggle="tab">Arts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pill3" data-toggle="tab">Tech</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pill3" data-toggle="tab">Business</a>
                        </li>
                    </ul>
                    <div class="tab-content tab-space">
                        <div class="tab-pane active" id="pill1"></div>
                        <div class="tab-pane" id="pill2"></div>
                        <div class="tab-pane" id="pill3"></div>
                        <div class="tab-pane" id="pill4"></div>
                    </div>
                </div>
            </div>
        </div>-->
        <div class="section">
            <div class="row">
                <?=  \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_list_item',
                    'layout' => "{items}\n{pager}",
                ]); ?>
            </div>
        </div>
    </div>
</div>
