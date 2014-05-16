<h2>新規登録</h2>

<body>
    <?php echo validation_errors(); ?>
    <?php echo form_open('news/create') ?>
        名前<?php echo form_input('username', set_value('username'));?><br />
        メールアドレス<?php echo form_input('email', set_value('email'));?><br />
	    パスワード<?php echo form_password('password', set_value('password'));?><br />
    <?php echo form_submit('submit', '登録する');?>
</form>
</body>