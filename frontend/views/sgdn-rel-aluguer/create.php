<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\sgdnPessoa */

// $this->title = 'Create Sgdn Pessoa';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel aluguer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-rel-aluguer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelsSgdnRelAluger' => $modelsSgdnRelAluger,
    ]) ?>

</div>
