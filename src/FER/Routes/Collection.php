<?php
namespace FER\Routes;

use FER\Routes\Route;

class Collection {
	private $routes = array();

	public function add(Route $route) {
		$this->routes[] = $route;
	}

	public function match($path) {
		if (!empty($this->routes)) {
			foreach ($this->routes as $_route) {
				if ($_route->getPath() == $path) {
					return $_route->getTemplate();
				}
			}
		}

		return false;
	}

	public function hasRoutes() {
		return (count($this->routes) > 0);
	}
}
