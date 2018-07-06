<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelAluguerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-rel-aluguer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'PESSOA_ID') ?>

    <?= $form->field($model, 'PRECARIO_ID') ?>

    <?= $form->field($model, 'DT_ALUGUER') ?>

    <?= $form->field($model, 'DT_DEVOLUCAO') ?>

    <?php // echo $form->field($model, 'VALOR') ?>

    <?php // echo $form->field($model, 'OBS') ?>

    <?php // echo $form->field($model, 'DT_REGISTO') ?>

    <?php // echo $form->field($model, 'ESTADO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
