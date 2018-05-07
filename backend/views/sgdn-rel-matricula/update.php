<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelMatricula */

$this->title = 'Update Sgdn Rel Matricula: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Matriculas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sgdn-rel-matricula-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
