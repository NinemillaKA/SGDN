<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\helpers\VarDumper;
use backend\models\SgdnRelContactos;
use backend\models\SgdnRelDocumentos;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnEntidade */
?>

<?= $this->render('view_detalhes_entidade', [
    'model' => $model,
    'show_buttonOrLabel'=>true,
])
?>


<div class="row">
  <div class="col-xs-6">
    <div class="box">
            <div class="box-header with-border" style="background-color: #F4F4F5;">
                <h3 class="box-title">Documentos</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                      <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                      <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body" style="">
              <ul class="products-list product-list-in-box">
                <?php foreach ($modelDocumentos as $key => $documento) { ?>
                           <?php if ($documento->pRDOCUMENTOTP->DESIG=="BI"){

                                      echo '<li class="item">
                                              <div class="product-img" style="background-color:#eff0f1;;">
                                                <i class="fa fa-cc-amex" style="padding: 14px;"></i>
                                              </div>
                                              <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title">Bilhete de Entidade </a>
                                                <span class="product-description">
                                                    Visualizar: '.Html::a('<i class="fa fa-eye"></i> ', ['sample-display','filename'=>$documento->URL_DOCUMENTO], ['class' => '', 'target' =>'_blank'])
                                                    .' Download: ' .Html::a('<i class="fa fa-download"></i>', ['sample-download','filename'=>$documento->URL_DOCUMENTO], ['class' => ''])
                                                .'</span>
                                              </div>
                                            </li>';

                                 }elseif($documento->pRDOCUMENTOTP->DESIG=="PASSAPORTE"){
                                         echo '<li class="item">
                                                 <div class="product-img" style="background-color:#eff0f1;;">
                                                   <i class="fa fa-book" style="padding: 14px;"></i>
                                                 </div>
                                                 <div class="product-info">
                                                   <a href="javascript:void(0)" class="product-title">Passaporte </a>
                                                   <span class="product-description">
                                                       Visualizar: '.Html::a('<i class="fa fa-eye"></i>', ['sample-display','filename'=>$documento->URL_DOCUMENTO], ['class' => '', 'target' =>'_blank'])
                                                       .' Download: ' .Html::a('<i class="fa fa-download"></i>', ['sample-download','filename'=>$documento->URL_DOCUMENTO], ['class' => ''])
                                                   .'</span>
                                                 </div>
                                               </li>';

                                         // echo '<br>';
                                         // echo '<b>PASSAPORTE</b> <i class="fa fa-book"></i>'.'&nbsp &nbsp &nbsp &nbsp'.Html::a('<i class="fa fa-eye"></i>', ['sample-display','filename'=>$documento->URL_DOCUMENTO], ['class' => '']);
                                         // echo '&nbsp &nbsp';
                                         // echo Html::a('<i class="fa fa-download"></i>', ['sample-download','filename'=>$documento->URL_DOCUMENTO], ['class' => '']);

                                 }elseif($documento->pRDOCUMENTOTP->DESIG=="NIF"){
                                         echo '<li class="item">
                                                 <div class="product-img" style="background-color:#eff0f1;;">
                                                   <i class="fa fa-file-pdf-o"" style="padding: 14px;"></i>
                                                 </div>
                                                 <div class="product-info">
                                                   <a href="javascript:void(0)" class="product-title">Nº Indentificação Fiscal </a>
                                                   <span class="product-description">
                                                       Visualizar: '.Html::a('<i class="fa fa-eye"></i>', ['sample-display','filename'=>$documento->URL_DOCUMENTO], ['class' => '', 'target' =>'_blank'])
                                                       .' Download: ' .Html::a('<i class="fa fa-download"></i>', ['sample-download','filename'=>$documento->URL_DOCUMENTO], ['class' => ''])
                                                   .'</span>
                                                 </div>
                                               </li>';
                                         // echo '<br>';
                                         // echo '<b>NIF</b> <i class="fa fa-file-pdf-o"></i>'.'&nbsp &nbsp >> &nbsp &nbsp'.Html::a('<i class="fa fa-eye"></i>', ['sample-display','filename'=>$documento->URL_DOCUMENTO], ['class' => '']);
                                         // echo '&nbsp &nbsp';
                                         // echo Html::a('<i class="fa fa-download"></i>', ['sample-download','filename'=>$documento->URL_DOCUMENTO], ['class' => '']);

                                 }elseif($documento->pRDOCUMENTOTP->DESIG=="CERTIDAO DE NASCIMENTO"){
                                         echo '<li class="item">
                                                 <div class="product-img" style="background-color:#eff0f1;;">
                                                   <i class="fa fa-file-pdf-o"" style="padding: 14px;"></i>
                                                 </div>
                                                 <div class="product-info">
                                                   <a href="javascript:void(0)" class="product-title">Certificado de Nascminto </a>
                                                   <span class="product-description">
                                                       Visualizar: '.Html::a('<i class="fa fa-eye"></i>', ['sample-display','filename'=>$documento->URL_DOCUMENTO], ['class' => '', 'target'=>'_blank'])
                                                       .' Download: ' .Html::a('<i class="fa fa-download"></i>', ['sample-download','filename'=>$documento->URL_DOCUMENTO], ['class' => ''])
                                                   .'</span>
                                                 </div>
                                               </li>';

                                 }else {
                                       echo '<li class="item">
                                               <div class="product-img" style="background-color:#eff0f1;;">
                                                 <i class="fa fa-file"" style="padding: 14px;"></i>
                                               </div>
                                               <div class="product-info">
                                                 <a href="javascript:void(0)" class="product-title">Documento</a>
                                                 <span class="product-description">
                                                     Visualizar: '.Html::a('<i class="fa fa-eye"></i>', ['sample-display','filename'=>$documento->URL_DOCUMENTO], ['class' => '','target' =>'_blank'])
                                                     .' Download: ' .Html::a('<i class="fa fa-download"></i>', ['sample-download','filename'=>$documento->URL_DOCUMENTO], ['class' => ''])
                                                 .'</span>
                                               </div>
                                             </li>';
                                 }

                          ?>

                  <?php } ?>
                </ul>
              </div>
    </div>
  </div>
  <div class="col-xs-6">
    <div class="box">
            <div class="box-header with-border" style="background-color: #F4F4F5;">
              <h3 class="box-title">Contacto</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body" style="">
            <ul class="products-list product-list-in-box">
                <?php foreach ($modelContatos as $key => $contato) { ?>
                            <?php if($contato->pRCONTACTOTP->DESIG=="EMAIL") {
                                      echo '<li class="item">
                                              <div class="product-img" style="background-color:#eff0f1;;">
                                                <i class="fa fa-file-pdf-o"" style="padding: 14px;"></i>
                                              </div>
                                              <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title">Endereço Email </a>
                                                <span class="product-description">
                                                    <a target="_blank" href="https://mail.google.com/">'.$contato->CONTACTO.'</a>
                                                </span>
                                              </div>
                                            </li>';

                                   }elseif($contato->pRCONTACTOTP->DESIG=="MOVEL"){
                                     echo '<li class="item">
                                             <div class="product-img" style="background-color:#eff0f1;;">
                                               <i class="fa fa-mobile-phone"" style="padding: 14px;"></i>
                                             </div>
                                             <div class="product-info">
                                               <a href="javascript:void(0)" class="product-title">Telefone </a>
                                               <span class="product-description">
                                                   <a target="_blank" href="https://www.viber.com/'.$contato->CONTACTO.'">'.$contato->CONTACTO.'</a>
                                               </span>
                                             </div>
                                           </li>';
                                   }elseif($contato->pRCONTACTOTP->DESIG=="TELEFONE"){
                                        echo '<li class="item">
                                                <div class="product-img" style="background-color:#eff0f1;;">
                                                  <i class="fa fa-phone"" style="padding: 14px;"></i>
                                                </div>
                                                <div class="product-info">
                                                  <a href="javascript:void(0)" class="product-title">Telefone </a>
                                                  <span class="product-description">
                                                      <a target="_blank" href="https://www.viber.com/'.$contato->CONTACTO.'">'.$contato->CONTACTO.'</a>
                                                  </span>
                                                </div>
                                              </li>';
                                          // echo ' <i class="fa fa-phone"></i>'. '&nbsp   '.'<span><a target="_blank" href="https://www.viber.com/">'.$contato->CONTACTO.'</a></span>';
                                    }elseif($contato->pRCONTACTOTP->DESIG=="FACEBOOK"){
                                         echo '<li class="item">
                                                  <div class="product-img" style="background-color:#eff0f1;;">
                                                    <i class="fa fa-facebook-official"" style="padding: 14px;"></i>
                                                  </div>
                                                  <div class="product-info">
                                                    <a href="javascript:void(0)" class="product-title">Facebook </a>
                                                    <span class="product-description">
                                                        <a target="_blank" href="https://facebook.com/'.$contato->CONTACTO.'">'.$contato->CONTACTO.'</a>
                                                    </span>
                                                  </div>
                                                </li>';
                                          // echo '&nbsp &nbsp &nbsp &nbsp;';
                                          // echo ' <i class="fa fa-facebook-official"></i>'.' &nbsp   '.'<span><a target="_blank" href="https://facebook.com/">'.$contato->CONTACTO.'</a></span>';
                                    }else{
                                      echo '<li class="item">
                                               <div class="product-img" style="background-color:#eff0f1;;">
                                                 <i class="fa fa-address-book"" style="padding: 14px;"></i>
                                               </div>
                                               <div class="product-info">
                                                 <a href="javascript:void(0)" class="product-title">Facebook </a>
                                                 <span class="product-description">
                                                     '.$contato->CONTACTO.'
                                                 </span>
                                               </div>
                                             </li>';
                                          // echo ' <i class="fa fa-address-book"></i>&nbsp'.$contato->CONTACTO.'</a></span>';
                                    }
                             ?>
                <?php } ?>
              </ul>
            </div>

    </div>
  </div>
</div>

<!--  the end here !!!! -->
