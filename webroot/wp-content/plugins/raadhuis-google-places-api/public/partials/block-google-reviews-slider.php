<?php
$placesApi = new Raadhuis_Google_Places_Api_Public();
$googleReviewQuery = $placesApi->get_reviews_query('all'); // $language en $limit zijn optioneel.

if (empty($googleReviewQuery->posts)) {
    echo '<p>Geen reviews gevonden.</p>';
    return;
}

$count = count($googleReviewQuery->posts) ?? 0;
$total_count = get_option('rh_google_reviews_total_count', 0);
$total_score = get_option('rh_google_reviews_total_score', 0);
?>

<section class="rh-google-reviews">
    <div class="row align-center">
        <div class="column small-12 large-6 text-center">
            <h2><?= __('Google reviews', TRANSLATION_GROUP) ?></h2>
        </div>
    </div>
    <?php if (!empty($googleReviewQuery->posts)): ?>
        <div class="rh-google-reviews__slider">
            <!-- Loop over reviews -->
            <?php foreach ($googleReviewQuery->posts as $key => $post) :
                // $time = get_field('rh_time', $post);
                $time = get_field('review_time', $post);
                $rating = get_field('review_rating', $post);
                $text = get_field('review_text', $post);
                $author_url = get_field('review_author_url', $post);
                $profile_photo_url = get_field('review_profile_photo_url', $post);
                $stars = $placesApi->renderStarRating($rating) ?? false;
                $timeAgo = human_time_diff($time, current_time('timestamp')) . ' geleden';
            ?>
                <article class="rh-google-reviews__item">
                    <div class="rh-google-reviews__title">
                        <?php if ($profile_photo_url): ?>
                            <img loading="lazy" class="rh-google-avatar" src="<?= $profile_photo_url; ?>" alt="">
                        <?php else : ?>
                            <svg class="rh-google-avatar" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="32" cy="32" fill="#e6ecff" r="31" />
                                <g fill="#4294ff">
                                    <path d="m56.877 50.4748a31.0647 31.0647 0 0 0 -49.7651-.0156 30.9669 30.9669 0 0 0 49.7651.0156z" />
                                    <circle cx="32" cy="22" r="12" />
                                </g>
                            </svg>
                        <?php endif; ?>
                        <div class="rh-google-reviews__name rh-capitalize">
                            <?= get_the_title($post); ?>
                        </div>
                    </div>

                    <div class="rh-google-reviews__stars">
                        <?php if ($stars): ?>
                            <div class="rh-google-stars">
                                <?= $stars; ?>
                            </div>
                        <?php endif; ?>
                        <div class="rh-google-date">
                            <?= $timeAgo; ?>
                        </div>
                    </div>

                    <div class="rh-google-reviews__content">
                        <p><?= $text; ?></p>
                    </div>

                    <a title="Bekijk auteur reviews op Google Reviews" target="_blank" href="<?= $author_url; ?>">
                        <svg class="rh-google-logo" viewBox="0 0 512 168" xmlns="http://www.w3.org/2000/svg">
                            <g transform="translate(0 -171.73)">
                                <path d="m219.106 260.424c0 24.248-18.969 42.116-42.249 42.116s-42.249-17.868-42.249-42.116c0-24.419 18.969-42.116 42.249-42.116s42.249 17.697 42.249 42.116zm-18.5 0c0-15.153-10.994-25.52-23.754-25.52s-23.752 10.368-23.752 25.52c0 15 10.994 25.52 23.754 25.52s23.757-10.538 23.757-25.52z" fill="#ff4131" />
                                <path d="m310.25 260.424c0 24.248-18.969 42.116-42.249 42.116s-42.249-17.868-42.249-42.116c0-24.4 18.969-42.116 42.249-42.116s42.249 17.697 42.249 42.116zm-18.495 0c0-15.153-10.994-25.52-23.754-25.52s-23.754 10.368-23.754 25.52c0 15 10.994 25.52 23.754 25.52s23.754-10.538 23.754-25.52z" fill="#ffbc00" />
                                <path d="m397.6 220.853v75.611c0 31.1-18.343 43.806-40.027 43.806-20.412 0-32.7-13.653-37.331-24.818l16.1-6.7c2.867 6.855 9.893 14.944 21.21 14.944 13.88 0 22.482-8.564 22.482-24.685v-6.057h-.646c-4.139 5.108-12.115 9.57-22.178 9.57-21.058 0-40.35-18.343-40.35-41.945 0-23.773 19.292-42.268 40.35-42.268 10.045 0 18.02 4.462 22.178 9.418h.646v-6.855h17.566zm-16.254 39.723c0-14.83-9.893-25.672-22.482-25.672-12.76 0-23.451 10.842-23.451 25.672 0 14.678 10.69 25.368 23.451 25.368 12.585.001 22.478-10.69 22.478-25.368z" fill="#0085f7" />
                                <path d="m426.553 176.534v123.424h-18.039v-123.424z" fill="#00a94b" />
                                <path d="m496.847 274.286 14.355 9.57a41.919 41.919 0 0 1 -35.09 18.665c-23.925 0-41.793-18.495-41.793-42.116 0-25.046 18.02-42.116 39.723-42.116 21.855 0 32.546 17.393 36.04 26.792l1.918 4.785-56.3 23.318c4.31 8.45 11.013 12.76 20.412 12.76 9.418 0 15.95-4.633 20.735-11.658zm-44.185-15.153 37.638-15.627c-2.07-5.26-8.3-8.924-15.627-8.924-9.403-.001-22.486 8.297-22.011 24.551z" fill="#ff4131" />
                                <path d="m66.326 249.468v-17.868h60.212a59.174 59.174 0 0 1 .892 10.785c0 13.406-3.665 29.982-15.475 41.793-11.488 11.963-26.166 18.343-45.61 18.343-36.04 0-66.345-29.356-66.345-65.395s30.305-65.4 66.345-65.4c19.938 0 34.141 7.823 44.812 18.02l-12.608 12.612a45.544 45.544 0 0 0 -32.223-12.758c-26.318 0-46.9 21.21-46.9 47.528s20.583 47.528 46.9 47.528c17.07 0 26.792-6.855 33.021-13.083 5.051-5.051 8.374-12.266 9.684-22.121z" fill="#0085f7" />
                            </g>
                        </svg>
                    </a>
                </article>
            <?php endforeach;
            wp_reset_postdata(); ?>
        </div>
    <?php endif; ?>
</section>

<style scoped>
    .rh-google-reviews {
        padding-bottom: 5rem !important;
    }

    .rh-google-reviews .slick-slide {
        display: flex;
        flex-direction: column;
    }

    .rh-capitalize {
        text-transform: capitalize;
    }

    .rh-google-reviews .slick-track {
        display: flex;
        gap: 1.5rem;
    }

    .rh-google-reviews .slick-track:before,
    .rh-google-reviews .slick-track:after {
        display: none;
    }

    .rh-google-reviews h2 {
        margin-bottom: 3rem;
    }

    .rh-google-reviews__title {
        display: flex;
        align-items: center;
    }

    .rh-google-reviews__title .rh-google-avatar {
        max-width: 2.5rem;
        margin-right: 1rem;
    }

    @media screen and (max-width: 40em) {
        .rh-google-reviews__title .rh-google-avatar {
            max-width: 2rem;
        }
    }

    .rh-google-reviews .rh-google-logo {
        max-width: 4.5rem;
        position: relative;
    }

    @media screen and (max-width: 40em) {
        .rh-google-reviews .rh-google-logo {
            max-width: 5rem;
            top: 1px;
        }
    }

    .rh-google-reviews__name {
        font-size: rem-calc(18);
        font-weight: 600;
        line-height: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .rh-google-reviews__slider {
        padding-bottom: 20px;
    }

    .rh-google-reviews__item {
        height: auto;
    }

    @media screen and (max-width: 40em) {
        .rh-google-reviews__item {
            padding: 0 2rem;
        }
    }

    .rh-slick-prev {
        color: transparent;
        width: auto;
        height: 1.5rem;
        object-fit: contain;
        object-position: center;
        transform: rotate(180deg);
        top: 50%;
        left: -3rem;
        position: absolute;
    }

    @media screen and (max-width: 40em) {
        .rh-slick-prev {
            left: 0.25rem;
            width: 1.25rem;
            height: 3.25rem;
        }
    }

    .rh-slick-next {
        color: transparent;
        width: auto;
        height: 1.5rem;
        object-fit: contain;
        object-position: center;
        top: 50%;
        right: -3rem;
        position: absolute;
    }

    @media screen and (max-width: 40em) {
        .rh-slick-next {
            right: 0.25rem;
            width: 1.25rem;
            height: 2.25rem;
        }
    }

    .rh-google-reviews .rh-google-date {
        line-height: 1;
    }

    .rh-google-reviews__stars {
        margin-top: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-wrap: nowrap;
    }

    .rh-google-reviews__stars .rh-google-stars {
        display: flex;
        margin-right: 0.75rem;
        align-items: center;
        justify-content: flex-start;
        flex-wrap: nowrap;
        column-gap: 2px;
    }

    .rh-google-reviews__stars .rh-google-stars svg {
        max-width: 1.25rem;
        width: 100%;
    }

    @media screen and (max-width: 40em) {
        .rh-google-reviews__stars .rh-google-stars svg {
            max-width: 1rem;
        }
    }

    .rh-google-reviews__stars .rh-google-stars svg path {
        fill: #ffc107;
    }

    .rh-google-reviews__content {
        margin-top: 1.25rem;
        flex-grow: 1;
    }

    .rh-google-reviews__content p {
        margin-top: 0;
    }
</style>



<script>
    function loadSlick(callback) {
        // CSS
        var link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css?v=' + new Date().getTime(); // Cache-buster
        document.head.appendChild(link);

        var themeLink = document.createElement('link');
        themeLink.rel = 'stylesheet';
        themeLink.href = 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css?v=' + new Date().getTime(); // Cache-buster
        document.head.appendChild(themeLink);

        // JS
        var script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js';
        script.onload = callback;
        document.head.appendChild(script);
    }

    function initializeSlick() {
        jQuery(".rh-google-reviews__slider").slick({
            infinite: true,
            dots: true,
            arrows: true,
            prevArrow: '<svg class="rh-slick-prev" width="40" height="40" enable-background="new 0 0 492.004 492.004" viewBox="0 0 492.004 492.004" xmlns="http://www.w3.org/2000/svg"><path d="m382.678 226.804-218.948-218.944c-5.064-5.068-11.824-7.86-19.032-7.86s-13.968 2.792-19.032 7.86l-16.124 16.12c-10.492 10.504-10.492 27.576 0 38.064l183.856 183.856-184.06 184.06c-5.064 5.068-7.86 11.824-7.86 19.028 0 7.212 2.796 13.968 7.86 19.04l16.124 16.116c5.068 5.068 11.824 7.86 19.032 7.86s13.968-2.792 19.032-7.86l219.152-219.144c5.076-5.084 7.864-11.872 7.848-19.088.016-7.244-2.772-14.028-7.848-19.108z"/></svg>',
            nextArrow: '<svg class="rh-slick-next" width="40" height="40" enable-background="new 0 0 492.004 492.004" viewBox="0 0 492.004 492.004" xmlns="http://www.w3.org/2000/svg"><path d="m382.678 226.804-218.948-218.944c-5.064-5.068-11.824-7.86-19.032-7.86s-13.968 2.792-19.032 7.86l-16.124 16.12c-10.492 10.504-10.492 27.576 0 38.064l183.856 183.856-184.06 184.06c-5.064 5.068-7.86 11.824-7.86 19.028 0 7.212 2.796 13.968 7.86 19.04l16.124 16.116c5.068 5.068 11.824 7.86 19.032 7.86s13.968-2.792 19.032-7.86l219.152-219.144c5.076-5.084 7.864-11.872 7.848-19.088.016-7.244-2.772-14.028-7.848-19.108z"/></svg>',
            slidesToShow: <?= $count > 3 ? 3 : $count; ?>,
            adaptiveHeight: true,
            responsive: [{
                breakpoint: 1224,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true,
                    centerPadding: '20px'
                },
            }]
        });
    }

    jQuery(document).ready(function() {
        if (typeof jQuery.fn.slick === 'undefined') {
            loadSlick(initializeSlick);
        } else {
            initializeSlick();
        }
    });
</script>