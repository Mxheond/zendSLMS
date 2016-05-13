<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initRequest() {
            $this->bootstrap('FrontController');
            $front = $this->getResource('FrontController');
            $request = new Zend_Controller_Request_Http();
            $front->setRequest($request);
    }
	protected function _initSession(){
		Zend_Session::start();
		$session = new Zend_Session_Namespace( 'Zend_Auth' );
		// $session->setExpirationSeconds( 1800 );
	}

	protected function _initPlaceholders()
	{
		$this->bootstrap('View');
		$view = $this->getResource('View');
		$view->doctype('XHTML1_STRICT');
		//Meta
		$view->headMeta()->appendName('keywords', 'framework, PHP')->appendHttpEquiv('Content-Type','	text/html;charset=utf-8');
		// Set the initial title and separator:
		$view->headTitle('BLOG')->setSeparator(' :: ');
		// Set the initial stylesheet:
		$view->headLink()->prependStylesheet($view->baseUrl().'/css/prettyPhoto.css');
		$view->headLink()->prependStylesheet($view->baseUrl().'/css/parallax.css');
		$view->headLink()->prependStylesheet($view->baseUrl().'/css/font-awesome.min.css');
		$view->headLink()->prependStylesheet($view->baseUrl().'/css/owl.carousel.css');
		$view->headLink()->prependStylesheet($view->baseUrl().'/css/jquery.bxslider.css');
		$view->headLink()->prependStylesheet($view->baseUrl().'/css/bootstrap-responsive.css');
		$view->headLink()->prependStylesheet($view->baseUrl().'/css/bootstrap.css');
		$view->headLink()->prependStylesheet($view->baseUrl().'/css/transitions.css');
		$view->headLink()->prependStylesheet($view->baseUrl().'/css/color.css');		
		$view->headLink()->prependStylesheet($view->baseUrl().'/css/style.css');
		
		// Set the initial JS to load:
		$view->headScript()->prependFile($view->baseUrl().'/js/functions.js');
		$view->headScript()->prependFile($view->baseUrl().'/js/skrollr.min.js');
		$view->headScript()->prependFile($view->baseUrl().'/js/modernizr.js');
		$view->headScript()->prependFile($view->baseUrl().'/js/owl.carousel.js');
		// $view->headScript()->prependFile('https://maps.googleapis.com/maps/api/js?v=3.exp');
		$view->headScript()->prependFile($view->baseUrl().'/js/jquery.bxslider.min.js');
		$view->headScript()->prependFile($view->baseUrl().'/js/bootstrap.min.js');
		$view->headScript()->prependFile($view->baseUrl().'/js/jquery-1.11.0.min.js');
	}

}
