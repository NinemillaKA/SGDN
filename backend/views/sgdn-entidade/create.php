<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SgdnEntidade */

$this->title = 'Criar Entidade';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Entidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-entidade-create">

    <!--h1><-?= Html::encode($this->title) ?></h1-->

    <?= $this->render('_form', [
        'model' => $model,
        'modelContatos' => $modelContatos,
        'modelDocumentos' => $modelDocumentos,
    ]) ?>

</div>
