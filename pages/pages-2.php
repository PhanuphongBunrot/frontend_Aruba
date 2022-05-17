



<div class="container">

<div class="   fs-2 shadow p-3 mb-5 bg-body rounded">
<?php 
require '../vendor/autoload.php';
$mon = new MongoDB\Client();
$conn = $mon->iparuba->ipmaster;
$data = $conn->find()->toArray();

for($i = 0 ; $i < count($data) ; $i ++){
    print_r ($data[$i]['ip']. "<br>");

}



?>

</div>
</div>