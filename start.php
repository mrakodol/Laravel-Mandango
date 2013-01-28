<?php

Autoloader::namespaces(array(
	'Mandango' => path('bundle').'mandango/src/Mandango',
  'Model'    => path('app').'models',
));

use Mandango\Mondator\Mondator;
$run = Config::get('mandango::mondator.run');

if($run){
	Autoloader::underscored(array(
  	'Twig' => path('bundle').'mandango/lib/Twig',
	));
	$mondator = new Mondator();
	$mondator->setConfigClasses(Config::get('mandango::schema'));
	// assign extensions
	$mondator->setExtensions(array(
	    new Mandango\Extension\Core(array(
	        'metadata_factory_class'  => 'Model\Mapping\MetadataFactory',
	        'metadata_factory_output' => path('app').'models/Mapping',
	        'default_output'          => path('app').'models',
	    )),
	));
	// process
	$mondator->process();	
}

use Mandango\Cache\FilesystemCache;
use Mandango\Connection;
use Mandango\Mandango;
use Model\Mapping\MetadataFactory;

$config = Config::get('mandango::database');

IoC::singleton('mandango', function()use($config){
	extract($config);
	$metadataFactory = new MetadataFactory();
	$cache = new FilesystemCache(path('storage').'cache');
	$mandango = new Mandango($metadataFactory, $cache);
	$connection = new Connection($server, $db, $options);
	$mandango->setConnection('uconnection', $connection);
	return $mandango;
});
