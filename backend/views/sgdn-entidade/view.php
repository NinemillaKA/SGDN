<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\helpers\VarDumper;
use backend\models\SgdnRelContactos;
use backend\models\SgdnRelDocumentos;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnEntidade */

$this->title ='Entidade: '.$model->DESIG;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Entidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-entidade-view">
  <div class="box box-widget">
      <div class="box-header with-border">
          <!--h1><!--?= Html::encode($this->title) ?></h1-->
              <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-flat btn-primary']) ?>
              <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
                  'class' => 'btn btn-flat btn-danger',
                  'data' => [
                      'confirm' => 'Are you sure you want to delete this item?',
                      'method' => 'post',
                  ],
              ]) ?>
      </div>
      <div class="box-body">
          <div class="col-md-8">
              <?= DetailView::widget([
                  'model' => $model,
                  'attributes' => [

                      'gLBGEOGRAFIA.NOME' ,
                      'CODIGO',
                      'DESIG',
                      'OBS',
                      'DT_REGISTO',
                      [
                        'attribute'=>'ESTADO',
                        'value'=>function($model){return ($model->ESTADO == 'A')?'Activo':'Inactivo';}
                      ],
                  ],
              ]) ?>

        </div>
        <div class="col-md-4" >
          <?php echo Html::img('@web/'.$model->URL_LOGO, ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: 200px; width:auto;border: 1px solid #d9d9d9; padding: 8px;']); ?>
          <footer 'style'='font-size: 12px;'><!--&emsp;--><i>#perfil da entidade:</i> <?= $model->DESIG ?> </footer>
        </div>
     </div>
    </div>
</div>

<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Contacto</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body" style="">
            <?php foreach ($modelContatos as $key => $contato) { ?>
                        <?php if($contato->pRCONTACTOTP->DESIG=="Email") {
                                    echo ' <i fa fa-address-book"></i>'.'<span><a target="_blank" href="https://mail.google.com/">'.$contato->CONTACTO.'</a></span>';
                                    // Html::a('<i class="fa fa-eye"></i>', ['sample-download','filename'=>'sgdnRelDocumentos.URL_DOCUMENTO'], ['class' => ''])
                              }elseif($contato->pRCONTACTOTP->DESIG=="Movel"){
                                    echo ' <i class="fa fa-eye"></i>'.' <span><a target="_blank" href="https://www.viber.com/">'.$contato->CONTACTO.'</a></span>';
                               }elseif($contato->pRCONTACTOTP->DESIG=="Telefone"){
                                     echo ' <i class="fa fa-eye"></i>'.' <span><a target="_blank" href="https://www.viber.com/">'.$contato->CONTACTO.'</a></span>';
                               }
                                // }else($contato->pRCONTACTOTP->DESIG=="Facebook"){
                                //       // echo ' <i class="fa fa-eye"></i>'.' <span><a target="_blank" href="https://facebook.com/">'.$contato->CONTACTO.'</a></span>';
                                // }
                         ?>
            <?php } ?>
        </div>
        <!-- /.box-body -->
        <div class="box-footer" style="">
          Click on links for entity contact...
        </div>
        <!-- /.box-footer!   fa fa-address-book  -->
</div>

<div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Documentos</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                  <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body" style="">
            <?php foreach ($modelDocumentos as $key => $documento) { ?>
                   <div> <b><?=$documento->pRDOCUMENTOTP->DESIG?></b><dl>
                         <?= Html::a('<i class="fa fa-eye"></i>', ['sample-download','filename'=>'sgdnRelDocumentos.URL_DOCUMENTO'], ['class' => '']) ?>
                         <?= Html::a('<i class="fa fa-download"></i>', ['sample-download','filename'=>'sgdnRelDocumentos.URL_DOCUMENTO'], ['class' => '']) ?>
                   </div>
            <?php } ?>
        </div>
        <!-- /.box-body -->
        <!-- <div class="box-footer" style="">
          Footer
        </div> -->
        <!-- /.box-footer-->
</div>
