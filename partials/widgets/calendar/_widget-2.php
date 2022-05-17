<?php 
require '../vendor/autoload.php';
$conn = new MongoDB\Client();
$companydb  = $conn->iparuba;
$empcollection = $companydb->ipaps;

$page1 = 0;

$rows = 11;
$total = count($data)-1;
$total_page = ceil($total/$rows);

$documentlist = $empcollection->find(
   [],[
      'limit' => $rows,
      'skip' => 22
   ]

);
foreach($documentlist as $doc){
   print_r($doc['Max'] . "<br>");
}
?>
<ul class="pagination">

<li class="page-item previous disabled"><a href="#" class="page-link"><i class="previous"></i></a></li>
<?php for($i = 1 ; $i <= $total_page ;$i ++){ ?>
<li class="page-item "><a href=" ?page1=<?php echo $i ?>" class="page-link"><?php echo $i ; ?></a></li>
<?php } ?>
<li class="page-item next"><a href="#"  class="page-link"><i class="next"></i></a></li>

</ul>
