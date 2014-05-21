jQuery( function() {
    jQuery( '#jquery-sample-button' ) . toggle(
        function() {
            jQuery . post(
                '/php/ajax.php',
                $('#form').serialize(),
                //{ username: $('input[name=username]').val(), user_id: '11', id: '26' },
                function( data, textStatus ) {//dataはhtml
                    if( textStatus == 'success' ) {
                        jQuery( '#jquery-sample-textStatus' ) . text( '読み込み成功' );
                    }
                    jQuery( '#jquery-sample-post' ) . html( data );//htmlデータとしてdata
                }
                ,'html'
            );
            if( jQuery( '#jquery-sample-textStatus' ) . text() == '' ) {
                jQuery( '#jquery-sample-textStatus' ) . text( '読み込み失敗' );
            }
        },
        function() {
            jQuery( '#jquery-sample-post' ) . html( '' );
            jQuery( '#jquery-sample-textStatus' ) . text( '' );
        }
    );
} );

}