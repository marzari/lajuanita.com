<?php 

if ( !defined('ABSPATH')) exit; 

 

get_header(); 

?>


<div class="container">
<?php if(is_front_page()): ?>
    <div class="row wpeden-bs-services">
        <div class="span3">
        <?php $tpid = (int)sensitive_get_theme_opts('home_featured_page_1'); $intropage = get_page($tpid); $introcontent = strip_tags($intropage->post_content,"p,br"); if (preg_match('/^.{1,80}\b/s', $introcontent, $match)) $introcontent = $match[0];  ?>
        <div class="about well">
          <?php sensitive_thumb($intropage,'wpeden-intro-thumb', array('class'=>'img')); ?> 
          <div class="entry-content">
          <h2><?php echo $intropage->post_title; ?></h2>
          <p><?php echo $introcontent; ?> ...</p>
          </div>
          <a href="<?php echo get_permalink($intropage->ID); ?>" class="btn btn-info">View details</a>
        </div>  
        </div>
        
        <div class="span3">
        <?php $tpid = (int)sensitive_get_theme_opts('home_featured_page_2'); $intropage = get_page($tpid); $introcontent = strip_tags($intropage->post_content,"p,br"); if (preg_match('/^.{1,80}\b/s', $introcontent, $match)) $introcontent = $match[0];  ?>
        <div class="about well">
          <?php sensitive_thumb($intropage,'wpeden-intro-thumb', array('class'=>'img')); ?> 
          <div class="entry-content">
          <h2><?php echo $intropage->post_title; ?></h2>
          <p><?php echo $introcontent; ?> ...</p>
          </div>
          <a href="<?php echo get_permalink($intropage->ID); ?>" class="btn btn-info">View details</a>
        </div>  
        </div>
        
        <div class="span3">
        <?php $tpid = (int)sensitive_get_theme_opts('home_featured_page_3'); $intropage = get_page($tpid); $introcontent = strip_tags($intropage->post_content,"p,br"); if (preg_match('/^.{1,80}\b/s', $introcontent, $match)) $introcontent = $match[0];  ?>
        <div class="about well">
          <?php sensitive_thumb($intropage,'wpeden-intro-thumb', array('class'=>'img')); ?> 
          <div class="entry-content">
          <h2><?php echo $intropage->post_title; ?></h2>
          <p><?php echo $introcontent; ?> ...</p>
          </div>
          <a href="<?php echo get_permalink($intropage->ID); ?>" class="btn btn-info">View details</a>
        </div>  
        </div>
        
        <div class="span3">
        <?php $tpid = (int)sensitive_get_theme_opts('home_featured_page_4'); $intropage = get_page($tpid); $introcontent = strip_tags($intropage->post_content,"p,br"); if (preg_match('/^.{1,80}\b/s', $introcontent, $match)) $introcontent = $match[0];  ?>
        <div class="about well">
          <?php sensitive_thumb($intropage,'wpeden-intro-thumb', array('class'=>'img')); ?> 
          <div class="entry-content">
          <h2><?php echo $intropage->post_title; ?></h2>
          <p><?php echo $introcontent; ?> ...</p>
          </div>
          <a href="<?php echo get_permalink($intropage->ID); ?>" class="btn btn-info">View details</a>
        </div>  
        </div>
        
        <!-- /.span4 -->
      
        <?php get_template_part('homepage','category'); ?>       
           
 
 
<div class="clear"></div>
<div>
</div>          

</div><!-- /.span4 -->
         
    </div>
<?php endif; ?> 
<?php if(is_front_page()&&!is_home()): ?> 
<?php get_template_part('content','loop'); ?>  
<?php endif; ?> 
</div>

        
<?php get_footer(); ?>
