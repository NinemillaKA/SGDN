<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelAlojamentoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-rel-alojamento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'PESSOA_ID') ?>

    <?= $form->field($model, 'RESIDENCIA_ID') ?>

    <?= $form->field($model, 'OBS') ?>

    <?= $form->field($model, 'DT_ENTRADA') ?>

    <?php // echo $form->field($model, 'DT_SAIDA') ?>

    <?php // echo $form->field($model, 'TOTAL') ?>

    <?php // echo $form->field($model, 'DT_REGISTO') ?>

    <?php // echo $form->field($model, 'ESTADO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
