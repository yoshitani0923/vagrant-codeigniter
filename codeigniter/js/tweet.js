jQuery( function() {
    jQuery( '#tweet_button' ) . click(
        function(event) {
            console.log('post'),
            event.preventDefault();//イベントキャンセル
            jQuery . post(
                '/index.php/tweet/new_tweet',
                //$('#form').serialize(),
                $("form").serialize(),
                function( aaa, textStatus ) {//dataはhtml
                    if( textStatus == 'success') {
                        jQuery( '#new_tweet' ) . prepend( aaa );//htmlデータとしてdata
                    }
                }
                ,'html'
            );
        }
    );

    jQuery( '#more_button' ) . click(
        function(event) {
            event.preventDefault();//イベントキャンセル
            jQuery . get(
                '/index.php/tweet/more_tweet',
                //$('#form').serialize(),
                '',
                function( bbb, textStatus ) {//dataはhtml
                    if( textStatus == 'success') {
                        jQuery( '#more_tweet' ) . append( bbb );//htmlデータとしてdata
                    }
                }
                ,'html'
            );
        }
    );
} );