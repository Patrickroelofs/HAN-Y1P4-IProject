<!DOCTYPE html>
<html lang="nl">
<head>
    <title>EenmaalAndermaal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="EenmaalAndermaal de veilingsite voor u.">


    <link rel="stylesheet" href="css/semantic.min.css" media="all">
    <link rel="stylesheet" href="css/stylesheet.min.css" media="all">


</head>
<body>
<?php include 'mobile-navigation.inc.php'; ?>

<div class="pusher">
<?php
    if(Admin::isLoggedIn()) {
        include 'adminbar.inc.php';
    }
?>
<?php include 'navigation.inc.php'; ?>