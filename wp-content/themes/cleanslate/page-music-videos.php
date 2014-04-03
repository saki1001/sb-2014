<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */

get_header(); ?>
        
        <section id="content">
            
        <?php
            // Query Artist Post Type
            $args = array(
                'post_type' => 'project',
                'project_category' => 'music-video',
                'posts_per_page' => 9999
            );
            
            $project_query = new WP_Query( $args );
            
            if ( $project_query->have_posts() ) :
                
                while ( $project_query->have_posts() ) : $project_query->the_post();
        ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </a>
        <?php
                endwhile;
                
            else :
            // Content Not Found Template
            include('content-not-found.php');
            
            endif;
        ?>
            
        </section>
        
<?php get_footer(); ?>