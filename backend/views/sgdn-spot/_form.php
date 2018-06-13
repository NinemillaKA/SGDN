<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\GlbGeografia;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;
use dosamigos\google\maps\services\DirectionsClient;
/* @var $this yii\web\View */
/* @var $model backend\models\SgdnSpot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-spot-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Informacoes Primordiais </h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="col-md-4">
                        <?= $form->field($model, 'CODIGO')->textInput(['maxlength' => true, 'disabled' => true]) ?>
                    </div>

                    <div class="col-md-10">
                        <?= $form->field($model, 'DESIG')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($model, 'DESCR')->textArea(['id'=>'idObservacao','placeholder' => 'Enter Descrição...','rows'=> '4', 'maxlength' => true])->label('Descrição') ?>
                    </div>

                    <div class="col-md-4">
                      <?php if(!$model->isNewRecord){
                            echo $form->field($model, 'ESTADO')->dropDownList(["A"=>"ACTIVO", "I"=>"INACTIVO"],['prompt' =>'*** ESTADO ***', 'class'=>'form-control']);
                            }
                       ?>
                    </div>

                </div>
                <div class="col-md-4">
                    <?php $img = ($model) ? '../../'.$model->URL_IMAGEM : '#' ; ?>
                    <div class="upload text-center" style="background: #f4f7fa; height: 210px; overflow: hidden; ">
                        <?php echo Html::img('@web/'.$model->URL_IMAGEM, ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: inherit !important;']); ?>
                        <div id="papelFundo">
                           <br><br><br><br>
                            <i class="fa fa-upload" id='upload'></i><br>
                           <span id="ecrevCriv">Carregar Imagen (233x216)</span>
                        </div>
                        <i class="fa fa-trash" style="background: #fff; border-radius: 4px;" id="trashd"></i>
                    </div>
                    <?= $form->field($model, 'file')->fileInput(['onchange'=>'readURL(this)','id'=>"file",'accept' => 'image/*', 'class'=>'btn btn-default btn-block']) ?>
                </div>
            </div>
        </div>
   </div>

   <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Endereço</h3>
        </div>
            <div class="row">
                <div class="box-body">
                    <div class="col-md-12">
                    <?php if(!$model->isNewRecord){
                                  $freguesia = $model->gEOGRAFIA->FREGUESIA;
                                  $conselho = $model->gEOGRAFIA->CONCELHO;
                                  $ilha = $model->gEOGRAFIA->ILHA;
                             ?>
                                 <div class="col-md-3">
                                     <label>Ilha</label>
                                     <?= Html::dropDownList('LOCALIDADE_ID_ilha', $ilha, ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE'=>'2','PAIS'=>'238'])->all(),'ID','NOME'),['prompt'=>'*** Ilha ***','Onchange'=>'getListConselho(this.value);','id'=>'selectIlha', 'class'=>'form-control']) ?>
                                 </div>
                                 <div class="col-md-3">
                                     <label>Concelho</label>
                                     <?= Html::dropDownList('LOCALIDADE_ID_conselho', $conselho, ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE' => '3','PAIS'=>'238','ILHA'=>$ilha])->all(),'ID','NOME'),['prompt'=>'*** Concelho ***','Onchange'=>'getListFreguesia(this.value);','id'=>'selectConcelho', 'class'=>'form-control']) ?>
                                 </div>
                                 <div class="col-md-3">
                                     <label>Freguesia</label>
                                     <?= Html::dropDownList('LOCALIDADE_ID_freguesia', $freguesia, ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE' => '4','PAIS'=>'238','CONCELHO'=>$conselho])->all(),'ID','NOME'),['prompt'=>'*** Freguesia ***','Onchange'=>'getListZona(this.value);','id'=>'selectFreguesia', 'class'=>'form-control']) ?>
                                 </div>
                                 <div class="col-md-3">
                                     <?= $form->field($model, 'GEOGRAFIA_ID')->label('Zona')->dropDownList(ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE'=>'5','PAIS'=>'238','FREGUESIA'=>$freguesia])->all(),'ID','NOME'),['prompt'=>'*** Zona ***'])?>
                                 </div>
                     <?php }else{ ?>
                                 <div class="col-md-6">
                                   <?= Html::dropDownList('LOCALIDADE_ID_ilha','', ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE'=>'2','PAIS'=>'238'])->all(),'ID','NOME'),
                                                         ['prompt'=>'*** Ilha ***','Onchange'=>'getListConselho(this.value);','id'=>'selectIlha', 'class'=>'form-control'])?>
                                   <?= Html::dropDownList('LOCALIDADE_ID_conselho','',[],['prompt'=>'*** Concelho ***','Onchange'=>'getListFreguesia(this.value);','id'=>'selectConcelho', 'class'=>'form-control']) ?>
                                 </div>
                                 <div class="col-md-6">
                                   <?= Html::dropDownList('LOCALIDADE_ID_freguesia','',[],['prompt'=>'*** Freguesia ***','Onchange'=>'getListZona(this.value);','id'=>'selectFreguesia', 'class'=>'form-control']) ?>
                                   <?= $form->field($model, 'GEOGRAFIA_ID')->dropDownList((!$model->ID) ? [] : ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE'=>'5','PAIS'=>'238'])->all(),'ID','NOME'),['prompt' =>'*** Zona ***', 'class'=>'form-control'])->label(false) ?>
                                   <!-- <-?= $form->field($model, 'GEOGRAFIA_ID')->dropDownList((!$model->ID) ? [] : ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE'=>'5','PAIS'=>'238'])->all(),'ID','NOME'),['prompt' =>'*** Zona ***', 'class'=>'form-control'])->label(false) ?> -->
                                 </div>

                                 <div class="box box-widget">

                                         <div class="box-body">

                                             <div id="gmap0-map-canvas" style="width:100%">
                                                 <?php
                                                       // $coord = new LatLng(['lat' => 39.720089311812094, 'lng' => 2.91165944519042]);
                                                       // -23.757389
                                                       $coord = new LatLng(['lat' => 15.265812, 'lng' => -23.757389]);
                                                       $map = new Map([
                                                       'center' => $coord,
                                                       'zoom' => 14,
                                                       'width'=>'100%',
                                                       ]);

                                                       // lets use the directions renderer
                                                       // $home = new LatLng(['lat' => 39.720991014764536, 'lng' => 2.911801719665541]);
                                                       $home = new LatLng(['lat' => 15.265812, 'lng' => -23.757389]);
                                                       // $school = new LatLng(['lat' => 39.719456079114956, 'lng' => 2.8979293346405166]);
                                                       $school = new LatLng(['lat' => 15.265812, 'lng' => -23.757389]);
                                                       $santo_domingo = new LatLng(['lat' => 39.72118906848983, 'lng' => 2.907628202438368]);
                                                       // $santo_domingo = new LatLng(['lat' => 15.265812, 'lng' => -23.757389]);

                                                       // setup just one waypoint (Google allows a max of 8)
                                                       $waypoints = [
                                                       new DirectionsWayPoint(['location' => $santo_domingo])
                                                       ];

                                                       $directionsRequest = new DirectionsRequest([
                                                       'origin' => $home,
                                                       'destination' => $school,
                                                       'waypoints' => $waypoints,
                                                       'travelMode' => TravelMode::DRIVING
                                                       ]);

                                                       // Lets configure the polyline that renders the direction
                                                       $polylineOptions = new PolylineOptions([
                                                       'strokeColor' => '#FFAA00',
                                                       'draggable' => true
                                                       ]);

                                                       // Now the renderer
                                                       $directionsRenderer = new DirectionsRenderer([
                                                       'map' => $map->getName(),
                                                       'polylineOptions' => $polylineOptions
                                                       ]);

                                                       // Finally the directions service
                                                       $directionsService = new DirectionsService([
                                                       'directionsRenderer' => $directionsRenderer,
                                                       'directionsRequest' => $directionsRequest
                                                       ]);

                                                       // Thats it, append the resulting script to the map
                                                       $map->appendScript($directionsService->getJs());

                                                       // Lets add a marker now
                                                       $marker = new Marker([
                                                       'position' => $coord,
                                                       'title' => 'Txira Surf Spot',
                                                       ]);

                                                       // Provide a shared InfoWindow to the marker
                                                       $marker->attachInfoWindow(
                                                       new InfoWindow([
                                                           'content' => '<p>Pico Txira</p>' //model->DESIG
                                                       ])
                                                       );

                                                       // Add marker to the map
                                                       $map->addOverlay($marker);

                                                       // Now lets write a polygon
                                                       // $coords = [
                                                       // new LatLng(['lat' => 25.774252, 'lng' => -80.190262]),
                                                       // new LatLng(['lat' => 18.466465, 'lng' => -66.118292]),
                                                       // new LatLng(['lat' => 32.321384, 'lng' => -64.75737]),
                                                       // new LatLng(['lat' => 25.774252, 'lng' => -80.190262])
                                                       // ];

                                                       $coords = [
                                                       new LatLng(['lat' => 15.265812, 'lng' => -23.757389]),
                                                       new LatLng(['lat' => 15.265812, 'lng' => -23.757389]),
                                                       new LatLng(['lat' => 15.265812, 'lng' => -23.757389]),
                                                       new LatLng(['lat' => 15.265812, 'lng' => -23.757389])
                                                       ];

                                                       $polygon = new Polygon([
                                                       'paths' => $coords
                                                       ]);

                                                       // Add a shared info window
                                                       $polygon->attachInfoWindow(new InfoWindow([
                                                           'content' => '<p>Txira Surf Spot</p>'
                                                       ]));

                                                       // Add it now to the map
                                                       // $map->addOverlay($polygon);


                                                       // Lets show the BicyclingLayer :)
                                                       $bikeLayer = new BicyclingLayer(['map' => $map->getName()]);

                                                       // Append its resulting script
                                                       $map->appendScript($bikeLayer->getJs());

                                                       // Display the map -finally :)
                                                       echo $map->display();

                                                       $direction = new DirectionsClient([
                                                           'params' => [
                                                               'language' => Yii::$app->language,
                                                               'origin' => 'street from',
                                                               'destination' => 'street to'
                                                           ]
                                                       ]);

                                                       $data = $direction->lookup(); //get data from google.maps API

                                                 ?>
                                             </div>

                                         </div>
                                     <!-- </div> -->
                                 </div>


                     <?php } ?>
                          <div class="col-md-12">
                              <?= $form->field($model, 'ENDERECO')->textArea(['id'=>'idObservacao','placeholder' => 'Enter Description da localização','rows'=> '3', 'maxlength' => true])->label(false) ?>
                          </div>
                       </div>
                </div>
          </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#blah').attr('src', e.target.result);
                  $('#upload').hide();
                  $('#papelFundo').show();
                  $('#ecrevCriv').hide();
                  $('#trashd').show();
                  $('#trashd').hover($('#trashd').css('cursor','pointer'));
                  $('#papelFundo').css('opacity',0.5);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }
  </script>

<script type="text/javascript">

    function getListConselho(id) {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                if (xmlhttp.responseText !== '<option> ------ </option>') {
                    document.getElementById("selectConcelho").innerHTML = xmlhttp.responseText;
                    document.getElementById("igtentidadeigt-localidade_id").innerHTML ='<option value>--- Zona ---</option>';
                }
            }
        };
        var URL = "<?php echo Yii::$app->request->hostInfo.Yii::$app->request->baseURL ?>/index.php?r=sgdn-spot/droplist-conselho&id=" + id;
        xmlhttp.open("GET", URL, true);
        xmlhttp.send();
    }

    function getListFreguesia(id) {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                if (xmlhttp.responseText !== '<option> ------ </option>') {
                    document.getElementById("selectFreguesia").innerHTML = xmlhttp.responseText;
                    document.getElementById("igtentidadeigt-localidade_id").innerHTML = '<option value>*** Zona ***</option>';
                }
            }
        };
        var URL = "<?php echo Yii::$app->request->hostInfo.Yii::$app->request->baseURL ?>/index.php?r=sgdn-spot/droplist-freguesia&id=" + id;
        xmlhttp.open("GET", URL, true);
        xmlhttp.send();
    }
    function getListZona(id) {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                if (xmlhttp.responseText !== '<option> ------ </option>') {
                    document.getElementById("sgdnspot-geografia_id").innerHTML = xmlhttp.responseText;
                }
            }
        };
        var URL = "<?php echo Yii::$app->request->hostInfo.Yii::$app->request->baseURL ?>/index.php?r=sgdn-spot/droplist-zona&id=" + id;
        xmlhttp.open("GET", URL, true);
        xmlhttp.send();
    }

</script>
