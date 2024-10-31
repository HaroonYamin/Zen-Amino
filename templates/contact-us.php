<?php
/* Template Name: Contact Us */
get_header()
?>

<section id="contact">
    <div class="container">
        <?php 
        $title = get_field('contact_us');
        if('title'):
            echo '<h2>'. $title .'</h2>';
        endif; 

        $inform = get_field('subtitle');
        if('inform'):
            echo '<h3>' . $inform . '</h3>' ;
        endif;

        $form = get_field('input');
        if('form'):
            echo do_shortcode($form); 
        endif; 
        ?>
    </div>
</section>

<section id="information">
    <div class="container">
        <?php $contact = get_field('contact_information');
        if('contact'):
        ?>
        <h2><?php echo $contact; ?></h2>
        <?php 
        endif;
        ?>
        <div class="d-flex flex-wrap contact_row">
            <?php
            $repeater = get_field('title');
                if ($repeater):
                    foreach ($repeater as $repeat):
                        ?>
                        <div class="contact_box d-flex">
                            <img src="<?php echo $repeat['icon'] ?>" alt="icon" class="contact_box-image me-2">
                            <div class="contact_box-text mt-1">
                                <h4><?php echo $repeat['title']; ?></h4>
                                <h5><?php echo $repeat['subtitle']; ?></h5>
                                <p><?php echo $repeat['contact']; ?></p>
                            </div>
                        </div>
                        <?php
                    endforeach;
                endif; 
                ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>