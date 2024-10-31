<?php

/* template Name: Block */

get_header();

echo '<main id="'. get_post_field( 'post_name', get_post() ) .'">';
    echo '<div class="container">';
        the_content();
    echo '</div>';
echo '</main>';

get_footer();