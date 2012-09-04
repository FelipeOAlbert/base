<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
<head>
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="generator" content="Komodo">
	<meta name="author" content="<?=$this->parameter_model->get('author');?>">
	
	<!-- Título da Página -->
	<title><?=$url_title?></title>
	
	<!-- Estilos CSS -->
	<link rel="stylesheet" type="text/css" href="<?=site_url();?>resources/css/jquery-ui/ui-darkness/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" type="text/css" href="<?=site_url();?>resources/css/styles.css" />
	
	<!-- Javascripts -->
	<script type="text/javascript" src="<?=site_url();?>resources/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="<?=site_url();?>resources/js/functions.js"></script>
</head>
<body onload="init();" class="login_bg">
	<div class="login_base">><?=$this->parameter_model->get('company_name');?></div>
	
	<div class="login_container">
		<div>
			<h1><?=$scr_title?></h1>

			<form method="post">
				<div>
					<label for="email"><?=$this->lang->line('login_email');?>:</label>
					<input ytpe="text" name="email" id="email" class="input"/>
				</div>
	
				<div>
					<label for="password"><?=$this->lang->line('login_password');?>:</label>
					<input type="password" name="password" id="password" class="input"/>
				</div>
					
				<div>
					<label for="submit"></label>
					<input type="submit" name="submit" id="submit" value="<?=$this->lang->line('button_proceed');?>" class="button" />
				</div>
			</form>
		</div>
	</div>
</body>
</html>
