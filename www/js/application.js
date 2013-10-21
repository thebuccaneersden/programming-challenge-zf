$(document).ready(function() {



    $(document).on("click", ".nav-tabs a", function (e)
    {
        var id = $(this).attr('data-id');
        console.log('List item with ID \''+id+'\' was clicked');

        // Perform backend ajax request
        var jqxhr = $.ajax( "/ajax/submit?id="+id )
            .done(function() {
                console.log('Backend request to update value was successful');
                updateBadge(id);
            })
            .fail(function() { console.log('Backend request to update value failed'); })
            .always(function() {});
    });

    function updateBadge(id)
    {
    	// Update the badge immediately, so we don't have to wait on polling to do it
        val = $("[data-id*='"+id+"'] .badge").text();
        $("[data-id*='"+id+"'] .badge").text(parseInt(val)+5);
        $("[data-id*='"+id+"']").hide();
        $("[data-id*='"+id+"']").fadeIn('slow');
    }


    function doPoll()
    {

        console.log('Polling');

        // Poll backend for current points list data
        $.getJSON('ajax/poll', function(data) {

            var items = [];

            $.each(data, function(key, val) {

                // If this player is not on the list, add it
                if( $("[data-id*='"+val['id']+"']").length == 0 )
                {
                    element = '<li><a href="#" data-id="'+ val['id'] +'">'+ val['player'] +'<span class="badge" style="float: right;">'+ val['points'] +'</span></a></li>'
                    $('.nav-tabs').append(element);
                    console.log('List element for player with the following data was not found. Adding it to the list.');
                    console.log(val);
                }

                // Update existing values if any change
                if( $("[data-id*='"+val['id']+"'] .badge").text() != val['points'] )
                {
                    $("[data-id*='"+val['id']+"'] .badge").text(val['points']);
                    $("[data-id*='"+val['id']+"']").hide();
                    $("[data-id*='"+val['id']+"']").fadeIn('slow');
                    console.log('Points for player ID \''+val['id']+'\' changed to \''+ val['points'] +'\'');
                }
            });

            // Continue polling
            setTimeout(doPoll,2000);
        });
    }
    doPoll();

});
