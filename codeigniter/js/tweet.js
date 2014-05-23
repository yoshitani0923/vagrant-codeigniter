jQuery( function() {
    jQuery( '#tweet_button' ) . click(
        function(event) {
            event.preventDefault();//イベントキャンセル
            jQuery . post(
                '/index.php/tweet/new_tweet',
                $('form').serialize(),
                function(aaa) {//dataはhtml
                    
                        var tweet = '';
                        tweet += '<div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">';
                        tweet += aaa.news["tweet"] + '<br>';
                        tweet += aaa.news["register_date"] + '<br>';
                        tweet += aaa['username'];
                        tweet += '</div>';
                        jQuery( '#new_tweet' ) . prepend(tweet);
                                var v = $('#page').val();
            v = Number(v) + 1;
            //alert(v);
            $('#page').val(v);
                }
                ,'json'
            );
        }
    );

    jQuery( '#more_button' ) . click(
        function(event) {
            event.preventDefault();//イベントキャンセル

            var v = $('#page').val();
            v = Number(v) + 10;
            //alert(v);
            $('#page').val(v);

            jQuery .getJSON(
                '/index.php/tweet/more_tweet',
                'page=' + $('#page').val(),
                function( bbb, textStatus ) {//dataはhtml
                    /*var bbb = [
                    {"username": "yoshitani", "message": "AAAAA", "time": "0000-00-00 00:00:00"},
                    {"username": "yoshitani", "message": "AAAAA", "time": "0000-00-00 00:00:00"},
                    {"username": "yoshitani", "message": "AAAAA", "time": "0000-00-00 00:00:00"},
                    {"username": "yoshitani", "message": "AAAAA", "time": "0000-00-00 00:00:00"}
                    ];*/
                    for (var i=0; i<bbb.news.length; i++) {
                        var tweet = '';
                        tweet += '<div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">';
                        tweet += bbb.news[i]["tweet"] + '<br>';
                        tweet += bbb.news[i]["register_date"] + '<br>';
                        tweet += bbb['username'];
                        tweet += '</div>';
                        jQuery( '#more_tweet' ) . append(tweet);
                    }
                    /*var bbb = '<div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">yoshitani<br>AAAAAA<br>2014-05-22 11:33:45            </div>';
                    if( textStatus == 'success') {
                        
                        jQuery( '#more_tweet' ) . append( bbb );//htmlデータとしてdata
                    }*/
                }
            );
        }
    );
} );