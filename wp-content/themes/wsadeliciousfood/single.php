<?php get_header();
$avg = get_post_meta(get_the_ID(), 'avg_rate', true);
?>
    <div class="receipe-post-area section-padding-40">

        <!-- Receipe Slider -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img src="<?= get_the_post_thumbnail_url()?>" alt="">
                </div>
            </div>
        </div>

        <!-- Receipe Content Area -->
        <div class="receipe-content-area section-padding-0-40">
            <div class="container">

                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="receipe-headline my-5">
                            <span><?= get_the_date()?></span>
                            <h2><?= the_title() ?> by <?= get_post_meta(get_the_ID(), 'chef', true) ?></h2>
                            <div class="receipe-duration">
                                <h6>Prep: <?= get_post_meta(get_the_ID(), 'preparation_time', true) ?> mins</h6>
                                <h6>Cook: <?= get_post_meta(get_the_ID(), 'cook_time', true) ?> mins</h6>
                                <h6>Yields: <?= get_post_meta(get_the_ID(), 'yields', true) ?></h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="receipe-ratings text-right my-5">
                            <div class="ratings" data-id="<?= get_the_ID() ?>">
                                <i data-value="1" class="fa fa-star<?= $avg >= 1 ? '' : '-o' ?>" aria-hidden="true"></i>
                                <i data-value="2" class="fa fa-star<?= $avg >= 2 ? '' : '-o' ?>" aria-hidden="true"></i>
                                <i data-value="3" class="fa fa-star<?= $avg >= 3 ? '' : '-o' ?>" aria-hidden="true"></i>
                                <i data-value="4" class="fa fa-star<?= $avg >= 4 ? '' : '-o' ?>" aria-hidden="true"></i>
                                <i data-value="5" class="fa fa-star<?= $avg >= 5 ? '' : '-o' ?>" aria-hidden="true"></i>
                            </div>
                            <span class="btn delicious-btn"><?= get_post_meta(get_the_ID(), 'difficulty', true) ?></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8">
                        <!-- Single Preparation Step -->
                        <div class="d-flex flex-wrap">
                            <?php foreach(explode("\n",  get_post_meta(get_the_ID(), 'instructions', true)) as $key => $row) { ?>
                                <p><strong><?= $key > 9 ? $key : '0' . $key ?>.</strong><?= $row ?></p>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Ingredients -->
                    <div class="col-12 col-lg-4">
                        <div class="ingredients">
                            <h4>Ingredients</h4>

                            <?php foreach(explode("\n",  get_post_meta(get_the_ID(), 'ingredients', true)) as $key => $row) { ?>
                                <!-- Custom Checkbox -->
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck<?= $key ?>">
                                    <label class="custom-control-label" for="customCheck1"><?= $row ?></label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="section-heading text-left">
                            <h3>Leave a comment</h3>
                        </div>
                    </div>
                </div>

                <?php foreach (get_comments() as $comment) { ?>
                    <p><b><?= $comment->comment_author ?></b></p>
                    <p><?= $comment->comment_content ?></p>
                    <br>
                <?php } ?>

                <div class="row">
                    <div class="col-12">
                        <div class="contact-form-area">
                            <?php comment_form([
                                    'comment_field' => '<div>
                                        <textarea name="comment" class="form-control" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                                    </div>',
                                'class_submit' => 'btn delicious-btn mt-30',
                            ], get_the_ID()); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>