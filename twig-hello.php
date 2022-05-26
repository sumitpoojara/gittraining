<?php

require_once __DIR__.'/bootstrap.php';

$parameters = [
  'my_var' => 'Hello world !!!',
  'times'   => 5,
  'show_all' => 'yes',
];

use Twig\Extra\Intl\IntlExtension;
use Twig\Extra\Html\HtmlExtension;
use Twig\Extra\Markdown\MarkdownExtension;
use Twig\Extra\String\StringExtension;
use Twig\Extension\DebugExtension;

$twig->addExtension(new IntlExtension());
$twig->addExtension(new HtmlExtension());
$twig->addExtension(new MarkdownExtension());
$twig->addExtension(new StringExtension());
$twig->addExtension(new DebugExtension());

//CUSTOM Filter
$filter = new \Twig\TwigFilter('disp_dot_spell', function ($string, $ar) {
    //extra arguments
    $string = htmlspecialchars($string);

    $is_truncate = $is_newline = '';
    if(!empty($ar)){
        $is_newline = $ar[0];
        $is_truncate= $ar[1];
    }
    if($is_newline==true){ $string = '<br>'.$string;}
    if($is_truncate !=''){ $string = substr($string,0,$is_truncate); }

    $str = $string;
    $str = str_replace('.','<b style="font-size:10px">[dot]</b>',$str);

    //return ($string);
    return $str;
}, [ 'is_safe' => ['html'], 'deprecated' => true, 'alternative'=>'LinkOmitSplChar'] );

$twig->addFilter($filter);

//CUSTOM FUNCTION
$function = new \Twig\TwigFunction('sum_of_arr', function ($arr) {
    return array_sum($arr);
});
$twig->addFunction($function);

// Render our view
echo $twig->render('helloworld.html.twig', $parameters);
?>
