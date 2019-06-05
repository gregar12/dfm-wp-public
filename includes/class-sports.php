<?php
/**
 * Register a custom menu page.
 */
add_action( 'admin_menu', 'sports_content_menu' );

//Add sports content menu to admin
function sports_content_menu(){

  $page_title = 'Sports Content';
  $menu_title = 'Sports';
  $capability = 'manage_options';
  $menu_slug  = 'sports';
  $function   = 'show_sports_content';//Query goes here
  $icon_url   = 'dashicons-media-code';
  $position   = 5;

  add_menu_page( $page_title,
                 $menu_title,
                 $capability,
                 $menu_slug,
                 $function,
                 $icon_url,
                 $position );
}

function show_sports_content() {
  //Set up query
  $args = array(
    'numberposts'	=> 25,
    'category_name' => 'sports',
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
    echo '<h2>There are no Sports posts. Check back later</h2>';
  endif;


  // Reset Query
  wp_reset_query();
}