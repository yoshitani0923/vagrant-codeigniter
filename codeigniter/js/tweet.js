jQuery( function() {
    jQuery( '#tweet_button' ).click(
        function(event) {
            event.preventDefault();//イベントキャンセル
            jQuery.post(
                '/index.php/tweet/new_tweet',
                $('form#form_tweet_area').serialize(),
                function(new_tweet_data) {

                    var reset = ''
                    $('#tweet_area').val(reset);

                    var tweet = '';
                    tweet += '<div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">';
                    tweet += new_tweet_data['username'] + '<br>';
                    tweet += new_tweet_data["tweet"] + '<br>';
                    tweet += new_tweet_data.new_tweet_time;//aaa.news["register_date"];
                    tweet += '</div>';
                    jQuery('#new_tweet').prepend(tweet);
                    
                    $('#page').val(Number($('#page').val()) + 1);
                }
                ,'json'
            );
        }
    );

    jQuery('#more_button').click(
        function(event) {
            event.preventDefault();//イベントキャンセル

            $('#page').val(Number($('#page').val()) + 10);

            jQuery.getJSON(
                '/index.php/tweet/more_tweet',
                'page=' + $('#page').val(),
                function( more_tweet, textStatus ) {
                    for (var i=0; i<more_tweet.news.length; i++) {
                        var tweet = '';
                        tweet += '<div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">';
                        tweet += more_tweet['username'] + '<br>';
                        tweet += more_tweet.news[i]["tweet"] + '<br>';
                        tweet += more_tweet.unix_time[i];
                        tweet += '</div>';
                        jQuery( '#more_tweet' ).append(tweet);
                    }
                }
            );
        }
    );
} );