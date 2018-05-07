<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\SgdnEntidade;
use backend\models\SgdnSpot;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelEntidadeSpot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-rel-entidade-spot-form">

    <?php $form = ActiveForm::begin(['id'=>'sgdn-rel-entidade-spot-form']); ?>

    <?php if (!$model->isNewRecord){ ?>
          <div class="row">

            <div class="col-md-12">
                <?= $form->field($model, 'ENTIDADE_ID')->textInput(['maxlength' => true])->dropDownList(ArrayHelper::map(SgdnEntidade::find()->where('ESTADO = "A"')->all(),'ID','DESIG'), ['disabled' => true,'Onchange'=>'getEntidade(this.value);','id'=>'selectEntidade', 'class'=>'form-control']) ?>
                <div id="result">
                </div>
            </div>
            <div class="col-md-12" >
                  <?= $form->field($model, 'SPOT_ID')->textInput(['maxlength' => true])->dropDownList(ArrayHelper::map(SgdnSpot::find()->where('ESTADO = "A"')->all(),'ID','DESIG'), ['disabled' => true,'Onchange'=>'getSpot(this.value);','id'=>'selectSpot', 'class'=>'form-control']) ?>
                  <div id="result2">
                  </div>
            </div>
            <div class="col-md-12">
                  <?= $form->field($model, 'ESTADO')->dropDownList(["A"=>"ACTIVO", "I"=>"INACTIVO"],['prompt' =>'*** ESTADO ***', 'class'=>'form-control']) ?>
            </div>
          </div>
    <?php }else{?>
          <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'ENTIDADE_ID')->textInput(['maxlength' => true])->dropDownList(ArrayHelper::map(SgdnEntidade::find()->where('ESTADO = "A"')->all(),'ID','DESIG'), ['prompt'=>'*** SELECIONE ENTIDADE ***','Onchange'=>'getEntidade(this.value);','id'=>'selectEntidade', 'class'=>'form-control']) ?>
                    <div id="result">
                    </div>
                </div>
                <div class="col-md-12" >
                      <?= $form->field($model, 'SPOT_ID')->textInput(['maxlength' => true])->dropDownList(ArrayHelper::map(SgdnSpot::find()->where('ESTADO = "A"')->all(),'ID','DESIG'), ['prompt'=>'*** SELECIONE SPOT ***','Onchange'=>'getSpot(this.value);','id'=>'selectSpot', 'class'=>'form-control']) ?>
                      <div id="result2">
                      </div>
                </div>

          </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">

    //get Sgdnpessoa
    <?php if (!$model->isNewRecord): ?>
        $(document).ready(function(){
            $("#selectEntidade").trigger("change");
        });
    <?php endif; ?>
      function getEntidade(id_entidade)
      {
          $.get( '<?=Url::to(['sgdn-entidade/get-entidade'])?>',{id:id_entidade}, function(data) {
              $("#result").html(data);

            });
      }

      //get SgdnSpot
      <?php if (!$model->isNewRecord): ?>
          $(document).ready(function(){

              $("#selectSpot").trigger("change");
          });
      <?php endif; ?>
        function getSpot(id_spot)
        {
            $.get( '<?=Url::to(['sgdn-spot/get-spot'])?>',{id:id_spot}, function(data) {
                $( "#result2" ).html( data );

              });
        }
</script>
