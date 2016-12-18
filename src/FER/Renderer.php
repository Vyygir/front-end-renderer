<?php
namespace FER;

use FER\Routes\Collection as RouteCollection;
use FER\Routes\Route as Route;

class Renderer {
	const PART_BEFORE = 'before';
	const PART_AFTER = 'after';

	private $routes;
	private $options;
	private $template;
	private $parts;
	private $output;

	public function __construct($options = array()) {
		$root = dirname($_SERVER['SCRIPT_FILENAME']);
		$this->parts = array(
			self::PART_BEFORE => array(),
			self::PART_AFTER => array()
		);

		$this->routes = new RouteCollection;
		$this->options = array_replace(array(
			'templates_dir' => $root . '/templates',
			'parts_dir' => $root . '/parts'
		), $options);
	}

	public function addRoute($path, $templateName) {
		$_path = sprintf('%s/%s', $this->options['templates_dir'], $templateName);

		if (file_exists($_path)) {
			$route = new Route($path, $_path);
			$this->routes->add($route);
			return $route;
		}

		return false;
	}

	public function getRoutes() {
		return $this->routes;
	}

	public function addPart($path, $location) {
		$_path = sprintf('%s/%s', $this->options['parts_dir'], $path);

		if (file_exists($_path)) {
			$this->parts[$location][] = $_path;
			return true;
		}

		return false;
	}

	public function getParts($location) {
		if (isset($this->parts[$location])) {
			return $this->parts[$location];
		}

		return false;
	}

	public function buffer() {
		if (!$this->routes->hasRoutes()) {
			trigger_error('There are no routes defined to load from');
		}

		$output = array();
		$request = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
		$template = $this->routes->match($request);

		if (!empty($this->getParts(self::PART_BEFORE))) {
			foreach ($this->getParts(self::PART_BEFORE) as $_part) {
				$output[] = file_get_contents($_part);
			}
		}

		$output[] = file_get_contents($template);

		if (!empty($this->getParts(self::PART_AFTER))) {
			foreach ($this->getParts(self::PART_AFTER) as $_part) {
				$output[] = file_get_contents($_part);
			}
		}

		$this->output = implode('', $output);
	}

	public function render() {
		return $this->output;
	}
}