<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelMatricula */

$this->title = 'Create Sgdn Rel Matricula';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Matriculas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-rel-matricula-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
