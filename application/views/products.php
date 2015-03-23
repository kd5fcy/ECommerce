<html>
<head>
	<title>Products Listing</title>
	<style type="text/css">
		table
		{
			margin: 20px 10px 20px 40px;
			border-collapse: collapse;
			padding: 5px;
		}
		td
		{
			padding: 5px;
		}
		body
		{
			padding: 20px;
		}
		.submit
		{
			width: 50px;
			background-color: green;
			color: white;
			box-shadow: 2px 2px 3px grey;
			border: 0px;
			border-radius: 5px;
			padding: 5px 15px;
		}
		input
		{
			width: 40px;
		}
		h1
		{
			display: inline-block;
		}	
		h2
		{
			display: inline-block;
			width: 70%;
			text-align: right;
		}
	</style>
</head>
<body>
	<h1>Products</h1>
	<?php
		
	?>
	<h2><a href='/products/cart'>Your Cart <?php if($this->session->userdata('cart')){echo '(' . COUNT($this->session->userdata('cart')) . ')';}else{echo '(Empty)';} ?></a></h2>
<?php
	$query = 'SELECT id, description, price FROM products';
	$products =	$this->db->query($query);	
?>
		<table>
			<thead>
				<td>Description</td>
				<td>Price</td>
				<td>Qty</td>
				<td></td>
			</thead>
			<tbody>
			<?php
				foreach ($products->result() as $key) 
				{
					echo '<tr>';
					foreach ($key as $name => $product) 
						if($name == 'id')
						{
							$id = $product;
							echo "<form action='/buy/" . $id . "' method='post'>";
						}
						elseif($name == 'price')
						{
							echo '<td>&#36;' . $product . '</td>';					
						}
						else
						{
							echo '<td>' . $product . '</td>';	
						}
					echo "<td><input type='number' value='1' name='qty'></td>";
					echo "<td><input type='submit' value='Buy' class='submit'></td>";
					echo '</tr></form>';
				}
			?>
			</tbody>
		</table>
</body>
</html>