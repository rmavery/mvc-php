<?php

/**
 * PHP Console loging examples
 * 
 * If you're looking for source code, please take a look at
 * ../src/ directory
 *
 * No specific extensions or browsers are required, since
 * this library only generates javascript code that will
 * execute the wanted console.log().
 *
 * @see https://github.com/nyratas/php-console-log
 * @version 1.1
 * @author Toon Van den Bos https://be.linkedin.com/in/toon-van-den-bos-40461264
 */

require_once(__DIR__ . '/../__logloader.php');

use PHPConsoleLog\Service as Console;

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <title>PHP console.log() examples</title>
      <link rel="stylesheet" href="style.css">
</head>
<body>

      <header class="main-head">
            <h1 class="main-head__title">Examples - PHP console.log()</h1>
            <a href="https://github.com/nyratas/php-console-log" class="main-head__cta">Back to GitHub</a>
      </header>



      <section class="example">
            <h2 class="example__title">#1 - Basic PHP console.log()</h2>
            <div class="example__text">
                  <p>Start by <strong>requiring</strong> and <strong>using</strong> the library.</p>
            </div>
            <div class="example__code">
                  <pre class="example__format">
<em>// require the library</em>

require_once(__DIR__ . '/../src/PHPConsoleLog/__autoload.php');

use PHPConsoleLog\Service as Console;</pre>
            </div>
            <div class="example__text">
                  <p>Next, you should define a place where you want to output the console.logs:</p>
            </div>
            <div class="example__code">
                  <pre class="example__format">
<em>&lt;!-- [...] some templating code --&gt;</em>

&lt;?php <strong>Console::exec();</strong> ?&gt;

<em>&lt;!-- [...] some other templating code --&gt;</em></pre>
            </div>
            <div class="example__text">
                  <p>Good. We're now all set. You can start using the Console::log() everywhere, as long as it is <strong>called before a <em>Console::exec()</em></strong> call.</p>
            </div>
            <div class="example__code">
                  <pre class="example__format">
<em>// [...] some templating/PHP code</em>

function handleSomeVar( $data ){
      <em>// ... do stuff.</em>
      <strong>Console::log($data);</strong>
      <em>// ... do some other stuff</em>
}

<em>// [...] some templating/PHP code</em></pre>
            </div>
            <div class="example__text">
                  <p>You can use <strong>Console::log()</strong> with any type of variable. If you want to output a PHP array or object, the library will show a JavaScript Array/Object in the browser's console. A boolean will remain a boolean, an integer will remain an integer, a string remain a string, and so on.</p>
                  <p>Take a look at your console, you should see what this basic Console::log() outputed on this page!</p>
            </div>

            <?php 
                  // Output a simple var in the browser's console :
                  Console::log( '#1 - Hello! This is example n.1 - The following object once was a simple PHP\'s stdClass(), but Console::log() formatted it so javascript can display it correctly.' );
                  $myVar = new stdClass();
                  $myVar->string = "hello";
                  $myVar->boolean = true;
                  $myVar->integer = 15;
                  $myVar->float = 1.15;
                  $myVar->array = ['one','two','three'];
                  $myVar->object = new stdClass();
                  $myVar->object->content = 'Is there anybody out there?';
                  Console::log( $myVar );
            ?>

      </section>

      <section class="example">
            <h2 class="example__title">#2 - The script tag</h2>
            <div class="example__text">
                  <p>All this library does is generating an HTML <strong>&lt;script&gt;</strong> tag.</p>
                  <p>This tag contains the required JavaScript logic in order to output the requested data in the browser's console. There is not much you can do on the generated JavaScript code, but you could want to add an attribute on the <strong>&lt;script&gt;</strong> tag.</p>
                  <p>The library generates the following default HTML markup:</p>
            </div>
            <div class="example__code">
                  <pre class="example__format">&lt;script type="text/javascript" data-php-console-log="true"&gt;<em>[...]</em>&lt;/script&gt;</pre>
            </div>
            <div class="example__text">
                  <p>You can remove or modify the <em>data-php-console-log</em> attribute by setting it as follows:</p>
            </div>
            <div class="example__code">
                  <pre class="example__format">
/*
 * Remove the attribute :
 */

Console::setAttribute();
<em>// or</em>
Console::setAttribute(false);


/*
 * Edit the attribute :
 */

<em>// simple attribute</em>
Console::setAttribute('data-my-attribute');
<em>// attribute with value</em>
Console::setAttribute('data-my-attribute','attribute-value');</pre>
            </div>
            <div class="example__text">
                  <p>On this page, we modified the attribute to <em>data-hello="Is there anybody?"</em>. Inspect the code, and take a look at the <strong>&lt;script&gt;</strong> tag, at the end of this file, where <strong>Console::exec()</strong> was called (just before the <strong>&lt;/body&gt;</strong> tag).</p>
            </div>

            <?php 
                  // Change the script tag attribute
                  Console::setAttribute('data-hello', 'Is there anybody?');
                  Console::log( '#2 - We\'ve just set the attribute of the HTML\'s <script> tag to data-hello="Is there anybody?".' );
            ?>

      </section>

      <footer class="main-footer">
            <p class="main-footer__author">By <a href="https://be.linkedin.com/in/toon-van-den-bos-40461264" target="_blank">Toon Van den Bos</a></p>
            <p class="main-footer__created">Project started: may 2016</p>
      </footer>
      <?php Console::exec(); ?>
</body>
</html>