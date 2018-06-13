<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelAvaliacao */

$this->title = 'Update Sgdn Rel Avaliacao: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Avaliacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sgdn-rel-avaliacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
