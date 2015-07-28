<?php
namespace cbulock\me\site;

class Standard {
	
 private $twig;
 private $template;
 protected $data = [];
 private $content_type;
 
 public function __construct() {
  $this->twig_init();
  $this->setContentType("Content-type: text/html; charset=UTF-8");
 }
 
 private function twig_init() {
  $loader = new \Twig_Loader_Filesystem('templates');
  $this->twig = new \Twig_Environment($loader);
 }
 
 public function setContentType($content_type) {
  $this->content_type = $content_type;
 }
 
 public function template($template) {
  $this->template = $template;
 }
 
 public function addData($data) {
  $this->data = array_merge($this->data, $data);
 }
 
 public function render() {
  header($this->content_type);
  $template = $this->twig->loadTemplate($this->template . '.twig');
  return $template->render($this->data);
 }
 
 public function output() {
  echo $this->render();
 }
 
 public function exceptionHandler($e) {
  $code = $e->getCode();
  switch($code) {
   case 403:
   case 404:
    header("HTTP/1.0 ".$code);
    $_SERVER['REDIRECT_STATUS'] = $code;
    $this->addData([
     'number'	=>	$code,
    ]);
    $this->template('error');
    $this->output();
    die();
    break;
   default:
    $this->addData([
     'code'	=>	$code,
     'message'	=>	$e->getMessage()
    ]);
    $this->template('exception');
    $this->output();
    die();
    break;
  }
 }
}