<nav class="default-navbar">
    <div class="aloc-content-navbar">
        <div class="items-left">
            <div class="aloc-btn-navbar sidebar-btn">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>

        <div class="items-right">
            <div class="aloc-theme-navbar">
                <input type="checkbox" id="switch-theme" class="check-switch-theme" <?=session()->get('user_theme') == 1 ? 'checked' : '' ?>>
                <label for="switch-theme" class="switch-theme">
                    <span class="circle-theme"></span>
                </label>
            </div>
            <a class="aloc-btn-navbar" href="/login/logout">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
        </div>
    </div>
</nav>