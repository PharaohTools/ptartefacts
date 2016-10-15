<div class="container" id="wrapper">

    <div class="navbar-default col-sm-2 sidebar" role="navigation">
        <div class="sidebar-nav ">
            <ul class="nav in" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form hvr-bounce-in">
                        <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search hvr-"></i>
                                </button>
                            </span>
                    </div>
                    <!-- /input-group -->
                </li>

                <li>
                    <a href="/index.php?control=Index&action=show" class="active hvr-bounce-in" ><i class="fa fa-dashboard fa-fw hvr-bounce-in"></i> Dashboard</a>
                </li>
                <li>
                    <a href="/index.php?control=ApplicationConfigure&action=show" class=" hvr-bounce-in">
                        <i class="fa fa-cogs fa-fw"></i> Configure PTSource<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="/index.php?control=ApplicationConfigure&action=show" class=" hvr-curl-bottom-right">Application</a>
                        </li>
                        <li>
                            <a href="/index.php?control=UserManager&action=show" class=" hvr-curl-bottom-right">Users</a>
                        </li>
                        <li>
                            <a href="/index.php?control=ModuleManager&action=show" class=" hvr-curl-bottom-right">Modules</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="/index.php?control=RepositoryConfigure&action=new" class=" hvr-bounce-in"><i class="fa fa-edit fa-fw hvr-bounce-in"></i> New Repository</a>
                </li>
                <li>
                    <a href="/index.php?control=RepositoryList&action=show" class=" hvr-bounce-in"><i class="fa fa-bars fa-fw hvr-bounce-in"></i> All Repositories</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-lg-9">

        <?php echo $this->renderLogs() ; ?>

        <div class="well well-lg">
            <div class="row clearfix no-margin">

                <div class="row">

                    <div class="col-lg-3 col-md-4 hvr-pop">

                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-database   fa-4x hvr-buzz-out"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge hvr-grow-rotate" ><?php echo $pageVars['pipesDetail']['total']; ?></div>
                                        <div>Total Jobs</div>
                                    </div>
                                </div>
                            </div>
                            <!-- <a href="#">
                                 <div class="panel-footer">
                                     <span class="pull-left">View Details</span>
                                     <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                     <div class="clearfix"></div>
                                 </div>-->
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 hvr-pop">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-check-circle fa-4x hvr-buzz-out"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge  hvr-grow-rotate"><?php echo $pageVars['pipesDetail']['success']; ?></div>
                                        <div>Jobs Complete!</div>
                                    </div>
                                </div>
                            </div>
                            <!--    <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>-->
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 hvr-pop">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-times-circle fa-4x hvr-buzz-out"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge  hvr-grow-rotate"><?php echo $pageVars['pipesDetail']['fail']; ?></div>
                                        <div>Jobs Failed!</div>
                                    </div>
                                </div>
                            </div>
                            <!--   <a href="#">
                                   <div class="panel-footer">
                                       <span class="pull-left">View Details</span>
                                       <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                       <div class="clearfix"></div>
                                   </div>-->
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 hvr-pop">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-chain-broken fa-4x hvr-buzz-out"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge hvr-grow-rotate"><?php echo $pageVars['pipesDetail']['unstable']; ?></div>
                                        <div>Jobs Pending Action!</div>
                                    </div>
                                </div>
                            </div>
                            <!--  <a href="#">
                                  <div class="panel-footer">
                                      <span class="pull-left">View Details</span>
                                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                      <div class="clearfix"></div>
                                  </div>-->
                            </a>
                        </div>
                    </div>
                </div>
				
                <div class="row">
	                <div class="col-lg-12">
	                    <div class="panel panel-default">
	                        <div class="panel-heading">
	                            <i class="fa fa-bar-chart-o fa-fw"></i> Repository Statuses
	                        </div>
	                        <!-- /.panel-heading -->
	                        <div class="panel-body">
	                            <div id="pipes-build-chart"></div>



                                <div class="row">
                                    <div class="col-sm-12 text-center"><h2>Alerts</h2></div>
                                </div>

                                <div class="row text-center">
                                    <div class="col-sm-6 text-center">
                                        <?php
                                        if (isset($pageVars["data"]["latest_system_alerts"]) && count($pageVars["data"]["latest_system_alerts"])>0 ) {
                                            $i = 1;

                                            foreach ($pageVars["data"]["latest_system_alerts"] as $latestAlert) {
                                                ?>


                                                <div class="alertRow" id="alertRow_<?php echo $latestAlert["alert-slug"]; ?>" >
                                                    <div class="blCell cellRowSourceHome" scope="row"><?php echo $latestAlert["alert-slug"]; ?> </div>
                                                    <div class="blCell cellRowName">
                                                        <a href="/index.php?control=AlertHome&action=show&item=<?php echo $pageVars["data"]["job"]["job_slug"]; ?>&alert=<?php echo $latestAlert["alert-slug"] ; ?>" class="pipeName">
                                                            <?php echo $latestAlert["alert-name"]; ?>
                                                        </a>
                                                    </div>
                                                    <div class="blCell cellRowDescription"><?php
                                                        if (strlen($latestAlert["alert-description"]) < 150) {
                                                            echo $latestAlert["alert-description"]; }
                                                        else {
                                                            $trunc = substr($latestAlert["alert-description"], 0, 150) ;
                                                            $trunc .= " ..." ;
                                                            echo $trunc ; } ?>
                                                    </div>
                                                    <div class="blCell cellRowAssignee"><?php echo $latestAlert["alert-assignee"]; ?> </div>
                                                    <div class="blCell cellRowPriority"><?php echo $latestAlert["alert-priority"]; ?> </div>
                                                </div>
                                                <?php

                                                $i++ ;
                                            } }
                                        else { ?>
                                            <h4>No User Alerts Found</h4>

                                        <?php  }  ?>
                                    </div>
                                    <div class="col-sm-6 text-center">
                                        <?php
                                        if (isset($pageVars["data"]["latest_system_alerts"]) && count($pageVars["data"]["latest_system_alerts"])>0 ) {
                                            $i = 1;
                                            foreach ($pageVars["data"]["latest_system_alerts"] as $latestAlert) { ?>
                                                <div class="systemAlertRow" id="systemAlertRow_<?php echo $latestAlert["system-alert-slug"]; ?>" >
                                                    <div class="blCell cellRowSourceHome" scope="row"><?php echo $latestAlert["system-alert-slug"]; ?> </div>
                                                    <div class="blCell cellRowName">
                                                        <a href="/index.php?control=AlertHome&action=show&item=<?php echo $pageVars["data"]["job"]["job_slug"]; ?>&alert=<?php echo $latestAlert["alert-slug"] ; ?>" class="pipeName">
                                                            <?php echo $latestAlert["alert-name"]; ?>
                                                        </a>
                                                    </div>
                                                    <div class="blCell cellRowDescription"><?php
                                                        if(strlen($latestAlert["system-alert-description"]) < 150) {
                                                            echo $latestAlert["system-alert-description"]; }
                                                        else {
                                                            $trunc = substr($latestAlert["system-alert-description"], 0, 150) ;
                                                            $trunc .= " ..." ;
                                                            echo $trunc ; } ?>
                                                    </div>
                                                    <div class="blCell cellRowAssignee"><?php echo $latestAlert["system-alert-assignee"]; ?> </div>
                                                    <div class="blCell cellRowPriority"><?php echo $latestAlert["system-alert-priority"]; ?> </div>
                                                </div>
                                                <?php
                                                $i++ ;
                                            } }
                                        else { ?>
                                            <h4>No System Alerts Found</h4>
                                        <?php  }  ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 text-center"><h2>Calendars</h2></div>
                                </div>

                                <div class="row">

                                    <div class="col-lg-4 col-md-6 hvr-pcreatoop">

                                        <div class="panel panel-primary">
                                            <a href="/index.php?control=IssueCalendar&action=show">
                                                <div class="panel-heading">
                                                    <div class="row">
                                                        <div class="col-xs-12 huge hvr-grow-rotate text-center" >
                                                            All
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                    <span class="allJobsCalendarLink pull-left">View Calendar</span>
                                                    <span class="pull-right allJobsCalendarLink"><i class="fa fa-arrow-circle-right"></i></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <?php
                                    if (isset($pageVars["data"]['user']->username)) {
                                    ?>

                                    <div class="col-lg-4 col-md-6 hvr-pcreatoop">
                                        <div class="panel panel-green">
                                            <a href="/index.php?control=IssueCalendar&action=show&filters[]=user::<?php echo $pageVars["data"]['user']->username ; ?>">
                                                <div class="panel-heading">
                                                    <div class="row">
                                                        <div class="col-xs-12 huge hvr-grow-rotate text-center">
                                                            Yours
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                    <span class="pull-left">View Calendar</span>
                                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <?php
                                    }
                                    ?>

                                    <div class="col-lg-4 col-md-6 hvr-pcreatoop">
                                        <div class="panel panel-yellow">
                                            <a href="/index.php?control=IssueCalendar&action=show&userswitch=true">
                                                <div class="panel-heading">
                                                    <div class="row">
                                                        <div class="col-xs-12 huge hvr-grow-rotate text-center">
                                                            By User
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                    <span class="pull-left">View Details</span>
                                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-sm-12 text-center"><h2>Jobs</h2></div>
                                </div>

                                <div class="row">

                                    <div class="col-lg-4 col-md-6 hvr-pcreatoop">

                                        <div class="panel panel-primary">
                                            <a href="/index.php?control=JobList&action=show">
                                                <div class="panel-heading">
                                                    <div class="row">
    <!--                                                    <div class="col-xs-3">-->
    <!--                                                        <i class="fa fa-database   fa-4x hvr-buzz-out"></i>-->
    <!--                                                    </div>-->
                                                        <div class="col-xs-12 text-center">
                                                            <div class="huge hvr-grow-rotate" ><?php
                                                                $jc = (isset( $pageVars["data"]['job_count'])) ?  $pageVars["data"]['job_count'] : "?" ;
                                                                echo $jc; ?></div>
                                                            <div> Total</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                    <span class="allJobsCalendarLink pull-left">View Jobs</span>
                                                    <span class="allJobsCalendarLink pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($pageVars["data"]['user']->username)) {
                                        ?>
                                        <div class="col-lg-4 col-md-6 hvr-pcreatoop">
                                            <div class="panel panel-green">
                                                <a href="/index.php?control=JobList&action=show&filters[]=job_creator::<?php echo $pageVars["data"]['user']->username ; ?>">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <!--                                                    <div class="col-xs-3">-->
                                                            <!--                                                        <i class="fa fa-check-circle fa-4x hvr-buzz-out"></i>-->
                                                            <!--                                                    </div>-->
                                                            <div class="col-xs-12 text-center">
                                                                <div class="huge  hvr-grow-rotate"><?php
                                                                    $jc = (isset( $pageVars["data"]['my_job_created_count'])) ?  $pageVars["data"]['my_job_created_count'] : "?" ;
                                                                    echo $jc; ?></div>
                                                                <div> Yours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Jobs</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>


                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if (isset($pageVars["data"]['user']->username)) {
                                        ?>
                                        <div class="col-lg-4 col-md-6 hvr-pcreatoop">
                                            <div class="panel panel-green">
                                                <a href="/index.php?control=JobList&action=show&filters[]=job_members[~]::<?php echo $pageVars["data"]['user']->username ; ?>">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <!--                                                    <div class="col-xs-3">-->
                                                            <!--                                                        <i class="fa fa-check-circle fa-4x hvr-buzz-out"></i>-->
                                                            <!--                                                    </div>-->
                                                            <div class="col-xs-12 text-center">
                                                                <div class="huge  hvr-grow-rotate"><?php
                                                                    $jc = (isset( $pageVars["data"]['my_job_member_count'])) ?  $pageVars["data"]['my_job_member_count'] : "?" ;
                                                                    echo $jc; ?></div>
                                                                <div> Member</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel-footer">
                                                        <span class="pull-left">View Jobs</span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>

                                </div>

                                <div class="row">
                                    <div class="col-sm-12 text-center"><h2>Issues</h2></div>
                                </div>

                                <div class="row">

                                    <div class="col-lg-3 col-md-6 hvr-pcreatoop">
                                        <div class="panel panel-primary">
                                            <a href="/index.php?control=IssueList&action=show">
                                                <div class="panel-heading">
                                                    <div class="row">
                                                        <div class="col-xs-12 text-center loading-ajax" id="total-holder-parent">
                                                            <div class="huge hvr-grow-rotate" id="total-holder">
                                                                &nbsp;
                                                            </div>
                                                            <div>Total</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                    <span class="allJobsCalendarLink pull-left">View Issues</span>
                                                    <span class="allJobsCalendarLink pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <?php
                                    if (isset($pageVars["data"]['user']->username)) {
                                    ?>

                                    <div class="col-lg-3 col-md-6 hvr-pcreatoop">
                                        <div class="panel panel-green">
                                            <a href="/index.php?control=IssueList&action=show">
                                                <div class="panel-heading">
                                                    <div class="row">
                                                        <div class="col-xs-12 text-center loading-ajax" id="watching-holder-parent">
                                                            <div class="huge hvr-grow-rotate" id="watching-holder">
                                                                &nbsp;
                                                            </div>
                                                            <div> Watching</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                    <span class="pull-left">View Issues</span>
                                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 hvr-pcreatoop">
                                        <div class="panel panel-green">
                                            <a href="/index.php?control=IssueList&action=show">
                                                <div class="panel-heading">
                                                    <div class="row">
                                                        <div class="col-xs-12 text-center loading-ajax" id="assigned-holder-parent">
                                                            <div class="huge hvr-grow-rotate" id="assigned-holder">
                                                                &nbsp;
                                                            </div>
                                                            <div> Assigned</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                    <span class="pull-left">View Issues</span>
                                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 hvr-pcreatoop">
                                        <div class="panel panel-yellow">
                                            <a href="/index.php?control=IssueList&action=show&filters[]=issue_assignee::<?php echo $pageVars["data"]['user']->username ; ?>">
                                                <div class="panel-heading">
                                                    <div class="row">
                                                        <div class="col-xs-12 text-center loading-ajax" id="submitted-holder-parent">
                                                            <div class="huge hvr-grow-rotate" id="submitted-holder">
                                                                &nbsp;
                                                            </div>
                                                            <div> Submitted</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                    <span class="pull-left">View Issues</span>
                                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>


                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
	                        <!-- /.panel-body -->	                    
	                	</div>
	                </div>             
            </div>

        </div>

        <hr>
        <div class="col-lg-13">

        </div>

</div>

<script type="text/javascript" src="/Assets/Modules/SourceHome/js/sourcehome.js"></script>
<link rel="stylesheet" type="text/css" href="/Assets/Modules/SourceHome/css/sourcehome.css">

<script type="text/javascript">
    $( document ).ready(function() {
        console.log( "ready!" );
        loadAllIssueCount();
        loadWatchingIssueCount();
        loadAssignedIssueCount();
        loadSubmittedIssueCount();
    });
</script>