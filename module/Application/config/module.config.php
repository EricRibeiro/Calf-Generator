<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Helper\EntityManager;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Application\Controller\DashboardController;
use Application\Controller\AnimalController;
use Application\Controller\EstacaoController;
use Application\Controller\ProtocoloController;
use Application\Controller\IAController;
use Application\Controller\InducaoController;


return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\DashboardController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'app' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/app',
                    'defaults' => [
                        'controller' => Controller\DashboardController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'dashboard' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/dashboard[/:action[/:id]]',
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]*'
                            ],
                            'defaults' => [
                                'controller' => Controller\DashboardController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'animal' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/animal[/:action[/:id]]',
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]*',
                            ],
                            'defaults' => [
                                'controller' => Controller\AnimalController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'estacao' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/estacao[/:action[/:id[/:eid]]]',
                            'constraints' => [
                                'id' => '[0-9]*',
                                'eid' => '[0-9]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults' => [
                                'controller' => Controller\EstacaoController::class,
                                'action' => 'index'
                            ],
                        ],
                    ],
                    'protocolo' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/protocolo[/:action[/:id[/:pid]]]',
                            'constraints' => [
                                'id' => '[0-9]*',
                                'pid' => '[0-9]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ],
                            'defaults' => [
                                'controller' => Controller\ProtocoloController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                     'inducao' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/inducao[/:action[/:id[/:pid]]]',
                            'constraints' => [
                                'id' => '[0-9]*',
                                'pid' => '[0-9]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ],
                            'defaults' => [
                                'controller' => Controller\InducaoController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'ia' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/ia[/:action[/:id]]',
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]*'
                            ],
                            'defaults' => [
                                'controller' => Controller\IAController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'relatorio' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/relatorio[/:action[/:id]]',
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]*'
                            ],
                            'defaults' => [
                                'controller' => Controller\RelatorioController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,

            Controller\DashboardController::class => InvokableFactory::class,

            Controller\AnimalController::class => InvokableFactory::class,

            Controller\EstacaoController::class => InvokableFactory::class,

            Controller\ProtocoloController::class => InvokableFactory::class,

            Controller\InducaoController::class => InvokableFactory::class,

            Controller\IAController::class => InvokableFactory::class,

            Controller\HelperController::class => InvokableFactory::class,

            Controller\RelatorioController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',

        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'view_helpers' => array(
        'invokables' => array (
            'flashHelper' => 'Application\View\Helper\FlashHelper'
        )
    ),
    'view_helper_config' => array(
        'flashmessenger' => array(
            'message_open_format'      => '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul><li>',
            'message_close_string'     => '</li></ul></div>',
            'message_separator_string' => '</li><li>'
        )
    ),
    'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'my_annotation_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity/'],
            ],

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'Application\Entity' => 'my_annotation_driver',
                ],
            ],
        ],
    ],


];
