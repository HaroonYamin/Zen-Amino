        <div class="position-fixed top-0 end-0 p-3" style="z-index: 2000">
            <div id="cart-toast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header" style="background-color: rgba(var(--color-orange), 1);">
                    <strong class="me-auto" style="color: #fff;">Cart</strong>
                    <button type="button" class="btn-close color-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Product added to cart!
                </div>
            </div>
        </div>

        <footer id="footer">
            <section id="newsletter">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-lg-7 col-12">
                            <h2 class="newsletter_title">Be the first to know</h2>
                            <p class="newsletter_paragraph">Receive all the latest information on events, sales, & offers.</p>
                        </div>
                        <div class="col-lg-4 col-5">
                            <?php echo do_shortcode('[contact-form-7 id="aec39b0" title="Newsletter"]'); ?>
                        </div>
                    </div>
                </div>
            </section>
            <section id="main_footer">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col main_footer_logo">
					        <?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); }; ?>
                            <p>We take pride in treating every client, large or small, with the utmost regard.</p>
                        </div>
                        <div class="main_footer_navs col-sm col-6">
                            <h4>Information</h4>
                            <ul>
                                <?php 
                                    $info = get_field('information', 'option');
                                    if ($info):
                                        foreach ($info as $single):
                                            echo '<li><a href="' . esc_url($single['link']['url']) . '" target="' . esc_attr($single['link']['target']) . '">' . esc_html($single['link']['title']) . '</a></li>';
                                        endforeach;
                                    endif;
                                ?>
                            </ul>
                        </div>
                        <div class="main_footer_navs col-sm col-6">
                            <h4>Buy Peptides</h4>
                            <ul>
                                <?php 
                                    $peptides = get_field('buy-peptides', 'option');
                                    if ($peptides):
                                        foreach ($peptides as $single):
                                            echo '<li><a href="' . esc_url($single['link']['url']) . '" target="' . esc_attr($single['link']['target']) . '">' . esc_html($single['link']['title']) . '</a></li>';
                                        endforeach;
                                    endif;
                                ?>
                            </ul>
                        </div>
                        <div class="main_footer_navs col-sm col-6">
                            <h4>Legal</h4>
                            <ul>
                                <?php 
                                    $legal = get_field('legal', 'option');
                                    if ($legal):
                                        foreach ($legal as $single):
                                            echo '<li><a href="' . esc_url($single['link']['url']) . '" target="' . esc_attr($single['link']['target']) . '">' . esc_html($single['link']['title']) . '</a></li>';
                                        endforeach;
                                    endif;
                                ?>
                            </ul>
                        </div>
                        <div class="main_footer_navs col-lg-1 col-sm col-6">
                            <h4>Support</h4>
                            <ul>
                                <?php 
                                    $support = get_field('support', 'option');
                                    if ($support):
                                        foreach ($support as $single):
                                            echo '<li><a href="' . esc_url($single['link']['url']) . '" target="' . esc_attr($single['link']['target']) . '">' . esc_html($single['link']['title']) . '</a></li>';
                                        endforeach;
                                    endif;
                                ?>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-sm-5 col-12 footer_socials">
                            <div class="footer_socials-group d-flex">
                                <div class="footer_socials-image me-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.2199 15.25L16.6999 14.96C16.0899 14.89 15.4899 15.1 15.0599 15.53L13.2099 17.38C11.7909 16.66 10.5039 15.721 9.39192 14.608C8.27892 13.496 7.33992 12.209 6.61992 10.79L8.46992 8.94001C8.89992 8.51001 9.10992 7.91001 9.03992 7.30001L8.74992 4.78001C8.62992 3.77001 7.77992 3.01001 6.75992 3.01001H5.02992C3.89992 3.01001 2.95992 3.95001 3.02992 5.08001C3.29492 9.34901 5.13392 13.188 7.97292 16.027C10.8119 18.866 14.6509 20.705 18.9199 20.97C20.0499 21.04 20.9899 20.1 20.9899 18.97V17.24C20.9899 16.22 20.2299 15.37 19.2199 15.25Z" fill="rgb(var(--color-orange))"></path>
                                    </svg>
                                </div>
                                <div class="footer_socials-text mt-1">
                                    <h4>Phone</h4>
                                    <a href="Tel:1-800-986-6401">T: 1-800-986-6401</a>
                                    <p>Monday - Friday 9AM - 4PM PST</p>
                                </div>
                            </div>
                            <div class="footer_socials-group d-flex">
                                <div class="footer_socials-image me-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.26562 5.76953C4.02824 5.76934 3.79969 5.85952 3.6264 6.02176L11.3829 11.2439C11.5359 11.3477 11.7162 11.4038 11.901 11.4052C12.0858 11.4066 12.2669 11.3532 12.4214 11.2518L20.398 6.04556C20.3111 5.95802 20.2077 5.88856 20.0938 5.84119C19.9799 5.79381 19.8577 5.76946 19.7344 5.76953H4.26562ZM3.32812 6.95129V17.2924C3.32841 17.5409 3.42727 17.7792 3.60303 17.955C3.77878 18.1307 4.01707 18.2296 4.26562 18.2299H19.7344C19.9829 18.2296 20.2212 18.1307 20.397 17.955C20.5727 17.7792 20.6716 17.5409 20.6719 17.2924V6.98636L12.9344 12.0365C12.6256 12.2392 12.2636 12.3459 11.8943 12.3432C11.5249 12.3404 11.1646 12.2284 10.8588 12.0211L3.32812 6.95129Z" fill="rgb(var(--color-orange))"></path>
                                    </svg>
                                </div>
                                <div class="footer_socials-text mt-1">
                                    <h4>Email</h4>
                                    <a href="mailto:info@zenamino.com">info@zenamino.com</a>
                                </div>
                            </div>
                            <div class="footer_socials-group d-flex">
                                <div class="footer_socials-image me-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_3139_783)">
                                            <path d="M4.8002 3.19995C3.9162 3.19995 3.2002 3.91595 3.2002 4.79995V7.99995H8.0002V3.19995H4.8002ZM9.60019 3.19995V7.99995H14.4002V3.19995H9.60019ZM16.0002 3.19995V7.99995H20.8002V4.79995C20.8002 3.91595 20.0842 3.19995 19.2002 3.19995H16.0002ZM3.2002 9.59995V14.4H8.0002V9.59995H3.2002ZM9.60019 9.59995V14.4H14.4002V9.59995H9.60019ZM16.0002 9.59995V13.35C14.842 13.9038 13.9041 14.8418 13.3502 16H9.60019V20.7999H13.3502C14.2527 22.6871 16.176 24 18.4002 24C21.4835 24 24.0002 21.4833 24.0002 18.4C24.0002 16.1758 22.6874 14.2524 20.8002 13.35V9.59995H16.0002ZM18.4002 14.4C20.6188 14.4 22.4002 16.1813 22.4002 18.4C22.4002 20.6186 20.6188 22.4 18.4002 22.4C16.1816 22.4 14.4002 20.6186 14.4002 18.4C14.4002 16.1813 16.1816 14.4 18.4002 14.4ZM18.3877 15.189C18.1758 15.1923 17.9739 15.2796 17.8262 15.4316C17.6786 15.5836 17.5973 15.788 17.6002 16V18.0687L16.6346 19.0343C16.5578 19.108 16.4965 19.1963 16.4543 19.294C16.412 19.3917 16.3897 19.4969 16.3886 19.6033C16.3876 19.7098 16.4077 19.8153 16.448 19.9139C16.4882 20.0124 16.5477 20.1019 16.6229 20.1772C16.6982 20.2525 16.7877 20.312 16.8863 20.3522C16.9848 20.3924 17.0904 20.4126 17.1968 20.4115C17.3033 20.4104 17.4084 20.3881 17.5061 20.3459C17.6038 20.3037 17.6921 20.2424 17.7658 20.1656L18.9658 18.9656C19.1158 18.8156 19.2002 18.6121 19.2002 18.4V16C19.2017 15.8929 19.1816 15.7867 19.1413 15.6875C19.101 15.5884 19.0411 15.4983 18.9654 15.4227C18.8896 15.3471 18.7995 15.2874 18.7002 15.2473C18.601 15.2072 18.4947 15.1873 18.3877 15.189ZM3.2002 16V19.2C3.2002 20.084 3.9162 20.7999 4.8002 20.7999H8.0002V16H3.2002Z" fill="rgb(var(--color-orange))"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_3139_783">
                                                <rect width="24" height="24" fill="white"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="footer_socials-text mt-1">
                                    <h4>Shipping Days</h4>
                                    <h5>Mon - Fri / Except Holidays</h5>
                                    <p>Orders placed and paid after 12 PM PST are shipped the following business day</p>
                                </div>
                            </div>
                            <!-- <div class="footer_socials-group d-flex">
                                <div class="footer_socials-image me-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.2233 0.31665C7.84136 0.31665 4.27637 3.90002 4.27637 8.30451C4.27637 13.014 9.15257 19.7087 12.2233 23.2973C15.2936 19.7092 20.1702 13.0142 20.1702 8.30451C20.1702 3.90002 16.6052 0.31665 12.2233 0.31665ZM12.2233 12.2986C10.0288 12.2986 8.24982 10.5103 8.24982 8.30451C8.24982 6.09871 10.0288 4.31058 12.2233 4.31058C14.4178 4.31058 16.1967 6.09871 16.1967 8.30451C16.1967 10.5103 14.4178 12.2986 12.2233 12.2986Z" fill="rgb(var(--color-orange))"></path>
                                    </svg>
                                </div>
                                <div class="footer_socials-text mt-1">
                                    <h4>Mailing Address</h4>
                                    <h5>P-Sciences<br>2831 St. Rose Pkwy Suite 362<br>Henderson, NV 89052<br>USA</h5>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <!-- row ended -->
                </div>
            </section>

            <section id="copyright">
                <div class="container text-center">
                    <p>© 2024<br>ZenAmino.com. All Rights Reserved.</p>
                    <p>All products on this site are for Research, Development use only. Products are Not for Human consumption of any kind.<br>The statements made within this website have not been evaluated by the US Food and Drug Administration. The statements and the products of this company are not intended to diagnose, treat, cure or prevent any disease.</p>
                </div>
            </section>
        </footer>

    <?php wp_footer(); ?>
    </body>
</html>