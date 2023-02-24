<?php 
   $item_classes = 'all ';
   $separator = ' ';
   $item_cats = get_the_terms( get_the_ID(), 'category' );
   if(!empty($item_cats) && !is_wp_error($item_cats)){
      foreach((array)$item_cats as $item_cat){
         $item_classes .= $item_cat->slug . ' ';
      }
   }
   $thumbnail = 'post-thumbnail';
   if(isset($thumbnail_size) && $thumbnail_size){
      $thumbnail = $thumbnail_size;
   }

   if(!isset($excerpt_words)){
      $excerpt_words = vizeon_get_option('blog_excerpt_limit', 20);
   }

   if(!isset($layout)){
      $layout = 'carousel';
   }
   if($layout == 'grid'){
      $item_classes .= ' item-columns';
   }
?>

<div class="<?php echo esc_attr($item_classes) ?>">
   <article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class('post'); ?>>
      <div class="post-thumbnail">
         <?php the_post_thumbnail( $thumbnail, array( 'alt' => get_the_title() ) ); ?>
      </div>   
      <div class="entry-content">
         <div class="content-inner"> 
            <p class="entry-title"><a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"><?php the_title() ?></a></p>
            <div class="entry-description">
               <?php echo vizeon_limit_words( $excerpt_words, get_the_excerpt(), get_the_content() ); ?>
            </div>
         </div>

         <div class="read-more"><a class="btn-inline" href="<?php echo esc_url( get_permalink() ) ?>">Chi tiết</a></div>
         
      </div>
   </article>   
</div>

  