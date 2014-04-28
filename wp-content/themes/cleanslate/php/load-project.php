<?php
/**
 * The general template for displaying content.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php
    require_once('../../../../wp-load.php');
    
    $id = $_POST['post_id'];
    
    $args = array(
        'p' => $id,
        'post_type' => 'project',
        'post_status' => 'publish'
    );
    
    $projects_query = new WP_Query($args);
    
    if ( $projects_query->have_posts() ) :
        
        // The Loop
        while ( $projects_query->have_posts() ) : $projects_query->the_post();
            include('../content.php');
        endwhile;
        
    else :
        // Content Not Found Template
        include('../content-not-found.php');
    endif;
?>