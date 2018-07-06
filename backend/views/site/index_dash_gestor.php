<?php
  $this->title = 'Dashboard School';
  use backend\models\SgdnRelEntidadeSpot;
  use yii\web\View;
  use yii\helpers\Url;
  // use backend\models\SgdnRelAulaInstrutorModalidade;
  // use yii\helpers\Html;
  $this->registerJsFile(Yii::getAlias('@web').'/js/fullcalendar/lib/moment.min.js',['depends' => [\yii\web\JqueryAsset::className()],'position'=>View::POS_END]);
  $this->registerJsFile(Yii::getAlias('@web').'/js/fullcalendar/fullcalendar.js',['depends' => [\yii\web\JqueryAsset::className()],'position'=>View::POS_END]);
  $this->registerCssFile(Yii::getAlias('@web').'/js/fullcalendar/fullcalendar.css',['depends' => [\yii\web\JqueryAsset::className()],'position'=>View::POS_END]);

?>

<div class="site-index">

    <!-- <div class="jumbotron"> -->
    <div class="box box-widget">
      <div class="box-header with-border">

        <div class="body-content">

          <?php
            $active = SgdnRelEntidadeSpot::find()->where(['ESTADO'=>'A'])->count();
            $inactive = SgdnRelEntidadeSpot::find()->where(['ESTADO'=>'I'])->count();
            $tot =  $inactive + $active;

            $width = (100 * $active)/$tot;

            // echo "$width";
            // Yii::$app->end();
          ?>
          <div class="row">

            <div class="col-md-6">
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Inventory</span>
                  <span class="info-box-number"><?= SgdnRelEntidadeSpot::find()->where(['ESTADO'=>'A'])->count() ?> </span>

                  <div class="progress">
                    <div class="progress-bar" style="width: <?php echo $width ?>%"></div>
                  </div>
                  <span class="progress-description">
                        <span class="info-box-number"><?= SgdnRelEntidadeSpot::find()->where(['ESTADO'=>'I'])->count()?> </span>
                  </span>

                </div>
                <!-- /.info-box-content -->
              </div>

              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Mentions</span>
                  <span class="info-box-number">92,050</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 20%"></div>
                  </div>
                  <span class="progress-description">
                        20% Increase in 30 Days
                  </span>
                </div>
              <!-- /.info-box-content -->
              </div>

              <!-- USERS LIST -->
              <?php
                // $instructorCounter = SgdnRelAulaInstrutorModalidade::find()->where(['AULA_ID' => $model->ID])->count();
                // $modelAulaInstrutorModalidade = SgdnRelAulaInstrutorModalidade::find()->where(['AULA_ID' => $model->ID])->all();
              ?>
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Instrutores da Escola</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger"><?php echo $instructorCounter?> Members</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" style="">
                  <ul class="users-list clearfix">
                      <?php foreach ($instrutores as $key => $instrutor) {
                          if (count($instrutor->sgdnRelInstrutorModalidades) <= 0)
                            continue;
                      ?>

                      <li>
                        <img src="<?= $instrutor->pESSOA->URL_FOTO ?>" alt="User Image" style="width: 50px; height: 50px;">
                        <a class="users-list-name" href="#"><?= $instrutor->pESSOA->NOME ?></a>
                        <!-- <span class="users-list-date"><-?= $instrutor->DT_REGISTO ?></span> -->
                        <?php
                              $newDate = date("d-M-Y", strtotime($instrutor->DT_REGISTO ));
                        ?>
                      <span class="users-list-date"><?= $newDate?></span>
                    </li>

                      <?php } ?>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center" style="">
                  <a href="javascript:void(0)" class="uppercase">View All Users</a>
                </div>

                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>

            <div class="col-md-6">

              <div id="calendar">

              </div>

              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Members</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-warning"><?php echo $alunosCounter?> New Members</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" style="">
                  <ul class="users-list clearfix">
                      <?php foreach ($alunos as $key => $aluno) {
                          // if (count($alunos->sgdnRelInstrutorModalidades) <= 0)
                          //   continue;
                      ?>

                      <li>
                        <img src="<?= $aluno->aLUNO->URL_FOTO ?>" alt="User Image" style="width: 50px; height: 50px;">
                        <a class="users-list-name" href="#"><?= $aluno->aLUNO->NOME ?>
                          <?php
                                $newDate = date("d-M-Y", strtotime($aluno->aLUNO->DT_REGISTO ));
                          ?>
                        <span class="users-list-date"><?= $newDate?></span>
                      </li>
                      <?php } ?>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center" style="">
                  <a href="javascript:void(0)" class="uppercase">View All Users</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
            </div>
          <!-- ./col -->
          </div>
      </div>

            </div>

            <!--row-->
          </div>

        </div>
      </div>
    </div>
</div>
<?=$this->registerJs(
    "
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    $.getJSON( '".Url::to(['geteventoscalendar'])."', function( data ) {

      $('#calendar').fullCalendar({
        header    : {
          left  : 'prev,next today',
          center: 'title',
          right : 'month,agendaWeek,agendaDay'
        },
        buttonText: {
          today: 'today',
          month: 'month',
          week : 'week',
          day  : 'day'
        },
        //Random default events
        events    : [data],
        editable  : true,
        droppable : true, // this allows things to be dropped onto the calendar !!!
        drop      : function (date, allDay) { // this function is called when something is dropped

          // retrieve the dropped element's stored Event Object
          var originalEventObject = $(this).data('eventObject')

          // we need to copy it, so that multiple events don't have a reference to the same object
          var copiedEventObject = $.extend({}, originalEventObject)

          // assign it the date that was reported
          copiedEventObject.start           = date
          copiedEventObject.allDay          = allDay
          copiedEventObject.backgroundColor = $(this).css('background-color')
          copiedEventObject.borderColor     = $(this).css('border-color')

          // render the event on the calendar

          $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)


          if ($('#drop-remove').is(':checked')) {
            $(this).remove()
          }

        }
      })
     });


    ",
    View::POS_READY,
    'my-button-handler'
);?>
