<?php
Yii::setAlias('@root', dirname(dirname(__DIR__)));

Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@mail', dirname(__DIR__) . '/mail');
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

Yii::setAlias('@modules', dirname(__DIR__) . '/modules');
Yii::setAlias('@themes', dirname(__DIR__) . '/themes');
Yii::setAlias('@files', dirname(__DIR__) . '/files');
Yii::setAlias('@filesUrl', '/files');


//// функция для дебага, вызывается из любого места
function d($var, $depth = 10)
{
    /*if(!isset($caller)){
        $caller = array_shift(debug_backtrace(1));
    }*/
    //echo '<code>File: '.$caller['file'].' / Line: '.$caller['line'].'</code>';
    echo '<pre>';
    yii\helpers\VarDumper::dump($var, $depth, true);
    echo '</pre>';
}