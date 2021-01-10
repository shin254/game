<?php
require "config.php";

$lang = isset($_GET['lang']) ? $_GET['lang'] : "";

if (!empty($lang)) {
    $curr_lang = $_SESSION['curr_lang'] = $lang;
} else if (isset($_SESSION['curr_lang'])) {
    $curr_lang = $_SESSION['curr_lang'];
} else {
    $curr_lang = "en";
}

if (file_exists("languages/" . $curr_lang . ".php")) {
    include "languages/" . $curr_lang . ".php";
} else {
    include "languages/en.php";
}

// Returns language key
function lang_key($key)
{
    global $arrLang;
    $output = "";
    
    if (isset($arrLang[$key])) {
        $output = $arrLang[$key];
    } else {
        $output = str_replace("_", " ", $key);
    }
    return $output;
}

if (isset($_SESSION['username'])) {
    $uname = $_SESSION['username'];
    $suser = mysqli_query($connect, "SELECT * FROM `players` WHERE username='$uname'");
    $count = mysqli_num_rows($suser);
    if ($count > 0) {
        echo '<meta http-equiv="refresh" content="0; url=home.php" />';
        exit;
    }
}

$_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$dirname   = $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']);
$vcity_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$dirname";

$query = mysqli_query($connect, "SELECT * FROM `settings` LIMIT 1");
$row   = mysqli_fetch_assoc($query);

$timeon  = time() - 60;
$queryop = mysqli_query($connect, "SELECT * FROM `players` WHERE timeonline>$timeon");
$countop = mysqli_num_rows($queryop);

$querytp = mysqli_query($connect, "SELECT * FROM `players`");
$counttp = mysqli_num_rows($querytp);

$querybp = mysqli_query($connect, "SELECT * FROM `players` ORDER BY respect DESC LIMIT 1");
$countbp = mysqli_num_rows($querybp);
if ($countbp > 0) {
    $rowbp       = mysqli_fetch_assoc($querybp);
    $best_player = $rowbp['username'];
} else {
    $best_player = "-";
}

$querynp = mysqli_query($connect, "SELECT * FROM `players` ORDER BY id DESC LIMIT 1");
$countnp = mysqli_num_rows($querynp);
if ($countnp > 0) {
    $rownp         = mysqli_fetch_assoc($querynp);
    $newest_player = $rownp['username'];
} else {
    $newest_player = "-";
}

if (isset($_GET['theme'])) {
    $id      = (int) $_GET["theme"];
    $queryts = mysqli_query($connect, "SELECT * FROM `themes` WHERE id='$id'");
    $rowts   = mysqli_fetch_assoc($queryts);
    $countts = mysqli_num_rows($queryts);
    if ($countts > 0) {
        $_SESSION["csspath"] = $rowts['csspath'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="<?php
echo $row['description'];
?>">
    <meta name="keywords" content="<?php
echo $row['keywords'];
?>">
    <meta name="author" content="Antonov_WEB">
    <link rel="icon" href="assets/img/favicon.png">

    <title><?php
echo $row['title'];
?></title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- Skin -->
<?php
if (isset($_SESSION["csspath"])) {
?>
    <link href="<?php
    echo $_SESSION["csspath"];
?>" rel="stylesheet">
<?php
} else {
    $querytd = mysqli_query($connect, "SELECT * FROM `themes` WHERE `default_theme`='Yes'");
    $rowtd   = mysqli_fetch_assoc($querytd);
?>
    <link href="<?php
    echo $rowtd["csspath"];
?>" rel="stylesheet">
<?php
}
?>

    <!-- Game CSS -->
    <link href="assets/css/game.css" rel="stylesheet">

    <!--Custom CSS -->
    <link href="assets/css/custom.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
</head>

<body>

   <div class="container" >
       <div class="col-md-12">
           <div class="main-bg"></div>
       </div>
   </div>




    <footer class="footer">
        <div class="container-fluid">
		<div class="row">
            <div class="col-md-6">
		
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php
echo lang_key("languages");
?> <span class="caret caret-up"></span></button>
                <ul class="dropdown-menu drop-up" role="menu">
                    <li><a href="?lang=<?php
echo $rowld['langcode'];
?>"><?php
echo $rowld['language'];
?> [<?php
echo lang_key("default");
?>]</a></li>
                    <li class="divider"></li>
<?php
$queryl = mysqli_query($connect, "SELECT * FROM `languages`");
while ($rowl = mysqli_fetch_assoc($queryl)) {
?>
                    <li><a href="?lang=<?php
    echo $rowl['langcode'];
?>"><?php
    echo $rowl['language'];
?></a></li>
<?php
}
?>
                </ul>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php
echo lang_key("themes");
?> <span class="caret caret-up"></span></button>
                <ul class="dropdown-menu drop-up" role="menu">
                    <li><a href="?theme=<?php
echo $rowtd['id'];
?>"><?php
echo $rowtd['name'];
?> [<?php
echo lang_key("default");
?>]</a></li>
                    <li class="divider"></li>
<?php
$queryt = mysqli_query($connect, "SELECT * FROM `themes`");
while ($rowt = mysqli_fetch_assoc($queryt)) {
?>
                    <li><a href="?theme=<?php
    echo $rowt['id'];
?>"><?php
    echo $rowt['name'];
?></a></li>
<?php
}
?>
                </ul>
            </div>
			
			</div>
			<div class="col-md-6">
			
            <div class="pull-right">&copy; <?php
echo date("Y");
?> <?php
echo $row['title'];
?></div>
            <a href="#" class="go-top"><i class="fa fa-arrow-up"></i></a>
			
			</div>
		</div>
        </div>
    </footer>

    <!-- JavaScript Libraries
    ================================================== -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Game JS -->
    <script src="assets/js/game.js"></script>

</body>
</html>