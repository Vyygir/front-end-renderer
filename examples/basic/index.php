<?php
require_once '../../vendor/autoload.php';
$renderer = new FER\Renderer();
$renderer->addRoute('/', 'test.php');
$renderer->render();
