<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SgdnMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Sgdn Menus';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php foreach ($aulas as $aula):?>
      <div class="col-md-3">
          <div class="box box-solid">
              <div class="box-body">
                  <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 4px 7px; margin-top: 0;">
                      <?=$aula['DESIG']?>
                  </h4>

                  <!-- <-?php echo Html::img('http://localhost/sgdn/backend/web/'.$aula['URL_LOGO'], ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: 200px; width:100%; border: 1px solid #d9d9d9; padding: 4px;']); ?> -->
                      <a href="#" class="btn-primary pull-center btn-sm ad-click-event" style="padding: 1.4% 33.4%; align: center;">
                          LEARN MORE
                      </a>
              </div>
              <br>
          </div>
      </div>
<?php endforeach;?>
