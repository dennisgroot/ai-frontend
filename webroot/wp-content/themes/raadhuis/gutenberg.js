wp.domReady(() => {
    wp.blocks.unregisterBlockStyle(
        'core/button',
        ['default', 'outline', 'squared', 'fill']
    );

    wp.blocks.unregisterBlockStyle(
        'core/table',
        ['default', 'stripes']
    );

    wp.blocks.registerBlockStyle(
        'core/button',
        [
            {
                name: 'primary',
                label: 'Primair',
                isDefault: true
            },
            {
                name: 'secondary',
                label: 'Secundair'
            }
        ]
    );

    const blocks = ['acf/faq', 'acf/image-slider', 'acf/image-text', 'acf/gallery', 'acf/news', 'acf/cards', 'acf/events', 'acf/team', 'acf/downloads']; // set all blocks where stylesBackground are set 
    const stylesBackground =
        [
            {
                name: 'no-bg',
                label: 'Geen achtergrondkleur',
                isDefault: true
            },
            {
                name: 'bg-light',
                label: 'Lichte achtergrondkleur',
            },
            {
                name: 'bg-dark',
                label: 'Donkere achtergrondkleur'
            }
        ];

    // Loop through each block and register all custom stylesBackground in one go..
    blocks.forEach(function (blocks) {
        wp.blocks.registerBlockStyle(blocks, [...stylesBackground]);
    });

    // Block clean up only blocks with // wil be allowed
    wp.domReady(function () {
        const blockTypes = [
            'core/archives',
            'core/audio',
            // 'core/button',
            'core/categories',
            'core/freeform',
            'core/code',
            'core/cover',
            // 'core/column',
            // 'core/columns',
            'core/embed',
            'core/file',
            'core/gallery',
            // 'core/heading',
            'core/html',
            // 'core/image',
            'core/media-text',
            'core/calendar',
            'core/latest-posts',
            'core/more',
            // 'core/list',
            // 'core/paragraph',
            // 'core/quote',
            // 'core/subhead',
            // 'core/table',
            // 'core/textColumns',
            // 'core/row',
            'core/nextpage',
            'core/page-list',
            'core/preformatted',
            'core/pullquote',
            'core/verse',
            'core/group',
            'core/separator',
            'core/spacer',
            'core/shortcode',
            'core/video',
            'core/tag-cloud',
            'core/social-links',
            'core/search',
            'core/rss',
            'core/navigation',
            'core/query-title',
            'core/term-description',
            'core/loginout',
            'core/post-comments',
            'core/post-navigation-link',
            'core/post-terms',
            'core/post-date',
            'core/post-author',
            'core/post-content',
            'core/post-featured-image',
            'core/post-excerpt',
            'core/post-title',
            'core/query',
            'core/site-tagline',
            'core/site-title',
            'core/site-logo',
            'yoast/faq-block',
            'yoast/how-to-block',
            'yoast-seo/breadcrumbs',
            'core/latest-comments',
            'core/post-author-biography',
            'core/post-comments-form',
            'core/comments-query-loop',
            'core/comment-template',
            'core/comments-pagination',
            'core/comments',
            'core/post-author-name',
            'core/read-more',
            'core/avatar',
            'filebird/block-filebird-gallery',
            'wpml/language-switcher'
        ];

        blockTypes.forEach(blockType => {
            if (wp.blocks.getBlockType(blockType)) {
                wp.blocks.unregisterBlockType(blockType);
            }
        });
    });

    // marked with commonds are allowed
    var embed_variations = [
        'amazon-kindle',
        'animoto',
        'cloudup',
        'collegehumor',
        'crowdsignal',
        'dailymotion',
        'facebook',
        'flickr',
        'imgur',
        'pinterest',
        'wolfram',
        'bluesky',
        'pocket-casts',
        'instagram',
        'issuu',
        'kickstarter',
        'meetup-com',
        'mixcloud',
        'reddit',
        'reverbnation',
        'screencast',
        'scribd',
        'slideshare',
        'smugmug',
        'soundcloud',
        'speaker-deck',
        'spotify',
        'ted',
        'tiktok',
        'tumblr',
        'twitter',
        'videopress',
        //'vimeo'
        'wordpress',
        'wordpress-tv',
        //'youtube'
    ];

    for (var i = embed_variations.length - 1; i >= 0; i--) {
        wp.blocks.unregisterBlockVariation('core/embed', embed_variations[i]);
    }

});