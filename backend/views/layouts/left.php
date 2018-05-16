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
                      ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/']],
                      [
                        'label' => 'Parametrizacao',
                        'icon' => 'fal fa-cog',
                        'url' => ['/'],
                              'items' => [

                                          [
                                            'label' => 'Informacional',
                                            'icon' => 'fal  fa-info-circle',
                                            'url' => ['/'],
                                                  'items' => [
                                                                  ['label' => 'Contatos', 'icon'     => 'fal fa-envelope', 'url' => ['/sgdn-pr-contacto-tp'],],
                                                                  ['label' => 'Documentos', 'icon'   => 'fal fa-file-pdf-o', 'url' => ['/sgdn-pr-documento-tp'],],
                                                                  ['label' => 'Estado Civil', 'icon' => 'fal fa-street-view', 'url' => ['/sgdn-pr-estado-civil'],],
                                                   ]
                                           ],


                                            [
                                              'label' => 'Materiais',
                                              'icon' => 'fal fa-wrench',
                                              'url' => ['/'],
                                                    'items' => [
                                                                  ['label' => 'Tipos', 'icon'    => 'fal fa-question', 'url' => ['/sgdn-pr-material-tp'],],
                                                                  ['label' => 'Marcas', 'icon'    => 'fal fa-slack', 'url' => ['/sgdn-pr-material-marca'],],

                                                     ]
                                             ],

                                             [
                                               'label' => 'Preciario',
                                               'icon' => 'fal fa-money',
                                               'url' => ['/'],
                                                     'items' => [
                                                                   ['label' => 'Materiais', 'icon'    => 'fal fa-wrench', 'url' => ['/sgdn-rel-precario'],],
                                                      ]
                                              ],
                               ]
                       ],

                     [
                       'label' => 'Pessoas', 'icon' => 'fab fa-group','url' => ['/sgdn-pessoa'],
                     ],
                     [
                         'label' => 'Spots',
                         'icon' => 'fab fa-anchor',
                         'url' => ['/sgdn-spot'],

                     ],

                    [
                      'label' => 'Entidades', 'icon' => 'fal fa-home', 'url' => ['/sgdn-entidade'],
                    ],

                    [
                      'label' => 'Armazem',
                      'icon' => ' fa-cubes',
                      'url' => ['/'],
                      'items' => [
                          ['label' => 'Materiais','icon' => 'fal fa-wrench','url' =>  ['/sgdn-material'],],
                        ],
                     ],

                     [
                       'label' => 'Escola',
                       'icon' => 'fab fa-bank',
                       'url' => ['/'],

                          'items' => [

                              ['label' => 'Spots','icon' => 'fab fa-anchor','url' => ['/sgdn-rel-entidade-spot'],                        ],
                              [
                                'label' => 'Modalidades',
                                'icon' => 'fal fa-xing',
                                'url' => ['/sgdn-pr-modalidade'],
                              ],
                              ['label' => 'Aulas','icon' => 'fab fa-leanpub','url' => ['/sgdn-rel-aula'],],
                              ['label' => 'Calendar','icon' => 'fal fa-calendar','url' => ['/sgdn-rel-aula/calendar'],],
                             ],
                      ],

                      [
                          'label' => 'Office',
                          'icon' => ' far fa-building',
                          'url' => '#',
                          'items' => [
                                        ['label' => 'Cadastro', 'icon' => 'far  fa-plus-circle', 'url' => ['/sgdm-instrutor'],],
                                        ['label' => 'Matricula', 'icon' => 'far fa-money', 'url' => ['/sgdn-rel-matricula'],],
                                        ['label' => 'Contracto', 'icon' => 'far fa-scissors', 'url' => ['/sgdn-rel-instrutor-modalidade'],],
                                        ['label' => 'Emprestimo','icon' => 'fal fa-exchange', 'url' => ['/sgdn-rel-aluguer'],],
                                        ['label' => 'Alojamento','icon' => 'fal fa-home', 'url' => ['/sgdn-residencia'],],
                                        ['label' => 'Trip','icon' => 'fal fa-tree', 'url' => ['#'],],
                          ],
                      ],

                ],
            ]
        ) ?>

    </section>

</aside>
