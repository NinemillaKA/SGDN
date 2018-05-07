<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelAula */

$this->title = 'Create Sgdn Rel Aula';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Aulas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
  Modal::begin([
    'id' => 'create-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Registar Aula</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-rel-aula-form").submit();', 'class' => 'btn btn-flat btn-primary']),
  ]);
?>

<div class="sgdn-rel-aula-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelAulaInstrutorModalidade' => $modelAulaInstrutorModalidade,
    ]) ?>

</div>
<?php
  Modal::end();
?>
