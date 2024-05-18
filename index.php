<?php 
//----INCLUDE APIS------------------------------------
include("api/api.inc.php");

//----PAGE GENERATION LOGIC---------------------------
function createPage()
{
    // Page-Specific Static Content
    $twelcome = file_get_contents("data/static/index_welcome.part.html");
    $site_description = file_get_contents("data/static/site_description.html");
    $album_details = get_album_details();

    $tcontent = <<<PAGE
        <div>
            {$site_description}
            {$twelcome}
        </div>
        <div class="image-container">
            {$album_details}
        </div>
    PAGE;

    return $tcontent;
}

//----BUSINESS LOGIC---------------------------------
//Start up a PHP Session for this user.
session_start();

//Build up our Dynamic Content Items. 
$tpagetitle = "Home Page";
$tpagelead  = "";
$tpagecontent = createPage();
$tpagefooter = "";




//----BUILD OUR HTML PAGE----------------------------
//Create an instance of our Page class
$tpage = new MasterPage($tpagetitle);
//Set the Three Dynamic Areas (1 and 3 have defaults)
if(!empty($tpagelead))
    $tpage->setDynamic1($tpagelead);
$tpage->setDynamic2($tpagecontent);
if(!empty($tpagefooter))
    $tpage->setDynamic3($tpagefooter);

$tpage->setMasterContent();

//Return the Dynamic Page to the user.    
$tpage->renderPage();
?>

<script>function directToAlbum(id) {window.location.href = 'album.php?id=' + id;}</script>