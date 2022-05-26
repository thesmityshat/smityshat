<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta content="text/html; charset=utf-8">
		<title>3adanie</title>
	</head>

	<body>
		<form action="main.php" method="post">
			<?php
				$Menu = new Product();
				$Ordering = new Order();

				$Ordering->OrderArr = array();
				$Ordering->OrderKol = array();
				$Menu->Products = array('Огурцы', 'Помидоры', 'Перцы');
				for ($i = 0; $i < count($Menu->GetProducts()); $i++) {
					echo "<input type='checkbox' name='OrderArr[]' value='$i' style='margin-left: 20px;'>", $Menu->GetProducts()[$i], "<input type='text' name='OrderKol[]' style='margin-left: 20px;'>";
				}
			?>
			<p><input type="submit" name = "submit" value="Заказать"></p>
			<?php
				$i=0;
				if(isset($_POST['submit'])){
					if(!empty($_POST['OrderArr'])){
						$Ordering->AddOrder($_POST['OrderArr'], $Ordering->OrderArr);
						$Ordering->AddOrder($_POST['OrderKol'], $Ordering->OrderKol);
						$Ordering->GetOrder($Menu->GetProducts(), $Ordering->OrderKol);
						}
					else{
						echo "<b>Please Select Atleast One Option and enter number.</b>";
					}
				}
			?>
		</form>
	</body>
</html>
<?php	
	class Product {
		public $Products;
		public function GetProducts() {
			return $this->Products;
		}
	}
	class Order {
		public $OrderArr;
		public $OrderKol;
		public function AddOrder($arg, &$arg2) {
			foreach($arg as $selected) {
				array_push($arg2, $selected);
			}
		}
		public function GetOrder($arg, $arg2) {
			echo "Ваш заказ: <br>";
			foreach ($this->OrderArr as $i) {
				if ($arg2[$i]!="") {
					echo $arg[$i], " в количестве: ", $arg2[$i] ,"<br>";
				}else {
					echo $arg[$i], " в количестве: 1 <br>";
				}
			}
		}
	}
?>
