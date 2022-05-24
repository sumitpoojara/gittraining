<?php

require_once __DIR__.'/bootstrap.php';

$parameters = [
'my_var' => 'Hello world !!!',
'times' => 5,
];

// Render our view
echo $twig->render('helloworld.html.twig', $parameters);

?>
