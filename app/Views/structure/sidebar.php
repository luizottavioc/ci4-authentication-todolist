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
                <div class="sid-profile-line">
                    <div class="sid-image-profile">
                        <img src="<?= base_url('image-icons/fantasy-logo.png')?>" alt="">
                    </div>
                    <div class="sid-name-profile">
                        Luiz Otávio Diniz
                    </div>
                </div>
            </div>
            <div class="aloc-sid-line active ajax-redirect" data-url="/home" data-sidebar-module="/home">
                <div class="icon">
                    <i class="fa-solid fa-house"></i>
                </div>
                <div class="name">
                    Home
                </div>
            </div>
            <div  id="title-acc-afazeres" class="aloc-sid-line acc-title" data-id-content="content-acc-afazeres" data-sidebar-module="/afazeres">
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
            </div>
            <div class="aloc-sid-line" data-sidebar-module="/anotacoes">
                <div class="icon">
                   <i class="fa-solid fa-pen-fancy"></i>
                </div>
                <div class="name">
                    Anotações
                </div>
            </div>
            <div class="aloc-sid-line ajax-redirect" data-url="/user" data-sidebar-module="/user">
                <div class="icon">
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="name">
                    Usuários
                </div>
            </div>
            <!-- <div id="title-acc-users" class="aloc-sid-line acc-title" data-id-content="content-acc-users" data-sidebar-module="/user">
                <div class="icon">
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="name">
                    Usuários
                </div>
                <div class="acc-arrow">
                    <i class="fa-solid fa-chevron-down first"></i>
                    <i class="fa-solid fa-chevron-down second"></i>
                </div>
            </div>
            <div id="content-acc-users" class="aloc-sid-subline acc-content d-none" >
                <div class="just-sid-subline ajax-redirect" data-url="/user">
                    <div class="icon">
                        <i class="fa-solid fa-users-viewfinder"></i>
                    </div>
                    <div class="name">
                        Visualizar Usuários
                    </div>
                </div>
                <div class="just-sid-subline ajax-redirect" data-url="/user/page_create">
                    <div class="icon">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div class="name">
                        Criar Usuário
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</aside>