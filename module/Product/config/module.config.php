<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Product\Controller\Product' => 'Product\Controller\ProductController',
            'Category\Controller\Category' => 'Category\Controller\CategoryController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'category' => __DIR__ . '/../view',
//            'category' => __DIR__ . '/../view',
        ),
    ),
    'router' => array(
        'routes' => array(
            'category' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/category[/:action][/:id]',
                    'defaults' => array(
                        'controller' => 'Category\Controller\Category',
                        'action' => 'index',
                    ),
                ),
            ),
            'product' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/product[/:action][/:id]',
                    'defaults' => array(
                        'controller' => 'Product\Controller\Product',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'zh_CN',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
                'text_domain' => 'todo',
            ),
        ),
    ),
);