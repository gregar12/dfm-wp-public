<?php
/**
 * Register a custom menu page.
 */
add_action( 'admin_menu', 'animals_content_menu' );

//Add animals content menu to admin
function animals_content_menu(){

  $page_title = 'Animals Content';
  $menu_title = 'Animals';
  $capability = 'manage_options';
  $menu_slug  = 'animals';
  $function   = 'show_animals_content';//Query goes here
  $icon_url   = 'dashicons-media-code';
  $position   = 6;

  add_menu_page( $page_title,
                 $menu_title,
                 $capability,
                 $menu_slug,
                 $function,
                 $icon_url,
                 $position );
}

function show_animals_content() {
  //Set up query
  $args = array(
    'numberposts'	=> 10,
    'category_name' => 'animals',
    'orderby' => 'date',
    'order'   => 'ASC'
  );
  //Pass arguments to query function
  query_posts( $args );

  //Check for post to show "Check back later" message
  if ( have_posts() ) :
    //Query has posts
    echo '<ul>';
      // The Loop
      while ( have_posts() ) : the_post();
          echo '<li>';
            the_title();
          echo '</li>';
      endwhile;
    echo '</ul>';
  else:
    //Check back later message
    echo '<h2>There are no Animals posts. Check back later</h2>';
  endif;


  // Reset Query
  wp_reset_query();
}