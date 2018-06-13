<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-view">

   <?php
        Modal::begin([
          'id' => 'view-modal',
          'size' => 'modal-lg',
          'header' => '<strong>SGDN User</strong>',
          'footer' => Html::button('Close', ['onclick' => '$("#user-form").submit();', 'class' => 'btn btn-flat btn-danger', 'data-dismiss'=>'modal']),
        ]);
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'username',
            'password_hash',
            'email:email',
            'sgdn_rel_perfil_ID',
            'url_perfil:url',
            'dt_registo',
            'dt_updated',
            'estado',
            'status',
        ],
    ]) ?>

</div>

<?php
  Modal::end();
?>
