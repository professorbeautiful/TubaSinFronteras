<?php 

$H2Line1 = "H2Line1 - put the text you want in descriptionfile.txt";
$H2Line2 = "H2Line2 - ditto";
$H2Line3 = "H2Line3 - ditto";



	//$base = $_SERVER["PHP_SELF"];
	//$base = "http://www.biostats.upci.pitt.edu/day/Bioinf%202054/docs/index.php";

// this copy sorts and orders properly.  It gets an odd initial setting
// for "sort" -   ../../docs/sort    --   probably caused by
// dreamweaver refactoring.  
   /***************************************************************************

snif 1.2.8
"snif is not an index file"
"simple and nice index file"
(c) Kai Blankenhorn
www.bitfolge.de
kaib@bitfolge.de


THIS IS THE REAL SNIF INDEX.PHP FILE.


This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details: <http://www.gnu.org/licenses/gpl.txt>

****************************************************************************


Changelog:

v1.2.8	12-13-03
	settings have been split in basic and advanced settings
	added configurable server name instead of what PHP detects (thanks to Paul Munn)
	added configurable date and time format (thanks to Paul Munn)
	improved default hidden file wildcards, now also hides emacs temp files (thanks to Paul Munn)
	notices are now always suppressed
	fixed various HTML and CSS glitches (thanks to Paul Munn)
	fixed a bug which caused the sorting arrow not to be displayed (thanks to Paul Munn)
	renamed and reorganized stylesheets (thanks to Paul Munn)

v1.2.7	12-09-03
	cross site scripting bug fixed (thanks to Justin Hagstrom for reporting)
	fixed a bug with the new hidden file wildcards

v1.2.6	12-06-03
	improved external icons: you may now mix external and internal icons 
	improved directory sorting (thanks to mpember at mpember dot net dot au)
	improved default hidden files wildcards, now also hides .* (thanks to Charles Hill)
	fixed a minor bug in file type detection (thanks to Charles Hill)
	added more file extensions (thanks to Charles Hill)

v1.2.5	11-26-03
	security fix: download would allow paths above snif directory

v1.2.4	11-16-03
	added configurable separation string for description files
	added option to use external icons

v1.2.3	11-15-03
	fixed minor typos and HTML glitches

v1.2.2	11-11-03
	fixed a bug where the current path wasn't properly shown in the heading

v1.2.1	11-10-03
	fixed files without extension
	suppressed warning when io functions fail
	experimental handling of symbolic links (completely untested! Please give feedback.)

v1.2	11-04-03
	put a simple file into subdirectories to have snif handle direct requests to them
	minor bugfix

v1.1a	11-03-03
	file download for Opera fixed

v1.1	11-03-03
	download files instead of opening
	better documentation
	code cleanup

v1.0    10-19-03
    initial release



****************************************************************************
**  DESCRIPTION FILE FORMAT                                               **
****************************************************************************

Hardcore definition:

<descriptionfile>  ::= <line>*
<line>             ::= <filename><separationString><description><EOL>
<filename>         ::= <anythingExceptSeparationString>+
<separationString> ::= defined by the $separationString variable, default "\t"
<description>      ::= <anyting>+
<EOL>              ::= "\r\n" | "\n"			// OS dependent


Simple example:

.	This directory contains downloadable files for MyProgram 12.0.
myprogram_12.0.exe	Installer version of MyProgram 12.0 (recommended)
myprogram_12.0.zip	Zip file distribution of MyProgram 12.0
releasenotes.txt	Release notes for MyProgram 12.0


Please note that the room between the filename and the description is not
filled with multiple spaces, but with one single tab. It doesn't matter if
the descriptions in a file align or not, just use one tab.
If you use a description for the current directory (.) as in the first line
in the above example, it will be used as a heading in the directory listing.

Put your descriptions in a text file within the same directory as the files 
to describe. Then put the text file's name in the $useDescriptionsFrom 
variable below. It is suggested that you use the same description file name
in all subdirectories you want to list. Reason: Read the next paragraph.

To make it even easier: For my download folder at 
http://www.bitfolge.de/download, I have put the description file at
http://www.bitfolge.de/download/descript.ion. You can download it and use
it as another example.


****************************************************************************
**  HANDLING SUBDIRECTORY LISTINGS                                        **
****************************************************************************

Say you've put the snif index.php into www.yourhost.com/download.
Now somebody makes a request to www.yourhost.com/download/releases. In
order to deal with this properly, you would have to copy the snif index.php
to that directory, too. But this will prevent the user to go to 
www.yourhost.com/download from www.yourhost.com/download/releases
directly by selecting the .. link.

If you have this situation, use the index.php file from the subdirectory
called "subdir" in the snif archive file. All it does is automatically 
forward the user to the parent directory and set URL parameters so that
the real snif will handle the request.

OK, that may be confusing. Again, a simple example:


/download/descript.ion                       << descriptions for /download/*.*
/download/index.php                          << this file you're reading now, >18 KB
/download/license.txt
/download/notes.txt
/download/releases/bigprogram_2.0.zip
/download/releases/descript.ion              << descriptions for /download/releases/*.*
/download/releases/index.php                 << subdir/index.php, <2 KB
/download/releases/nightly/2.1_20031103.zip
/download/releases/nightly/2.1_20031104.zip
/download/releases/nightly/index.php         << subdir/index.php, <2 KB


If a users points his browser to
  www.yourhost.com/download/releases/nightly/
  
The small index.php will forward him to
  www.yourhost.com/download/releases/?path=nightly/

And then the index file in that directory will forward him again, this time to
  www.yourhost.com/download/?path=releases/nightly/

Now we've reached the directory with the real snif (should get a copyright on
that phrase ;-)), which will take over and miraculously lists the directory
the user typed as an URL.



/***************************************************************************/
/**  SET YOUR CONFIGURATION HERE                                          **/
/***************************************************************************/



/**************  BASIC SETTINGS  *******************************************/
/* These settings configure the most basic functions of snif. You should   */
/* be able to understand them quickly.                                     */
/***************************************************************************/

/**
 * Specify which files should be hidden in the file listing using
 * unix/DOS wildcards (? and *).
 * This is case insensitive. This script, the current directory and the
 * description file will automatically be hidden.
 **/
$hiddenFilesWildcards = Array("*.php", "*~");

/**
 * Show sub directories and let the user change to them.
 * It will be impossible to go above the directory this script is in.
 **/
$allowSubDirs = true;

/**
 * Allow the users to download .php files. This will expose the full contents
 * of the downloaded files (including any password used in it). Be careful
 * with this!
 * This only makes sense if you don't hide all .php files.
 **/
$allowPHPDownloads = false;





/**************  ADVANCED SETTINGS  ****************************************/
/* Usually you won't need to change these, but you may have a look if you  */
/* want snif to do something you think it can't. Maybe there's a setting   */
/* which lets you do it.                                                   */
/***************************************************************************/

/**
 * Set the server name to be reported on generated pages. Use this only if
 * your server reports the wrong name if $_SERVER['HTTP_HOST'] (which is 
 * the default) is used.
 **/
$snifServer = $_SERVER['HTTP_HOST'];
//$snifServer = 'www.yourdomain.com';

/**
 * Set the date and time format used for file modified dates. For the syntax
 * of this string, please refer to 
 * http://www.php.net/manual/en/function.date.php
 **/
$snifDateFormat = 'Y-m-d';

/**
 * Specify which files should be hidden in the file listing using
 * regular expressions. Do not use expression limiters or modifiers.
 * These patterns will be merged with $hiddenFilesWildcards.
 **/
$hiddenFilesRegex = Array();
 
/**
 * Description file, leave blank for no descriptions.
 **/
$useDescriptionsFrom = "descriptionfile.txt";

/**
 * Define the string that should be used to separate file names and
 * descriptions in the description files. Defaults to "\t" (tab).
 **/
$separationString = "\t";

/**
 * Use external images instead of built-in ones. If you set this to
 * true, you should specify each of the $iconForXXX variables below.
 * If you don't, internal images will be used instead.
 **/
$useExternalImages = true;

/**
 * State the filenames for external file icons. Only used if
 * $useExternalImages == true. Paths are relative to the directory of snif.
 * Icon size should be 16x16 pixels, except where noted otherwise.
 * Use an empty string to use the internally stored image for that icon.
 **/
$externalIcons = Array (
	"archive"	=> "",
	"binary"	=> "",
	"folder"	=> "",
	"html"		=> "",
	"image"		=> "",
	"text"		=> "",
	"unknown"	=> "",
	"download"	=> "",		// 7x16 pixels
	"asc"		=> "",		// 5x3 pixels
	"desc"		=> ""		// 5x3 pixels
);




/***************************************************************************/
/**  REAL CODE STARTS HERE                                                **/
/***************************************************************************/


// INITIALISATION

// make sure all the notices don't come up in some configurations
error_reporting (E_ALL ^ E_NOTICE);

$displayError = "";

// safify all GET variables
foreach($_GET AS $key => $value) {
	$_GET[$key] = strip_tags($value);
}

// first of all, security: prevent any unauthorized paths
// if sub directories are forbidden, ignore any path setting
if (!$allowSubDirs) {
	$path = "";
} else {
	$path = $_GET["path"];
	
	// ignore any potentially malicious paths
	$path = safeDirectory($path);
}

// default sorting is by date
if ($_GET["sort"]=="") 
	$_GET["sort"] = "date";
if ($_GET["sort"]=="../../docs/date") 
	$_GET["sort"] = "date";

// default order is ascending
if ($_GET["order"]=="") {
	$_GET["order"] = "asc";
} else {
	$_GET["order"] = strtolower($_GET["order"]);
}
	
// add files used by snif to hidden file list
$hiddenFilesWildcards[] = $useDescriptionsFrom;
$hiddenFilesWildcards[] = ".";
$hiddenFilesWildcards[] = basename($_SERVER["PHP_SELF"]);

// build hidden files regular expression
for ($i=0;$i<count($hiddenFilesWildcards);$i++) {
	$from = Array(".","*","?");
	$to = Array("\\.",".*",".?");
	$hiddenFilesRegex[] = "^".str_replace($from,$to,$hiddenFilesWildcards[$i])."$";
}
// hide .*
$hiddenFilesRegex[] = "^\\.[^.].*$";
$hiddenFilesWholeRegex = "/".join("|",$hiddenFilesRegex)."/i";

// handle image requests
if ($_GET["getimage"]!="") {
	Header("Content-Type: image/gif");
	Header("Expires: ".date("r",time()+3600));
	
	switch ($_GET["getimage"]) {
		case "archive":		echo base64_decode("R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAI3lA+pxxgfUhNKPRAbhimu2kXiRUGeFwIlN47qdlnuarokbG46nV937UO9gDMHsMLAcSYU0GJSAAA7"); break;
		case "asc":		echo base64_decode("R0lGODlhBQADAIABAN3d3f///yH5BAEAAAEALAAAAAAFAAMAAAIFTGAHuF0AOw=="); break;
		case "binary":		echo base64_decode("R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAI0lICZxgYBY0DNyfhAfROrxoVQBo5mpzFih5bsFLoX5iLYWK6xyur5ubPAbhPZrKhSKCmCAgA7"); break;
		case "desc":		echo base64_decode("R0lGODlhBQADAIABAN3d3f///yH5BAEAAAEALAAAAAAFAAMAAAIFhB0XC1sAOw=="); break;
		case "folder":		echo base64_decode("R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAIplI+JwKAJggzuiThl2wbnT3UgWHmjJp5Tqa5py7bhJc/mWW46Z/V+UgAAOw=="); break;
		case "html":		echo base64_decode("R0lGODlhEAAQAKIHABsb/2ho/4CA/0BA/zY2/wAAAP///////yH5BAEAAAcALAAAAAAQABAAAANEeFfcrVAVQ6thUdo6S57b9UBgSHmkyUWlMAzCmlKxAZ9s5Q5AjWqGwIAS8OVsNYJxJgDwXrHfQoVLEa7Y6+Wokjq+owQAOw=="); break;
		case "image":		echo base64_decode("R0lGODlhEAAQAKIEAK6urmRkZAAAAP///////wAAAAAAAAAAACH5BAEAAAQALAAAAAAQABAAAANCSCTcrVCJQetgUdo6RZ7b9UBgSHnkAKwscEZTy74pG9zuBavA7dOanu+H0gyGxN0RGdClKEjgwvKTlkzFhWOLISQAADs="); break;
		case "text":		echo base64_decode("R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAI0lICZxgYBY0DNyfhAfXcuxnWQBnoKMjXZ6qUlFroWLJHzGNtHnat87cOhRkGRbGc8npakAgA7"); break;
		case "download":	echo base64_decode("R0lGODlhBwAQAIABAAAAAP///yH5BAEAAAEALAAAAAAHABAAAAISjI+pywb6UkQzgHsPls3h2gUFADs="); break;
		case "blank":		echo base64_decode("R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="); break;
		case "unknown":		echo base64_decode("R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAI1lICZxgYBY0DNyfhAfXcuxnkI1nCjB2lgappld6qWdE4vFtprR+4sffv1ZjwdkSc7KJYUQQEAOw=="); break;
	}
	die();
}


// handle download requests
if ($_GET["download"]!="") {
	$filename = safeDirectory($path.$_GET["download"]);
	if (
		!file_exists($filename)
		OR fileIsHidden($filename)
		OR (substr(strtolower($filename), -4)==".php" AND !$allowPHPDownloads)) {
		
		Header("HTTP/1.0 404 Not Found");
		$displayError = "File not found: $filename";
	} else {
		Header("Content-Length: ".filesize($filename));
		Header("Content-Type: application/x-download");
		Header("Content-Disposition: attachment; filename=".$_GET["download"]);
		readfile($filename);
		die();
	}
}


function safeDirectory($path) {
	$result = $path;
	if (strpos($path,"..")!==false)
		$result = "";
	if (substr($path,0,1)=="/") {
		$result = "";
	}
	return $result;
}


/**
 * Formats a file's size nicely (750 B, 3.4 KB etc.)
 **/
function niceSize($size) {
	define("SIZESTEP", 1024.0);
	static $sizeUnits = Array("&nbsp;B","KB","MB","GB","TB");
	
	if ($size=="")
		return "";
	
	$unitIndex = 0;
	while ($size>SIZESTEP) {
		$size = $size / SIZESTEP;
		$unitIndex++;
	}
	
	if ($unitIndex==0) {
		return number_format($size, 0)."&nbsp;".$sizeUnits[$unitIndex];
	} else {
		return number_format($size, 1, ".", ",")."&nbsp;".$sizeUnits[$unitIndex];
	}
}

/**
 * Compare two strings or numbers. Return values as strcmp().
 **/
function myCompare($arrA, $arrB, $caseSensitive=false) {
	$a = $arrA[$_GET["sort"]];
	$b = $arrB[$_GET["sort"]];
	
	// sort directories above everything else
	if ($arrA["isDirectory"] != $arrB["isDirectory"]) {
		$result = $arrB["isDirectory"]-$arrA["isDirectory"];
	} else if (
		$arrA["isDirectory"] && $arrB["isDirectory"] &&
		($_GET["sort"]=="type" || $_GET["sort"]=="size")) {
        $result = 0;
	} else {
		if (is_string($a) || is_string($b)) {
			if (!$caseSensitive) {
				$a = strtoupper($a);
				$b = strtoupper($b);
			}
			$result = strcoll($a,$b);
		} else {
			$result = $a-$b;
		}
	}
	
	if (strtolower($_GET["order"])=="desc") {
		$result = -$result;
	} 
	//$result
	return $result ;
}

/**
 * Build a URL using new sorting settings.
 **/
function getNewSortURL($newSort) {
	GLOBAL $path;
	$base = $_SERVER["PHP_SELF"];
	//$base = "http://www.biostats.upci.pitt.edu/day/Bioinf%202054/docs/index.php";
	$url = $base."?sort=$newSort";
	if ($newSort==$_GET["sort"]) {
		if ($_GET["order"]=="asc" OR $_GET["order"]=="") {
			$url.= "&order=desc";
		}
		else
			$url.= "&order=asc";
	}
	if ($path!="") {
		$url.= "&path=$path";
	}
	return $url;
}

/**
 * Determine a file's file type based on its extension.
 **/
function getFileType($extension, $isDir) {
	// put any additional extensions in here
	static $fileTypes = Array(
		"html"		=> Array("html","htm"),
		"image"		=> Array("gif","jpg","jpeg","png","tif","tiff","bmp","art"),
		"text"		=> Array("asp","c","cfg","cpp","css","csv","conf","cue","diz","h","inf","ini","java","js","log","nfo","php","phps","pl","rdf","rss","rtf","sql","txt","vbs","xml"),
		"binary"	=> Array("asf","au","avi","bin","class","divx","doc","exe","mov","mpg","mpeg","mp3","ogg","ogm","pdf","ppt","ps","rm","swf","wmf","wmv","xls"),
		"archive"	=> Array("ace","arc","bz2","cab","gz","lha","jar","rar","sit","tar","tbz2","tgz","z","zip","zoo")
	);
	static $extensions = null;

	if ($extensions==null) {
		$extensions = Array();
		foreach($fileTypes AS $keyType => $value) {
			foreach($value AS $ext) $extensions[$ext] = $keyType;
		}
	}

	if ($isDir)
		return "folder";
	
	$type = $extensions[strtolower($extension)];
	if ($type=="") {
		return "unknown";
	} else {
		return $type;
	}
}

function getIcon($fileType) {
	GLOBAL $useExternalImages, $externalIcons;
	if ($useExternalImages && $externalIcons[$fileType]!="") {
		return $externalIcons[$fileType];
	} else {
		return $_SERVER["PHP_SELF"]."?getimage=$fileType";
	}
}

// checks if a file is hidden from view
function fileIsHidden($filename) {
	GLOBAL $hiddenFilesWholeRegex;
	return preg_match($hiddenFilesWholeRegex,$filename);
}



// change directory
// must be done before description file is parsed
if ($path!="") {
	if (!@chdir($path)) {
		$displayError = "$path is not a subdirectory of the current directory.";
		$path = "";
	}
}
$dir = dir(".");

// parsing description file
$descriptions = Array();
if ($useDescriptionsFrom!="") {
	$descriptionsFile = @file($useDescriptionsFrom);
	if ($descriptionsFile!==false) {
		for ($i=0;$i<count($descriptionsFile);$i++) {
			$d = explode($separationString,$descriptionsFile[$i]);
			$descriptions[$d[0]] = join($separationString, array_slice($d, 1));
			if($d[0] == "H2Line1")
				$H2Line1 = $descriptions[$d[0]];
			if($d[0] == "H2Line2")
				$H2Line2 = $descriptions[$d[0]];
			if($d[0] == "H2Line3")
				$H2Line3 = $descriptions[$d[0]];
		}
	}
}
// build a two dimensional array containing the files in the chosen directory and their meta data
$files = Array();
while($entry = $dir->read()) {
	// if the filename matches one of the hidden files wildcards, skip the file
	if (fileIsHidden($entry))
		continue;
		
	// if the file is a directory and if directories are forbidden, skip it
	if (!$allowSubDirs AND is_dir($entry))
		continue;
	
	$f = Array();

	$f["name"] = $entry;
	$f["isDownloadable"] = (substr(strtolower($entry), -4)!=".php") || $allowPHPDownloads;
	$f["isDirectory"] = is_dir($entry);
	$f["date"] = @filemtime($entry);
	if (is_dir($entry)) {
		$f["type"] = "&lt;DIR&gt;";
		
		// building the link
		if ($entry=="..") {
			// strip the last directory from the path
			$pathArr = explode("/",$path);
			$link = implode("/",array_slice($pathArr,0,count($pathArr)-2));
			
			// if there is no path set, don't add it to the link
			if ($link=="") {
				// we're already in $baseDir, so skip the file
				if ($path=="")
					continue;
				$f["link"] = $_SERVER["PHP_SELF"];
			} else {
				$link.= "/";
				$f["link"] = $_SERVER["PHP_SELF"]."?path=".$link;
			}
		} else {
			$f["link"] = $_SERVER["PHP_SELF"]."?path=".$path.$entry."/";
		}
	} else {
		if (is_link($entry)) {
			$linkTarget = readlink($entry);
			$pi = pathinfo($linkTarget);
			$scriptDir = dirname($_SERVER["SCRIPT_FILENAME"]);
			if (strpos($pi["dirname"], $scriptDir)===0) {
				$f["type"] = "&lt;LINK&gt;";
				// links have no date, so take the target's date
				$f["date"] = filemtime($linkTarget);
				$f["link"] = $path.substr($linkTarget, strlen($scriptDir)+1);
			} else {
				// link target is outside of script directory, so skip it
				continue;
			}
		} else {
			$f["size"] = @filesize($entry);
			$pi = pathinfo($entry);
			$f["type"] = $pi["extension"];
			$f["link"] = $path.$entry;
		}
	}
	$f["filetype"] = getFileType($f["type"], is_dir($entry));
	$f["icon"] = getIcon($f["filetype"]);
	$f["description"] = $descriptions[$entry];
	$files[] = $f;
}

usort($files, "myCompare");

$columns = 4;
if ($useDescriptionsFrom!="")
	$columns++;

?>
<html>
	<head>
		<title>Index of <?echo dirname($_SERVER["PHP_SELF"])."/".$path;?></title>
  <style type="text/css">
			.snif * {
				font-family: Tahoma, Sans-Serif;
				font-size: 10pt;
			}
			body {
				background: ##aFaFa6;
			}
			table.snif {
				border: 3px solid #444400;
			}
			table.snif td {
				padding-left: 10px;
				padding-right: 10px;
			}
			td.snifDir {
				font-weight: bold;
				color: #4abb0f;
				background-color: #008000;
				padding-top: 3px;
				padding-bottom: 3px;
			}
			tr.snifHeading, td.snifHeading, td.snifHeading a {
				font-weight: bold;
				color: #dddddd;
				background-color: #244424;
				padding-top: 3px;
				padding-bottom: 3px;
			}
			td.snifFile {
				color: #444444;
				padding-top: 2px;
				padding-bottom: 2px;
				vertical-align: top;
				padding-left: 10px;
				padding-right: 10px;
			}
			td.snifFile a {
				color: #000000;
			}
			.snif a {
				text-decoration: none;
			}
			.snif a:hover {
				text-decoration: underline;
			}
			td.snifFile a:hover {
				text-decoration: none;
				background-color: #bbbbee;
			}
			tr.snifEven {
				background-color: #eeeeee;
			}
			tr.snifOdd {
				background-color: #dddddd;
			}
			.snifCopyright {
				font-family: Tahoma, Sans-Serif;
				color: #bbbbbb;
				font-size: 8pt;
			}
			.snifSmaller {
				font-weight: normal;
				font-size: 8pt;
			}
			.snifNoWrap {
				white-space:nowrap;
			}
		</style>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head> 
<body bgcolor="#9999FF" text="#000000">
<h2 align=center style='text-align:center'>

<? echo $H2Line1 ; ?>

</h2>

<h2 align=center style='text-align:center'>

<? echo $H2Line2 ; ?>

</h2>

  
<p align=center style='text-align:center'><font size="+2">
<? echo $H2Line3 ; ?>
</font></p>

<p align=center style='text-align:center'>Email: 
<a href="mailto:day@upci.pitt.edu">day@upci.pitt.edu</a></p>
<p>Click on the arrow before the file you wish to download or view.</p>

  <?
if ($displayError!="") {
	echo "<b style=\"color:red\">$displayError</b><br><br>";
}
?>
<span class="snif"></span><span class="snif"> 
<table width="867" border="0" cellpadding="0" cellspacing="0" class="snif">
  <tr> 
    <td width="185" colspan="<?echo $columns?>" bgcolor="#b05030" class="snifDir"> http://<?echo $snifServer?><?echo dirname($_SERVER["PHP_SELF"])."/".$path;?><br>
      <span class="snifSmaller"><?echo $descriptions["."];?></span> </td>
  </tr>
  <tr class="snifHeading"> 
    <td class="snifHeading"> <img src="<?echo $PHP_SELF?>?getimage=blank" alt="" width="30" height="16" border="0" style="vertical-align:middle;"><a href="<?echo getNewSortURL("name");?>">name</a> 
      <?
			$sort = $_GET["sort"];
			if ($sort=="name")
				echo "<img src=\"".getIcon($_GET["order"])."\" width=\"5\" height=\"3\" style=\"vertical-align:middle;\" alt=\"".$_GET["order"]."\">&nbsp;";
			?>
    </td>
    <td width="102" class="snifHeading"> <a href="<?echo getNewSortURL("type");?>">type</a> 
      <?
			if ($sort=="type")
				echo "<img src=\"".getIcon($_GET["order"])."\" width=\"5\" height=\"3\" style=\"vertical-align:middle;\" alt=\"".$_GET["order"]."\">&nbsp;";
			?>
    </td>
    <td width="98" align="right" class="snifHeading"> 
      <?
			if ($sort=="size")
				echo "&nbsp;<img src=\"".getIcon($_GET["order"])."\" width=\"5\" height=\"3\" style=\"vertical-align:middle;\" alt=\"".$_GET["order"]."\">";
			?>
      <a href="<?echo getNewSortURL("size");?>">size</a> </td>
    <td width="102" class="snifHeading"> <a href="<?echo getNewSortURL("date");?>">date</a> 
      <?
			if ($sort=="date")
				echo "<img src=\"".getIcon($_GET["order"])."\" width=\"5\" height=\"3\" style=\"vertical-align:20%;\" alt=\"".$_GET["order"]."\">&nbsp;";
			?>
    </td>
    <?
		if ($useDescriptionsFrom!="") {
		?>
    <td width="374" class="snifHeading">description</td>
    <?
		}
		?>
  </tr>
  <?
	for ($i=0;$i<count($files);$i++) {
	?>
  <tr class="<?echo ($i%2==0) ? "snifEven" : "snifOdd"?>"> 
    <td class="snifFile snifNoWrap"> 
      <?
			if ($files[$i]["isDirectory"] OR !$files[$i]["isDownloadable"]) {?>
      <img src="<?echo $PHP_SELF?>?getimage=blank" alt="" width="7" height="16" border="0" style="vertical-align:middle;"> 
      <?} else {?>
      <a href="<?echo $PHP_SELF?>?path=<?echo $path?>&download=<?echo $files[$i]["name"];?>"><img src="<?echo getIcon("download")?>" title="download" width="7" height="16"  border="0" style="vertical-align:middle;"></a> 
      <?}?>
      <a href="<?echo $files[$i]["link"];?>"><img src="<?echo $files[$i]["icon"]?>" title="<?echo $files[$i]["filetype"]?>" width="16" height="16" border="0" style="vertical-align:middle;">&nbsp;<?echo $files[$i]["name"];?>&nbsp;</a> 
    </td>
    <td class="snifFile snifNoWrap"><?echo $files[$i]["type"];?></td>
    <td class="snifFile snifNoWrap" align="right"><span title="<?echo number_format($files[$i]["size"],0,".",".");?> Bytes"><?echo niceSize($files[$i]["size"]);?></span></td>
    <td class="snifFile snifNoWrap"><span title="<?echo date("r",$files[$i]["date"]);?>"><?echo date($snifDateFormat,$files[$i]["date"]);?></span></td>
    <?
		if ($useDescriptionsFrom!="") {
		?>
    <td class="snifFile"><?echo $files[$i]["description"];?></td>
    <?
		}
		?>
  </tr>
  <?
	}
	?>
</table>
</span> 
<p><span class="snif"><br>
  </a></span></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
</body>
</html>
