<?php

Namespace Controller ;

class PullRequest extends Base {

    public function execute($pageVars) {
        $thisModel = $this->getModelAndCheckDependencies(substr(get_class($this), 11), $pageVars) ;
        // if we don't have an object, its an array of errors
        $this->content = $pageVars ;
        if (is_array($thisModel)) {
            return $this->failDependencies($pageVars, $this->content, $thisModel) ; }
        if ($pageVars["route"]["action"] == "close") {
            $close_data = $thisModel->updatePullRequestStatus();
            $page_data = $thisModel->getData();
            $this->content["data"] = array_merge($close_data, $page_data) ; }
        if ($pageVars["route"]["action"] == "show") {
            $this->content["data"] = $thisModel->getData(); }
        if ($pageVars["route"]["action"] == 'add-comment') {
            $commentModel = $this->getModelAndCheckDependencies(substr(get_class($this), 11), $pageVars, 'Comments') ;
            $this->content["data"] = $commentModel->attemptCreatePullRequestComment();
            return array ("type"=>"view", "view"=>"pullRequestAPHAX", "pageVars"=>$this->content); }
        return array ("type"=>"view", "view"=>"pullRequest", "pageVars"=>$this->content);
    }

}