<?php
/* Template Name: Our Company */
get_header();
?>
<section id="about">
    <div class="container">
        <div class="row align-items-stretch">
            <div class="col-lg-6 col-12 about_text">
                <?php
                    $title = get_field('about_zenamino');
                    if ($title):
                    ?>
                        <h2 class="about_text-title"><?php echo $title; ?></h2>
                    <?php 
                    endif; 
                    $repeater = get_field('title');
                    if ($repeater):
                        foreach ($repeater as $repeat):
                            ?>
                            <div class="about_text-card d-flex w-100 align-items-start">
                                <img src="<?php echo $repeat['icon'] ?>" alt="icon" class="about_text-card_image me-3">
                                <div class="about_text-card_title">
                                    <h4><?php echo $repeat['title']; ?></h4>
                                    <p><?php echo $repeat['paragraph']; ?></p>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    endif; 
                    ?>
            </div>
            <div class="col-lg-6 col-12 p-0 about_image img-fluid">
            <?php 
                $image = get_field('pure_and_tested');
                if($image):
            ?>
                <img src="<?php echo $image; ?>" alt="About Image" class="about_image-img">
                <?php
                endif;                    
                ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
