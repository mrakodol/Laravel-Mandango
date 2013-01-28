Laravel-Mandango
================

Laravel MongoDB ODM Mandango

This is Mandango ODM bundle for Laravel.

I setup Base Bundle which is very easy to use.

Configuration

1. There is schema defination in Config -> Schema where you define schema. If you want to know how to define schema follow this link http://mandango.org/doc/mandango/basic-mapping.html

2. There is another configuration , i.e. Config -> Mondator, if you change schema or create new one, then make it (run => true) for one time then again false for better performance. Initially I make it true after 1 run make it false. And Then Whenever You Changes schema make it true for one time.

3. In Database Configuration You set your database options.

I uses singelton pattern, eg. I use mandango in routes

Route::get('/', function()
{
	
	$mandango = IoC::resolve('mandango');
	$author = $mandango->create('Model\Author');
	$author->setName('Mr. Singh');
	$author->save();

	$article = $mandango->create('Model\Article');
	$article->setTitle('Amritpal\'s Article');
	$article->setContent('Mandango rocks!');
	$article->setAuthor($author);
	$article->save();
	return 'Author And Articles Are Successfully Saved';

});

IMP. In Mandango, When we use refrences pass array to argument not string there is problem in document

For More Information visit 
http://mandango.org/doc/