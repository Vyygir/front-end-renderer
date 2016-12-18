<?php
use FER\Renderer;
use FER\Routes\Route;

class RendererTest extends PHPUnit_Framework_TestCase {
	private $renderer;

	public function __construct() {
		$this->renderer = new Renderer(array(
			'templates_dir' => dirname(__FILE__) . '/raw',
			'parts_dir' => dirname(__FILE__) . '/raw'
		));
	}

	public function testCanAddRoute() {
		$route = $this->renderer->addRoute('/', 'template.html');
		$this->assertTrue(is_a($route, 'FER\Routes\Route'));
	}

	public function testCanAddParts() {
		$this->renderer->addPart('part_above.html', Renderer::PART_BEFORE);
		$this->renderer->addPart('part_below.html', Renderer::PART_AFTER);
		$this->assertTrue(count($this->renderer->getParts(Renderer::PART_BEFORE)) > 0);
		$this->assertTrue(count($this->renderer->getParts(Renderer::PART_AFTER)) > 0);
		$this->assertFalse($this->renderer->getParts('nonexistant_location'));
	}

	public function testHasCollection() {
		$collection = $this->renderer->getRoutes();
		$this->assertTrue(is_a($collection, 'FER\Routes\Collection'));
	}

	public function testCollectionHasRoutes() {
		$this->renderer->addRoute('/', 'template.html');
		$this->assertTrue($this->renderer->getRoutes()->hasRoutes());
	}

	public function testCanCreateBuffer() {
		$this->renderer->addRoute('/', 'template.html');
		$this->renderer->buffer();
		$this->assertGreaterThan(0, strlen($this->renderer->render()));
	}

	public function testCanCreateBufferWithParts() {
		$this->renderer->addRoute('/', 'template.html');
		$this->renderer->addPart('part_above.html', Renderer::PART_BEFORE);
		$this->renderer->addPart('part_below.html', Renderer::PART_AFTER);
		$this->renderer->buffer();
		$this->assertGreaterThan(0, strlen($this->renderer->render()));
	}
}