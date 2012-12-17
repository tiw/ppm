<?php
/**
 * User: wangting
 * Date: 12-11-28
 * Time: 上午9:43
 * copyright 2012 tiddr.de
 */
return array(
    'controllers' => array(
        'invokables' => array(
            'Person\Controller\Person' => 'Person\Controller\PersonController',
            'Person\Controller\PersonFront' => 'Person\Controller\PersonFrontController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'person' => __DIR__ . '/../view',
        ),
    ),
    'router' => array(
        'routes' => array(
            'person' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/person[/:action][/:id]',
                    'defaults' => array(
                        'controller' => 'Person\Controller\Person',
                        'action' => 'index',
                    ),
                ),
            ),
            'person-front' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/person[/:action][/:id]',
                    'defaults' => array(
                        'controller' => 'Person\Controller\PersonFront',
                        'action' => 'list',
                    ),
                ),
            ),
        ),
    ),
);
