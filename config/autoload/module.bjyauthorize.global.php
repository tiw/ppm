<?php

return array(
    'bjyauthorize' => array(
        'default_role' => 'guest',
        'identity_provider' => 'BjyAuthorize\Provider\Identity\ZfcUserZendDb',
        'unauthorized_strategy' => 'BjyAuthorize\View\UnauthorizedStrategy',
        'role_providers' => array(
            /* here, 'guest' and 'user are defined as top-level roles, with
             * 'admin' inheriting from user
             */
            'BjyAuthorize\Provider\Role\Config' => array(
                'guest' => array(),
                'user'  => array('children' => array(
                    'admin' => array(),
                )),
            ),

            // this will load roles from the user_role table in a database
            // format: user_role(role_id(varchar), parent(varchar))
            'BjyAuthorize\Provider\Role\ZendDb' => array(
                'table'             => 'user_role',
                'role_id_field'     => 'role_id',
                'parent_role_field' => 'parent',
            ),
        ),
        'resource_providers' => array(
        ),
        'rule_providers' => array(
        ),
        'guards' => array(
           /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all routes unless they are specified here.
             */
            'BjyAuthorize\Guard\Route' => array(
                array('route' => 'zfcuser', 'roles' => array('user')),
                array('route' => 'zfcuser/logout', 'roles' => array('user')),
                array('route' => 'zfcuser/login', 'roles' => array('guest')),
                array('route' => 'zfcuser/register', 'roles' => array('guest')),
                //// Below is the default index action used by the [ZendSkeletonApplication](https://github.com/zendframework/ZendSkeletonApplication)
                array('route' => 'home', 'roles' => array('guest', 'user')),
                array('route' => 'todo', 'roles' => array('user')),
                array('route' => 'product', 'roles' => array('guest', 'user')),
                array('route' => 'category', 'roles' => array('guest', 'user')),
                array('route' => 'product-front', 'roles' => array('guest', 'user')),
                array('route' => 'product-image', 'roles' => array('guest', 'user')),
                array('route' => 'product-front-filter', 'roles' => array('guest', 'user')),
                array('route' => 'person', 'roles' => array('guest', 'user')),
                array('route' => 'person-front', 'roles' => array('guest', 'user')),
                array('route' => 'product-list', 'roles' => array('guest', 'user')),
                array('route' => 'category-list', 'roles' => array('guest', 'user')),
                array('route' => 'person-list', 'roles' => array('guest', 'user')),
                array('route' => 'product-rest', 'roles' => array('guest', 'user')),
            ),
        ),
    ),

    'view_manager' => array(
        'template_map' => array(
            'error/403' => __DIR__ . '/../view/error/403.phtml',
        ),
    ),
);
