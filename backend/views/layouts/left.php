<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Elismar Gonçalves</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Navegation', 'options' => ['class' => 'header']],
                      [
                        'label' => 'Parametrizacao',
                        'icon' => 'fal fa-cog',
                        'url' => ['/'],
                              'items' => [
                                            ['label' => 'Contatos', 'icon'     => 'fal fa-envelope', 'url' => ['/sgdn-pr-contacto-tp'],],
                                            ['label' => 'Documentos', 'icon'   => 'fal fa-file-pdf-o', 'url' => ['/sgdn-pr-documento-tp'],],
                                            ['label' => 'Estado Civil', 'icon' => 'fal fa-street-view', 'url' => ['/sgdn-pr-estado-civil'],],
                               ]
                       ],

                       [
                         'label' => 'Parametrizacao Materiais',
                         'icon' => 'fal fa-cog',
                         'url' => ['/'],
                               'items' => [
                                             ['label' => 'Tipos', 'icon'    => 'fal fa-question', 'url' => ['/sgdn-pr-material-tp'],],
                                             ['label' => 'Marcas', 'icon'    => 'fal fa-slack', 'url' => ['/sgdn-pr-material-marca'],],
                                             ['label' => 'Preciario', 'icon'    => 'fal fa-money', 'url' => ['/'],],
                                ]
                        ],

                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/']],
                    [
                      'label' => 'Entidades', 'icon' => 'fal fa-home', 'url' => ['/sgdn-entidade'],
                      // 'items' => [
                      //   ['label' => 'Create', 'icon' => 'fal fa-circle-o text-blue', 'url' => ['#'],],
                      //   ['label' => 'Read', 'icon' => 'fal fa-circle-o text-green', 'url' => ['#'],],
                      //   ['label' => 'Update', 'icon' => 'fal fa-circle-o text-yellow', 'url' => ['#'],],
                      //   ['label' => 'Delete', 'icon' => 'fal fa-circle-o text-red', 'url' => ['#'],],
                      //
                      // ],
                    ],
                    [
                      'label' => 'Pessoas',
                      'icon' => '/*fa-user*/ fa-group',
                      'url' => ['/sgdn-pessoa'],
                    ],

                    [
                      'label' => 'Armazem',
                      'icon' => ' fa-cubes',
                      'url' => ['/'],
                      'items' => [
                          [
                            'label' => 'Materiais',
                            'icon' => 'fal fa-wrench',
                            'url' =>  ['/sgdn-material'],
                            // 'items' => [
                            //                 ['label' => 'Create', 'icon' => 'fal fa-circle-o text-blue', 'url' => ['#'],],
                            //                 ['label' => 'Read', 'icon' => 'fal fa-circle-o text-green', 'url' => ['#'],],
                            //                 ['label' => 'Update', 'icon' => 'fal fa-circle-o text-yellow', 'url' => ['#'],],
                            //                 ['label' => 'Delete', 'icon' => 'fal fa-circle-o text-red', 'url' => ['#'],],
                            // ]

                          ],
                        ],
                     ],

                     [
                       'label' => 'Escola',
                       'icon' => 'fab fa-bank',
                       'url' => '#',

                          'items' => [
                              [
                                'label' => 'Modalidades',
                                'icon' => 'fal fa-xing',
                                'url' => '#',
                                'items' => [
                                              ['label' => 'Surf', 'icon' => 'fal fa-circle-o text-blue', 'url' => ['#'],],
                                              ['label' => 'BodyBoard ', 'icon' => 'fal fa-circle-o text-blue', 'url' => ['#'],],
                                              ['label' => 'KitSurf', 'icon' => 'fal fa-circle-o ', 'url' => ['#'],],
                                              ['label' => 'WindSurf', 'icon' => 'fal fa-circle-o ', 'url' => ['#'],],
                                ],
                              ],
                              ['label' => 'Aulas','icon' => 'fab fa-leanpub','url' => ['#'],],
                              ['label' => 'Calendar','icon' => 'fal fa-calendar','url' => ['#'],],
                             ],
                      ],

                      [
                          'label' => 'Spots',
                          'icon' => '/*fab fa-spotify*/  fa-anchor',
                          'url' => '#',
                          // 'items' => [
                          //               ['label' => 'Create', 'icon' => 'fal fa-circle-o text-blue', 'url' => ['#'],],
                          //               ['label' => 'Read', 'icon' => 'fal fa-circle-o text-green', 'url' => ['#'],],
                          //               ['label' => 'Update', 'icon' => 'fal fa-circle-o text-yellow', 'url' => ['#'],],
                          //               ['label' => 'Delete', 'icon' => 'fal fa-circle-o text-red', 'url' => ['#'],],
                          // ],
                      ],
                      [
                          'label' => 'Front Office',
                          'icon' => ' far fa-building',
                          'url' => '#',
                          'items' => [
                                        ['label' => 'Registo de Matricula', 'icon' => 'far fa-registered', 'url' => ['#'],],
                                        ['label' => 'Emprestimo','icon' => 'fal fa-exchange', 'url' => ['#'],],
                                        ['label' => 'Alojamento','icon' => 'fal fa-home', 'url' => ['#'],],
                                        //['label' => 'Update', 'icon' => 'fal fa-circle-o text-yellow', 'url' => ['#'],],
                                        //['label' => 'Delete', 'icon' => 'fal fa-circle-o text-red', 'url' => ['#'],],
                          ],
                      ],

                    /*['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],*/
                    //['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    /*[
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],]///,
                            /*[
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    */
                ],
            ]
        ) ?>

    </section>

</aside>
