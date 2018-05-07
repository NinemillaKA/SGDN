<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelMatriculaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-rel-matricula-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ALUNO_ID') ?>

    <?= $form->field($model, 'AULA_ID') ?>

    <?= $form->field($model, 'CODIGO') ?>

    <?= $form->field($model, 'DATA') ?>

    <?php // echo $form->field($model, 'OBS') ?>

    <?php // echo $form->field($model, 'DT_REGISTO') ?>

    <?php // echo $form->field($model, 'ESTADO') ?>

    <?php // echo $form->field($model, 'PRECO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
