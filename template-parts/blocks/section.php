
<?php
$className = 'section';

if(!empty($block['className'])){
  $className .= ' ' . $block['className'];
}

if(!empty($block['align'])){
  $className .= ' align' . $block['align'];
}

$section = get_field('section');
$bg_image = get_field('bg_image');
$heading = get_field('heading');
$subheading = get_field('subheading');
$details = get_field('details');

$boxes = get_field('boxes');

$classSection = strtolower(str_replace(' ', '_', $section));
?>

<div class="<?php echo esc_attr($className); ?> <?php echo esc_attr($classSection); ?>">
  <?php if(!empty($bg_image)) : ?>
  <div class="with_bg_wrapper" style="background-image: url('<?php echo $bg_image; ?>');">
  <?php endif; ?>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 <?php echo (!empty($bg_image) ? 'col-md-8' : 'col-md-12' ) ?>">
          <h6><?php echo $section; ?></h6>
          <h2><?php echo apply_filters('the_content', $heading); ?></h2>
          <h3><?php echo apply_filters('the_content', $subheading); ?></h3>
          <?php echo apply_filters('the_content', $details); ?>
        </div>
      </div>

      <?php
      if( !empty($boxes) ) : ?>
      <div class="row">
      <?php
        $box_left  = '';
        $box_right  = '';
        $left_right_box_html  = '';
        foreach($boxes as $idx => $box) :
          if( !empty($box['label']) ) :
            if( $box['label'] == 1 || $box['label'] == 3 ) :
              $box_left .= '<div class="box box-left">
                <label>'. $box['label'] .'</label>
                <h4>'. apply_filters('the_content', $box['title']) .'</h4>
                '. apply_filters('the_content', $box['details']) .'
              </div>';
            else :
              $box_right .= '<div class="box box-right">
                <label>'. $box['label'] .'</label>
                <h4>'. apply_filters('the_content', $box['title']) .'</h4>
                '. apply_filters('the_content', $box['details']) .'
              </div>';
            endif;

            $left_right_box_html .= '<div class="box">
              <label>'. $box['label'] .'</label>
              <h4>'. apply_filters('the_content', $box['title']) .'</h4>
              '. apply_filters('the_content', $box['details']) .'
            </div>';

      ?>
      <?php
          else : ?>
        <div class="box col-xs-12 col-sm-6 col-md-3">
          <div class="box-wrapper">
            <div class="img-wrapper">
              <img src="<?php echo $box['image']; ?>" alt="">
            </div>
            <?php if(!empty($box['title'])) : ?>
            <h4><?php echo apply_filters('the_content', $box['title']); ?></h4>
            <?php endif; ?>
            <?php echo apply_filters('the_content', $box['details']); ?>
          </div>
        </div>
      <?php
          endif;
        endforeach; ?>
        <div class="col-sm-12 d-none d-sm-block">
          <div class="row">
          <?php if(!empty($box_left)) : ?>
          <div class="box-left-wrapper col-xs-12 col-sm-6 col-md-6">
            <?php echo $box_left; ?>
          </div>
          <?php endif; ?>
          <?php if(!empty($box_right)) : ?>
          <div class="box-right-wrapper col-xs-12 col-sm-6 col-md-6">
            <?php echo $box_right; ?>
          </div>
          <?php endif; ?>
          </div>
        </div>

      </div>
      <div class="row d-block d-sm-none">
        <div class="col-sm-12">
          <?php echo $left_right_box_html; ?>
        </div>
      </div>
    <?php
      endif;
      ?>
    </div>
  <?php if(!empty($bg_image)) : ?>
  </div>
  <?php endif; ?>
</div>
