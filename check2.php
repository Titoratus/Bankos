<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Чекер</title>
	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<?include ("head_menu.php");?>
	<style>
	[name=fakes]{
	resize: none;
	}
	input[type=submit]{
		width: 375px;
	}
	</style>
</head>
<body>
	<center>
		<textarea name="fakes" id="fakes" cols="50" rows="20"></textarea><br>
		<input id="start" type="button" value="Чекнуть" />
		<input id="stop" type="button" value="Отмена" />
	
		<div class="form">
			<center>
				<div class="ok sma">
				<div id="load"></div>
					<table id="result" border="0" cellpadding="0" cellspacing="0">
						<tbody>
						</tbody>
					</table>
				</div>
			</center>
		<br>
		</div>
	</center>
<script>
$(document).ready(function() {
	function delimg(){
	$("#load").html("");
	}
	
	function send(a,b,i){
	$.ajax({
		url: 'ajax.php',
		type: 'POST',
		data: 'id='+a+'&key='+b,
		beforeSend: function(u){
			$("#load").html("<img src='mobile/img/hourglass.svg' />");
			//console.log(u);
		},
		success: function(u){
			//$("#result").html($("#result").html()+"<br><tr>"+u+"</tr>");
		},
		complete: function(u){
			$("#result").html($("#result").html()+"<br><tr>"+u.responseText+"</tr>");
			console.log(u);
			$("#load").html("");
		}
	});
	}
	function perebor(i){
	$("#result").html("");
	var text = $("#fakes").val();   //помещаем в var text содержимое текстареи 
	var lines = text.split(/\r|\r\n|\n/);  //разбиваем это содержимое на фрагменты по переносам строк 
	var count = lines.length; // var count - количество полученных фрагментов

		var values = lines[i].split(":");
		var keys = ["id", "key"];
		var final = {};
		
		final[keys[0]] = values[0];  //final.id
		final[keys[1]] = values[1];  //final.key
		i++;
		send(final.id,final.key,i);
		perebor(i);
	}
	$("#stop").hide();
	$("#start").click(function(){
		$("#start").hide();
		$("#stop").show();
		$(".sma").show();
		perebor(0);
	});
	$("#stop").click(function(){
		$("#start").show();
		$("#stop").hide();
		$("#result").html("");
	});
});
</script>
</body>
</html>