<?

class App_Plugin_AccessControl extends Zend_Controller_Plugin_Abstract {

    private $_acl = null;

    public function __construct($auth, $acl) {

        $this->_acl = $acl;
        $this->_auth = $auth;
    }

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        
        //As in the earlier example, authed users will have the role user
        $role = "guest";
        
        if($this->_auth->hasIdentity()) {
            $role = $this->_auth->getIdentity()->role;
        }
        
        $request = $this->getRequest();
        $resource = strtolower($request->getControllerName());
        $action = $request->getActionName();
        
        // ověříme zda existuje resource
        if(!Zend_Controller_Front::getInstance()->getDispatcher()->isDispatchable($request)){
            return $request->setControllerName('error')->setActionName('not-found');
        }

        // jinak ověříme ACL
        if (!$this->_acl->isAllowed($role, $resource, $action)) {

			// pošleme uživatele jinam
           return $request->setControllerName('error')
                    ->setActionName('denied');

        }
        
		// potaháme si menu
		Zend_View_Helper_Navigation_HelperAbstract::setDefaultAcl($this->_acl);
		Zend_View_Helper_Navigation_HelperAbstract::setDefaultRole($role);
        
    }

}
