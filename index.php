<?php
    #⊗ppPmSDPrm №1
require 'connect.php';

$url = $_SERVER['REQUEST_URI'];
$layout = file_get_contents('layout.html');
$header = file_get_contents('html/header.html');
$footer = file_get_contents('html/footer.html');

$route = '/categories$';
if (preg_match("#$route#", $url, $slugs)) {
    $page = require 'pages/categories.php';
}

$route = '/categories/(?<categorySlug>[a-zA-Z-_]+)$';
if (preg_match("#$route#", $url, $slugs)) {
    $page = require 'pages/show_category.php';
}

$layout = preg_replace('#{{ title }}#', $page['title'], $layout);
$layout = preg_replace('#{{ content }}#', $page['content'], $layout);
$layout = preg_replace('#{{ css }}#', "<link rel='stylesheet' href='$page[css]'>", $layout);
$layout = preg_replace('#{{ header }}#', $header, $layout);
$layout = preg_replace('#{{ footer }}#', $footer, $layout);

echo $layout;



?>