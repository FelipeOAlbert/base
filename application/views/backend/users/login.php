<div class="container-fluid">
	<div class="row-fluid">
	
		<div class="row-fluid">
			<div class="span12 center login-header">
				<h2><?=$scr_title?></h2>
			</div>
		</div>
		
		<div class="row-fluid">
			<div class="well span5 center login-box">
				<div class="alert alert-info">
					Por favor, faça o login com seu usuário e senha.
				</div>
				
				<? if(isset($alert)){  ?>
				<div class="alert alert-block">
					<h4 class="alert-heading">Atenção!</h4>
					<p>Falha na autenticação. Preencha os campos corretamente!</p>
				</div>
				<? } ?>
				
				<form class="form-horizontal" action="" method="post">
					<fieldset>
						<div class="input-prepend" title="Usuário" data-rel="tooltip">
							<span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="username" id="username" type="text" value="" />
						</div>
						<div class="clearfix"></div>
						
						<div class="input-prepend" title="Senha" data-rel="tooltip">
							<span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="password" id="password" type="password" value="" />
						</div>
						<div class="clearfix"></div>
						
						<div class="input-prepend">
						<label class="remember" for="remember"><input type="checkbox" id="remember" />Lembrar</label>
						</div>
						<div class="clearfix"></div>
						
						<p class="center span5">
						<button type="submit" class="btn btn-primary">Login</button>
						</p>
					</fieldset>
				</form>
			</div>
		</div>
	</div>