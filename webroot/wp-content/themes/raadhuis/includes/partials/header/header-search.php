<?php
/**
 * Header with search functionality using Tailwind CSS
 */

// Get ACF fields if available
$title = get_field('header_search_title') ?: 'Onafhankelijke en betrouwbare informatie over de schildklier';
$search_placeholder = get_field('header_search_placeholder') ?: 'Waar ben je naar op zoek?';
$popular_terms_label = get_field('header_search_popular_terms_label') ?: 'Populaire zoektermen:';

// Get popular terms from ACF if available, otherwise use defaults
$popular_terms = get_field('header_search_popular_terms');
if (!$popular_terms) {
    $popular_terms = [
        ['term' => 'Zwangerschap', 'url' => '#'],
        ['term' => 'Voeding', 'url' => '#'],
        ['term' => 'Schildkliertelefoon', 'url' => '#'],
    ];
}

// Get background image or use placeholder
$bg_image = get_field('header_search_bg_image');
$bg_image_url = $bg_image ? $bg_image['url'] : 'https://placehold.co/1200x800/1B1B3A/white';

// Get feature image or use placeholder
$feature_image = get_field('header_search_feature_image');
$feature_image_url = $feature_image ? $feature_image['url'] : 'https://placehold.co/800x600/CCCCCC/333333';
?>

<header class="w-full bg-[#1B1B3A]">
  <div class="flex flex-col md:flex-row gap-0 md:gap-5">
    <!-- Left Column -->
    <div class="w-full md:w-1/2 flex flex-col">
      <div class="relative flex flex-col items-end justify-center min-h-[629px] py-[69px] px-5 md:px-20">
        <!-- Background Image -->
        <img src="<?php echo esc_url($bg_image_url); ?>" 
             class="absolute inset-0 w-full h-full object-cover object-center" 
             alt="<?php echo esc_attr($title); ?>">
        
        <!-- Content Container -->
        <div class="relative flex flex-col items-start justify-start w-full md:w-[683px] max-w-full">
          <!-- Title -->
          <h1 class="text-white text-4xl md:text-[66px] font-semibold leading-[49px] md:leading-[72px] font-inter self-stretch">
            <?php echo esc_html($title); ?>
          </h1>
          
          <!-- Search Form -->
          <form role="search" method="get" class="w-full md:w-[641px] max-w-full mt-8" action="<?php echo esc_url(home_url('/')); ?>">
            <div class="relative flex items-start justify-start bg-white rounded-[10px] min-h-[79px] w-full py-6 px-5 md:px-7">
              <input type="search" 
                     class="text-[#5a5a5a] text-xl font-medium leading-normal font-inter my-auto bg-transparent border-none outline-none w-full" 
                     placeholder="<?php echo esc_attr($search_placeholder); ?>" 
                     value="<?php echo get_search_query(); ?>" 
                     name="s" />
              
              <!-- Search Button -->
              <button type="submit" class="absolute right-[9px] bottom-[9px] flex items-center justify-center bg-[#694f9c] rounded-[10px] w-[60px] h-[60px] p-5 border-0">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/assets/img/search-icon.svg" 
                     class="w-[19px] object-contain self-stretch my-auto" 
                     alt="Search">
              </button>
            </div>
          </form>
          
          <!-- Popular Terms -->
          <?php if (!empty($popular_terms)) : ?>
          <div class="flex flex-wrap items-center justify-center gap-[18px] mt-8 p-[10px] text-white text-base font-normal leading-8 font-inter max-w-full">
            <div class="self-stretch my-auto"><?php echo esc_html($popular_terms_label); ?></div>
            <?php foreach ($popular_terms as $term) : ?>
              <a href="<?php echo esc_url($term['url']); ?>" class="self-stretch my-auto underline cursor-pointer text-white no-underline hover:underline">
                <?php echo esc_html($term['term']); ?>
              </a>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    
    <!-- Right Column -->
    <div class="w-full md:w-1/2 md:ml-5">
      <img src="<?php echo esc_url($feature_image_url); ?>" 
           class="w-full aspect-[1.33] object-contain object-center flex-grow" 
           alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
    </div>
  </div>
</header>
