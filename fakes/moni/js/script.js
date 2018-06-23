$(document).ready(function() {
	$(".like").bind("click", function() {
		var link = $(this);
		var ids = link.data('id');
	    var userid = userida;
		$.ajax({
			url: "/moni/like.php", 
			type: "POST",
			data: {id:ids, uid:userida, auth_key:auth_key}, // Передаем ID нашей статьи
			dataType: "json", 
			success: function(result) {
				if (!result.error){ //если на сервере не произойло ошибки то обновляем количество лайков на странице
					link.addClass('active'); // помечаем лайк как "понравившийся"
					$('.counter',link).html(result.count);
				}else{
					alert(result.message);
				}
			}
		});
	});
});