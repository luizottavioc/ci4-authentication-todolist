<?php 
    $data_user = session()->get()['active_user'];
    $path_user = 'files/user_images/'.$data_user['id_user'].'/profile.png';
    $path_default = '/files/user_images/default_image_profile.png';
    $img_user = !file_exists($path_user) ? $path_default : '/'.$path_user;
?>
<aside class="default-sidebar">
    <div class="just-sidebar">
        <div class="aloc-logo">
            <div class="just-logo">
                <img src="<?= base_url('image-icons/fantasy-logo.png')?>" alt="logo - to do list system">
            </div>
            <div class="name-logo">
                Sistema de afazeres
            </div>
        </div>
        <div class="aloc-sid-contents">
            <div class="aloc-sid-profile">
                <a href="/users/profile" class="sid-profile-line ajax-redirect" data-url="/users/profile">
                    <div class="sid-image-profile">
                        <img src="<?= $img_user.'?'.time() ?>" alt="">
                    </div>
                    <div class="sid-name-profile">
                        <?= $data_user['name'] ?>
                    </div>
                </a>
            </div>
            <a href="/home" class="aloc-sid-line active ajax-redirect" data-url="/home" data-sidebar-module="/home">
                <div class="icon">
                    <i class="fa-solid fa-house"></i>
                </div>
                <div class="name">
                    Home
                </div>
            </a>
            <!-- <div id="title-acc-afazeres" class="aloc-sid-line acc-title" data-id-content="content-acc-afazeres" data-sidebar-module="/afazeres">
                <div class="icon">
                    <i class="fa-regular fa-rectangle-list"></i>
                </div>
                <div class="name">
                    Afazeres
                </div>
                <div class="acc-arrow">
                    <i class="fa-solid fa-chevron-down first"></i>
                    <i class="fa-solid fa-chevron-down second"></i>
                </div>
            </div>
            <div class="aloc-sid-subline acc-content d-none" id="content-acc-afazeres">
                <div class="just-sid-subline">
                    <div class="icon">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div class="name">
                        Completos
                    </div>
                </div>
                <div class="just-sid-subline">
                    <div class="icon">
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <div class="name">
                        Inacabados
                    </div>
                </div>
                <div class="just-sid-subline">
                    <div class="icon">
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <div class="name">
                        Pendentes
                    </div>
                </div>
            </div> -->
            <a href="/afazeres" class="aloc-sid-line" data-sidebar-module="/afazeres">
                <div class="icon">
                   <i class="fa-regular fa-square-check"></i>
                </div>
                <div class="name">
                    Afazeres
                </div>
            </a>
            <a href="/anotacoes" class="aloc-sid-line" data-sidebar-module="/anotacoes">
                <div class="icon">
                   <i class="fa-solid fa-feather"></i>
                </div>
                <div class="name">
                    Anotações
                </div>
            </a>
            <?php if(permissoes_helper('acessar_usuarios')): ?>
                <a href="/users" class="aloc-sid-line ajax-redirect" data-url="/users" data-sidebar-module="/users">
                    <div class="icon">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div class="name">
                        Usuários
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
</aside>