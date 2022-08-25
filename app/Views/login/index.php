<!DOCTYPE html>

<html lang="pt-br" id="html-id" class="light">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title class="title-page">To-Do List - Login</title>
  <?php date_default_timezone_set("America/Sao_Paulo") ?>
  <!-- font awesome -->
  <link rel="stylesheet" href="<?= base_url('fontawesome/css/all.css')?>">
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <!-- style default -->
  <link rel="stylesheet" href="<?= base_url('assets/css/styles.css')?>">
</head>

<body>
    <form id="auth-user"  name="auth_user" action="/login/auth" method="POST" autocomplete="off">
        <div class="gd-spaces-1 gap-2 w100 pd-3">
            <div class="aloc-input">
                <input type="text" name="login" class="input" placeholder=" " value="<?=session()->get('last_login') !== null ? session()->get('last_login') : ''?>">
                <label class="plch">Login:</label>
            </div>
            <div class="aloc-input">
                <input type="password" name="password" class="input" placeholder=" ">
                <label class="plch">Senha:</label>
            </div>
            <div class="aloc-input">
                <input id="submit-login" type="submit" class="d-none">
                <label for="submit-login" class="submit-form">
                    <label>Entrar</label>
                    <i class="fa-solid fa-arrow-right"></i>
                </label>
            </div>
        </div>
    </form>
</body>

<script src="<?= base_url("sweet-alert2/dist/sweetalert2.all.js") ?>"></script>
<script src="<?= base_url("jquery/dist/jquery.min.js") ?>"></script>
<?php
    if (session()->get('alert') !== null) {
        echo 
        '<script>
            Swal.fire({
                toast: true,
                icon: "' . session()->get('type_alert') . '",
                position: "top-end",
                title: "' . session()->get('alert') . '",
                background: "f3f2f6",
                color: "#0a0a0b",
                showConfirmButton: false,
                timer: 2300
            });
        </script>';
    }
?>
</html>
