<?php
require_once '../../vendor/autoload.php';
$renderer = new FER\Renderer();
$renderer->addPart('header.php', $renderer::PART_BEFORE);
$renderer->addPart('footer.php', $renderer::PART_AFTER);
$renderer->addRoute('/', 'home.php');
$renderer->addRoute('/about', 'about.php');
$renderer->buffer();
echo $renderer->render();