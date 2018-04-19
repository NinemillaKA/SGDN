<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnEntidade */

$this->title = 'Update Sgdn Entidade:'.$model->DESIG;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Entidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sgdn-entidade-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelContatos' => $modelContatos,
        'modelDocumentos' => $modelDocumentos,
    ]) ?>

</div>
