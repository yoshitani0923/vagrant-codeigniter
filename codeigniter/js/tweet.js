$( function() {
  var button = $("#button").val();
  if (button == 0) {
    $("#more_button").hide();
    $("#appear").html('もうないよ');
  }

    $('#tweet_button').click(function(event) {
            event.preventDefault();
            $.post(
                '/index.php/tweet/new_tweet',
                $('#form_tweet_area').serialize(),
                function(new_tweet_data) {

                    var reset = '';
                    $('#tweet_area').val(reset);

                    $tweet = $(".template").clone(true);
                    $tweet.attr("class", "copied");
                    $(".temp_username", $tweet).text(new_tweet_data['username']);
                    $(".temp_tweet", $tweet).text(new_tweet_data["tweet"]);
                    $(".temp_unix_time", $tweet).text(new_tweet_data.new_tweet_time);
                    $("#new_tweet").prepend($tweet);

                    $('#page').val(Number($('#page').val()) + 1);
                },'json'
            );
        });

    $('#more_button').click(function(event) {
            event.preventDefault();//イベントキャンセル

            $('#page').val(Number($('#page').val()) + 10);

            $.getJSON(
                '/index.php/tweet/more_tweet',
                'page=' + $('#page').val(),
                function(more_tweet, textStatus) {
                    for (var i = 0 ; i < more_tweet.news.length ; i++) {
                        $tweet = $(".template").clone(true);
                        $tweet.attr("class", "copied");
                        $(".temp_username", $tweet).text(more_tweet['username']);
                        $(".temp_tweet", $tweet).text(more_tweet.news[i]["tweet"]);
                        $(".temp_unix_time", $tweet).text(more_tweet.news[i]["unix_time"]);
                        
                        $('#more_tweet').append($tweet);
                    }
                    if(more_tweet['num'] < 10) {
                        $('#more_button_area').hide();
                        $("#appear").html('もうないよ');

                    }
                    if(more_tweet['num'] == 10) {
                        if(more_tweet['all_num'] == Number($('#page').val()) + 10){
                            $('#more_button_area').hide();
                            $("#appear").html('もうないよ');
                        }
                    }
                });
        });
});