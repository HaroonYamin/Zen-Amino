<?php
/* Template Name: Editor */

get_header();

echo '<main id="editor-page">';
    echo '<div class="container">';
        the_content();
    echo '</div>';
echo '</main>';

get_footer();