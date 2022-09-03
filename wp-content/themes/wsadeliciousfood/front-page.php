<?php
get_header();
$sliderRecipes = get_posts([
    'post_type' => 'recipe',
    'posts_per_page' => 3,
    'orderby' => 'rand',
]);
$bestRecipes = get_posts([
    'post_type' => 'recipe',
    'posts_per_page' => 6,
    'meta_query' => [
        'relation' => 'OR',
        ['key' => 'avg_rate', 'compare' => 'NOT EXISTS'],
        ['key' => 'avg_rate', 'compare' => 'EXISTS'],
    ],
    'orderby' => 'meta_value post_date',
]);
$allRecipes = get_posts([
    'post_type' => 'recipe',
    'posts_per_page' => -1,
]);

?>
    <!-- ##### Hero Area Start ##### -->
<?php if(count($sliderRecipes)) : ?>
    <section class="hero-area">
        <div class="hero-slides owl-carousel">
            <!-- Single Hero Slide -->
            <?php foreach($sliderRecipes as $post) { ?>
                <div class="single-hero-slide bg-img" style="background-image: url(<?= get_the_post_thumbnail_url($post->ID) ?>);">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                                <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                                    <h2 data-animation="fadeInUp" data-delay="300ms"><?= $post->post_title ?></h2>
                                    <p data-animation="fadeInUp" data-delay="700ms"><?= $post->post_content ?></p>
                                    <a href="<?= get_the_permalink($post->ID) ?>" class="btn delicious-btn" data-animation="fadeInUp" data-delay="1000ms">See Recipe</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
<?php endif; ?>
    <!-- ##### Hero Area End ##### -->

<?php if(count($bestRecipes)) : ?>
    <!-- ##### Best Recipe Area Start ##### -->
    <section class="best-receipe-area section-padding-80-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>The best recipes</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Best Recipe Area -->
                <?php foreach($bestRecipes as $post) {
                    $avg = get_post_meta($post->ID, 'avg_rate', true);
                    ?>
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-best-receipe-area mb-30">
                            <a href="<?= get_the_permalink($post->ID) ?>">
                                <img src="<?= get_the_post_thumbnail_url($post->ID) ?>" alt="">
                            </a>
                            <div class="receipe-content">
                                <a href="<?= get_the_permalink($post->ID) ?>">
                                    <h5><?= $post->post_title ?></h5>
                                </a>
                                <div class="ratings" data-id="<?= $post->ID ?>">
                                    <i data-value="1" class="fa fa-star<?= $avg >= 1 ? '' : '-o' ?>" aria-hidden="true"></i>
                                    <i data-value="2" class="fa fa-star<?= $avg >= 2 ? '' : '-o' ?>" aria-hidden="true"></i>
                                    <i data-value="3" class="fa fa-star<?= $avg >= 3 ? '' : '-o' ?>" aria-hidden="true"></i>
                                    <i data-value="4" class="fa fa-star<?= $avg >= 4 ? '' : '-o' ?>" aria-hidden="true"></i>
                                    <i data-value="5" class="fa fa-star<?= $avg >= 5 ? '' : '-o' ?>" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- ##### Best Recipe Area End ##### -->
<?php endif; ?>

<?php if(count($allRecipes)) : ?>
    <!-- ##### Small Recipe Area Start ##### -->
    <section class="small-receipe-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>All recipes</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php foreach($allRecipes as $post) {
                    $avg = get_post_meta($post->ID, 'avg_rate', true);
                    ?>
                    <!-- Small Recipe Area -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-small-receipe-area d-flex">
                            <!-- Recipe Thumb -->
                            <div class="receipe-thumb">
                                <img src="<?= get_the_post_thumbnail_url($post->ID) ?>" alt="">
                            </div>
                            <!-- Recipe Content -->
                            <div class="receipe-content">
                                <span><?= get_the_date('', $post->ID) ?></span>
                                <a href="<?= get_the_permalink($post->ID) ?>">
                                    <h5><?= $post->post_title ?></h5>
                                </a>
                                <div class="ratings" data-id="<?= $post->ID ?>">
                                    <i data-value="1" class="fa fa-star<?= $avg >= 1 ? '' : '-o' ?>" aria-hidden="true"></i>
                                    <i data-value="2" class="fa fa-star<?= $avg >= 2 ? '' : '-o' ?>" aria-hidden="true"></i>
                                    <i data-value="3" class="fa fa-star<?= $avg >= 3 ? '' : '-o' ?>" aria-hidden="true"></i>
                                    <i data-value="4" class="fa fa-star<?= $avg >= 4 ? '' : '-o' ?>" aria-hidden="true"></i>
                                    <i data-value="5" class="fa fa-star<?= $avg >= 5 ? '' : '-o' ?>" aria-hidden="true"></i>
                                </div>
                                <p><?= get_comment_count(get_the_ID())['all'] ?> Comments</p>
                            </div>
                        </div>
                    </div>
                <?php } wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <!-- ##### Small Recipe Area End ##### -->
<?php endif; ?>
<?php get_footer(); ?>