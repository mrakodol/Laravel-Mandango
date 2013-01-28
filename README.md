Laravel-Mandango
================

Laravel MongoDB ODM Mandango

This is Mandango ODM bundle for Laravel.

I setup Base Bundle which is very easy to use.

There is schema defination in config.schema where you define schema. If you want to know how to define schema follow this link http://mandango.org/doc/mandango/basic-mapping.html

There is another configuration , i.e. mondator, if you change schema or create new one, then make it (run => true) for one time then again false For better Performance.

In Database Configuration You set your options.


we use Mandango anywhere, I use mandango in routes

$mandango = IoC::resolve('mandango');
$author = $mandango->create('Model\Author');
$author->setName('Mr. Singh');
$author->save();

$article = $mandango->create('Model\Article');
$article->setTitle('Amritpal's Article');
$article->setContent('Mandango rocks!');
$article->setAuthor($author);
$article->save();

In Mandango When we use refrences pass array to argument not string there is problem in document

For More Information visit 
http://mandango.org/doc/