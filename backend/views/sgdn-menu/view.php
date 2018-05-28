<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnMenu */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-menu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'ID',
            'DESIG',
            'DESCR',
            'CONTROLLER',
            [
                'attribute'=>'ESTADO',
                'value'=>function($model){return ($model->ESTADO == 'A')?'Activo':'Inactivo';},
            ],
            'DT_REGISTO',
            'DT_UPDATE',
            'ACTION',
        ],
    ]) ?>

</div>
