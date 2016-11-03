<?php
namespace cbulock\me\controller;

class Beer extends Standard {

	public function process() {

		$this->setTemplate('beer');

		$beerdata = new \cbulock\me\beer\Data();

		$this->addData(['recent' => $beerdata->recent()]);
		$this->addData(['fav_styles' => $beerdata->fav_styles()]);
		$this->addData(['all_styles' => $beerdata->all_styles()]);
		$this->addData(['recent_fav_styles' => $beerdata->recent_fav_styles()]);
		$this->addData(['most_checked_in' => $beerdata->most_checked_in()]);
	}

}
