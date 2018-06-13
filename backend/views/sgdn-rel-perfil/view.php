<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelPerfil */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Perfils', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-rel-perfil-view">

  <?php
    Modal::begin([
      'id' => 'view-modal',
      'size' => 'modal-lg',
      'header' => '<strong>SGDN Modalidade</strong>',
      'footer' => Html::button('Close', ['onclick' => '$("#sgdn-rel-perfil-form").submit();', 'class' => 'btn btn-flat btn-danger', 'data-dismiss'=>'modal']),
    ]);
  ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            //'USER_ID',
            'DESIG',
            'DESCR',
            'ESTADO',
            'DT_REGISTO',
            'DT_UPDATE',
        ],
    ]) ?>

</div>

<?php
  Modal::end();
?>
