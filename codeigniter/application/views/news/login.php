<h2>ログインs</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('login/login') ?>

<label for="">メールアドレス</label>
<input type="input" name="email" /><br />

<label for="">パスワード</label>
<input type="input" name="password" /><br />

<input type="submit" name="submit" value="ログイン" />

</form>