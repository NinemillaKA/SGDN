<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelAulaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-rel-aula-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'SPOT_ID') ?>

    <?= $form->field($model, 'MODALIDADE_ID') ?>

    <?= $form->field($model, 'INST_MODALIDADE_ID') ?>

    <?= $form->field($model, 'DT_INICIO') ?>

    <?php // echo $form->field($model, 'DT_FIM') ?>

    <?php // echo $form->field($model, 'DT_REGISTO') ?>

    <?php // echo $form->field($model, 'HORA_INICIO') ?>

    <?php // echo $form->field($model, 'HORA_FIM') ?>

    <?php // echo $form->field($model, 'ESTADO') ?>

    <?php // echo $form->field($model, 'DESIG') ?>

    <?php // echo $form->field($model, 'PRECO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
