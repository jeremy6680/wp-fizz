
<?php
  /*
  Title: Témoignage
  Description: test
  Category: formatting
  Icon: admin-comments
  Keywords: testimonial quote
  */
?>

<blockquote data-<?php echo $block['id'] ?>>
    <p><?php the_field('testimonial') ?></p>
    <cite>
      <img src="<?php echo get_field('picture')['url'] ?>" alt="<?php echo get_field('picture')['alt'] ?>" />
      <span><?php the_field('author') ?></span>
    </cite>
</blockquote>

<style type="text/css">
  [data-<?php echo $block['id'] ?>] {
    background: {{get_field('color')}};
  }
</style>