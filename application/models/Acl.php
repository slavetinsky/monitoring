<?php

class App_Model_Acl extends Zend_Acl {

    public function __construct()
    {
  
        // základní role
        $this->addRole(new Zend_Acl_Role("guest"));
        $this->addRole(new Zend_Acl_Role("editor"), "guest");
        $this->addRole(new Zend_Acl_Role("caddy"), "editor");
        $this->addRole(new Zend_Acl_Role("photographer"), "editor");
        $this->addRole(new Zend_Acl_Role("corrector"), "editor");	   
        $this->addRole(new Zend_Acl_Role("chief"), "editor");
        $this->addRole(new Zend_Acl_Role("admin"), "chief");
  
  
	   $controllers = array(
			"article", "calendar", "chief",
			"corrector", "editor", "error",
			"index", "user", "photographer", "news"
		);

        // resources
	   foreach ($controllers as $controller) {
		  $this->add(new Zend_Acl_Resource($controller));
	   }

        // quests,
        $this->allow("guest", "index")
			 ->allow("guest", "error")
			 ->allow("guest", "user", array("login", "profile"));
		
		$this->allow("photographer", "photographer");
		
		$this->allow("editor", "editor")
			 ->allow("editor", "news")
			 ->allow("editor", "user")
		 	 ->allow("editor", "article", array())
		 	 ->allow("chief", "photographer");
		 	 
		 	 
		$this->allow("caddy", "calendar")
			 ->allow("caddy", "user")
			 ->allow("chief", "photographer");
			
		$this->allow("chief", "chief")
			 ->allow("chief", "article")
			 ->allow("chief", "photographer");
			 
		$this->allow("corrector", "corrector")
			 ->allow("corrector", "article");
		
		$this->allow("admin");
		
        // customers
       /* $this->allow('customer', 'order', array("list", "show", "report", "bill"))
		   ->allow('customer', 'user', array("profile","password", "welcome"));
		   //->deny("customer", "api", array("help"));
        
	   // contractors
	   $this->allow('contractor', 'contractor')
			->deny("contractor", "contractor", array("costs"))
			->allow("contractor", "api", "help");
	   
	   // admins
        $this->allow('admin')
			->allow("admin", "contractor"); */
              
         
    }
}
