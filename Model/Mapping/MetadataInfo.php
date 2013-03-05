<?php

namespace Model\Mapping;

class MetadataInfo
{
    public function getModelUserClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'users',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'fbid' => array(
                    'type' => 'integer',
                    'dbName' => 'fbid',
                ),
                'name' => array(
                    'type' => 'string',
                    'dbName' => 'name',
                ),
                'username' => array(
                    'type' => 'string',
                    'dbName' => 'username',
                ),
                'email' => array(
                    'type' => 'string',
                    'dbName' => 'email',
                ),
                'gender' => array(
                    'type' => 'string',
                    'dbName' => 'gender',
                ),
                'birthday' => array(
                    'type' => 'string',
                    'dbName' => 'birthday',
                ),
                'hometown' => array(
                    'type' => 'string',
                    'dbName' => 'hometown',
                ),
                'location' => array(
                    'type' => 'string',
                    'dbName' => 'location',
                ),
                'picture' => array(
                    'type' => 'string',
                    'dbName' => 'picture',
                ),
                'visibility' => array(
                    'type' => 'string',
                    'dbName' => 'visibility',
                ),
                'hierarchy' => array(
                    'type' => 'string',
                    'dbName' => 'hierarchy',
                ),
                'batch' => array(
                    'type' => 'string',
                    'dbName' => 'batch',
                ),
                'created' => array(
                    'type' => 'date',
                    'dbName' => 'created',
                ),
                'updated' => array(
                    'type' => 'date',
                    'dbName' => 'updated',
                ),
                'onsearch' => array(
                    'type' => 'string',
                    'dbName' => 'onsearch',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(
                0 => array(
                    'keys' => array(
                        'fbid' => 1,
                        'visibility' => 1,
                    ),
                ),
            ),
            '_indexes' => array(
                0 => array(
                    'keys' => array(
                        'fbid' => 1,
                        'visibility' => 1,
                    ),
                ),
            ),
        );
    }

    public function getModelHierarchyClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'hierarchies',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'name' => array(
                    'type' => 'string',
                    'dbName' => 'name',
                ),
                'parent' => array(
                    'type' => 'string',
                    'dbName' => 'parent',
                ),
                'level' => array(
                    'type' => 'integer',
                    'dbName' => 'level',
                ),
                'path' => array(
                    'type' => 'string',
                    'dbName' => 'path',
                ),
                'root' => array(
                    'type' => 'boolean',
                    'dbName' => 'root',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(
                0 => array(
                    'keys' => array(
                        'name' => 1,
                        'root' => 1,
                        'parent' => 1,
                    ),
                ),
            ),
            '_indexes' => array(
                0 => array(
                    'keys' => array(
                        'name' => 1,
                        'root' => 1,
                        'parent' => 1,
                    ),
                ),
            ),
        );
    }
}