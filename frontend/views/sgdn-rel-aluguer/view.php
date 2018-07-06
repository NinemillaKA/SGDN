<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelAluguer */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Aluguers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-rel-aluguer-view">

  <?php
    Modal::begin([
      'id' => 'view-modal',
      'size' => 'modal-lg',
      'header' => '<strong>SGDN Modalidade</strong>',
      'footer' => Html::button('Close', ['onclick' => '$("#sgdn-rel-aluguer-form").submit();', 'class' => 'btn btn-flat btn-danger', 'data-dismiss'=>'modal']),
    ]);
  ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'PESSOA_ID',
            'PRECARIO_ID',
            'DT_ALUGUER',
            'DT_DEVOLUCAO',
            'VALOR',
            'OBS',
            'DT_REGISTO',
            'ESTADO',
        ],
    ]) ?>

</div>

<?php
  Modal::end();
?>
