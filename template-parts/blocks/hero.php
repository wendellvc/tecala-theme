<?php
$className = 'hero';

if(!empty($block['className'])){
  $className .= ' ' . $block['className'];
}

if(!empty($block['align'])){
  $className .= ' align' . $block['align'];
}

$bg_img = get_field('bg_image');
$heading = get_field('heading');
$subheading = get_field('subheading');
?>

<div class="<?php echo esc_attr($className); ?>">
  <div class="hero-wrapper" style="background-image: url('<?php echo $bg_img; ?>');">
    <div class="container">
      <h2><?php echo apply_filters('the_content', $heading); ?></h2>
      <h3><?php echo apply_filters('the_content', $subheading); ?></h3>
    </div>
  </div>
</div>
