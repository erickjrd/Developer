function Informacion(ced) 
{	
	//var _this = $(this);
	
	$.getJSON('http://cidez.no-ip.org:6969/cidez/conex.php?q='+ ced +'&jsoncallback=?',
	function(data) 
	{
		var items = [];

		$.each(data, function(i, item) 
		{			
			if (item.BANDERA == 1)
			{
				
				document.getElementById("cidez").innerHTML = 
				'<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px">' +
				'<tr><td width="174">NOMBRE:</td><td width="360">' + item.NOMBRE + '</td></tr>' + 
				'<tr><td width="174">CEDULA:</td><td width="360">' + item.CEDULA + '</td></tr>' + 
				'<tr><td width="174">ESPECIALIZACION:</td><td width="360">' + item.ESPECIALIZACION + '</td></tr>' + 
				'<tr><td width="174"><b>CIV:</b></td><td width="360"><b>' + item.CIV + '</b></td></tr></table>';
				$.unblockUI();
			}
			else
			{
				document.getElementById("cidez").innerHTML = 'Su numero de cedula es invalido o no esta registrado en el CIDEZ'
				$.unblockUI();
			}
		});
		$('<ul/>', 
		{
			'class': 'json_populated',
			html: items.join('')
		}).appendTo('body')
	 }
		
);}