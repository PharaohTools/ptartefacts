<?php

Namespace Controller ;

class UserSSHKey extends Base {

    public function execute($pageVars) {
        $thisModel = $this->getModelAndCheckDependencies(substr(get_class($this), 11), $pageVars) ;
        // if we don't have an object, its an array of errors
        $this->content = $pageVars ;
        if (is_array($thisModel)) { 
			return $this->failDependencies($pageVars, $this->content, $thisModel) ;
		}

        $loginSession = $thisModel->checkLoginSession() ;

        if ($pageVars['route']['action'] === "new") {
            if($loginSession["status"] == TRUE){
                $this->content["data"] = $thisModel->getData();
                return array ("type"=>"view", "view"=>"UserSSHKey", "pageVars"=>$this->content); }
            return array ("type"=>"view", "view"=>"UserSSHKeyAlert", "pageVars"=>$this->content); }

        if ($pageVars['route']['action'] === "create") {
            if($loginSession["status"] == TRUE){
                // @todo output format change not being implemented
                $thisModel = $this->getModelAndCheckDependencies(substr(get_class($this), 11), $pageVars, "CreateUser") ;
                $this->content["params"]["output-format"] = "JSON";
                $this->content['route']["extraParams"]["output-format"] = "JSON";
                $this->content["data"] = $thisModel->getData();
                return array ("type"=>"view", "view"=>"userSSHKeyCreateUser", "pageVars"=>$this->content);  }
            return array ("type"=>"view", "view"=>"UserSSHKeyAlert", "pageVars"=>$this->content); }

        if ($pageVars['route']['action'] === "update") {
            if($loginSession["status"] == TRUE){
                // @todo output format change not being implemented
                $thisModel = $this->getModelAndCheckDependencies(substr(get_class($this), 11), $pageVars, "UpdateUser") ;
                $this->content["params"]["output-format"] = "JSON";
                $this->content['route']["extraParams"]["output-format"] = "JSON";
                $this->content["data"] = $thisModel->getData();
                return array ("type"=>"view", "view"=>"userSSHKeyUpdateUser", "pageVars"=>$this->content);  }
            return array ("type"=>"view", "view"=>"UserSSHKeyAlert", "pageVars"=>$this->content); }

        if ($pageVars['route']['action'] === "delete") {
            if($loginSession["status"] == TRUE){
                // @todo output format change not being implemented
                $thisModel = $this->getModelAndCheckDependencies(substr(get_class($this), 11), $pageVars, "DeleteUser") ;
                $this->content["params"]["output-format"] = "JSON";
                $this->content['route']["extraParams"]["output-format"] = "JSON";
                $this->content["data"] = $thisModel->getData();
                return array ("type"=>"view", "view"=>"userSSHKeyDeleteUser", "pageVars"=>$this->content);  }
            return array ("type"=>"view", "view"=>"UserSSHKeyAlert", "pageVars"=>$this->content); }

        if ($pageVars['route']['action'] === "show") {
            if($loginSession["status"] == TRUE){
                $this->content["data"] = $thisModel->getData();
                $this->content["userdata"] = $thisModel->getUserDetails();
                return array ("type"=>"view", "view"=>"UserSSHKey", "pageVars"=>$this->content); }
            return array ("type"=>"view", "view"=>"UserSSHKeyAlert", "pageVars"=>$this->content); }

        if ($pageVars['route']['action'] === "save") {
            if($loginSession["status"] == TRUE){
                $thisModel->saveData();
                $this->content["data"] = $thisModel->getData();
                $this->content["userdata"] = $thisModel->getUserDetails();
                return array ("type"=>"view", "view"=>"UserSSHKey", "pageVars"=>$this->content); }
            return array ("type"=>"view", "view"=>"UserSSHKeyAlert", "pageVars"=>$this->content); }

        if ($pageVars['route']['action'] === "get-user") {
            // @todo output format change not being implemented
            $thisModel = $this->getModelAndCheckDependencies(substr(get_class($this), 11), $pageVars, "GetUser") ;
            $this->content["params"]["output-format"] = "JSON";
            $this->content['route']["extraParams"]["output-format"] = "JSON";
            $this->content["data"] = $thisModel->getData();
            return array ("type"=>"view", "view"=>"userSSHKeyGetUser", "pageVars"=>$this->content); }
    }

}