<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\SgdnPessoa;
use backend\models\SgdnViagen;
use backend\models\SgdmInstrutor;
use kartik\daterange\DateRangePicker;
use yii\helpers\Url;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelInscricaoViagen */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="sgdn-rel-inscricao-viagen-form">

    <?php $form = ActiveForm::begin(['id'=>'sgdn-rel-inscricao-viagen-form']); ?>

    <div class="row">
        <div class="col-md-6">
             <?= $form->field($model, 'PESSOA_ID')->dropDownList(ArrayHelper::map(SgdnPessoa::find()->where('ESTADO = "A"')->all(),'ID','NOME'),
             ['prompt'=>'*** Seleciona Pessoa ***',
             'Onchange'=>'getPessoa(this.value);','id'=>'selectPessoa', 'class'=>'form-control']) ?>
             <div id="result"></div>
        </div>
        <div class="col-md-6">
             <?= $form->field($model, 'VIAGEM_ID')->dropDownList(ArrayHelper::map(SgdnViagen::find()->where('ESTADO = "A"')->all(),'ID','DESIG'),
             ['prompt'=>'*** Seleciona Residencia***',
             'Onchange'=>'getViagen(this.value);','id'=>'selectViagen', 'class'=>'form-control'])?>

             <div id="result_viagen"></div>

        </div>
    </div>

    <div class="col-md-4">
        <?= $form->field($model, 'INSTRUTOR_ID')->dropDownList(ArrayHelper::map(SgdnPessoa::find()->where('ESTADO = "A"')->all(),'ID','NOME'),
        ['prompt'=>'*** Seleciona Pessoa ***',
        'Onchange'=>'getPessoa(this.value);','id'=>'selectPessoa', 'class'=>'form-control']) ?>

        <div id="result_instrutor"></div>
    </div>

    <?php if (!$model->isNewRecord): ?>
              <?= $form->field($model, 'ESTADO')->dropDownList(["A"=>"ACTIVO", "I"=>"INACTIVO"],['prompt' =>'*** ESTADO ***', 'class'=>'form-control']);?>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">

    <?php if (!$model->isNewRecord): ?>
        $(document).ready(function(){

            $("#selectPessoa").trigger("change");
        });
    <?php endif; ?>
      function getPessoa(id_pessoa)
      {
          $.get( '<?=Url::to(['sgdn-pessoa/get-pessoa'])?>',{id:id_pessoa}, function( data ) {
              $( "#result" ).html( data );

            });
      }
</script>

<script type="text/javascript">

    <?php if (!$model->isNewRecord): ?>
        $(document).ready(function(){

            $("#selectViagen").trigger("change");
        });
    <?php endif; ?>

      function getViagen(id_viagen)
      {
          $.get( '<?=Url::to(['sgdn-viagen/get-viagen'])?>',{id:id_viagen}, function( data ) {
              $( "#result_viagen" ).html( data );

            });
      }
      <?php if (!$model->isNewRecord): ?>
          $(document).ready(function(){
              $("#selectInstrutor").trigger("change");
          });
      <?php endif; ?>

      function getInstrutor(id_pessoa)
      {
          $.get( '<?=Url::to(['sgdn-pessoa/get-pessoa1'])?>',{id:id_pessoa}, function( data ) {
              $( "#result_instrutor" ).html( data );

            });
      }

</script>
