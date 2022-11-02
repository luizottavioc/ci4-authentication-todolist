<!DOCTYPE html>

<html lang="pt-br" id="html-id" class="<?=session()->get('user_theme') == 1 ? 'dark' : 'light' ?>">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title class="title-page">Afazeres</title>
  <?php date_default_timezone_set("America/Sao_Paulo") ?>
  <!-- font awesome -->
  <link rel="stylesheet" href="<?= base_url('fontawesome/css/all.css')?>">
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <!-- croppie -->
  <link rel="stylesheet" href="<?= base_url('plugins/croppie/croppie.css')?>">
  <!-- style default -->
  <link rel="stylesheet" href="<?= base_url('assets/css/styles.css')?>">
</head>

<body>
  <div class="wrapper">

    <!-- Preloader -->

    <?php include_once('navbar.php') ?>
    <?php include_once('sidebar.php') ?>
    
    <div id="load-mutation-page" class="load-mutation-page">
      <div class="load-diagonal-line"></div>
      <div class="aloc-load-logo">
        <img src="<?= base_url('image-icons/fantasy-logo.png')?>" alt="logo - to do list system">
      </div>
    </div>
    
    <div id='main-container' class="main-container">
