<?php

/**
 * Pharaoh Tools Constants
 */

define('PHARAOH_APP', "ptartefacts") ;
define('PHARAOH_APP_FRIENDLY', str_replace("pt", "", PHARAOH_APP)) ;

if (in_array(PHP_OS, array("Windows", "WINNT"))) {
    $sd = getenv('SystemDrive') ;
    $pf = getenv('ProgramFiles') ;
    $pf = str_replace(" (x86)", "", $pf) ;
    $command = "where /R \"{$pf}\" *VBoxManage* " ;
    $outputArray = array();
    exec($command, $outputArray);
    define('SUDOPREFIX', "");
    define('VBOXMGCOMM', "\"{$outputArray[0]}\" ") ;
    define('PFILESDIR', $sd."\\PharaohTools\\") ;
    define('PTCCOMM', PFILESDIR.'ptconfigure.cmd"') ;
    define('PTDCOMM',  PFILESDIR."ptdeploy.cmd") ;
    define('PTVCOMM',  PFILESDIR."ptvirtualize.cmd") ;
    define('PTBCOMM',  PFILESDIR."ptbuild.cmd") ;
    define('PTTRCOMM',  PFILESDIR."pttrack.cmd") ;
    define('PTMCOMM',  PFILESDIR."ptmanage.cmd") ;
    define('PTSCOMM',  PFILESDIR."ptsource.cmd") ;
    define('BOXDIR', $sd.'\\PharaohTools\boxes') ;
    define('PIPEDIR', $sd.'\\PharaohTools\pipes'.'\\') ;
    define('REPODIR', $sd.'\\PharaohTools\repositories'.'\\') ;
	define('PLUGININS', $sd.'\\PharaohTools\plugins\installed'.'\\') ;
    define("DS", "\\");
    define("BASE_TEMP_DIR", getenv("SystemDrive").'\Temp\\'); }
else if (in_array(PHP_OS, array("Linux", "Solaris", "FreeBSD", "OpenBSD", "Darwin"))) {
    define('DS', "/") ;
    $uname = exec('whoami');
    $isAdmin = ($uname == "root") ? true : false ;
    if ($isAdmin == true) { define('SUDOPREFIX', ""); }
    else { define('SUDOPREFIX', "sudo "); }
    define('VBOXMGCOMM', "vboxmanage ") ;
    define('PFILESDIR', "/opt/") ;
    define('PTCCOMM', "ptconfigure ") ;
    define('PTDCOMM', "ptdeploy ") ;
    define('PTVCOMM', "ptvirtualize") ;
    define('PTBCOMM', "ptbuild") ;
    define('PTTRCOMM', "pttrack") ;
    define('PTMCOMM', "ptmanage") ;
    define('PTSCOMM', "ptsource") ;
    define("BASE_TEMP_DIR", '/tmp/');
    define('BOXDIR', '/opt/ptvirtualize/boxes') ;
    define('PIPEDIR', '/opt/ptbuild/pipes') ;
    define('REPODIR', '/opt/ptsource/repositories') ;
    define('PLUGININS', '/opt/ptbuild/plugins/installed') ; }

// LOG LEVELS
define('LOG_FAILURE_EXIT_CODE', 1) ;
