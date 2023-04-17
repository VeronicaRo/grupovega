<div class="login-form-wrapper">
    <div class="login-form">
        <form class="">
            <input type="hidden" name="action" value="cpt_verify_purchase_code">
            <div style="min-width: 500px;">
                <div class="cpt-field-group">
                    <span class="fas fa-user" aria-hidden="true"></span>
                    <div class="cpt-field">
                        <input type="text" name="username" id="username"
                               placeholder="<?php esc_html_e('Username', CPT_TEXT_DOMAIN) ?>">
                    </div>
                </div>
                <div class="cpt-field-group">
                    <span class="fas fa-lock" aria-hidden="true"></span>
                    <div class="cpt-field">
                        <input type="Password" name="password" id="password"
                               placeholder="<?php esc_html_e('Password', CPT_TEXT_DOMAIN) ?>">
                    </div>
                </div>
            </div>
            <div class="cpt-field field-submit">
                <button type="button" class="button btn-login ld-ext-right">
                    <?php esc_html_e('Login', CPT_TEXT_DOMAIN) ?>
                    <div class="ld ld-spin ld-ring"></div>
                </button>
            </div>
        </form>
    </div>
</div>