<?php

namespace Model\Mapping;

class Metadata extends \Mandango\MetadataFactory
{
    protected $classes = array(
        'Model\\User' => false,
        'Model\\Hierarchy' => false,
    );
}