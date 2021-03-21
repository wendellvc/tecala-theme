<?php
$className = 'cta-banner';

if(!empty($block['className'])){
  $className .= ' ' . $block['className'];
}

if(!empty($block['align'])){
  $className .= ' align' . $block['align'];
}

$heading = get_field('heading');
$subheading = get_field('subheading');
$links = get_field('links');
?>

<div class="<?php echo esc_attr($className); ?>">
  <div class="container">
    <h2><?php echo $heading; ?></h2>
    <h3><?php echo $subheading; ?></h3>
    <div class="cta-buttons">
    <?php
    if( !empty($links) ) :
      foreach($links as $idx => $link) : ?>
      <a class="btn" href="<?php echo $link['button_url']; ?>"><?php echo $link['button_name']; ?></a>
    <?php
      endforeach;
    endif;
    ?>
    </div>
  </div>
</div>
