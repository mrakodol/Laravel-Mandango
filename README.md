# Laravel - Mandango

## Overview

**Mandango**, MongoDB ODM, I have created Laravel Bundle using Mandango <http://mandango.org/>.

### Use Composer to complete installation. 
Command used to install vendor's files 
``` composer install ```
####  Configuration

1. Database Config : In Database Configuration you can set your database in 'db' and in options you have to set username password for admin if you don't specify db in options. If you specify same db in both place then give thats db username and password. 

2. Schema Config : In Schema Configuration you define your own Schema(Default : I set it to Author and Article for example.).If you want to know how to define schema follow this link <http://mandango.org/doc/mandango/basic-mapping.html>

3. Mondator Config : In Mondator Configuration you have to set Boolean value for <b>run</b>. If you change your schema or create new one, then make it true for first time and then again false for better performance. Every time it creates necessary files in Model Directory (automatically build in bundle during first run) , but if you donot make any changes to your schema, then it is unnecessary load. Initially I make it true for first run after that make it false and then whenever you changes schema make it true for only one time.

#### Use of Mandango Singelton in Routes
```
Route::get('/', function(){
	$mandango = IoC::resolve('mandango');
	$author = $mandango->create('Model\Author');
	$author->setName('Mr. Singh');
	//we use $author->name = 'Mr. Singh'; or $author['name'] = 'Mr. Singh';
	$author->save();
	$article = $mandango->create('Model\Article');
	$article->setTitle('Amritpal\'s Article');
	$article->setContent('Mandango rocks!');
	$article->setAuthor($author);
	$article->save();
	if($author->getId() && $article->getId())
		return 'Author And Articles Are Successfully Saved';
	else
		return 'Something going wrong';
});
```

#### Important Note
Mandango Docs are not updated regularly but mostly it help me. There is one problem in <http://mandango.org/doc/mandango/querying.html>. in refrences example. So I fix it according to their code.

```
When we call $articles = $articleRepository->createQuery()->references('author')->all();
it give error
it should be $articles = $articleRepository->createQuery()->references(array('author'))->all();
parameter should be array in refrences.
```

### For Further Documentation
<http://mandango.org/doc/>

### Follow Me On Twitter
<https://twitter.com/Boparaiamrit> 
