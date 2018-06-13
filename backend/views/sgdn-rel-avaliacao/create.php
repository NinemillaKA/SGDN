<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelAvaliacao */

$this->title = 'Create Sgdn Rel Avaliacao';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Avaliacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-rel-avaliacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
