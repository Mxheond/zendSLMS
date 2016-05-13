<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initSession(){
		Zend_Session::start();
		$session = new
		Zend_Session_Namespace( 'Zend_Auth' );
		$session->setExpirationSeconds( 1800 );
	}

<<<<<<< HEAD
	protected function _initSession()
		{
			Zend_Session::start();
			$session = new Zend_Session_Namespace( 'Zend_Auth' );
			// $session->setExpirationSeconds( 1800 );
		}
=======
	protected function _initPlaceholders()
	{
		$this->bootstrap('View');
		$view = $this->getResource('View');
		$view->doctype('XHTML1_STRICT');
		//Meta
		$view->headMeta()->appendName('keywords', 'framework, PHP')
		->appendHttpEquiv('Content-Type','	text/html;charset=utf-8');
		// Set the initial title and separator:
		$view->headTitle('BLOG')->setSeparator(' :: ');
		// Set the initial stylesheet:
		$view->headLink()->prependStylesheet('/zendSLMS/public/css/prettyPhoto.css');
		$view->headLink()->prependStylesheet('/zendSLMS/public/css/parallax.css');
		$view->headLink()->prependStylesheet('/zendSLMS/public/css/font-awesome.min.css');
		$view->headLink()->prependStylesheet('/zendSLMS/public/css/owl.carousel.css');
		$view->headLink()->prependStylesheet('/zendSLMS/public/css/jquery.bxslider.css');
		$view->headLink()->prependStylesheet('/zendSLMS/public/css/bootstrap-responsive.css');
		$view->headLink()->prependStylesheet('/zendSLMS/public/css/bootstrap.css');
		$view->headLink()->prependStylesheet('/zendSLMS/public/css/transitions.css');
		$view->headLink()->prependStylesheet('/zendSLMS/public/css/color.css');		
		$view->headLink()->prependStylesheet('/zendSLMS/public/css/style.css');
		
		// Set the initial JS to load:
		$view->headScript()->prependFile('/zendSLMS/public/js/functions.js');
		$view->headScript()->prependFile('/zendSLMS/public/js/skrollr.min.js');
		$view->headScript()->prependFile('/zendSLMS/public/js/modernizr.js');
		$view->headScript()->prependFile('/zendSLMS/public/js/owl.carousel.js');
		// $view->headScript()->prependFile('https://maps.googleapis.com/maps/api/js?v=3.exp');
		$view->headScript()->prependFile('/zendSLMS/public/js/jquery.bxslider.min.js');
		$view->headScript()->prependFile('/zendSLMS/public/js/bootstrap.min.js');
		$view->headScript()->prependFile('/zendSLMS/public/js/jquery-1.11.0.min.js');
	}
>>>>>>> 084892eec83807a025ce36621de7bd0551e5a6e4

}

