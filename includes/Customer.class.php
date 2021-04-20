<?php 

/******************************************
PRAKTIKUM RPL
******************************************/

class Customer extends Database{
	
	// Mengambil data
	function getCustomers(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM customer";

		// Mengeksekusi query
		return $this->execute($query);
	}
	
	function addCustomer($data){
		$name = $data["nama"];
		$age = $data["umur"];
		$gender = $data["jenis_kelamin"];
		$address = $data["alamat"];
		$order = $data["pesanan"];
		$detail = $data["keterangan"];
	
		$query = "INSERT INTO customer VALUES('', '$name', '$age', '$gender', '$address', '$order', '$detail');";
		
		
		$this->execute($query);
		$this->reload();
	}

	function deleteCustomer($id){
		$query = "DELETE FROM customer WHERE id = $id";
		
		$this->execute($query);
		$this->reload();
	}
	
	function updateOrder($id, $order){
		$query = "UPDATE customer SET pesanan = '$order' WHERE id = $id";
		
		$this->execute($query);
		// $this->reload();
	}


	function reload(){
		?>
		<script>
			// Hilangkan parameter get pada link
			var link = window.location.href;
			link = link.split('?');
			
			// link tanpa parameter get
			window.location = link[0];
		</script>
		<?php
	}
}



?>
