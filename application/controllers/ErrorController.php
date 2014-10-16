<?php

class ErrorController extends Zend_Controller_Action
{
	public function init(){

		
	}

    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
        
		switch ($errors->type) {
			case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
			case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
				 
				 // 404 error -- controller or action not found
				$this->getResponse()->setHttpResponseCode(404);
				$this->view->message = 'Page not found';
				break;
			case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
				
				// 404 error -- controller or action not found
				$this->getResponse()->setHttpResponseCode(404);
				$this->view->message = 'Page not found';
				break;
			default:
				// application error
				$this->getResponse()->setHttpResponseCode(500);
				$this->view->message = 'Application error';
				break;
		}

		// conditionally display exceptions
		if ($this->getInvokeArg('displayExceptions') == true) {
			$this->view->exception = $errors->exception;
		}
		$this->view->exception = $errors->exception;
		$this->view->request = $errors->request;
    }

	public function deniedAction(){
		// action body
	}

	public function notFoundAction() {
		
		//Zend_Debug::dump($this->_getAllParams());
		//goes here if the page was not found
	}
	 
	public function notAuthorizedAction() {
		
		//goes here if the user has no access to a page
	}
}



