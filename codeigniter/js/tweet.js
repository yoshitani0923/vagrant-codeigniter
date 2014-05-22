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
                        jQuery('#tweet_area').val("");//フォームの文字削除
                    }
                }
                ,'html'
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

            jQuery . get(
                '/index.php/tweet/more_tweet',
                'page=' + $('#page').val(),

                function( bbb, textStatus ) {//dataはhtml
                    if( textStatus == 'success') {
                        jQuery( '#more_tweet' ) . append( bbb );//htmlデータとしてdata
                    }
                }
            );
        }
    );
} );