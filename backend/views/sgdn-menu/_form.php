<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnMenu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-menu-form">

    <?php $form = ActiveForm::begin(['id' => 'sgdn-menu-form', 'options'=>['class'=>'']]); ?>

    <!-- <-?= $form->field($model, 'ID')->textInput(['maxlength' => true]) ?>

    <-?= $form->field($model, 'DESIG')->textInput(['maxlength' => true]) ?>

    <-?= $form->field($model, 'DESCR')->textInput(['maxlength' => true]) ?>

    <-?= $form->field($model, 'CONTROLLER')->textInput(['maxlength' => true]) ?>

    <-?= $form->field($model, 'ESTADO')->textInput(['maxlength' => true]) ?>

    <-?= $form->field($model, 'DT_REGISTO')->textInput() ?>

    <-?= $form->field($model, 'DT_UPDATE')->textInput() ?>

    <-?= $form->field($model, 'ACTION')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <-?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div> -->

    <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label"><?=$model->getAttributeLabel('DESIG')?></label>
            <?= $form->field($model, 'DESIG')->textInput(['maxlength' => true, 'class'=>'form-control'])->label(false) ?>
        </div>

        <div class="form-group">
            <label class="control-label"><?=$model->getAttributeLabel('CONTROLLER')?></label>
            <?= $form->field($model, 'CONTROLLER')->dropDownList($controllers,[
                                                    'class'=>'form-control select',
                                                    'prompt'=>Yii::t('app', '-- Select a Controller --'),
                                                    'onchange' => '
                                                        $.post(
                                                            "' . Url::toRoute('get-controller-actions') . '",
                                                            {controller_id: $(this).val()},
                                                            function(res){
                                                                $("#sgdn-menu-action").html(res);
                                                            }
                                                        );
                                                    ',])->label(false) ?>
        </div>

        <div class="form-group">
            <label class="control-label"><?=$model->getAttributeLabel('ACTION')?></label>
            <?= $form->field($model, 'ACTION')->dropDownList($menu_actions,['class'=>'form-control select','prompt'=>Yii::t('app', '-- Select an Action --')])->label(false) ?>
        </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
            <label class="control-label"><?=$model->getAttributeLabel('DESCR')?></label>
            <?= $form->field($model, 'DESCR')->textInput(['maxlength' => true, 'class'=>'form-control'])->label(false) ?>
        </div>

        <div class="form-group">
            <label class="control-label"><?=$model->getAttributeLabel('pg_menu_ID')?></label>
            <?= $form->field($model, 'MENU_ID')->dropDownList(ArrayHelper::map(PgMenu::find()->all(), 'ID', 'DESIG'),['class'=>'form-control select','prompt'=>Yii::t('app', '-- Select a Parent Menu --')])->label(false) ?>
        </div>

        <?php if(!$model->isNewRecord):?>
        <div class="form-group">
            <label class="control-label"><?=$model->getAttributeLabel('ESTADO')?></label>
                <?= $form->field($model, 'ESTADO')->dropDownList(['A'=>Yii::t('app', 'Enabled'),'I'=>Yii::t('app', 'Disabled')],['prompt' => Yii::t('app', '-- Select a State --'), 'class'=>'form-control select'])->label(false)?>
        </div>
        <?php endif;?>

        <div class="form-group">
            <label class="check">
                <input <?php echo($model->FLAG_DISPLAY == 1)? "checked":"";?> id="<?=Html::getInputId ( $model, 'FLAG_DISPLAY')?>" type="checkbox" name="<?=Html::getInputName ( $model, 'FLAG_DISPLAY')?>">
                <?=$model->getAttributeLabel('FLAG_DISPLAY')?>
             </label>
        </div>
    </div>
</div>

    <?php ActiveForm::end(); ?>

</div>

<script>
$(document).ready(function(){
  $('#sgdn_menu-flag_display').iCheck({
    checkboxClass: 'icheckbox_minimal-grey',
    radioClass: 'iradio_minimal',
    increaseArea: '20%' // optional
  });
});
</script>
