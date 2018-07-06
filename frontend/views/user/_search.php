<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password_hash') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'sgdn_rel_perfil_ID') ?>

    <?php // echo $form->field($model, 'url_perfil') ?>

    <?php // echo $form->field($model, 'dt_registo') ?>

    <?php // echo $form->field($model, 'dt_updated') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
