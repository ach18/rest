<!DOCTYPE HTML>
<html>
	<head>
		<script src= "web/assets/jquery/jquery.js" ></script>
		<script src = "web/js/request.js" ></script>
		<meta charset = "utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="web/assets/bootstrap/css/bootstrap.min.css">
		<title> Заказ пиццы </title>
	</head>
	<body>
		<div id = 'user-info'>
			<p id="p-id" hidden> </p>
			<p id="p-fio"> </p>
		</div>
		<form id = 'create-user'>
			<input type="text" id ="id" hidden>
			<input type="text" id ="fio" required minlength="5">
			<input type="submit" id = "user-btn" value="Создать пользователя">
		</form>

		<div id = 'content'> </div>
		<p>Список заказов</p>
		<form id = 'create-order' hidden>
			<input type="text" id ="id" hidden>
			<input type="text" id ="summ" required min="100">
			<input type="submit" id = "order-btn" value="Создать новый заказ">
			<input type="submit" id = "update-order-btn" value="Изменить заказ">
			<input type="submit" id = "delete-order-btn" value="Удалить заказ">
			<input type="submit" id = "update-user-btn" value="Изменить профиль">
			<input type="submit" id = "delete-user-btn" value="Удалить аккаунт">
		</form>
		<table class="table">
		<thead>
			<tr>
			<th scope="col" hidden>id</th>
			<th scope="col">Код</th>
			<th scope="col">Сумма</th>
			</tr>
		</thead>
		<tbody class = "table-body">
		</tbody>
		</table>
	</body>
</html>