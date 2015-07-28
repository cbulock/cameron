<?php
namespace cbulock\me\controller;

class Standard extends Base {
 
 protected $interface;
 
 public function __construct($route) {
  parent::__construct($route);
  $this->setupInterface();
 }
 
 protected function setupInterface() {
  $this->interface = new \cbulock\me\site\Standard;
 }
 
 public function setTemplate($template) {
  $this->interface->template($template);
 }
 
 public function addData($data) {
  $this->interface->addData($data);
 }
 
 public function api($method, $params=[]) {
  return $this->interface->api($method, $params);
 }
 
 public function setContentType($content_type) {
  $this->interface->setContentType($content_type);
 }
 
 public function load() {
  parent::load();
  $this->interface->output();
 }
}
