<?php
// Register custom post type "Page Section"
add_action('init', 'k2t_register_portfolio'); 
function k2t_register_portfolio()  { 
  global $smof_data;
  $portfolio_slug = $smof_data['portfolio-slug'];
  
  $labels = array(  
    'name' => __('Portfolio', 'contractor'),  
    'singular_name' => __('Portfolio', 'contractor'),  
    'add_new' => __('Add New Portfolio', 'contractor'),  
    'add_new_item' => __('Add New Portfolio', 'contractor'),  
    'edit_item' => __('Edit Portfolio', 'contractor'),  
    'new_item' => __('New Portfolio', 'contractor'),  
    'view_item' => __('View Portfolio', 'contractor'),  
    'search_items' => __('Search Portfolio', 'contractor'),  
    'not_found' =>  __('No Portfolio found', 'contractor'),  
    'not_found_in_trash' => __('No Portfolio found in Trash', 'contractor'),  
    'parent_item_colon' => '' 
  );  
  
  $args = array(  
    'labels' 				=> $labels,  
    'menu_position' 		=> 5, 
	'public' 				=> true,
	'publicly_queryable' 	=> true,
	'has_archive' 			=> true,
	'hierarchical' 			=> false,
	'supports' 				=> array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'post-formats' )
  );
  if(!empty($portfolio_slug)){
  	$args['rewrite'] = array('slug' => $portfolio_slug);
  }else{
	$args['rewrite'] = array('slug' => 'portfolio');
  }
  register_post_type('post-portfolio',$args);  
}

/* --------------------------------------------------- */
/* Register Portfolio Category
/* --------------------------------------------------- */
add_action( 'init', 'k2t_register_portfolio_category', 0 );

if ( !function_exists('k2t_register_portfolio_category') ) {
function k2t_register_portfolio_category(){
	global $smof_data;
  	$portfolio_category_slug = $smof_data['portfolio-category-slug'];
	$labels = array(
		'name'                => _x( 'Portfolio Categories', 'taxonomy general name','contractor'),
		'singular_name'       => _x( 'Portfolio Category', 'taxonomy singular name','contractor'),
		'search_items'        => __( 'Search Portfolio Categories','contractor'),
		'all_items'           => __( 'All Portfolio Categories','contractor'),
		'parent_item'         => __( 'Parent Portfolio Category','contractor'),
		'parent_item_colon'   => __( 'Parent Portfolio Category:','contractor'),
		'edit_item'           => __( 'Edit Portfolio Category','contractor'), 
		'update_item'         => __( 'Update Portfolio Category','contractor'),
		'add_new_item'        => __( 'Add New Portfolio Category','contractor'),
		'new_item_name'       => __( 'New Portfolio Category Name','contractor'),
		'menu_name'           => __( 'Portfolio Category','contractor')
	); 	
	
	$args = array(
		'hierarchical'        => true,
		'labels'              => $labels,
		'show_ui'             => true,
		'show_admin_column'   => true,
		'query_var'           => true,
	);
	
	if(!empty($portfolio_category_slug)){
		$args['rewrite'] = array('slug' => $portfolio_category_slug);
	}else{
		$args['rewrite'] = array('slug' => 'portfolio-category');
	}
	
	register_taxonomy( 'portfolio-category', array('post-portfolio'), $args );
}

}

?>