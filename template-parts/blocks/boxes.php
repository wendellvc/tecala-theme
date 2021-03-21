
<?php
$className = 'boxes';

if(!empty($block['className'])){
  $className .= ' ' . $block['className'];
}

if(!empty($block['align'])){
  $className .= ' align' . $block['align'];
}

$boxes = get_field('box');
?>

<div class="<?php echo esc_attr($className); ?>">
  <div class="container">
    <div class="row">
    <?php
    if( !empty($boxes) ) :
      foreach($boxes as $idx => $box) :
    ?>
      <div class="box col-xs-12 col-sm-6 col-md-3">
        <div class="img-wrapper">
          <img src="<?php echo $box['image']; ?>" alt="">
        </div>
        <?php if(!empty($box['label'])) : ?>
        <label><?php echo $box['label']; ?></label>
        <?php endif; ?>
        <?php if(!empty($box['title'])) : ?>
        <h4><?php echo apply_filters('the_content', $box['title']); ?></h4>
        <?php endif; ?>
        <?php echo $box['details']; ?>
      </div>
    <?php
      endforeach;
    endif;
    ?>
    </div>
  </div>
</div>
