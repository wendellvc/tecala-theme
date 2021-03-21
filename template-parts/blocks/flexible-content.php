<?php
$className = 'hero';

if(!empty($block['className'])){
  $className .= ' ' . $block['className'];
}

if(!empty($block['align'])){
  $className .= ' align' . $block['align'];
}


if( have_rows('flexible_content') ):
  while( have_rows('flexible_content') ) : the_row();

    $bg_img = get_sub_field('bg_image');
    $heading = get_sub_field('heading');
    $subheading = get_sub_field('subheading');
?>

<div class="<?php echo esc_attr($className); ?>">
  <div class="hero-wrapper" style="background-image: url('<?php echo $bg_img; ?>');">
    <?php echo $heading; ?>
    <?php echo $subheading; ?>
  </div>
</div>

<?php
  endwhile;
endif;

?>
