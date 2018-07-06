<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelMatricula */

$this->title = 'Create Sgdn Rel Matricula';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Matriculas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- sgdn-rel-matricula-form -->
<?php
  Modal::begin([
    'id' => 'create-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Registar Matricula</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-rel-matricula-form").submit();', 'class' => 'btn btn-flat btn-primary']),
  ]);
?>

<div class="sgdn-rel-matricula-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_aula' => $model_aula,
    ]) ?>

</div>
<?php
  Modal::end();
?>
