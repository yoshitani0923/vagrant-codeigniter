<h2>新規登録</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('news/create') ?>

	<label for="">名前</label>
	<input type="input" name="username" /><br />

	<label for="">メールアドレス</label>
	<input type="input" name="email" /><br />

	<label for="">パスワード</label>
	<input type="input" name="password" /><br />


	<input type="submit" name="submit" value="登録する" />

</form>