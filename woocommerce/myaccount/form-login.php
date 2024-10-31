<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

<section id="my-account">
    <div class="container py-4">
        <?php do_action( 'woocommerce_before_customer_login_form' ); ?>
        <div class="u-columns col2-set" id="customer_login">

            <div class="u-column1 col-1">

                <h2><?php esc_html_e( 'Sign In', 'woocommerce' ); ?></h2>

                <p class="account_create-text">If you have an account, sign in with your email address</p>

                <form method="post" class="woocommerce-form woocommerce-form-login login">

                    <?php do_action( 'woocommerce_login_form_start' ); ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="username"><?php esc_html_e( 'Email', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                    </p>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
                    </p>

                    <?php do_action( 'woocommerce_login_form' ); ?>

                    <p class="form-row">
                        <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                        <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Sign In', 'woocommerce' ); ?>"><?php esc_html_e( 'Sign In', 'woocommerce' ); ?></button>
                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                        </label>
                    </p>
                    <p class="woocommerce-LostPassword lost_password">
                        <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot Your Password?', 'woocommerce' ); ?></a>
                    </p>

                    <?php do_action( 'woocommerce_login_form_end' ); ?>

                </form>

            </div>

            <div class="v_line"></div>

            <div class="u-column2 col-2">

                <h2><?php esc_html_e( 'Sign Up', 'woocommerce' ); ?></h2>

                <p class="account_create-text">Creating an account has many benefits: check out faster, keep more than one address, track orders and more.</p>

                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button"><?php esc_html_e( 'Create an Account', 'woocommerce' ); ?></a>

            </div>

        </div>
        <?php do_action( 'woocommerce_after_customer_login_form' ); ?>
    </div>
</section>