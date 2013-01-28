<?php 

return array(
    		'Model\Author' => array(
    			'collection' => 'author',
    			'connection' => 'uconnection',
        	   'fields' => array(
          	     'name' => 'string',
        	   ),
            ),

    		'Model\Article' => array(
    			'collection' => 'articles',
    			'connection' => 'uconnection',
        	    'fields' => array(
                    'title'   => 'string',
                    'content' => 'string',
        	   ),
        	   'referencesOne' => array(
                    'author' => array('class' => 'Model\Author'),
        	   ),
    		),
    	);