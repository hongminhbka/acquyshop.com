<?php
/**
 * The template for displaying posts in the Video post format
 *
 * @version    1.0
 * @package    basetheme
 * @author     gaviasthemes Team     
 * @copyright  Copyright (C) 2016 gaviasthemes. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */
?>
<?php 
	$thumbnail = 'post-thumbnail';
	if(isset($thumbnail_size) && $thumbnail_size){
		$thumbnail = $thumbnail_size;
	}
	if(is_single()){
		$thumbnail = 'full';
	}

	if(!isset($excerpt_words)){
    	$excerpt_words = vizeon_get_option('blog_excerpt_limit', 20);
  	}

?>
<article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class(); ?>>

	<div class="post-thumbnail">
		<?php the_post_thumbnail( $thumbnail, array( 'alt' => get_the_title() ) ); ?>
	</div>	

   <?php if ( is_single() ){ ?>
      <h1 class="entry-title"><?php echo the_title() ?></h1>       
   <?php } ?>

	<div class="entry-content">
		<div class="content-inner">

			<?php if(!is_single()){ ?>
	         <p class="entry-title"><a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"><?php the_title() ?></a></p>             
	      <?php } ?>	

			<?php if(is_single()){
				the_content( sprintf(
					esc_html__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'vizeon' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
				) );
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'vizeon' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			
			}else{
				echo vizeon_limit_words( $excerpt_words, get_the_excerpt(), get_the_content() );
			}
			?>
		</div>
		<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
      <div class="read-more hidden"><a class="btn-inline" href="<?php echo esc_url( get_permalink() ) ?>">Chi tiết</a></div>
      
	</div><!-- .entry-content -->	

	
</article><!-- #post-## -->
