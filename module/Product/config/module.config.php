<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Product\Controller\Product' => 'Product\Controller\ProductController',
            'Category\Controller\Category' => 'Category\Controller\CategoryController',
            'Product\Controller\ProductFront' => 'Product\Controller\ProductFrontController',
            'Product\Controller\Image' => 'Product\Controller\ImageController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'category' => __DIR__ . '/../view',
//            'category' => __DIR__ . '/../view',
        ),
        'template_map' => array(
            'partial/productlist' => __DIR__ . '/../view/partial/productlist.phtml',
        )
    ),
    'router' => array(
        'routes' => array(
            'category' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/category[/:action][/:id]',
                    'defaults' => array(
                        'controller' => 'Category\Controller\Category',
                        'action' => 'index',
                    ),
                ),
            ),
            'product' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/product[/:action][/:id]',
                    'defaults' => array(
                        'controller' => 'Product\Controller\Product',
                        'action' => 'index',
                    ),
                ),
            ),
            'product-front' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/product[/:action][/:id]',
                    'defaults' => array(
                        'controller' => 'Product\Controller\ProductFront',
                        'action' => 'list',
                    ),
                ),
            ),
            'product-image' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/product-image[/:action][/:id]',
                    'defaults' => array(
                        'controller' => 'Product\Controller\Image',
                        'action' => 'index',
                    ),
                ),
            ),
            'product-front-filter' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/products/:filter-name/:filter-value',
                    'defaults' => array(
                        'controller' => '\Product\Controller\ProductFront',
                        'action' => 'filter',
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