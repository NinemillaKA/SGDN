<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\sgdnPessoa */

$this->title = 'Update Pessoa: {'." ".$model->NOME." ".'}';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pessoas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sgdn-pessoa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelContatos' => $modelContatos,
        'modelDocumentos' => $modelDocumentos,
    ]) ?>

</div>
