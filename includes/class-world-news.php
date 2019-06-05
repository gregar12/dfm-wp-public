<?php
/**
 * Register a custom menu page.
 */
add_action( 'admin_menu', 'world_news_content_menu' );

//Add world_news content menu to admin
function world_news_content_menu(){

  $page_title = 'World News Content';
  $menu_title = 'World News';
  $capability = 'manage_options';
  $menu_slug  = 'world_news';
  $function   = 'show_world_news_content';//Query goes here
  $icon_url   = 'dashicons-media-code';
  $position   = 9;

  add_menu_page( $page_title,
                 $menu_title,
                 $capability,
                 $menu_slug,
                 $function,
                 $icon_url,
                 $position );
}

function show_world_news_content() {
  //Set up query
  $args = array(
    'numberposts'	=> 100,
    'category_name' => 'world_news',
    'orderby' => 'date',
    'order'   => 'ASC'
  );
  //Pass arguments to query function
  query_posts( $args );

  //echo the title
  echo '<h1>World News Content</h1>';

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
    echo '<h2>There are no World and News posts. Check back later</h2>';
  endif;


  // Reset Query
  wp_reset_query();
}