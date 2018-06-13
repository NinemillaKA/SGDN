<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrAvaliacaoTp */

$this->title = 'Update Sgdn Pr Avaliacao Tp: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pr Avaliacao Tps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sgdn-pr-avaliacao-tp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
