/**
 * search.js
 *
 * For all custom js codes.
 */
jQuery(document).ready(function($) {

    $(document).on('keyup', '#search-bar', function(e){
        event.preventDefault();
        var searchKeyword = $(this).val();


                $('#data_box').addClass( 'active' );
                if (searchKeyword.length >= 2) {
                setTimeout(() => {
                    var mysearch = {
                        'action': 'broker_form',
                        'keywords': $('#search-bar').val()
                    };

                    $.ajax({
                    url: search_broker_params.ajaxurl,
                    data: mysearch,
                    type: 'POST',
                    success: function(objectresult) {
                        // var arr = jQuery.parseJSON( '[{"id":10,"name":"sinu"},{"id":20,"name":"shinto"}]' );

                        // for (var i = 0; i < arr.length; i++) {
                        //     console.log('index: ' + i + ', id: ' + arr[i].id + ', name: ' + arr[i].name);
                        // }
                        var data = $.parseJSON(objectresult);
                        var wizards = data.results;
                        var html = '';
                        if (data.results !='') {
                          wizards.forEach(function (wizard) {
                            if (wizard.title != '') {
                              html += '<li class="list_obj"><a href="'+wizard.link +'"> <img src="' + wizard.logo + '" alt=""><span class="text">' + wizard.title + '</a></span></li>';
                            }
                          });
                          // Wrap items in an unordered list
                          html = html;
                          //$('#data_box').addClass( 'active' );
                          document.querySelector('#data_box').classList.add('active');
                          document.querySelector('#datafetch').innerHTML = html;
                        //   console.log(data.results);
                        }
                    },
                    error: function(req, err){
                        console.log('my message' + err);
                    }
                    });
                }, 0);
                }else{
                    $('#datafetch').empty();
                }




    });

    $(document).mouseup(function(e) 
{
    var container = $('#search-bar');

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        $('#datafetch').empty();
    }
});

});
