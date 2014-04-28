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
            <div class="bbq-content">
                <div class="bbq-loading" style="display: none;">Loading content...</div>
            </div>
            
        <?php
            // Query Artist Post Type
            $args = array(
                'post_type' => 'project',
                'project_category' => 'music-video',
                'posts_per_page' => 9999
            );
            
            $project_query = new WP_Query( $args );
            
            if ( $project_query->have_posts() ) :
?>
                <div class="projects">
<?php
                while ( $project_query->have_posts() ) : $project_query->the_post();
?>
                    <div class="project">
                        <a href="#<?php echo $post->post_name; ?>" data-id="<?php echo $post->ID; ?>"><?php the_post_thumbnail('thumbnail'); ?>
                            <span><?php the_title(); ?></span>
                        </a>
                    </div>
<?php
                endwhile;
?>
                </div>
<?php
            else :
            // Content Not Found Template
            include('content-not-found.php');
            
            endif;
        ?>
            
        </section>
        
<?php get_footer(); ?>