<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrDocumentoTpSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-pr-documento-tp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'CODIGO') ?>

    <?= $form->field($model, 'DESIG') ?>

    <?= $form->field($model, 'DESCR') ?>

    <?= $form->field($model, 'DT_REGISTO') ?>

    <?php // echo $form->field($model, 'ESTADO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
