<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overridding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'bjyauthorize' => array(
        'default_role'      => 'guest',
        'identity_provider' => 'BjyAuthorize\Provider\Identity\ZfcUserDoctrine',

        'role_providers'    => array(

            /* here, 'guest' and 'user are defined as top-level roles, with
             * 'admin' inheriting from user
             */
            // 'BjyAuthorize\Provider\Role\Config' => array(
            //     'guest' => array(),
            //     'user'  => array('children' => array(
            //         'admin' => array(),
            //     )),
            // ),

            // this will load roles from the user_role table in a database
            // format: user_role(role_id(varchar), parent(varchar))
            'BjyAuthorize\Provider\Role\Doctrine' => array(
                'table'             => 'user_role',
                'role_id_field'     => 'role_id',
                'parent_role_field' => 'parent',
            ),
        ),
    ),
);
