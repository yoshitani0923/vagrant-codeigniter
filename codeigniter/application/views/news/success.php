<h2>時計</h2>

<body>
	<?php
        $date = date('Y-m-d H:i:s');
        $a = strtotime($date);
        $b = strtotime($jikan);
    ?>
    <?php $ans = $a - $b ?>
    <?php 
          $ansans = $ans/(60*60*24);
          for ($i = 0; $i <= $ansans ; $i++) {
          	$z = $i;
          }
          ?>
</br>
    <?php 
        echo '今の時間は'.$date.'で、投稿した時間は'.$jikan.'です。あなたは'.$z.'日前に投稿しました。';
    ?>
</body>