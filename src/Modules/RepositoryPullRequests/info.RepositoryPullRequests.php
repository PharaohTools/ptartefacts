<?php

Namespace Info;

class RepositoryPullRequestsInfo extends PTConfigureBase {

    public $hidden = false;

    public $name = "RepositoryPullRequests Module";

    public function _construct() {
      parent::__construct();
    }

    public function routesAvailable() {
      return array( "RepositoryPullRequests" => array("show", "create") );
    }

    public function routeAliases() {
      return array("repositoryPullRequests"=>"RepositoryPullRequests");
    }

    public function helpDefinition() {
      $help = <<<"HELPDATA"
  This command is part of Core - Display or find historys of commits...
HELPDATA;
      return $help ;
    }

}