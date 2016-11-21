<body class='login'>
	<div class="wrapper">
		<h1><a href="#"><img src="<?php echo base_url(); ?>public/img/logo-big.png" alt="" class='retina-ready' width="59" height="49">Login</a></h1>
		<div class="login-body">
			<h2><?php echo $titlepage; ?></h2>				
			<?php echo form_open("adminlevel/login/signin", array('id' => 'frmlogin', 'name' => 'frmlogin', 'class' => 'form-validate')); ?>
				<div class="control-group">
					<div class="controls">
						<input type="text" name='uuser' placeholder="Username" class='input-block-level' data-rule-required="true">
					</div>
				</div>				
				<div class="control-group">
					<div class="pw controls">
						<input type="password" name="upw" placeholder="Password" class='input-block-level' data-rule-required="true">
					</div>					
				</div>
				<div class="control-group">
					<div class="controls">
						<input type="text" name='ucode' placeholder="Store ID" class='input-block-level' data-rule-required="true">
					</div>					
				</div>
				<?php echo '<div class="control-group error"><span class="help-block">'.validation_errors().'</span></div>'; ?>
				<div class="submit">
					<div class="remember">
						<input type="checkbox" value="1" name="remember" class='icheck-me' data-skin="square" data-color="blue" id="remember"> <label for="remember">Remember me</label>
					</div>
					<input type="submit" value="Sign me in" class='btn btn-primary'>
				</div>
			</form>
			<div class="forget">
				<a href="#"><span>Forgot password?</span></a>
			</div>
		</div>
	</div>
</body>