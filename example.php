<?php
include 'crud.php';
// Adım 1: Veritabanı bağlantısı oluşturun
$host = 'localhost'; // Veritabanı sunucusunun adresi
$dbname = 'your_database'; // Kullanılacak veritabanının adı
$username = 'your_username'; // Veritabanı kullanıcı adı
$password = 'your_password'; // Veritabanı şifresi

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Veritabanı bağlantısı başarıyla kuruldu.";
} catch (PDOException $e) {
    die("Veritabanı bağlantısı başarısız: " . $e->getMessage());
}

// Adım 2: CRUD sınıfını kullanarak işlemleri gerçekleştirin
include('CRUD.php'); // CRUD sınıfının bulunduğu dosyanın adını ve yolunu güncelleyin.

$crud = new CRUD();
$crud->db = $db; // Veritabanı bağlantısını CRUD sınıfına atayın

// Örnek 1: Veri okuma (Read)
$table = 'your_table_name'; // Veri okunacak tablo adı
$where = 'id = ?'; // Filtreleme koşulu
$input = [1]; // Filtreleme için kullanılacak değerler
$data = $crud->get_data($table, $where, $input, false); // false kullanarak tüm verileri alın
print_r($data);

// Örnek 2: Veri ekleme (Create)
$table = 'your_table_name'; // Veri eklenecek tablo adı
$query = ['column1', 'column2', 'column3']; // Eklenecek sütun adları
$input = ['value1', 'value2', 'value3']; // Eklenecek değerler
$result = $crud->add_data($table, $query, $input);
if ($result) {
    echo "Veri başarıyla eklendi.";
}

// Örnek 3: Veri güncelleme (Update)
$table = 'your_table_name'; // Veri güncellenecek tablo adı
$query = ['column1', 'column2', 'column3']; // Güncellenecek sütun adları
$where = 'id = ?'; // Hangi veriyi güncelleyeceğinizi belirleyen koşul
$input = ['new_value1', 'new_value2', 'new_value3', 1]; // Yeni değerler ve koşul değeri
$result = $crud->set_data($table, $query, $where, $input);
if ($result) {
    echo "Veri başarıyla güncellendi.";
}

// Örnek 4: Veri silme (Delete)
$table = 'your_table_name'; // Veri silinecek tablo adı
$where = 'id = ?'; // Hangi veriyi sileceğinizi belirleyen koşul
$input = [1]; // Silinecek verinin koşula karşılık gelen değeri
$result = $crud->delete_data($table, $where, $input);
if ($result) {
    echo "Veri başarıyla silindi.";
}

// Adım 3: Veritabanı bağlantısını kapatın
$db = null;

?>
