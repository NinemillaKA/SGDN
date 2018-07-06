<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model backend\models\sgdnPessoa */

$this->title = $model->NOME;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pessoas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('view_detalhes_pessoa', [
    'model' => $model,
    'show_buttonOrLabel'=>true,
]) ?>

<?= $this->render('view_contacto_pessoa', [
    'model' => $model,
    'modelContatos' => $modelContatos,
    'modelDocumentos' => $modelDocumentos,
    'show_buttonOrLabel'=>true,
]) ?>
