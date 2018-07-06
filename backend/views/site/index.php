

<?php
/* @var $this yii\web\View */
use backend\models\SgdnViagen;
use backend\models\SgdnRelAluguer;

$this->title = 'SGDN Application';
?>
<div class="site-index">

    <!-- <div class="jumbotron"> -->
    <div class="box box-widget">
        <div class="box-header with-border">

          <div class="body-content">

              <div class="row">
                  <div class="col-md-4">
                      <div class="box box-success">

                        <div class="box-header with-border">
                            <h3 class="box-title">Lending Report</h3>

                            <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body no-padding" style="">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="ion ion-ios-gear-outline"></i></span>

                                <div class="info-box-content">
                                  <!-- <span class="info-box-text">CPU Traffic</span> -->
                                  <span class="info-box-number"><h1><?= SgdnViagen::find()->where(['ESTADO'=>'A'])->count() ?></h1></span>
                                </div>
                                <!-- /.info-box-content -->
                               </div>
                              </div>
                              <div class="col-md-6">
                                <!-- /.info-box -->
                                <div class="info-box">
                                  <span class="info-box-icon bg-red"><iclass="fa fa-google-plus"></i></span>

                                  <div class="info-box-content">
                                    <!-- <span class="info-box-text">Likes</span> -->
                                    <span class="info-box-number"><h1><?= SgdnViagen::find()->where(['ESTADO'=>'I'])->count() ?></h1></span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>
                              </div>
                          </div>
                        <!-- /.info-box -->
                          <div class="box box-solid bg-green-gradient">
                              <div class="box-header ui-sortable-handle" style="cursor: move;">
                                  <i class="fa fa-calendar"></i>

                                  <h3 class="box-title">Calendar</h3>
                                  <!-- tools box -->
                                  <div class="pull-right box-tools">
                                    <!-- button with a dropdown -->
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-bars"></i></button>
                                      <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Add new event</a></li>
                                        <li><a href="#">Clear events</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">View calendar</a></li>
                                      </ul>
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                                    </button>
                                  </div>
                                  <!-- /. tools -->
                              </div>
                              <!-- /.box-header -->
                              <div class="box-body no-padding">
                                  <!--The calendar -->
                                  <div id="calendar" style="width: 100%"><div class="datepicker datepicker-inline"><div class="datepicker-days" style=""><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">June 2018</th><th class="next">»</th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td class="old day" data-date="1527379200000">27</td><td class="old day" data-date="1527465600000">28</td><td class="old day" data-date="1527552000000">29</td><td class="old day" data-date="1527638400000">30</td><td class="old day" data-date="1527724800000">31</td><td class="day" data-date="1527811200000">1</td><td class="day" data-date="1527897600000">2</td></tr><tr><td class="day" data-date="1527984000000">3</td><td class="day" data-date="1528070400000">4</td><td class="day" data-date="1528156800000">5</td><td class="day" data-date="1528243200000">6</td><td class="day" data-date="1528329600000">7</td><td class="day" data-date="1528416000000">8</td><td class="day" data-date="1528502400000">9</td></tr><tr><td class="day" data-date="1528588800000">10</td><td class="day" data-date="1528675200000">11</td><td class="day" data-date="1528761600000">12</td><td class="day" data-date="1528848000000">13</td><td class="day" data-date="1528934400000">14</td><td class="day" data-date="1529020800000">15</td><td class="day" data-date="1529107200000">16</td></tr><tr><td class="day" data-date="1529193600000">17</td><td class="day" data-date="1529280000000">18</td><td class="day" data-date="1529366400000">19</td><td class="day" data-date="1529452800000">20</td><td class="day" data-date="1529539200000">21</td><td class="day" data-date="1529625600000">22</td><td class="day" data-date="1529712000000">23</td></tr><tr><td class="day" data-date="1529798400000">24</td><td class="day" data-date="1529884800000">25</td><td class="day" data-date="1529971200000">26</td><td class="day" data-date="1530057600000">27</td><td class="day" data-date="1530144000000">28</td><td class="day" data-date="1530230400000">29</td><td class="day" data-date="1530316800000">30</td></tr><tr><td class="new day" data-date="1530403200000">1</td><td class="new day" data-date="1530489600000">2</td><td class="new day" data-date="1530576000000">3</td><td class="new day" data-date="1530662400000">4</td><td class="new day" data-date="1530748800000">5</td><td class="new day" data-date="1530835200000">6</td><td class="new day" data-date="1530921600000">7</td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">2018</th><th class="next">»</th></tr></thead><tbody><tr><td colspan="7"><span class="month">Jan</span><span class="month">Feb</span><span class="month">Mar</span><span class="month">Apr</span><span class="month">May</span><span class="month focused">Jun</span><span class="month">Jul</span><span class="month">Aug</span><span class="month">Sep</span><span class="month">Oct</span><span class="month">Nov</span><span class="month">Dec</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">2010-2019</th><th class="next">»</th></tr></thead><tbody><tr><td colspan="7"><span class="year old">2009</span><span class="year">2010</span><span class="year">2011</span><span class="year">2012</span><span class="year">2013</span><span class="year">2014</span><span class="year">2015</span><span class="year">2016</span><span class="year">2017</span><span class="year focused">2018</span><span class="year">2019</span><span class="year new">2020</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-decades" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">2000-2090</th><th class="next">»</th></tr></thead><tbody><tr><td colspan="7"><span class="decade old">1990</span><span class="decade">2000</span><span class="decade focused">2010</span><span class="decade">2020</span><span class="decade">2030</span><span class="decade">2040</span><span class="decade">2050</span><span class="decade">2060</span><span class="decade">2070</span><span class="decade">2080</span><span class="decade">2090</span><span class="decade new">2100</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-centuries" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">2000-2900</th><th class="next">»</th></tr></thead><tbody><tr><td colspan="7"><span class="century old">1900</span><span class="century focused">2000</span><span class="century">2100</span><span class="century">2200</span><span class="century">2300</span><span class="century">2400</span><span class="century">2500</span><span class="century">2600</span><span class="century">2700</span><span class="century">2800</span><span class="century">2900</span><span class="century new">3000</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div></div></div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer text-black">
                                    <div class="row">
                                        <div class="col-sm-6">
                                          <!-- Progress bars -->
                                          <div class="clearfix">
                                            <span class="pull-left">Task #1</span>
                                            <small class="pull-right">90%</small>
                                          </div>
                                          <div class="progress xs">
                                            <div class="progress-bar progress-bar-success" style="width: 90%;"></div>
                                          </div>

                                          <div class="clearfix">
                                            <span class="pull-left">Task #2</span>
                                            <small class="pull-right">70%</small>
                                          </div>
                                          <div class="progress xs">
                                            <div class="progress-bar progress-bar-success" style="width: 70%;"></div>
                                          </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6">
                                          <div class="clearfix">
                                            <span class="pull-left">Task #3</span>
                                            <small class="pull-right">60%</small>
                                          </div>
                                          <div class="progress xs">
                                            <div class="progress-bar progress-bar-success" style="width: 60%;"></div>
                                          </div>

                                          <div class="clearfix">
                                            <span class="pull-left">Task #4</span>
                                            <small class="pull-right">40%</small>
                                          </div>
                                          <div class="progress xs">
                                            <div class="progress-bar progress-bar-success" style="width: 40%;"></div>
                                          </div>
                                        </div>
                                        <!-- /.col -->
                                      </div>
                                      <!-- /.row -->
                                </div>
                          </div>
                        </div>
                      <!-- ./col -->
                      </div>
                  </div>

                  <div class="col-md-4">
                      <div class="box box-success">

                        <div class="box-header with-border">
                            <h3 class="box-title">Lending Report</h3>

                            <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body no-padding" style="">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="ion ion-ios-gear-outline"></i></span>

                                <div class="info-box-content">
                                  <!-- <span class="info-box-text">CPU Traffic</span> -->
                                  <span class="info-box-number"><h1><?= SgdnRelAluguer::find()->where(['ESTADO'=>'A'])->count()?></h1></span>
                                </div>
                                <!-- /.info-box-content -->
                               </div>
                              </div>
                              <div class="col-md-6">
                                <!-- /.info-box -->
                                <div class="info-box">
                                  <span class="info-box-icon bg-blue"><i class="fa fa-google-plus"></i></span>

                                  <div class="info-box-content">
                                    <!-- <span class="info-box-text">Likes</span> -->
                                    <span class="info-box-number"><h1><?= SgdnRelAluguer::find()->where(['ESTADO'=>'I'])->count()?></h1></span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>
                              </div>
                          </div>
                        <!-- /.info-box -->
                          <div class="box box-solid bg-green-gradient">
                              <div class="box-header ui-sortable-handle" style="cursor: move;">
                                  <i class="fa fa-calendar"></i>

                                  <h3 class="box-title">Calendar</h3>
                                  <!-- tools box -->
                                  <div class="pull-right box-tools">
                                    <!-- button with a dropdown -->
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-bars"></i></button>
                                      <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Add new event</a></li>
                                        <li><a href="#">Clear events</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">View calendar</a></li>
                                      </ul>
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                                    </button>
                                  </div>
                                  <!-- /. tools -->
                              </div>
                              <!-- /.box-header -->
                              <div class="box-body no-padding">
                                  <!--The calendar -->
                                  <div id="calendar" style="width: 100%"><div class="datepicker datepicker-inline"><div class="datepicker-days" style=""><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">June 2018</th><th class="next">»</th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td class="old day" data-date="1527379200000">27</td><td class="old day" data-date="1527465600000">28</td><td class="old day" data-date="1527552000000">29</td><td class="old day" data-date="1527638400000">30</td><td class="old day" data-date="1527724800000">31</td><td class="day" data-date="1527811200000">1</td><td class="day" data-date="1527897600000">2</td></tr><tr><td class="day" data-date="1527984000000">3</td><td class="day" data-date="1528070400000">4</td><td class="day" data-date="1528156800000">5</td><td class="day" data-date="1528243200000">6</td><td class="day" data-date="1528329600000">7</td><td class="day" data-date="1528416000000">8</td><td class="day" data-date="1528502400000">9</td></tr><tr><td class="day" data-date="1528588800000">10</td><td class="day" data-date="1528675200000">11</td><td class="day" data-date="1528761600000">12</td><td class="day" data-date="1528848000000">13</td><td class="day" data-date="1528934400000">14</td><td class="day" data-date="1529020800000">15</td><td class="day" data-date="1529107200000">16</td></tr><tr><td class="day" data-date="1529193600000">17</td><td class="day" data-date="1529280000000">18</td><td class="day" data-date="1529366400000">19</td><td class="day" data-date="1529452800000">20</td><td class="day" data-date="1529539200000">21</td><td class="day" data-date="1529625600000">22</td><td class="day" data-date="1529712000000">23</td></tr><tr><td class="day" data-date="1529798400000">24</td><td class="day" data-date="1529884800000">25</td><td class="day" data-date="1529971200000">26</td><td class="day" data-date="1530057600000">27</td><td class="day" data-date="1530144000000">28</td><td class="day" data-date="1530230400000">29</td><td class="day" data-date="1530316800000">30</td></tr><tr><td class="new day" data-date="1530403200000">1</td><td class="new day" data-date="1530489600000">2</td><td class="new day" data-date="1530576000000">3</td><td class="new day" data-date="1530662400000">4</td><td class="new day" data-date="1530748800000">5</td><td class="new day" data-date="1530835200000">6</td><td class="new day" data-date="1530921600000">7</td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">2018</th><th class="next">»</th></tr></thead><tbody><tr><td colspan="7"><span class="month">Jan</span><span class="month">Feb</span><span class="month">Mar</span><span class="month">Apr</span><span class="month">May</span><span class="month focused">Jun</span><span class="month">Jul</span><span class="month">Aug</span><span class="month">Sep</span><span class="month">Oct</span><span class="month">Nov</span><span class="month">Dec</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">2010-2019</th><th class="next">»</th></tr></thead><tbody><tr><td colspan="7"><span class="year old">2009</span><span class="year">2010</span><span class="year">2011</span><span class="year">2012</span><span class="year">2013</span><span class="year">2014</span><span class="year">2015</span><span class="year">2016</span><span class="year">2017</span><span class="year focused">2018</span><span class="year">2019</span><span class="year new">2020</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-decades" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">2000-2090</th><th class="next">»</th></tr></thead><tbody><tr><td colspan="7"><span class="decade old">1990</span><span class="decade">2000</span><span class="decade focused">2010</span><span class="decade">2020</span><span class="decade">2030</span><span class="decade">2040</span><span class="decade">2050</span><span class="decade">2060</span><span class="decade">2070</span><span class="decade">2080</span><span class="decade">2090</span><span class="decade new">2100</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-centuries" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">2000-2900</th><th class="next">»</th></tr></thead><tbody><tr><td colspan="7"><span class="century old">1900</span><span class="century focused">2000</span><span class="century">2100</span><span class="century">2200</span><span class="century">2300</span><span class="century">2400</span><span class="century">2500</span><span class="century">2600</span><span class="century">2700</span><span class="century">2800</span><span class="century">2900</span><span class="century new">3000</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div></div></div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer text-black">
                                    <div class="row">
                                        <div class="col-sm-6">
                                          <!-- Progress bars -->
                                          <div class="clearfix">
                                            <span class="pull-left">Task #1</span>
                                            <small class="pull-right">90%</small>
                                          </div>
                                          <div class="progress xs">
                                            <div class="progress-bar progress-bar-success" style="width: 90%;"></div>
                                          </div>

                                          <div class="clearfix">
                                            <span class="pull-left">Task #2</span>
                                            <small class="pull-right">70%</small>
                                          </div>
                                          <div class="progress xs">
                                            <div class="progress-bar progress-bar-success" style="width: 70%;"></div>
                                          </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6">
                                          <div class="clearfix">
                                            <span class="pull-left">Task #3</span>
                                            <small class="pull-right">60%</small>
                                          </div>
                                          <div class="progress xs">
                                            <div class="progress-bar progress-bar-success" style="width: 60%;"></div>
                                          </div>

                                          <div class="clearfix">
                                            <span class="pull-left">Task #4</span>
                                            <small class="pull-right">40%</small>
                                          </div>
                                          <div class="progress xs">
                                            <div class="progress-bar progress-bar-success" style="width: 40%;"></div>
                                          </div>
                                        </div>
                                        <!-- /.col -->
                                      </div>
                                      <!-- /.row -->
                                </div>
                          </div>
                        </div>
                      <!-- ./col -->
                      </div>
                  </div>

                  <div class="col-md-4">
                    <div class="box box-danger">

                      <div class="box-header with-border">
                          <h3 class="box-title">Accommodation Report</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                      </div>
                      <div class="box-body no-padding" style="">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="info-box">
                              <span class="info-box-icon bg-red"><i class="ion ion-ios-gear-outline"></i></span>

                              <div class="info-box-content">
                                <!-- <span class="info-box-text">CPU Traffic</span> -->
                                <span class="info-box-number"><h1><?= SgdnRelAluguer::find()->where(['ESTADO'=>'I'])->count()?></h1></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            </div>
                            <div class="col-md-6">
                              <!-- /.info-box -->
                              <div class="info-box">
                                <span class="info-box-icon bg-blue"><i class="fa fa-google-plus"></i></span>

                                <div class="info-box-content">
                                  <!-- <span class="info-box-text">Likes</span> -->
                                  <span class="info-box-number"><h1><?= SgdnRelAluguer::find()->where(['ESTADO'=>'I'])->count()?></h1></span>
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                            </div>
                        </div>
                      <!-- /.info-box -->
                        <div class="box box-solid bg-red-gradient">
                            <div class="box-header ui-sortable-handle" style="cursor: move;">
                                <i class="fa fa-calendar"></i>

                                <h3 class="box-title">Calendar</h3>
                                <!-- tools box -->
                                <div class="pull-right box-tools">
                                  <!-- button with a dropdown -->
                                  <div class="btn-group">
                                    <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">
                                      <i class="fa fa-bars"></i></button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                      <li><a href="#">Add new event</a></li>
                                      <li><a href="#">Clear events</a></li>
                                      <li class="divider"></li>
                                      <li><a href="#">View calendar</a></li>
                                    </ul>
                                  </div>
                                  <button type="button" class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                                  </button>
                                  <button type="button" class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                                  </button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <!--The calendar -->
                                <div id="calendar" style="width: 100%"><div class="datepicker datepicker-inline"><div class="datepicker-days" style=""><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">June 2018</th><th class="next">»</th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td class="old day" data-date="1527379200000">27</td><td class="old day" data-date="1527465600000">28</td><td class="old day" data-date="1527552000000">29</td><td class="old day" data-date="1527638400000">30</td><td class="old day" data-date="1527724800000">31</td><td class="day" data-date="1527811200000">1</td><td class="day" data-date="1527897600000">2</td></tr><tr><td class="day" data-date="1527984000000">3</td><td class="day" data-date="1528070400000">4</td><td class="day" data-date="1528156800000">5</td><td class="day" data-date="1528243200000">6</td><td class="day" data-date="1528329600000">7</td><td class="day" data-date="1528416000000">8</td><td class="day" data-date="1528502400000">9</td></tr><tr><td class="day" data-date="1528588800000">10</td><td class="day" data-date="1528675200000">11</td><td class="day" data-date="1528761600000">12</td><td class="day" data-date="1528848000000">13</td><td class="day" data-date="1528934400000">14</td><td class="day" data-date="1529020800000">15</td><td class="day" data-date="1529107200000">16</td></tr><tr><td class="day" data-date="1529193600000">17</td><td class="day" data-date="1529280000000">18</td><td class="day" data-date="1529366400000">19</td><td class="day" data-date="1529452800000">20</td><td class="day" data-date="1529539200000">21</td><td class="day" data-date="1529625600000">22</td><td class="day" data-date="1529712000000">23</td></tr><tr><td class="day" data-date="1529798400000">24</td><td class="day" data-date="1529884800000">25</td><td class="day" data-date="1529971200000">26</td><td class="day" data-date="1530057600000">27</td><td class="day" data-date="1530144000000">28</td><td class="day" data-date="1530230400000">29</td><td class="day" data-date="1530316800000">30</td></tr><tr><td class="new day" data-date="1530403200000">1</td><td class="new day" data-date="1530489600000">2</td><td class="new day" data-date="1530576000000">3</td><td class="new day" data-date="1530662400000">4</td><td class="new day" data-date="1530748800000">5</td><td class="new day" data-date="1530835200000">6</td><td class="new day" data-date="1530921600000">7</td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">2018</th><th class="next">»</th></tr></thead><tbody><tr><td colspan="7"><span class="month">Jan</span><span class="month">Feb</span><span class="month">Mar</span><span class="month">Apr</span><span class="month">May</span><span class="month focused">Jun</span><span class="month">Jul</span><span class="month">Aug</span><span class="month">Sep</span><span class="month">Oct</span><span class="month">Nov</span><span class="month">Dec</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">2010-2019</th><th class="next">»</th></tr></thead><tbody><tr><td colspan="7"><span class="year old">2009</span><span class="year">2010</span><span class="year">2011</span><span class="year">2012</span><span class="year">2013</span><span class="year">2014</span><span class="year">2015</span><span class="year">2016</span><span class="year">2017</span><span class="year focused">2018</span><span class="year">2019</span><span class="year new">2020</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-decades" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">2000-2090</th><th class="next">»</th></tr></thead><tbody><tr><td colspan="7"><span class="decade old">1990</span><span class="decade">2000</span><span class="decade focused">2010</span><span class="decade">2020</span><span class="decade">2030</span><span class="decade">2040</span><span class="decade">2050</span><span class="decade">2060</span><span class="decade">2070</span><span class="decade">2080</span><span class="decade">2090</span><span class="decade new">2100</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-centuries" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">2000-2900</th><th class="next">»</th></tr></thead><tbody><tr><td colspan="7"><span class="century old">1900</span><span class="century focused">2000</span><span class="century">2100</span><span class="century">2200</span><span class="century">2300</span><span class="century">2400</span><span class="century">2500</span><span class="century">2600</span><span class="century">2700</span><span class="century">2800</span><span class="century">2900</span><span class="century new">3000</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div></div></div>
                              </div>
                              <!-- /.box-body -->
                              <div class="box-footer text-black">
                                  <div class="row">
                                      <div class="col-sm-6">
                                        <!-- Progress bars -->
                                        <div class="clearfix">
                                          <span class="pull-left">Task #1</span>
                                          <small class="pull-right">90%</small>
                                        </div>
                                        <div class="progress xs">
                                          <div class="progress-bar progress-bar-danger" style="width: 90%;"></div>
                                        </div>

                                        <div class="clearfix">
                                          <span class="pull-left">Task #2</span>
                                          <small class="pull-right">70%</small>
                                        </div>
                                        <div class="progress xs">
                                          <div class="progress-bar progress-bar-danger" style="width: 70%;"></div>
                                        </div>
                                      </div>
                                      <!-- /.col -->
                                      <div class="col-sm-6">
                                        <div class="clearfix">
                                          <span class="pull-left">Task #3</span>
                                          <small class="pull-right">60%</small>
                                        </div>
                                        <div class="progress xs">
                                          <div class="progress-bar progress-bar-danger" style="width: 60%;"></div>
                                        </div>

                                        <div class="clearfix">
                                          <span class="pull-left">Task #4</span>
                                          <small class="pull-right">40%</small>
                                        </div>
                                        <div class="progress xs">
                                          <div class="progress-bar progress-bar-danger" style="width: 40%;"></div>
                                        </div>
                                      </div>
                                      <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                              </div>
                        </div>
                      </div>
                    <!-- ./col -->
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
