<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    
	/**
	 * Inicializace route
	 * @see /configs/routes.xml
	 **/
    protected function _initRoute(){
		
		$config = new Zend_Config_Xml(APPLICATION_PATH . "/configs/routes.xml");
	
		$router =  Zend_Controller_Front::getInstance()->getRouter();
		$router->addConfig($config, "routes");
		
	}   

	protected function _initPlugins(){

		$front = Zend_Controller_Front::getInstance();
		# ACL control
		$auth = Zend_Auth::getInstance();
		$front->registerPlugin(new App_Plugin_AccessControl($auth, new App_Model_Acl($auth)));	
	
	}
	
    /*protected function _initNamespaces()
    {
        $autoloader = Zend_Loader_Autoloader::getInstance();

		$namespaces = array("Zend", "Zag", "PhpThumb");
        $autoloader->registerNamespace($namespaces);
    }*/
   
    protected function _initViewHelpers()
    {
		
        $view = $this->bootstrap('layout')->getResource('layout')->getView();
        
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers/', 'Helper');
        //$view->addHelperPath(APPLICATION_PATH . '/views/helpers/order/', 'Helper_Order');
		
		$view->doctype(Zend_View_Helper_Doctype::XHTML1_RDFA);
        // meta 
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8')
						 ->appendHttpEquiv('Content-Language', 'cs-CZ');
		
        // title
        $view->headTitle("Monitoring");
        $view->headTitle()->setSeparator(' - ');
        
		//Zend_View_Helper_PaginationControl::setDefaultViewPartial('partials/default-paginator.phtml');

    }

	

}

