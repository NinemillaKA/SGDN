<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\sgdnPessoa */

$this->title = $model->NOME;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pessoas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-pessoa-view">
  <div class="box box-widget">
  <div class="box-body">
    <!-- <h1><-?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'ID',
            // 'NATURALIDADE_ID',
            'nATURALIDADE.NACIONALIDADE',
            //'LOCALIDADE_ID',
            'lOCALIDADE.NOME',
            //'PR_ESTADO_CIVIL_ID',
            'pRESTADOCIVIL.DESIG',
            'NOME',
            'DT_NASC',
            'SEXO',
            'MORADA',
            //'URL_FOTO:url',
            'DT_REGISTO',
            'ESTADO',
            // [
            //   'attribute'=>'ESTADO',
            //   'value'=>function($model){return ($model->ESTADO == 'A')?'Activo':'Inactivo';}
            // ],
            //'SGDN_PESSOA_ID',
        ],
    ]) ?>

  </div>
</div>

    <div class="box box-widget">
    <div class="box-body">
      <div class="col-md-8">
        <?php if($modelContatos){ ?>
        <?php foreach ($modelContatos as $key => $contato) { ?>
             <div> <b><?=$contato->pRCONTACTOTP->DESIG?></b><dl>
             <?php if($contato->pRCONTACTOTP->DESIG=="Email") {
                      echo '<span><a target="_blank" href="https://mail.google.com">'.$contato->CONTACTO.'</a></span></div>';
                 }elseif($contato->pRCONTACTOTP->DESIG=="Movel"){
                      echo '<span><a target="_blank" href="https://www.viber.com/">'.$contato->CONTACTO.'</a></span></div>';
                 }elseif($contato->pRCONTACTOTP->DESIG=="Telefone"){
                      echo '<span><a target="_blank" href="https://www.viber.com/">'.$contato->CONTACTO.'</a></span></div>';
                 }elseif($contato->pRCONTACTOTP->DESIG=="Facebook"){

                 }
             ?>
         <?php } ?>

        <?php } ?>
      </div>
    </div>

</div>
