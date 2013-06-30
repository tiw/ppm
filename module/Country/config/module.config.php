<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ting
 * Date: 13-6-30
 * Time: 上午11:10 
 */
return array(
    'controllers' => array(
        'invokables' => array(
            'Country\Controller\Country' => 'Country\Controller\CountryController',
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
            'country' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/country[/:action][/:id]',
                    'defaults' => array(
                        'controller' => 'Country\Controller\Country',
                        'action' => 'index',
                    ),
                ),
            ),
        )
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
