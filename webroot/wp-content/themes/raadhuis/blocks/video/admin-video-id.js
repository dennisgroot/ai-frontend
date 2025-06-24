document.addEventListener('DOMContentLoaded', function() {
    (function($) {
        // Functie om YouTube video-ID te verkrijgen
        function getYouTubeVideoID(url) {
            var urlObj = new URL(url);
            if (urlObj.hostname === 'youtu.be') {
                return urlObj.pathname.slice(1); // video ID is the path after the hostname
            }
            var urlParams = new URLSearchParams(urlObj.search);
            return urlParams.get('v');
        }

        // Functie om Vimeo video-ID te verkrijgen
        function getVimeoVideoID(url) {
            var regex = /vimeo.com\/(\d+)/;
            var match = url.match(regex);
            return match ? match[1] : null;
        }

        // Functie om te kijken of het een YouTube of Vimeo URL is en de waarde van de ID in te stellen
        function checkAndModifyURL(input) {
            var url = input.val();
            var videoID = null;

            if (url.includes('youtube.com/watch') || url.includes('youtu.be')) {
                videoID = getYouTubeVideoID(url);
            } else if (url.includes('vimeo.com')) {
                videoID = getVimeoVideoID(url);
            }

            if (videoID) {
                input.val(videoID);
            }
        }

        // Observer om te wachten tot het veld is toegevoegd aan de DOM
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.addedNodes) {
                    $(mutation.addedNodes).each(function() {
                        var $this = $(this);
                        // Controleer of het het specifieke veld is dat we zoeken
                        if ($this.find('[data-key="field_633ab75a531ae"]').length) {
                            // Voeg hier je event toe
                            $this.find('[data-key="field_633ab75a531ae"] input').on('change', function() {
                                checkAndModifyURL($(this));
                            });
                        }
                    });
                }
            });
        });

        // Start observer
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });

        // Voor reeds bestaande blokken bij initialisatie
        $('[data-key="field_633ab75a531ae"]').each(function() {
            var $this = $(this);
            $this.find('input').on('change', function() {
                checkAndModifyURL($(this));
            });
        });
    })(jQuery);
});
