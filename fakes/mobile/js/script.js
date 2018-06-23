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
		var damage = code.damage;
		var curdamage = code.curdamage;
		
		if(res == 0){
			$("#reshit").html("Нанесли <a style='color:red;'>"+damage+"</a> урона");
			$("#curdamag").html(curdamage);
		}else if(res == 111){
			$("#reshit").html("Перезарядка оружия ¯\\_(ツ)_/¯");
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