<?php
namespace FER\Routes;

class Route {
	private $path;
	private $template;

	public function __construct($path, $template) {
		$this->path = $path;
		$this->template = $template;
	}

	public function getPath() {
		return $this->path;
	}

	public function getTemplate() {
		return $this->template;
	}
}
