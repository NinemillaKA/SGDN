<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\SgdnResidencia */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Residencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
  Modal::begin([
    'id' => 'view-modal',
    'size' => 'modal-lg',
    'header' => '<strong>SGDN Modalidade</strong>',
    'footer' => Html::button('Close', ['onclick' => '$("#sgdn-pr-modalidade-form").submit();', 'class' => 'btn btn-flat btn-danger', 'data-dismiss'=>'modal']),
  ]);
?>
<!-- <div class="row"> -->

<?= $this->render('view_detalhes_residencia', [
    'model' => $model,
    'show_buttonOrLabel'=>true,
]) ?>

<div>
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
<!-- </div> -->

</div>

  <?php
  Modal::end();
  ?>
