<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->registerJsFile(Yii::getAlias('@web').'/js/plugins/bootstrap/bootstrap-treeview.js',['depends' => [\yii\web\JqueryAsset::className()],'position'=>$this::POS_HEAD]);
$this->registerCssFile(Yii::getAlias('@web').'/css/bootstrap/bootstrap-treeview.css',['depends' => [\yii\web\JqueryAsset::className()],'position'=>$this::POS_HEAD]);


/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelPerfil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-rel-perfil-form">

    <?php $form = ActiveForm::begin(['id'=>'sgdn-rel-perfil-form', 'options'=>['class'=>'']]); ?>

    <!-- <-?= $form->field($model, 'ID')->textInput(['maxlength' => true]) ?>

    <-?= $form->field($model, 'USER_ID')->textInput() ?>

    <-?= $form->field($model, 'DESIG')->textInput(['maxlength' => true]) ?>

    <-?= $form->field($model, 'DESCR')->textInput(['maxlength' => true]) ?>

    <-?= $form->field($model, 'ESTADO')->textInput(['maxlength' => true]) ?>

    <-?= $form->field($model, 'DT_REGISTO')->textInput() ?>

    <-?= $form->field($model, 'DT_UPDATE')->textInput() ?>

    <div class="form-group">
        <-?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div> -->

<div class="row">
    <div class="col-md-6">
          <div class="form-group">
              <label class="control-label"><?=$model->getAttributeLabel('DESIG')?></label>
              <?= $form->field($model, 'DESIG')->textInput(['maxlength' => true, 'class'=>'form-control'])->label(false) ?>
          </div>
          <div class="form-group">
              <label class="control-label"><?=$model->getAttributeLabel('DESCR')?></label>
              <?= $form->field($model, 'DESCR')->textInput(['maxlength' => true, 'class'=>'form-control'])->label(false) ?>
          </div>
          <?php if(!$model->isNewRecord):?>
          <div class="form-group">
              <label class="control-label"><?=$model->getAttributeLabel('ESTADO')?></label>
              <?= $form->field($model, 'ESTADO')->dropDownList(['A'=>Yii::t('app', 'Enabled'),'I'=>Yii::t('app', 'Disabled')],['prompt' => Yii::t('app', '-- Select a State --'), 'class'=>'form-control select'])->label(false)?>
          </div>
          <?php endif;?>
  </div>
  <div class="col-md-6">
         <label class="col-md-12 pull-left"><?=Yii::t('app', 'Permissions')?>:</label>
     <span id="_permissoes" class="treeview col-md-12">
              <ul class="list-group">
              </ul>
           </span>
      </div>
      <div id="ckecked_permissions">
      </div>
</div>

<?php
  if(!$model->isNewRecord)
  {
    echo $form->field($model,'ID')->hiddenInput()->label(false);
  }
?>

    <?php ActiveForm::end(); ?>

</div>

<script>
function setPermissionsSelected()
{
	$("#ckecked_permissions").html('');
	$('.node-checked').each(function(i, obj) {
		var permissao_id = $($(obj).children().last()).val();
		$("#ckecked_permissions").append('<input type="hidden" value="'+permissao_id+'" name="cheched_permissions[]"\>')
	});
}

$(document).ready(function(){
	$('#sgdn-rel-perfil-form').on('afterValidate', function (event, attribute, messages, deferreds) {
		$('#_permissoes').treeview('expandAll', {silent: true });
		setPermissionsSelected();
		return true;
	});

	if( $('#sgdnrelperfil-id').length )
	{
		var id = $('#sgdn-rel-perfil-id').val();
	}else{
		var id = null;
	}

	$.post(
		'<?=Url::to(['sgdn-menu/get-permissions'])?>',
		{id_perfil: id},
		function(res){
			var $tree = $('#_permissoes').treeview({
				data: res,
				multiSelect:true,
				showCheckbox:true,
				levels: 5,
			});

			$tree.on('nodeChecked ', function(ev, node) {
				for(var i in node.nodes) {
					var child = node.nodes[i];
					$(this).treeview(true).checkNode(child.nodeId);
				}
			}).on('nodeUnchecked ', function(ev, node) {
				for(var i in node.nodes) {
					var child = node.nodes[i];
					$(this).treeview(true).uncheckNode(child.nodeId);
				}
			});
			}
	);

	});
</script>
