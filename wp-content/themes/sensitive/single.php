<?php get_header(); ?>     
<div class="container">
<div class="row-fluid">
<div class="span8">
<div  id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
<?php 

while(have_posts()): the_post(); ?>
 
<div  <?php post_class('post'); ?>>
<div class="breadcrumb">Posted on <?php the_date(); ?> / Posted by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
<nav id="nav-single"> 
                        <?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> Previous Post'); ?>
                        <?php next_post_link( '%link', 'Next Post<span class="meta-nav">&rarr;</span>' ); ?>
</nav>
</div>
<div class="clear"></div>
<h1 class="entry-title"><?php the_title(); ?></h1>
<div class="entry-content">
<?php sensitive_post_thumb('wpeden-responsive-post-thumb'); ?>  
<?php the_content(); ?>
</div>
<?php wp_link_pages( ); ?>
</div>
 <div class="mx_comments"> 
<?php comments_template(); ?>
</div>
<?php endwhile; ?>
</div>
</div>
<div class="span4">
 
<?php dynamic_sidebar('Single Post'); ?>
</div>
</div>
</div>

         

<?php get_footer(); ?>
