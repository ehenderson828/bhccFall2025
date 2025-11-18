// Once document has loaded
$(document).ready(function() {
    $('body').hide().fadeIn(2000);
    $('#flickr_search_input').focus();
    
    var flickr_url = "https://www.flickr.com/services/feeds/photos_public.gne?jsoncallback=?";

    $('#trigger').click(function() {
        var flickr_search = document.getElementById('flickr_search_input').value;

        $.getJSON(flickr_url, {
            tags: `${flickr_search}`,
            tagmode: 'all',
            format: 'json'
        })
        .done(function(data) {
            // Show the results container with fade effect
            $('#api_results_container').fadeIn(500);

            $.each(data.items, function(index, item) {
                // Create a container for each image and title
                var $itemContainer = $('<div>').addClass('image-item');

                // Create and append the image
                $('<img>').attr('src', item.media.m).appendTo($itemContainer);

                // Create and append the title
                var title = item.title || 'Untitled';
                $('<p>').addClass('image-title').text(title).appendTo($itemContainer);

                // Append the container to the output
                $itemContainer.appendTo("#image_output_container");
            });
        })
        .fail(function() {
            alert('Issue fetching data');
        });
    });
    $('#reset').click(function() {
        location.reload();
    });
});