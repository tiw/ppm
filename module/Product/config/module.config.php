<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Product\Controller\Product' => 'Product\Controller\ProductController',
            'Category\Controller\Category' => 'Category\Controller\CategoryController',
            'Category\Controller\SubCategory' => 'Category\Controller\SubCategoryController',
            'Product\Controller\ProductFront' => 'Product\Controller\ProductFrontController',
            'Product\Controller\ProductRest' => 'Product\Controller\ProductRestController',
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
            'pagination_control' => __DIR__ . '/../view/partial/pagination_control.phtml',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
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
            'sub-category' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/sub-category[/:action][/:id]',
                    'defaults' => array(
                        'controller' => 'Category\Controller\SubCategory',
                        'action' => 'index',
                    ),
                ),
            ),
            'product' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/product[/:action][/:id][/page/:page]',
                    'defaults' => array(
                        'controller' => 'Product\Controller\Product',
                        'action' => 'index',
                    ),
                ),
            ),
            'product-list' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/products[/page/:page]',
                    'defaults' => array(
                        'controller' => 'Product\Controller\Product',
                        'action' => 'index',
                    ),
                ),
            ),
            'category-list' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/categories[/page/:page]',
                    'defaults' => array(
                        'controller' => 'Category\Controller\Category',
                        'action' => 'index',
                    ),
                ),
            ),
            'person-list' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/persons[/page/:page]',
                    'defaults' => array(
                        'controller' => 'Person\Controller\Person',
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
            'product-decoration' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/products/decorations/:name',
                    'defaults' => array(
                        'controller' => '\Product\Controller\ProductFront',
                        'action' => 'decorations',
                    )
                )

            ),
            'product-utensil' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/products/utensils/:name',
                    'defaults' => array(
                        'controller' => '\Product\Controller\ProductFront',
                        'action' => 'utensils',
                    )
                )

            ),
            'front-category' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/products/category/:id',
                    'defaults' => array(
                        'controller' => '\Product\Controller\ProductFront',
                        'action' => 'filterByCategory'
                    )
                )
            ),
            'product-omament' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/products/omaments/:name',
                    'defaults' => array(
                        'controller' => '\Product\Controller\ProductFront',
                        'action' => 'omaments',
                    )
                )

            ),
            'product-vintage' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/products/vintage-items/:name',
                    'defaults' => array(
                        'controller' => '\Product\Controller\ProductFront',
                        'action' => 'vintages',
                    )
                )

            ),
            'product-rest' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/product-rest[/:id]',
                    'defaults' => array(
                        'controller' => '\Product\Controller\ProductRest',
                    ),
                ),
            )
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
