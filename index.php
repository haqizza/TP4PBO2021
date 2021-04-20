<?php
    include('./conf.php');
    include('./includes/Database.class.php');
    include('./includes/Customer.class.php');
    include('./includes/Template.class.php');
    
    
    $customer = new Customer($db_host, $db_user, $db_password, $db_name);
    
    if($_SERVER["REQUEST_METHOD"] == "POST" & $_POST != null){
        // Buka koneksi
        $customer->open();
        
        // Add Task
        $customer->addCustomer($_POST);
        
        // Tutup koneksi
        $customer->close();
        
        // Mengosongkan POST agar tidak terbaca lagi
        unset($_POST);
    }
    else if($_SERVER["REQUEST_METHOD"] == "GET" & $_GET != null){
        // Buka koneksi
        $customer->open();
        
        // Update Pesanan / Delete Customer
        if(isset($_GET['id_update'])){
            $customer->updateOrder($_GET['id_update'], $_GET['order']);
        }
        else{
            $customer->deleteCustomer($_GET['id_delete']);
        }
        
        // Tutup koneksi
        $customer->close();

        // Mengosongkan get
        unset($_GET);
    }
    
    $customer->open();
    
    // Fetch data customer dari database
    $customers_data = $customer->getCustomers();
    
    $data = null;
    $no = 1;
    
    while (list($id, $name, $age, $gender, $address, $order, $detail) = $customer->getResult()) {
        // Tampilan Data Customer
        $data .= "<tr>
        <td>" . $no . "</td>
        <td>" . $name . "</td>
        <td>" . $age . "</td>
        <td>" . $gender . "</td>
        <td>" . $address . "</td>
        <td id='order-" . $id . "'>" . $order . "</td>
        <td>" . $detail . "</td>
        <td id='aksi-" . $id . "'>
        <button class='btn btn-primary' onclick='editOrder(" . $id . ")' >Ubah Pesanan</button>
        <a href='index.php?id_delete=" . $id . "'>
            <button class='btn btn-danger'>Hapus</button>
        </a>
        </td>
        </tr>";
        $no++;
    }

    // Tutup koneksi
    $customer->close();
    
    // Membaca template view
    $view = new Template('./templates/customer_form.html');
    
    // Mengganti posisi [DATA] dengan data yang sudah diproses
    $view->replace("DATA", $data);
    
    // Print view
    $view->write();
?>