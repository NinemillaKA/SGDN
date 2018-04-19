<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelPrecario */

$this->title = 'Update Sgdn Rel Precario: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Precarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sgdn-rel-precario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
