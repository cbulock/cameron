<?php
namespace cbulock\me\controller;

class BreweryMap extends Standard {

	public function process() {

		$this->setTemplate('brewerymap');

		$beermapdata = new \cbulock\me\brewerymap\Data();

		$this->addData(['all' => $beermapdata->all()]);

	}

}
