<div id="user-content" class="content-wrapper">
    <div class="aloc-header-page">
        <div class="aloc-title">
            <?= $titulo?>
        </div>
        <div class="aloc-route">
            <label class="text-nolink"><?= $titulo?></label>
            <label class="text-nolink">/</label>
            <a class="link-page ajax-redirect" data-url="/">Home</a>
        </div>
    </div>
    <div class="aloc-content-page">
        <div class="card-content-page">
            <div class="aloc-top-buttons">
                <?php if(permissoes_helper('create_usuario')): ?>
                    <button class="btn-default td-modal" data-modal-url="/users/create" data-modal-id="modal-user" data-modal-title="Criar Usuário" data-modal-footer="footer-data-user" data-modal-size="small">Criar usuário</button>
                <?php endif; ?>
            </div>
            <table class="default-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nível</th>
                        <th>Login</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>E-mail</th>
                        <th>Situação</th>
                        <th class="th-action">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $key => $user): ?>
                        <tr>
                            <td><?=$user['id_user']?></td>
                            <td><?=ucfirst($user['tipo_nivel'])?></td>
                            <td>@<?=$user['login']?></td>
                            <td><?=$user['name']?></td>
                            <td><?=$user['lastname']?></td>
                            <td><?=$user['email']?></td>
                            <td><?=isset($user['deleted_at']) ? 'Desligado' : 'Ativo' ?></td>
                            <td class="td-action">
                                <?php if(empty($user['deleted_at'])): ?>
                                    <?php if(permissoes_helper('acessar_usuarios')): ?>
                                        <button class="btn-action td-modal" data-modal-url="/users/view/<?=$user['id_user']?>" data-modal-id="modal-user" data-modal-title="Visualizar Usuário" data-modal-footer="footer-data-user" data-modal-size="small">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                    <?php endif; ?>
                                    <?php if(permissoes_helper('edit_usuario')): ?>
                                        <button class="btn-action td-modal" data-modal-url="/users/edit/<?=$user['id_user']?>" data-modal-id="modal-user" data-modal-title="Editar Usuário" data-modal-footer="footer-data-user" data-modal-size="small">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                    <?php endif; ?>
                                    <?php if(permissoes_helper('delete_usuario')): ?>
                                        <button class="btn-action td-ajax-confirm" data-confirm-url="/users/delete_user/<?=$user['id_user']?>" data-confirm-title="Excluir Usuário" data-confirm-text="Você realmente deseja excluir este usuário?" data-confirm-success-text="Usuário excluído com sucesso" data-url-refresh="/users">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <button class="btn-action <?= permissoes_helper('delete_usuario') ? 'td-ajax-confirm' : 'dsb' ?>" <?= permissoes_helper('delete_usuario') ? 'data-confirm-url="/users/roolback_user/'.$user['id_user'].'" data-confirm-title="Reativar Usuário" data-confirm-text="Você realmente deseja reativar este usuário?" data-confirm-success-text="Usuário reativado com sucesso" data-url-refresh="/users"' : '' ?>>
                                        <i class="fa-solid fa-rotate-left"></i>
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="modal-user" class="smooth-modal">
        <div class="aloc-content-modal">
            <div class="title-modal">
                <label class="just-title"></label>
                <span class="close-modal"><i class="fa-solid fa-xmark"></i></span>
            </div>
            <div class="content-modal"></div>
            <div class="footer-modal"></div>
        </div>
    </div>
    
    <input type="hidden" class="src-script" value="<?= base_url('assets/js/user/user.js'.version_js()) ?>">
</div>


