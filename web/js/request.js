$(document).ready(function(){
	$("#user-btn").click(
		function(){
			sendUser();
			$("#content").append('<img id="waiting" src="web/img/loading.gif" />');
			return false;
		}
	);
	$("#order-btn").click(
		function(){
			sendOrder();
			$("#content").append('<img id="waiting" src="web/img/loading.gif" />');
			return false;
		}
	);

	$("#update-order-btn").click(
		function(){
			//
			updateOrder();
			return false;
		}
	);
	$("#update-user-btn").click(
		function(){
			updateUser();
			return false;
		}
	);
	$("#delete-order-btn").click(
		function(){
			deleteOrder();
			return false;
		}
	);
	$("#delete-user-btn").click(
		function(){
			deleteUser();
			return false;
		}
	);
});

function sendUser(){
	$.ajax({
		type: "POST",
		url: "/user",
		ContentType: "application/x-www-form-urlencoded",
		data: {
			fio:$("#fio").val()
		},
		success: function(response) {
			id = response;
			getUserInfo(id);
			getOrders(id);
			$("#create-order").attr("hidden",false);
			$("#create-user").attr("hidden",true);
			$("#waiting").remove();
			$("#error").remove();
			$("#p-id").val(id);
			//$("#user-info").append();
		},
		error: function(error){
			$("#waiting").remove();
			$("#content").html("<p id ='error'>Ошибка</p>");
		}
	});
}

function getOrders(id){
	//id = $("#p-id").val();
	$.ajax({
		type: "GET",
		url: "/user/" + id + "/order",
		data: {
		},
		success: function(response) {
			$(".table-body").html("");
			jsonObj = JSON.parse(response);
			for (var i = 0; i < jsonObj.length; i++) {
				$(".table").append('<tr><td>' + jsonObj[i]['id'] + '</td><td>' + jsonObj[i]['summ'] + '</td></tr>');
			  }
			$("#waiting").remove();
			$("#error").remove();
		},
		error: function(error){
			$("#waiting").remove();
			$("#content").html("<p id ='error'>Ошибка</p>");
		}
	});
}

function sendOrder(){
	id = $("#p-id").val();
	summ = $("#summ").val();
	$.ajax({
		type: "POST",
		url: "/order",
		data: {
			summ:summ,
			userId:id
		},
		success: function(response) {
			$("#waiting").remove();
			$("#error").remove();
			getOrders(id);
		},
		error: function(error){
			$("#waiting").remove();
			$("#content").html("<p id ='error'>Ошибка</p>");
		}
	});
}

function getUserInfo(id){
	//id = $("#p-id").val();
	$.ajax({
		type: "GET",
		url: "/user/" + id,
		data: {
		},
		success: function(response) {
			jsonObj = JSON.parse(response);
			$("#waiting").remove();
			$("#error").remove();
			fio = jsonObj['fio'];
			$("#p-fio").html(fio);
		},
		error: function(error){
			$("#waiting").remove();
			$("#content").html("<p id ='error'>Ошибка</p>");
		}
	});
}

function updateOrder()
{
	id = prompt('Код заказа:');
	summ = prompt('Новая сумма заказа:');
	userId = $("#p-id").val();

	$.ajax({
		type: "PUT",
		url: "/order/" + id,
		data: {
			id:id,
			summ:summ,
			userId:userId
		},
		success: function(response) {
			$("#waiting").remove();
			$("#error").remove();
			getOrders(userId);
		},
		error: function(error){
			$("#waiting").remove();
			$("#content").html("<p id ='error'>Ошибка</p>");
		}
	});
}
function updateUser()
{
	id = $("#p-id").val();
	fio = prompt('Новый ФИО:');

	$.ajax({
		type: "PUT",
		url: "/user/" + id,
		data: {
			id:id,
			fio:fio
		},
		success: function(response) {
			$("#waiting").remove();
			$("#error").remove();
			getUserInfo(id);
		},
		error: function(error){
			$("#waiting").remove();
			$("#content").html("<p id ='error'>Ошибка</p>");
		}
	});
}

function deleteOrder()
{
	id = prompt('Код заказа:');

	$.ajax({
		type: "DELETE",
		url: "/order/" + id,
		data: {
			id:id
		},
		success: function(response) {
			$("#waiting").remove();
			$("#error").remove();
			userId = $("#p-id").val();
			getOrders(userId);
		},
		error: function(error){
			$("#waiting").remove();
			$("#content").html("<p id ='error'>Ошибка</p>");
		}
	});
}

function deleteUser()
{
	id = $("#p-id").val();

	$.ajax({
		type: "DELETE",
		url: "/user/" + id,
		data: {
			id:id
		},
		success: function(response) {
			location.reload();
		},
		error: function(error){
			$("#waiting").remove();
			$("#content").html("<p id ='error'>Ошибка</p>");
		}
	});
}