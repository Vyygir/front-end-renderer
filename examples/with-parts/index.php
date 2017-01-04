<?php
require_once '../../vendor/autoload.php';
$renderer = new FER\Renderer();
$renderer->addPart('header.php', $renderer::PART_BEFORE);
$renderer->addPart('footer.php', $renderer::PART_AFTER);
$renderer->addPart('sidebar.php', $renderer::PART_IN_TEMPLATE, '##SIDEBAR##');
$renderer->addRoute('/', 'home.php');
$renderer->addRoute('/about', 'about.php');
$renderer->buffer();
echo $renderer->render();