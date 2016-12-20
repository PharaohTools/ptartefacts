<?php

Namespace Model;

class UserSSHKeyCreateKeyAllOS extends Base {

    // Compatibility
    public $os = array("any") ;
    public $linuxType = array("any") ;
    public $distros = array("any") ;
    public $versions = array("any") ;
    public $architectures = array("any") ;

    // Model Group
    public $modelGroup = array("CreateKey") ;

    public function getData() {
        $ret["data"] = $this->createKey();
        return $ret ;
    }

    public function createKey() {
        $valid = $this->validateKeyDetails() ;
        if ($valid !== true) {
            return $valid ; }
        $createdKey = $this->addTheKey() ;
        if ($createdKey !== true) {
            return $createdKey ; }
        $one_stored_key = $this->getOneKeyDetails($this->params["create_username"]) ;
        $return = array(
            "status" => true ,
            "message" => "Key Created",
            "fingerprint" => "" );
        return $return ;

    }

    public function validateKeyDetails() {
        if ($this->keyAlreadyExists()) {
            $return = array(
                "status" => false ,
                "message" => "This Key Name already exists" );
            return $return ; }
        $presult = $this->keyInvalid() ;
        if ($presult !== true) {
            $return = array(
                "status" => false ,
                "message" => $presult );
            return $return ; }
        return true ;
    }

    private function keyAlreadyExists() {
        $allkeys = $this->getAllKeyDetails() ;
        foreach ($allkeys as $onekey) {
            if ($onekey->keyname == $this->params["new_ssh_key_title"]) {
                return true ; } }
        return false ;
    }

    private function keyInvalid() {

        if (strlen($this->params["new_ssh_key"]) <7 ) {
            $return = "This does not apear to be an SSH Key" ;
            return $return ; }

        $crypt_loc = dirname(__DIR__).DS.'Libraries'.DS.'phpseclib'.DS.'Crypt'.DS ;
        $crypt_files = scandir($crypt_loc) ;
        foreach ($crypt_files as $crypt_file) {
            if (!in_array($crypt_file, array('.', '..'))) {
                require_once $crypt_loc.$crypt_file ; } }

        $math_loc = dirname(__DIR__).DS.'Libraries'.DS.'phpseclib'.DS.'Math'.DS ;
        $math_files = scandir($math_loc) ;
        foreach ($math_files as $math_file) {
            if (!in_array($math_file, array('.', '..'))) {
                require_once $math_loc.$math_file ; } }

//        $seclib_loc = dirname(__DIR__).DS.'Libraries'.DS.'phpseclib'.DS.'Crypt'.DS.'RSA.php' ;
//        require_once $seclib_loc;
        $rsa = new \Crypt_RSA() ;
        $rsa->setPublicKey($this->params["new_ssh_key"]) ;

        $finger = $rsa->getPublicKeyFingerprint() ;
        if ($finger === false) {
            $msg = 'Unable to generate fingerprint.l This key is invalid.' ;
            return $msg ; }
//        var_dump($finger, $this->params["new_ssh_key"]) ;


        return true ;
    }

    private function getAllKeyDetails() {

        $signupFactory = new \Model\Signup();
        $signup = $signupFactory->getModel($this->params);
        $me = $signup->getLoggedInUserData() ;
        $uname = $me->username;

        $datastoreFactory = new \Model\Datastore() ;
        $datastore = $datastoreFactory->getModel($this->params) ;

        $loggingFactory = new \Model\Logging() ;
        $logging = $loggingFactory->getModel($this->params) ;
        $parsed_filters = array() ;
        $parsed_filters[] = array("where", "user_name", '=', $uname ) ;

        if ($datastore->collectionExists('user_ssh_keys')==false){

            $column_defines = array(
                'key_id' => 'integer',
                'title' => 'string',
                'key_data' => 'string',
                'fingerprint' => 'string'
            );
            $logging->log("Creating User SSH Keys Collection in Datastore", $this->getModuleName()) ;

            $datastore->createCollection('user_ssh_keys', $column_defines) ;
        }
        $keys = $datastore->findAll('user_ssh_keys', $parsed_filters) ;

//        var_dump($keys) ;

//        $logging->log('Collating Existing, Collection', $this->getModuleName()) ;


        return $keys ;
    }

    private function getOneKeyDetails($keyname) {
        $signupFactory = new \Model\Signup();
        $signup = $signupFactory->getModel($this->params);
        $au =$signup->getKeysData();
        foreach ($au as $onekey) {
            if ($onekey->keyname == $this->params["new_ssh_key_title"]) {
                $return = new \StdClass();
                $return->keyname = $onekey->keyname ;
                $return->email = $onekey->email ;
                return $return ; } }
        return array() ;
    }

    private function addTheKey() {

        $newKey["key_data"] = $this->params["new_ssh_key"] ;
        $newKey["title"] = $this->params["new_ssh_key_title"] ;
        $newKey["fingerprint"] = $this->params["create_email"] ;

        $datastoreFactory = new \Model\Datastore() ;
        $datastore = $datastoreFactory->getModel($this->params) ;


        $res = $datastore->insert('user_ssh_keys', array(
            "job_slug"=>$this->params["item"],
            "issue_slug"=>$name,
        )) ;



        if ($res == false) {
            $return = array(
                "status" => false ,
                "message" => "Unable to add this SSH Key to your account" );
            return $return ; }

        return true ;
    }

}
