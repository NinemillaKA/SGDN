<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\sgdnPessoaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-pessoa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'NATURALIDADE_ID') ?>

    <?= $form->field($model, 'LOCALIDADE_ID') ?>

    <?= $form->field($model, 'PR_ESTADO_CIVIL_ID') ?>

    <?= $form->field($model, 'NOME') ?>

    <?php // echo $form->field($model, 'DT_NASC') ?>

    <?php // echo $form->field($model, 'SEXO') ?>

    <?php // echo $form->field($model, 'MORADA') ?>

    <?php // echo $form->field($model, 'URL_FOTO') ?>

    <?php // echo $form->field($model, 'DT_REGISTO') ?>

    <?php // echo $form->field($model, 'ESTADO') ?>

    <?php // echo $form->field($model, 'SGDN_PESSOA_ID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
