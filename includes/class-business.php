<?php
/**
 * Register a custom menu page.
 */
add_action( 'admin_menu', 'business_content_menu' );

//Add business content menu to admin
function business_content_menu(){

  $page_title = 'Business Content';
  $menu_title = 'Business';
  $capability = 'manage_options';
  $menu_slug  = 'business';
  $function   = 'show_business_content';//Query goes here
  $icon_url   = 'dashicons-media-code';
  $position   = 7;

  add_menu_page( $page_title,
                 $menu_title,
                 $capability,
                 $menu_slug,
                 $function,
                 $icon_url,
                 $position );
}

function show_business_content() {
  //Set up query
  $args = array(
    'numberposts'	=> 12,
    'category_name' => 'business',
    'orderby' => 'date',
    'order'   => 'ASC'
  );
  //Pass arguments to query function
  query_posts( $args );

  //echo the title
  echo '<h1>Business Content</h1>';

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
    echo '<h2>There are no Business posts. Check back later</h2>';
  endif;


  // Reset Query
  wp_reset_query();
}