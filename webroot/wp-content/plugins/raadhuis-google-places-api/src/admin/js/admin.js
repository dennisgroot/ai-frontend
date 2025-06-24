(function ($) {
    'use strict';

    $(document).on('click', '#fetch-google-places-reviews', function () {
        if (confirm('Weet je zeker dat je de Google Reviews wilt ophalen?')) {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'fetch_google_places_reviews',
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.error) {
                        alert('Er is een fout opgetreden: ' + data.error);
                    } else {
                        alert('Google Reviews zijn succesvol opgehaald. LET OP: Deze staat op status: Concept.');
                        console.log(response); // eslint-disable-line
                        location.reload();
                    }
                },
                error: function (error) {
                    alert('Er is een fout opgetreden bij het ophalen van de Google Reviews.');
                    console.log(error); // eslint-disable-line
                }
            });
        }
    });

    // Clear debug log
    $(document).on('click', '#clear-log', function () {
        if (confirm('Weet je zeker dat je de log wilt legen?')) {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'clear_debug_log',
                },
                success: function (response) {
                    alert('Debug log is succesvol geleegd.');
                    console.log(response); // eslint-disable-line
                    location.reload();
                },
                error: function (error) {
                    alert('Er is een fout opgetreden bij het legen van de debug log.');
                    console.log(error); // eslint-disable-line
                }
            });
        }
    });

    // mybusiness API
    // $(document).on('click', '#fetch-google-mybusiness-reviews', function () {
    //     if (confirm('Weet je zeker dat je de Google Reviews wilt ophalen?')) {
    //         $.ajax({
    //             url: ajaxurl,
    //             type: 'POST',
    //             data: {
    //                 action: 'fetch_google_mybusiness_reviews',
    //             },
    //             success: function (response) {
    //                 alert('Google Reviews zijn succesvol opgehaald.');
    //                 location.reload();
    //             },
    //             error: function () {
    //                 alert('Er is een fout opgetreden bij het ophalen van de Google Reviews.');
    //             }
    //         });
    //     }
    // });

})(jQuery);
