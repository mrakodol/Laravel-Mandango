<?php

$autoload = __DIR__.'/vendor/autoload.php';
if(file_exists($autoload)){
	$loader = require $autoload;
}else{
	echo "Go to terminal and run 'composer install' on mandango bundle, otherwise you cannot use this bundle. If you donot know about composer then google for it.";
	die;
}
$loader->add('Model', __DIR__);

use Mandango\Mondator\Mondator;

$run = Config::get('mandango::mondator.run');

if($run){
	$mondator = new Mondator();
	$schema = Config::get('mandango::schema');
	$mondator->setConfigClasses($schema);
	$directory = Config::get('mandango::mondator.directory');
	$mondator->setExtensions(array(
	    new Mandango\Extension\Core(array(
	        'metadata_factory_class'  => 'Model\Mapping\Metadata',
	        'metadata_factory_output' => $directory.'/Model/Mapping',
	        'default_output'          => $directory.'/Model',
	    )),
	    new Mandango\Extension\DocumentPropertyOverloading(),
	    new Mandango\Extension\DocumentArrayAccess(),
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
	$mandango->setConnection($db, $connection);
	$mandango->setDefaultConnectionName($db);
	return $mandango;
});

// use anywhere
//$mandango = IoC::resolve('mandango');
