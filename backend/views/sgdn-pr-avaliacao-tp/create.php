<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrAvaliacaoTp */

$this->title = 'Create Sgdn Pr Avaliacao Tp';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pr Avaliacao Tps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-pr-avaliacao-tp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
