<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelPrecario */

$this->title = 'Create Sgdn Rel Precario';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Precarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-rel-precario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
