<?php 

return array(
    'Model\Author' => array(
        'collection' => 'author',
       'fields' => array(
         'name' => 'string',
       ),
    ),

    'Model\Article' => array(
        'collection' => 'articles',
        'fields' => array(
            'title'   => 'string',
            'content' => 'string',
       ),
       'referencesOne' => array(
            'author' => array('class' => 'Model\Author'),
       ),
    ),
);