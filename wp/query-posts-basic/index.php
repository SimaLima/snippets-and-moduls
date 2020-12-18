<?php

$blogposts = new WP_Query( array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 3
) );



if ( $blogposts->have_posts() ) :

    while( $blogposts->have_posts() ) :
        $blogposts->the_post();
    ?>

    <!-- BLOG POST -->
    <div class="blog-post">
        <!-- thumbnail image -->
        <a href="<?php the_permalink(); ?>">
            <?php
            if( has_post_thumbnail() ) :
                $url = get_the_post_thumbnail_url($post->ID, 'medium');
                the_post_thumbnail('medium', ['src' => '', 'data-src' => $url]);
            endif;
            ?>
        </a>
        <!-- !thumbnail image -->
        <!-- blog category -->
        <?php $category = get_the_category(); ?>
        <span class="category">
            <a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) ); ?>">
                <?php echo esc_html( $category[0]->name ) ?>
            </a>
        </span>
        <!-- !blog category -->
        <!-- blog title -->
        <p class="blog-heading">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </p>
        <!-- !blog title -->
    </div>
    <!-- !BLOG POST -->

    <?php
    endwhile;
    wp_reset_postdata();
endif;
?>
