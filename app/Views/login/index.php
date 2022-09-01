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
  <link rel="stylesheet" href="<?= base_url('assets/css/login/login.css')?>">
</head>

<body>
    <div class="content-login-page">
        <div class="header-login">
            <div class="left-icons">
                <a class="login-icon" href="https://github.com/luizottavioc" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                </a>
                <a class="login-icon" href="https://linkedin.com/in/luizottavioc" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                </a>
            </div>
            <div class="right-icons">
                <div class="aloc-switch-theme">
                    <input type="checkbox" id="switch-theme" class="check-switch-theme">
                    <label for="switch-theme" class="switch-theme">
                        <span class="circle-theme"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="just-login-page">
            <div class="background-login">
                <svg viewBox="0 0 1440 600" xmlns="http://www.w3.org/2000/svg" class="bg-svg">
                    <linearGradient id="login-bg-gradient">
                        <stop offset="0%" />
                        <stop offset="100%" />
                    </linearGradient>
                    <path d="M 0,600 C 0,600 0,300 0,300 C 208.40000000000003,286.26666666666665 416.80000000000007,272.53333333333336 559,284 C 701.1999999999999,295.46666666666664 777.2,332.1333333333333 913,339 C 1048.8,345.8666666666667 1244.4,322.93333333333334 1440,300 C 1440,300 1440,600 1440,600 Z" stroke="none" stroke-width="0" fill="url(#login-bg-gradient)" fill-opacity="1" class="login-wave"></path>
                </svg>
            </div>
            <div class="aloc-card-login">
                <div class="header-card">
                    <div class="aloc-logo-login">
                        <img src="<?=base_url('/image-icons/fantasy-logo.png')?>" alt="">
                    </div>
                </div>
                <div class="content-card">
                    <form id="auth-user" name="auth_user" action="/login/auth" method="POST" autocomplete="off" class="aloc-data-login">
                        <div class="aloc-input login">
                            <input type="text" name="login" class="input" placeholder=" " value="<?=session()->get('last_login') !== null ? session()->get('last_login') : ''?>">
                            <label class="plch">Login:</label>
                        </div>
                        <div class="aloc-input login">
                            <input type="password" name="password" class="input" placeholder=" ">
                            <label class="plch">Senha:</label>
                        </div>
                        <div class="aloc-input login">
                            <input id="submit-login" type="submit" class="d-none">
                            <label for="submit-login" class="submit-form login">
                                <label class="text-btn">Entrar</label>
                                <span class="bg-btn"></span>
                            </label>
                        </div>
                    </form>
                </div>
                <div class="footer-card">
                    Ainda não possui conta? <a href="" class="ajax-redirect" data-url="">Cadastre-se</a>
                </div>
                
            </div>
        </div>
    </div>
    
</body>

<script src="<?= base_url("sweet-alert2/dist/sweetalert2.all.js") ?>"></script>
<script src="<?= base_url("jquery/dist/jquery.min.js") ?>"></script>
<script src="<?= base_url("assets/js/login/login.js") ?>"></script>
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
