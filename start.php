<?php

$loader = require __DIR__.'/vendor/autoload.php';
$loader->add('Model', __DIR__);

use Mandango\Mondator\Mondator;

$run = Config::get('mandango::mondator.run');

if($run){
	$mondator = new Mondator();
	$directory = Config::get('mandango::mondator.directory');
	$schema = Config::get('mandango::schema');
	$mondator->setConfigClasses($schema);
	$mondator->setExtensions(array(
	    new Mandango\Extension\Core(array(
	        'metadata_factory_class'  => 'Model\Mapping\Metadata',
	        'metadata_factory_output' => $directory.'/Model/Mapping',
	        'default_output'          => $directory.'/Model',
	    )),
	    new Mandango\Extension\DocumentPropertyOverloading(),
	));
	$mondator->process();
}

use Mandango\Cache\FilesystemCache;
use Mandango\Connection;
use Mandango\Mandango;
use Model\Mapping\Metadata;

$config = Config::get('mandango::database');

IoC::singleton('mandango', function()use($config){
	extract($config);
	$metadata = new Metadata();
	$cache = new FilesystemCache(path('storage').'cache');
	$mandango = new Mandango($metadata, $cache);
	$connection = new Connection($server, $db, $options);
	$mandango->setConnection('unester', $connection);
	$mandango->setDefaultConnectionName('unester');
	return $mandango;
});

$mandango = IoC::resolve('mandango');
dd($mandango);