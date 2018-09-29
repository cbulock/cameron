<?php
namespace cbulock\me\controller;

class AlwaysSunny extends Standard {

	public function process() {

		$this->setTemplate('always_sunny');

		$data = new \cbulock\me\alwayssunny\Data();

		$this->addData(['list' => $data->all()]);
	}

}