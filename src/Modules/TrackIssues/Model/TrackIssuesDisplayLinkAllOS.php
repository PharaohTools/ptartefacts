<?php

Namespace Model;

class TrackIssuesDisplayLinkAllOS extends Base {

    // Compatibility
    public $os = array("any") ;
    public $linuxType = array("any") ;
    public $distros = array("any") ;
    public $versions = array("any") ;
    public $architectures = array("any") ;

    // Model Group
    public $modelGroup = array("RepositoryFeature") ;

	public $repositoryFeatureValues;
	public $repository;

	public function collate() {
        $collated = array() ;
        $collated = array_merge($collated, $this->getLink()) ;
        $collated = array_merge($collated, $this->getTitle()) ;
        $collated = array_merge($collated, $this->getImage()) ;
		return array($collated ) ;
	}

	public function setValues($vals) {
		$this->repositoryFeatureValues = $vals ;
	}

	public function setRepository($repository) {
		$this->repository = $repository ;
	}

    protected function getAllTrackIssues() {
        $sf = array( "track_job" ) ;
        return $sf ;
    }

    public function getLink() {
        $ff = array("link" =>$this->repositoryFeatureValues["track_job_url"]);
        return $ff ;
    }

	public function getTitle() {
        $ff = array("title" => $this->repository["project-name"]);
		return $ff ;
	}

	public function getImage() {
        $prefix = '/Assets/Modules/DefaultSkin/image/' ;
        $ff = array("image" => "{$prefix}track-logo.png");
		return $ff ;
	}

}
