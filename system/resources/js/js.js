$(document).ready(function(){

		//create a bubble popup for each DOM element with class attribute as "text", "button" or "link" and LI, P, IMG elements.
		$('.text, .button, .link, li, p.paragraph, #myimage1, #myimage2').CreateBubblePopup
        ({
            
            position : 'top',
            align	 : 'center',
            
            innerHtml: 'Take a look to the HTML source of this page <br /> \
                        to learn how the plugin works!',
    
            innerHtmlStyle: {
                                color:'#FFFFFF', 
                                'text-align':'center',
                                'background':'#000',
                                'font':'10px Verdana'
                            },
                                                
            themeName: 	'img',
            themePath: 	'resources'
         
        });
        
        //SLIDER CABEÇALHO
        $('.slider').cycle({ 
        fx: 'fade', 
        pause: 1,
        after: function() {
            $('span.slidertext').html($('.slider img:visible').attr('alt'));
        },
        timeout: 6000
        });
        
        //Efeito Zebra
        $('table.tableredacao tbody tr:even').css('background','#DBD8CF'); 
        $('table.tableredacao tbody tr:odd').css('background','#F0F0F0');
        $('table.tableweb tbody tr:even').css('background','#DBD8CF'); 
        $('table.tableweb tbody tr:odd').css('background','#F0F0F0');
        $('table.tablemidia tbody tr:even').css('background','#DBD8CF'); 
        $('table.tablemidia tbody tr:odd').css('background','#F0F0F0');
        $('table.tableart tbody tr:even').css('background','#DBD8CF'); 
        $('table.tableart tbody tr:odd').css('background','#F0F0F0');
        $('table.tablegestao tbody tr:even').css('background','#DBD8CF'); 
        $('table.tablegestao tbody tr:odd').css('background','#F0F0F0');
        
        //Zoom Fonte
        $(".zoomFonte a").click(function(){
        var $content = $('#orangetable');
        var currentSize = $content .css('font-size');
        var num = parseFloat(currentSize,10);
        var unit = currentSize.slice(-2);
        if(this.id == 'mais' && num <= 16)           num *= 1.2;         else if(this.id == 'menos' && num >= 10)
            num /= 1.2;
        $content.css('fontSize', num + unit);
        
        
     });
        
});