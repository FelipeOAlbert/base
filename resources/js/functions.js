function init(address)
{
	//Endereço da Aplicação
	//var address = 'http://localhost/classificados/';
	
	//Inicialização do modal de exclusão
	$(".modal:ui-dialog").dialog("destroy");
	
	//Esconder a barra de mensagens
	window.setTimeout('$("#messages").slideUp("slow")', 5000);
	
	//Código dos botões jQueryUI
	$("button, .button").button();
	
	//Hook de click nos botões jQuery
	$("a.button").click(function(){
		switch($(this).attr('rel')){
			case 'delete':
				var href = $(this).attr('href');
				
				$("#delete_confirm").dialog({
					modal: true,
					width:400,
					buttons: {
						"Confirmar": function(){
							$(this).dialog("close");
							window.location = href;
						},
						
						"Cancelar": function(){
							$(this).dialog("close");
						}
					}
				});
				
				return false;
				break;
				
			default:
				return true;
				break;
		}
	});
	
	//Checkboxes de permissões
	$(".checks").click(function(){
		if($(this).attr("checked")){
			$(".subcheck_" + $(this).attr("id")).attr("checked", true);
		} else {
			$(".subcheck_" + $(this).attr("id")).attr("checked", false);
		}
	});
	
	//Código de ativação dos Datepickers do jQueryUI
	$(".datepicker").datepicker({showButtonPanel: true});
	
	//Plugin do sistema de uploads
	//$('#file_upload').uploadify({
	//	'uploader'  : address + 'resources/js/uploadify-v2/uploadify.swf',
	//	'script'    : address + 'resources/js/uploadify-v2/uploadify.php',
	//	'cancelImg' : address + 'resources/js/uploadify-v2/cancel.png',
	//	'folder'    : address + 'uploads',
	//	'auto'      : true
	//});
	
	//Código de solicitações em AJAX
	$(".datacombo").change(function(){
		var u = address + 'ajax/' + $(this).attr("rel") + '/' + $(this).val();
		var t = "#" + $(this).attr("to");
		
		$.get(u, function(d){
			$(t).html('<option value="0">Selecione...</option>' + d);
		});
	});
	
	//Código de pesquisa de lojas
	$("#store").keyup(function(e){
		var s = $(this).val();
		var u = address + 'ajax/store_search/' + s;
		
		if(s.length > 0){
			$.get(u, function(d){
				if(d !== ':('){
					$("#store_suggest").empty();
					$("#store_suggest").show('slow');
					$("#store_suggest").html(d);
				} else {
					$("#store_suggest").hide('slow');
				}
			});
		} else {
			$("#store_suggest").hide('slow');
			$("#store").val('');
		}
	});
	
	//Adicionar Lojas
	$("#store_suggest div").live('click', function(){
		data = data + '<li rel="' + $(this).attr("rel") + '" title="Clique para remover">' + $(this).text() + '</li>';
		
		$(".stores").append(data);
		$("#store_suggest").hide('slow');
		$("#store").val('');
	});
	
	//Código de pesquisa de produtos
	$("#product").keyup(function(e){
		var s = $(this).val();
		var i = $("#brand_id").val();
		var u = address + 'ajax/product_search/' + s + '/' + i;
		
		if($("#brand_id").val() == 0){
			alert('Selecione uma marca para continuar...');
			$("#product").val('');
			$("#brand_id").focus();
			return false;
		}
		
		$.get(u, function(d){
			if(d !== ':('){
				$("#product_suggest_container").show();
				$("#product_suggest").show('slow').html(d);
				$("#button_add_all").show('slow');
				$("#button_close").show('slow');
			} else {
				$("#product_suggest_container").hide();
				$("#product").val('');
			}
		});
	});
	
	//Adicionar Produtos
	$("#product_suggest div").live('click', function(){
		var data = '';
		data = data + '<li rel="' + $(this).attr("rel") + '" title="Clique para remover">' + $(this).text() + '</li>';
		$(".products").html(data);
	});
	
	//Adicionar Todos os Produtos
	$("#button_add_all").live('click', function(){
		$("#product_suggest > div").each(function(i){
			$(".products").append('<li rel="' + $(this).attr("rel") + '" title="Clique para remover">' + $(this).text() + '</li>');
			$("#product_suggest").hide('slow');
			$("#button_add_all").hide('slow');
			$("#button_close").hide('slow');
			$("#product").val('').focus();
		});
	});
	
	//Remover produtos
	$(".products li").live('click', function(){
		$(this).fadeOut();
	});
	
	//Desabilitar carregamento de lojas quando for degustação
	$("#action_type_id").change(function(){
		if($("#action_type_id").val() == '1'){
			$("#stores_container").hide('slow');
		} else {
			$("#stores_container").show('slow');
		}
	});
	
	//Carregar lojas automaticamente
	$("#network_id").change(function(){
		var i = $("#network_id").val();
		
		if($("#action_type_id").val() == '1'){
			$("#stores_container").hide();
			var u = address + 'ajax/store_search_by_id/' + i;
		} else {
			var u = address + 'ajax/store_search/' + s;
		}

		$.get(u, function(d){
			if(d !== ':('){
				$(".stores").show('slow');
				$(".stores").html(d);
			} else {
				$(".stores").hide('slow');
			}
		});
	});
	
	//Validação do Formulário de Ações
	$("#action_submit").live('click', function(){
		
		//Variáveis de controle
		var e = 0;
		var d = '';
		var p = '';
		var l = '|';
		
		//Validação básica de erros
		if($("#name").val() == ''){e++;}
		if($("#action_type_id").length == 0){e++;}
		if($("#channel_id").length == 0){e++;}
		if($("#group_id").length == 0){e++;}
		if($("#network_id").length == 0){e++;}
		if($("#starts_in").val() == ''){e++;}
		if($("#ends_in").val() == ''){e++;}
		
		//Formatação de lojas e produtos para o post
		$(".stores > li").each(function(i){d = d + $(this).attr("rel") + ',';});
		$(".products > li").each(function(i){p = p + $(this).attr("rel") + ',';});
		
		//Atribuição dos dados de lojas e produtos
		$("#real_stores").val(d);
		$("#real_products").val(p);
		
		//Verifica se existe algum erro
		if(e > 0){
			
			//Exibe a caixa de diálogo de erros
			$("#validation_error").dialog({
				modal: true,
				width:400,
				buttons: {
					"Ok": function(){
						$(this).dialog("close");
					}
				}
			});
			
			return false;
		} else {
			
			//Verifica se existe algum conflito entre ações
			var type	= $("#action_type_id").val();
			var channel	= $("#channel_id").val();
			var group	= $("#group_id").val();
			var network	= $("#network_id").val();
			var brand	= $("#brand_id").val();
			var start	= $("#starts_in").val();
			var send	= $("#ends_in").val();

			//Endereço de pesquisa de ações
			var surl = address + 'ajax/action_search/' + type + '/' + channel + '/' + group + '/' + network + '/' + brand + '/' + start + '/' + send;
			
			//Pesquisa os dados da ação
			$.get(surl, function(res){
				
				//Verifica os dados da resposta
				if(res == ':)'){
					$("#period_error").dialog({
						modal: true,
						width:400,
						buttons: {
							"Prosseguir": function(){
								$(this).dialog("close");
								$("#actions_form").submit();
							},
							"Selecionar outro Período": function(){
								$(this).dialog("close");
								$("#starts_in").focus();
								return falsé;
							}
						}
					});

					return false;
				} else {

					//Posta os dados para a URL
					$("#actions_form").submit();
				}
			});
			
			//Moiô geral, pega o gato
			return false;
		}
	});
	
	//Código de Tooltips
	$(".calendar_action").mouseover(function(){
		if($(".tooltip").is(":hidden")){
			$(".tooltip").css("top", ($(this).offset().top-15)+"px").css("left", ($(this).offset().left-250)+"px").show();
		}
	}).mouseout(function(){
		$(".tooltip").hide();
	});
}
