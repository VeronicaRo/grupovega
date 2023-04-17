<div class="login-form-wrapper">
    <div class="login-form">
        <form>
            <input type="hidden" name="action" value="cpt_verify_purchase_code">
            <div style="min-width: 500px;">
                <div class="cpt-field-group">
                    <span class="fas fa-envelope" aria-hidden="true"></span>
                    <div class="cpt-field">
                        <input type="text" name="email" id="email"
                               placeholder="<?php esc_html_e('Email', CPT_TEXT_DOMAIN) ?>">
                    </div>
                </div>
                <div class="cpt-field-group">
                    <span class="fas fa-address-card" aria-hidden="true"></span>
                    <div class="cpt-field">
                        <input type="text" name="name" id="name"
                               placeholder="<?php esc_html_e('Name', CPT_TEXT_DOMAIN) ?>">
                    </div>
                </div>
                <div class="cpt-field-group required-field">
                    <span class="fas fa-user-tag" aria-hidden="true"></span>
                    <div class="cpt-field">
                        <input type="text" name="purchase_code" id="purchase-code"
                               placeholder="<?php esc_html_e('Purchase Code', CPT_TEXT_DOMAIN) ?>">
                    </div>
                </div>
            </div>
            <div class="cpt-field field-submit">
                <button type="button" class="button btn-verify-purchase-code ld-ext-right">
                    <?php esc_html_e('Verify', CPT_TEXT_DOMAIN) ?>
                    <div class="ld ld-spin ld-ring"></div>
                </button>
            </div>
        </form>
    </div>
</div>