<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\ServiceManager\ServiceLocatorInterface;
return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index'
                    ]
                ]
            ],
            'search' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/search',
                    'defaults' => [
                        'page' => 1,
                        'controller' => Controller\SearchController::class,
                        'action' => 'index'
                    ]
                ]
            ],
            'video' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/video/:id',
                    'constraints' => [
                        'id' => '[a-zA-Z0-9]+'
                    ],
                    'defaults' => [
                        'controller' => Controller\VideoController::class,
                        'action' => 'index'
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\SearchController::class => function (ServiceLocatorInterface $serviceLocator)
            {
                return new Controller\SearchController($serviceLocator->get('VideoProvider'),
                    $serviceLocator->get('Config')['video_item_limit']);
            },
            Controller\VideoController::class => function (ServiceLocatorInterface $serviceLocator)
            {
                return new Controller\VideoController($serviceLocator->get('VideoProvider'));
            }
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml'
        ],
        'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
        'error/404' => __DIR__ . '/../view/error/404.phtml',
        'error/index' => __DIR__ . '/../view/error/index.phtml',
        'template_path_stack' => [
            __DIR__ . '/../view'
        ]
    ]
];
