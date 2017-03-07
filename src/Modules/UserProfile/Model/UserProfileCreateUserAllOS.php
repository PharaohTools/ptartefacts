<?php

Namespace Model;

class UserProfileCreateUserAllOS extends Base {

    // Compatibility
    public $os = array("any") ;
    public $linuxType = array("any") ;
    public $distros = array("any") ;
    public $versions = array("any") ;
    public $architectures = array("any") ;

    // Model Group
    public $modelGroup = array("CreateUser") ;

    public function getData() {
        $ret["data"] = $this->createUser();
        return $ret ;
    }

    public function createUser() {

//        $create_perms = $this->checkCreationPermissions() ;
//        if ($create_perms !== true) { return $create_perms ; }

        $valid = $this->validateUserDetails() ;
        if ($valid !== true) { return $valid ; }

        $createdUser = $this->makeTheUser() ;
        if ($createdUser !== true) { return $createdUser ; }

        $return = array(
            "status" => true ,
            "message" => "User Created",
            "user" => $this->getOneUserDetails($this->params["create_username"]) );
        return $return ;

    }

    public function validateUserDetails() {
        if ($this->userAlreadyExists()) {
            $return = array(
                "status" => false ,
                "message" => "This username already exists" );
            return $return ; }
        $presult = $this->passwordInvalid() ;
        if ($presult !== true) {
            $return = array(
                "status" => false ,
                "message" => $presult );
            return $return ; }
        return true ;
    }

    private function userAlreadyExists() {
        $allusers = $this->getAllUserDetails() ;
        foreach ($allusers as $oneuser) {
            if ($oneuser['username'] == $this->params["create_username"]) {
                return true ; } }
        return false ;
    }

    private function passwordInvalid() {

        if ($this->params["update_password"] !== $this->params["update_password_match"]) {
            $return =  "Passwords must match" ;
            return $return ; }

        if (strlen($this->params["update_password"]) <3 ) {
            $return = "Password must be longer than three characters" ;
            return $return ; }

        return true ;
    }

    private function getAllUserDetails() {
        $userAccountFactory = new \Model\UserAccount();
        $userAccount = $userAccountFactory->getModel($this->params);
        $me = $userAccount->getLoggedInUserData() ;
        $rid = $userAccount->getUserRole($me['email']);
        if ($rid == 1) {
            $au =$userAccount->getUsersData();
            return $au; }
        return array() ;
    }

    private function getOneUserDetails($username) {
        $userAccountFactory = new \Model\UserAccount();
        $userAccount = $userAccountFactory->getModel($this->params);
        $au = $userAccount->getUserDataByUsername($username);
        return $au ;
    }

    private function makeTheUser() {

        $newUser["username"] = $this->params["create_username"] ;
        $newUser["password"] = $this->params["update_password"] ;
        $newUser["email"] = $this->params["create_email"] ;
        $newUser["status"] = 1 ;
        $newUser["role"] = 1 ;

        $userAccountFactory = new \Model\UserAccount();
        $userAccount = $userAccountFactory->getModel($this->params);
        $cu = $userAccount->createNewUser($newUser);

        if ($cu == false) {
            $return = array(
                "status" => false ,
                "message" => "Unable to create this user" );
            return $return ; }

        return true ;
    }

}
