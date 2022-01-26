<?php

return [

    'Administration' => [
		
        'label' => 'Team',
        'icon' => 'fa-copy',
        'children' => [

            [
                'label' => 'User',
                'url' => 'user',
                'icon' => 'fa-user',
                //'policy' => 'ACLS_LIST'
            ],
            [
                'label' => 'Role',
                'url' => 'role',
				'icon' => 'fa-lock',
               // 'policy' => 'USERS_LIST'
            ],
        ],
        //'policy' => ['ACLS_LIST', 'USERS_LIST']
    ]
];
