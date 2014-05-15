<h2>ログイン</h2>

<body>
    <?php echo validation_errors(); ?>
    <?php echo form_open('login/index') ?>
        メールアドレス<?php echo form_input('email');?><br />
	    パスワード<?php echo form_password('password');?><br />
    <?php echo form_submit('submit', 'ログイン');?>
</form>
</body>

<a href="http://vagrant-codeigniter.local/index.php/news/create">
	新規登録はこちら
</a>