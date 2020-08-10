$('.tlClogo').bind('contextmenu', function (e) {
	return false;
});


$(document).ready(function () {


	$('#fileDrag input').change(function () {
		$('#fileDrag p').text(this.files.length + " arquivo(s) selecionado(s)");
	});

	$('.anexo').blur(function () {
		$atual = $(this);
		$proximo = $(this).closest('tr').next().find('.anexo');
		

		//alert("Prox: "+$proximo.val()+". Prev: "+$atual.val());


		$hasProximo = true;

		while ($hasProximo) {
			
			if (parseInt($proximo.val()) == parseInt($atual.val())) {
				$proximo.val(parseInt($atual.val()) + 1);
				$atual = $proximo;
				$proximo = $proximo.closest('tr').next().find('.anexo');
			} else {
				$hasProximo = false;
			}
		}

	}

	)


	$('.botoes').click(function () {



		var card = $(this).closest("div .pasta");
		var cardSetor = $(this).closest("div .titleSect");


		var nome = card.find(".pasta").text();
		var setor = cardSetor.find(".setorTitle").text();
		var nomeBreak = nome.split(" - ");
		var dateBreak = nomeBreak[1].split("/");
		var caminho = setor + "\\" + dateBreak[2] + "\\" + dateBreak[1] + "\\" + dateBreak[0] + "\\" + nomeBreak[0];
		//alert(caminho);
		//alert(nome);



		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: 'POST',
			url: 'cadDoc',
			dataType: 'JSON',
			data: { caminho: caminho },
			success: function () { window.location.href = "createDocument" },

		});



	});

	$('.butReuniao').click(function () {
		var cardSetor = $(this).closest("div .titleSect");
		var setor = cardSetor.find(".setorTitle").text();
		//alert(setor);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});



		$.ajax({
			type: 'POST',
			url: 'cadMeeting',

			data: { setor: setor },
			success: function () { window.location.href = "cadMeetings"; }
		});


	});

	$('.butArq').click(function () {
		var card = $(this).closest("div .pasta");
		var cardSetor = $(this).closest("div .titleSect");


		var nome = card.find(".pasta").text();
		var setor = cardSetor.find(".setorTitle").text();
		var nomeBreak = nome.split(" - ");
		var dateBreak = nomeBreak[1].split("/");
		var caminho = setor + "/" + dateBreak[2] + "/" + dateBreak[1] + "/" + dateBreak[0] + "/" + nomeBreak[0];

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: 'POST',
			url: 'editDoc',
			dataType: 'JSON',
			data: { caminho: caminho },
			success: function () { window.location.href = "editDocuments" },

		});
	});

	$('.editFolder').click(function () {


		$fileName = "Anexo " + $(this).closest('tr').find('.anexo').val();
		$fileName = $fileName + " - Item " + $(this).closest('tr').find('.item').val();
		$fileName = $fileName + " - " + $(this).closest('tr').find('.arquivo').text();

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: 'POST',
			url: 'openFolder',
			dataType: 'JSON',
			data: { folder: $fileName },
			success: function () { window.location.href = "editDocuments" },

		});
	});

	$('.deleteFolder').click(function () {


		$fileName = "Anexo " + $(this).closest('tr').find('.anexo').val();

		$option = confirm("Deseja deletar o arquivo " + $(this).closest('tr').find('.arquivo').text() + "?");

		if ($option = "yes") {
			$fileName = $fileName + " - Item " + $(this).closest('tr').find('.item').val();
			$fileName = $fileName + " - " + $(this).closest('tr').find('.arquivo').text();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				type: 'POST',
				url: 'deleteFile',
				dataType: 'JSON',
				data: { folder: $fileName },
				success: function () { window.location.href = "index" },

			});
		}



	});

});





function saveDoc() {
	var myTable = new Array();
	$('tr').each(function (index) {

		if (index != 0) {
			var indice = index - 1;
			var row = new Object();
			row.item = $('#item' + indice).val();
			row.anexo = $('#anexo' + indice).val();
			row.arquivo = $('#arquivo' + indice).html();
			
			if(row.item.length===1){
				row.item="0"+row.item;
			}
			if(row.anexo.length===1){
				row.anexo="0"+row.anexo;
			}
			
			myTable.push(row);
		}
	});
	var jstable = JSON.stringify(myTable);
	//console.log(jstable);


	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$.ajax({
		type: 'POST',
		url: 'procDoc',
		dataType: 'JSON',
		data: { dados: jstable },
		complete: function () {
			alert("Documentos Processados com Sucesso!");
			window.location.href = "index";
		},


	});

};

function editDoc() {

	var myTable = new Array();
	$('tr').each(function (index) {

		if (index != 0) {
			var indice = index - 1;
			var row = new Object();
			row.anexo = $('#anexo' + indice).val();
			row.item = $('#item' + indice).val();
			row.arquivo = $('#arquivo' + indice).html();
			if(row.item.length===1){
				row.item="0"+row.item;
			}
			if(row.anexo.length===1){
				row.anexo="0"+row.anexo;
			}
			myTable.push(row);
		}
	});
	var jstable = JSON.stringify(myTable);
	//console.log(jstable);


	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$.ajax({
		type: 'POST',
		url: 'procEditedDocs',
		dataType: 'JSON',
		data: { dados: jstable },
		complete: function () {
			alert("Documentos Processados com Sucesso!");
			window.location.href = "index";
		},


	});

};

