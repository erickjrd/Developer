function Informacion(ced) 
{
	//var _this = $(this);
	
	$.getJSON('http://cidez.no-ip.org:6969/cidez/conex_i.php?q='+ ced +'&jsoncallback=?',
	function(data) 
	{
		var items = [];

		$.each(data, function(i, item) 
		{			
			if (item.BANDERA == 1)
			{			
				document.getElementById("cidez").innerHTML = '<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px">' +
				'<tr><td width="174">Cedula:</td><td width="360">' + item.CEDULA + '</td></tr>' + 
				'<tr><td width="174">Nombre:</td><td width="360">' + item.NOMBRE + '</td></tr>' + 
				'<tr><td width="174">Fecha Graduacion:</td><td width="360">' + item.FECGRADUACION + '</td></tr>' + 
				'<tr><td width="174">Fecha Inscripcion:</td><td width="360">' + item.FECINCRIPCION + '</td></tr></table>' +
				'<br>El trámite de su numero CIV ya fue procesado, si aún no ha retirado su título puede dirigirse al CIDEZ o llamarnos, para realizar la entrega del mismo.'; 
				$.unblockUI();
			}
			else
			{
				if (item.BANDERA == 2)
				{			
					document.getElementById("cidez").innerHTML = '<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px">' +
					'<tr><td width="174">Cedula:</td><td width="360">' + item.CEDULA + '</td></tr>' + 
					'<tr><td width="174">Nombre:</td><td width="360">' + item.NOMBRE + '</td></tr>' + 
					'<tr><td width="174">Fecha Graduacion:</td><td width="360">' + item.FECGRADUACION + '</td></tr>' + 
					'<tr><td width="174">Fecha Inscripcion:</td><td width="360">' + item.FECINCRIPCION + '</td></tr></table>' +
					'<br>El trámite de su CIV está en proceso actualmente. Recuerde que el proceso tiene un tiempo de tramitación de 60 días hábiles (3 Meses).'; 
					$.unblockUI();
				}
				else
				{
					document.getElementById("cidez").innerHTML = 'El numero de identificacion no esta registrado en nuestro Sistema.'
					$.unblockUI();
				}
			}							
		});
		$('<ul/>', 
		{
		    'class': 'json_populated',
			html: items.join('')
		}).appendTo('body')
	 }		
);}