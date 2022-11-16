<div class="content-wrapper">
    <div class="grid-home-cards">
        <div class="aloc-home-card">
            <div class="home-card">
                <div class="title-card">Afazeres</div>
                <div class="text-card"><p>Acesse através do botão abaixo sua lista de afazeres.</p></div>
                <div class="aloc-btn-card">
                    <span class="button-open ajax-redirect" data-url="/afazeres">
                        <i class="fa-solid fa-angle-right"></i>
                        <p>Abrir</p>
                    </span>
                </div>
            </div>
        </div>
        <div class="aloc-home-card">
            <div class="home-card">
                <div class="title-card">Anotações</div>
                <div class="text-card"><p>Acesse através do botão abaixo suas anotações.</p></div>
                <div class="aloc-btn-card">
                    <span class="button-open ajax-redirect" data-url="/anotacoes">
                        <i class="fa-solid fa-angle-right"></i>
                        <p>Abrir</p>
                    </span>
                </div>
            </div>
        </div>
        <?php if (permissoes_helper('acessar_usuarios')): ?>
            <div class="aloc-home-card">
                <div class="home-card">
                    <div class="title-card">Usuários</div>
                    <div class="text-card"><p>Acesse através do botão abaixo a lista dos usuários e as funcionalidades associadas.</p></div>
                    <div class="aloc-btn-card">
                        <span class="button-open ajax-redirect" data-url="/users">
                            <i class="fa-solid fa-angle-right"></i>
                            <p>Abrir</p>
                        </span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>