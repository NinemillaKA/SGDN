<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelAvaliacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-rel-avaliacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MATRICULA_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AVALIACAO_TP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OBS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DT_REGISTO')->textInput() ?>

    <?= $form->field($model, 'ESTADO')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
