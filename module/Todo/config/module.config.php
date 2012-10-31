<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Todo\Controller\Todo' => 'Todo\Controller\TodoController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'todo' => __DIR__ . '/../view',
        ),
    ),
    'router' => array(
        'routes' => array(
            'todo' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/todo[/:action][/:id]',
                    'defaults' => array(
                        'controller' => 'Todo\Controller\Todo',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
);
