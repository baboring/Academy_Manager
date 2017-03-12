<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<link rel="shortcut icon" href="<?php echo URL; ?>favicon.ico">
 	<link rel="stylesheet" href="<?php echo URL; ?>public/css/style.css">
 	<link rel="stylesheet" href="<?php echo URL; ?>public/css/option.css">

	<!-- java script load -->
	<script src="<?php echo URL; ?>public/js/functions.js"></script>
    <title><?php echo APP_NAME?></title>
</head>
<body>
	<div class="app">
    <!-- views ---------------------------------------------- -->
<?php 
    $daysofweek[1] = 'Monday';
    $daysofweek[2] = 'Tuesday';
    $daysofweek[3] = 'Wednesday';
    $daysofweek[4] = 'Thursday';
    $daysofweek[5] = 'Friday';
    $daysofweek[6] = 'Saturday';

    $hours = array("08","09","10","11","12","13","14","15","16","17","18","19","20");
    $minutes = array("00","10","20","30","40","50");
    $terms = array("00","60","120");
	
	require_once('_server/views/head/div.navbar.php');
	require_once('_server/views/CallReceiver_API.php');
?>
    <!-- views ---------------------------------------------- -->
    <div class="contents" style="margin:0 auto;">

<?php 


?>
