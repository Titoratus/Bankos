//////////////Timer///////////
function initializeTimer(sss1) {
	var endDate = sss1; // получаем дату истечения таймера
	var currentDate = new Date(1970,1,1,0,00); // получаем текущую дату
	var seconds = (endDate-currentDate) / 1000; // определяем количество секунд до истечения таймера
	if (seconds > 0) { // проверка - истекла ли дата обратного отсчета
		var minutes = seconds/60; // определяем количество минут до истечения таймера
		var hours = minutes/60; // определяем количество часов до истечения таймера
		minutes = (hours - Math.floor(hours)) * 60; // подсчитываем кол-во оставшихся минут в текущем часе
		hours = Math.floor(hours); // целое количество часов до истечения таймера
		seconds = Math.floor((minutes - Math.floor(minutes)) * 60); // подсчитываем кол-во оставшихся секунд в текущей минуте
		minutes = Math.floor(minutes); // округляем до целого кол-во оставшихся минут в текущем часе
		
		setTimePage(hours,minutes,seconds); // выставляем начальные значения таймера
		
		function secOut() {
		  if (seconds == 0) { // если секунду закончились то
			  if (minutes == 0) { // если минуты закончились то
				  if (hours == 0) { // если часы закончились то
					  showMessage(timerId); // выводим сообщение об окончании отсчета
				  }
				  else {
					  hours--; // уменьшаем кол-во часов
					  minutes = 59; // обновляем минуты 
					  seconds = 59; // обновляем секунды
				  }
			  }
			  else {
				  minutes--; // уменьшаем кол-во минут
				  seconds = 59; // обновляем секунды
			  }
		  }
		  else {
			  seconds--; // уменьшаем кол-во секунд
		  }
		  setTimePage(hours,minutes,seconds); // обновляем значения таймера на странице
		}
		timerId = setInterval(secOut, 1000) // устанавливаем вызов функции через каждую секунду
	}
	else {
		alert("Установленная дата уже прошла");
	}
}

function setTimePage(h,m,s) { // функция выставления таймера на странице
	var element = document.getElementById("timer"); // находим элемент с id = timer
	element.innerHTML = "<center>"+h+":"+m+":"+s+"</center>"; // выставляем новые значения таймеру на странице
}

function showMessage(timerId) { // функция, вызываемая по истечению времени
	window.location.href = "boss.php";
	clearInterval(timerId); // останавливаем вызов функции через каждую секунду
}
//////////////Timer///////////

function del(){
 $("div.error").remove();
}
var a = $("#tex").length;
var b = $("#tex").text();

setTimeout(function(){
	if(a > 0){
		if(b == 'Успешно напали'){
			window.location.href = "boss.php";
		}
	}
}, 2000);

setTimeout(del, 3000);
///////////////////////////////////////////////// 
$("#reshit").hide();
var id = $("#bossID").text();
function ydar(a,b){
$.ajax({
	url: 'ajax.php',
	type: 'POST',
	data: 'hitBoss=1&idhit='+a+'&amout='+b+'&boss_id='+id,
	success: function(u){
		$("#reshit").show();
		var code = $.parseJSON(u);
		var res = code.code;
		var perez = code.perez;
		var damage = code.damage;
		var curdamage = code.curdamage;
		
		if(res == 0){
			$("#reshit").html("Нанесли <a style='color:red;'>"+damage+"</a> урона");
			$("#curdamag").html(curdamage);
		}else if(res == 111){
			if(perez == 777){
				$("#reshit").html("Нехватает оружия");
			}else if(perez == 333){
				$("#reshit").html("Перезарядка оружия ¯\\_(ツ)_/¯");
			}
		}else if(res == 3){
			$("#reshit").html("Нехватает оружия");
		}else $("#reshit").html("Код ошибки #"+code);
	}
});
}
$("#glas").click(function(){
	var v = confirm("Ударить в глаз ?");
	if(v){
		ydar(1,1);
	}
});
$("#vux").click(function(){
	var v = confirm("Ударить в ухо ?");
	if(v){
		ydar(2,1);
	}
});
$("#soln").click(function(){
	var v = confirm("Ударить в солнышко ?");
	if(v){
		ydar(3,1);
	}
});////////////
$("#f1").click(function(){
	var count = $("#counthit").val();
	var v = confirm("Ударить финкой ?\nПотратиться "+count+" штук");
	if(v){
		ydar(4,count);
	}
});
$("#s1").click(function(){
	var count = $("#counthit").val();
	var v = confirm("Ударить самопалом ?\nПотратиться "+count+" штук");
	if(v){
		ydar(5,count);
	}
});
$("#y1").click(function(){
	var count = $("#counthit").val();
	var v = confirm("Ударить ядом ?\nПотратиться "+count+" штук");
	if(v){
		ydar(6,count);
	}
});
$("#pax").click(function(){
	var v = confirm("Ударить в пах? ?");
	if(v){
		ydar(7,1);
	}
});
$(".refresh1").click(function(){
	$("#refresher").html("<center><img src='img/hourglass.svg' /></center>");
	$.ajax({
	url: 'ajax.php',
	type: 'POST',
	data: 'refresh1=1',
	success: function(u){
		$("#refresher").html(u);
		}
	});
});
$(".refresh2").click(function(){
	$("#frends").html("<center><img src='img/hourglass.svg' /></center>");
	$.ajax({
	url: 'ajax.php',
	type: 'POST',
	data: 'refresh2=1',
	success: function(u){
		$("#frends").html(u);
		}
	});
});
$(".refresh").click(function(){
	$("#ydari").html("<img src='img/hourglass.svg' />");
	$.ajax({
	url: 'ajax.php',
	type: 'POST',
	data: 'refresh=1',
	success: function(u){
		$("#ydari").html(u);
		}
	});
});