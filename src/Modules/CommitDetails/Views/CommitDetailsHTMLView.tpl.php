<div class="container" id="wrapper">
       
        <div class="navbar-default col-sm-2 sidebar" role="navigation">
		<div class="sidebar-nav ">
			<ul class="nav in" id="side-menu">


                <?php

                if (in_array($pageVars["data"]["current_user_role"], array("1", "2"))) {

                ?>
                <li>
                    <a href="/index.php?control=Index&amp;action=show" class="hvr-bounce-in">
                        <i class="fa fa-dashboard fa-fw hvr-bounce-in"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="/index.php?control=RepositoryList&amp;action=show" class="hvr-bounce-in">
                        <i class="fa fa-bars fa-fw hvr-bounce-in"></i> All Repositories
                    </a>
                </li>
                <li>
                    <a href="index.php?control=RepositoryConfigure&action=show&item=<?php echo $pageVars["data"]["repository"]["project-slug"] ; ?>" class="hvr-bounce-in">
                        <i class="fa  fa-cog fa-fw hvr-bounce-in"></i> Configure
                    </a>
                </li>

                <?php

                }
                ?>

                <li>
                    <a href="index.php?control=FileBrowser&action=show&item=<?php echo $pageVars["data"]["repository"]["project-slug"] ; ?>" class="hvr-bounce-in">
                        <i class="fa fa-folder-open-o hvr-bounce-in"></i> File Browser
                    </a>
                </li>
                <li>
                    <a href="index.php?control=RepositoryCharts&action=show&item=<?php echo $pageVars["data"]["repository"]["project-slug"] ; ?>" class="hvr-bounce-in">
                        <i class="fa fa-bar-chart-o hvr-bounce-in"></i> Charts
                    </a>
                </li>
                <li>
                    <a href="index.php?control=RepositoryHistory&action=show&item=<?php echo $pageVars["data"]["repository"]["project-slug"] ; ?>"class="hvr-bounce-in">
                        <i class="fa fa-history fa-fw hvr-bounce-in""></i> History <span class="badge"></span>
                    </a>
                </li>

                <?php

                if (in_array($pageVars["data"]["current_user_role"], array("1", "2"))) {

                    ?>

                    <li>
                        <a href="index.php?control=CommitDetails&action=delete&item=<?php echo $pageVars["data"]["repository"]["project-slug"] ; ?>" class="hvr-bounce-in">
                            <i class="fa fa-trash fa-fw hvr-bounce-in""></i> Delete
                        </a>
                    </li>

                <?php

                }
                ?>

            </ul>
        </div>
        </div>
    
        <div class="col-lg-9">

            <div class="well well-lg ">
           
            <div class="row clearfix no-margin">
            	<h3 class="text-uppercase text-light ">Commit</h3>

                <p><strong>Commit Message: </strong><?php echo $pageVars["data"]["commit"]->getMessage() ; ?></p>
                <p><strong>Committer: </strong><?php echo $pageVars["data"]["commit"]->getAuthor()->getName() ; ?></p>
                <p><strong>Hash: </strong><?php echo $pageVars["data"]["commit"]->getShortHash() ; ?></p>
                <p><strong>Date: </strong><?php echo $pageVars["data"]["commit"]->getDate()->format('H:i d/m/Y') ; ?></p>
                <hr />
                <p><strong>Diffs: </strong></p>
                <?php
                    $diffs = $pageVars["data"]["commit"]->getDiffs() ;
                    $count = $pageVars["data"]["commit"]->getChangedFiles() ;
                    if ($count==1) {
                        $sinpluris = "is" ;
                        $sinplur = "file" ; }
                    else {
                        $sinpluris = "are" ;
                        $sinplur = "files" ; }
                    echo "<p> There {$sinpluris} {$count} changed {$sinplur}</p>" ;

//                var_dump('<pre>', $diffs, '</pre>') ;

                    foreach ($diffs as $diff) {
                        echo '<div class="commitDiff">' ;
                        $file = $diff->getFile() ;
                        echo '<p class="diff_file_name">';
                        echo '<a href="index.php?control=FileBrowser&action=show&item=' ;
                        echo $pageVars["data"]["repository"]["project-slug"] ;
                        echo '&relpath=' ;
                        echo $file ;
                        echo '/">View in File Browser</a></p>' ;
                        echo '<p class="old_diff_line">'.$diff->getOld() .'</p>' ;
                        echo '<p class="new_diff_line">'.$diff->getNew() .'</p>' ;
                        $difflines = $diff->getLines() ;
                        foreach ($difflines as $diffline) {
                            $type = $diffline->getType() ;
                            if ($type == "old") {
                                echo '<p class="old_diff_line">' . $diffline->getLine() . "</p>" ; }
                            else if ($type == "new") {
                                echo '<p class="new_diff_line">' . $diffline->getLine() . "</p>" ; }
                            else {
                                echo "<p>" . $diffline->getLine() . "</p>" ; }
                        }
                        echo '</div>' ;
                    }

                ?>
                <p><strong>File Browser: </strong><a href="http://source.pharaoh.tld/"></a></p>
            </div>

        </div>

    </div>
</div>
<link rel="stylesheet" type="text/css" href="/Assets/Modules/CommitDetails/css/commitdetails.css">
