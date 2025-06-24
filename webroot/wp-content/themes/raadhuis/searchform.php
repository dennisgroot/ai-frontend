<form class="inline-flex items-start justify-start h-12" method="get" action="<?= esc_url(home_url('/')); ?>">
    <div class="flex flex-row flex-nowrap relative">
        <div class="search-field"><input type="search" name="s" value="<?php if (is_search()) {
                                                                            echo get_search_query();
                                                                        } ?>" placeholder="<?= __('Zoeken', 'raadhuis-wp'); ?>" /></div>
        <button type="submit" class="absolute w-5 h-5 left-5 top-1/2 -translate-y-1/2" role="button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
            <span class="sr-only"><?= __('Zoeken', 'raadhuis-wp'); ?></span>
        </button>
    </div>
</form>