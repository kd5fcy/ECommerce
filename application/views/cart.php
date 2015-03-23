<html>
<head>
	<title>Cart</title>
	<style type="text/css">
		body
		{
			padding: 20px;	
		}
		table
		{
			margin: 20px 10px 20px 40px;
			border-collapse: collapse;
			padding: 5px;
		}
		tfoot
		{
			border-top: 1px solid black;
		}
		td
		{
			padding: 5px;
		}
		button:not(.submit)
		{
			background-color: red;
			border-radius: 5px;
			padding: 5px;
			box-shadow: 2px 2px 3px grey;
			border: 0px;
		}
		.submit
		{
			background-color: blue;
			color: white;
			margin-left: 200px;
			box-shadow: 2px 2px 3px grey;
			border: 0px;
			border-radius: 5px;
			padding: 5px 15px;
		}
	</style>
</head>
<body>
	<h1>Checkout</h1>
	<table>
		<thead>
			<tr>
				<td>Qty</td>
				<td>Description</td>
				<td>Price</td>
				<td></td>
			</tr>
		</thead>
		<tbody>
		<?
			$cart = $this->session->userdata('cart');
			$total = 0;
			if($this->session->userdata('cart'))
			{
				foreach ($cart as $key) 
				{
					$query = 'SELECT id, description, price FROM products WHERE id = ' . $key['id'];
					$products = $this->db->query($query);
					foreach ($products->result() as $number => $product) 
					{
						$description = $product->description;
						$price = $product->price;
					}
					echo '<tr>';
					foreach ($key as $purchase => $value) 
					{
						if ($purchase == 'id')
						{
							$id = $value;
							echo '<td>' . $description . '</td>';
						}
						if ($purchase == 'qty')
						{
							$qty = $value;
							echo '<td>' . $value . '</td>';
						}
					}
					echo "<td>$" . ($price * $qty) . "</td><td><a href='/products/delete/" . $id . "'><button>Delete</button></a></td></tr>";
					$total = $total + ($price * $qty);
				}
			}
		?>
		</tbody>
		<tfoot>
			<tr>
				<td></td>
				<td>Total:</td>
				<td>$<?= $total ?></td>
				<td></td>
			</tr>
		</tfoot>
	</table>
	<a href='/products'><button class='submit'>Add More Items</button></a>
	<h2>Billing Info</h2>
	<form action='/products/order' method='post'>
		<table>
			<tr>
				<td>Name:</td>
				<td><input type='text' name='name'></td>
			</tr>
			<tr>
				<td>Address:</td>
				<td><input type='text' name='address'></td>
			</tr>
			<tr>
				<td>Card #:</td>
				<td><input type='text' name='card'></td>
			</tr>
		</table>
		<input type='submit' value='Order' class='submit'>
	</form>
</body>
</html>