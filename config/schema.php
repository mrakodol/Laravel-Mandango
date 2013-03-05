<?php 

return array(
		'Model\User' => array(
			'collection' => 'users',
    	'fields' => array(
    	  'fbid' => 'integer',
        'name' => 'string',
        'username' => 'string',
        'email' => 'string',
        'gender' => 'string',
        'birthday' => 'string',
        'hometown' => 'string',
        'location' => 'string',
        'picture' => 'string',
        'visibility' => 'string',
        'hierarchy' => 'string',
        'batch' => 'string',
        'created' => 'date',
        'updated' => 'date',
        'onsearch' => 'string',
    	),
      'indexes' => array(
            array(
                'keys' => array('fbid' => 1, 'visibility' => 1),
            ),
      ),
    ),
    'Model\Hierarchy' => array(
      'collection' => 'hierarchies',
      'fields' => array(
        'name' => 'string',
        'parent' => 'string',
        'level' => 'integer',
        'path' => 'string',
        'root' => 'boolean',
      ),
      'indexes' => array(
            array(
                'keys' => array('name' => 1, 'root' => 1, 'parent' => 1),
            ),
      ),
    ),
);