<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
?>
<style>
</style>
<div class="row">
    <div class="col-md-8">

        <!-- list alojamentos -->
        <div class="row">
            <div class="col-md-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title" style="margin-top: 10px;margin-left: 10px;">Latest Members</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" style="background-color:#ecf0f547;">
                  <ul class="users-list clearfix" style="padding:0">
                      <?php foreach ($residencias as $residencia):?>

                        <div class="col-md-4">
                            <div class="box box-solid" style="margin-bottom:5px;">
                                <div class="box-body">
                                    <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 4px 7px; margin-top: 0;">
                                        <?=$residencia['DESIG']?>
                                    </h4>

                                    <?php echo Html::img('http://localhost/sgdn/backend/web/'.$residencia['URL_LOGO'], ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: 200px; width:100%; border: 1px solid #d9d9d9; padding: 4px;']); ?>
                                        <a href="" class="btn btn-primary btn-sm ad-click-event" style="width: 100%;margin-top: 5px;border-radius: unset;">
                                            LEARN MORE
                                        </a>
                                </div>
                            </div>
                        </div>
                      <?php endforeach;?>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center" style="height: 30px;margin-top: 10px;">
                  <a href="javascript:void(0)" class="uppercase">View All Users</a>
                </div>
                <!-- /.box-footer -->
              </div>
              </div>
        </div>
        <!-- list materiais -->
        <div class="row">
          <h3 style="text-align:left;">MATERIAIS</h3>
          <?php foreach ($materiais as $material):?>

            <div class="col-md-4">
                <div class="box box-solid">
                    <div class="box-body">
                        <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                            <?=$material['DESIG']?>
                        </h4>
                        <?php echo Html::img('http://localhost/sgdn/backend/web/'.$material['URL_LOGO'], ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: 200px; width:100%;border: 1px solid #d9d9d9; padding: 4px;']); ?>
                        <a href="#" class="btn btn-primary btn-sm ad-click-event" style="padding: 1.4% 30.4%;">
                            LEARN MORE
                        </a>
                    </div>
                </div>
            </div>
          <?php endforeach;?>
        </div>
        <!-- list aulas -->
        <div class="row">
          <h3 style="text-align:left;">AULAS</h3>
          <?php foreach ($aulas as $aula):?>

            <div class="col-md-4">
                <div class="box box-solid">
                    <div class="box-body">
                        <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                            <?=$aula->DESIG?>
                        </h4>
                        <?= Html::img('http://localhost/sgdn/backend/web/'.$aula->mODALIDADE->URL_IMAGEM, ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: 200px; width:100%;border: 1px solid #d9d9d9; padding: 4px;']); ?>
                        <a onclick="create('<?='sgdn-rel-matricula/create&id='.$aula->ID?>')"  href="#" class="btn btn-primary btn-sm ad-click-event" style="padding: 1.4% 30.4%;">
                            LEARN MORE                        </a>
                    </div>
                </div>
            </div>
          <?php endforeach;?>
        </div>
        <!-- list viagens -->
        <div class="row">
          <h3 style="text-align:left;">TRIPS</h3>
          <?php foreach ($trips as $trip):?>

            <div class="col-md-4">
                <div class="box box-solid">
                    <div class="box-body">
                        <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                            <?=$trip['DESIG']?>
                        </h4>
                        <?php echo Html::img('http://localhost/sgdn/backend/web/'.$trip['URL_IMAGEM'], ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: 200px; width:100%;border: 1px solid #d9d9d9; padding: 4px;']); ?>
                        <a href="#" class="btn btn-primary btn-sm ad-click-event" style="padding: 1.4% 30.4%;">
                            LEARN MORE
                        </a>
                    </div>
                </div>
            </div>
          <?php endforeach;?>
        </div>
    </div>

    <div class="col-md-4">
      <div class="row">
        <div class="info-box bg-red">
            <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Downloads</span>
              <span class="info-box-number">114,381</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
              <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>


    <!-- <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-info"></i> Alert! <-?php echo date("M-d-Y h:m:s",strtotime($modelAluguer->DT_DEVOLUCAO)); ?></h4>
         <! Info alert preview. This alert is dismissable. ->

        <h3>
            <!- Display the countdown timer in an element ->

            <p id="demo"></p>

            <script>
                var countDownDate = new Date("<-?php echo date("M-d-Y h:m:s",strtotime($model->HORA_INICIO)); ?> ");
                console.log(countDownDate);
                var x = setInterval(function() {

                  var finalDate = new Date().getTime();

                  // Find the distance between now an the count down date
                  var distance = countDownDate - finalDate;

                  // Time calculations for days, hours, minutes and seconds
                  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                  // Display the result in the element with id="demo"
                  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                  + minutes + "m " + seconds + "s ";

                  // If the count down is finished, write some text
                  if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";
                    //call Avaliations pages
                  }
                }, 1000);
            </script>
        </h3>
    </div> -->
</div>
<div id="hidden-content"></div>
