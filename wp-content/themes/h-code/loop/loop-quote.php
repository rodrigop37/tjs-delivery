<?php
/**
 * displaying posts quote for blog
 *
 * @package H-Code
 */
?>
<?php
$blog_quote = hcode_post_meta('hcode_quote');
echo '<div class="blog-image">';
    if($blog_quote):
        echo '<blockquote class="bg-gray">';
            echo '<p>'.$blog_quote.'</p>';
        echo '</blockquote>';
    endif;
echo '</div>';	
?>