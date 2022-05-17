<link href="cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" rel="stylesheet" type="text/css" />

<div class="   shadow p-3 mb-5 bg-body rounded">
    <?php

    require '../vendor/autoload.php';
    $url = "http://127.0.0.2:8000/api/view";
    //$ip = '172.16.0.50';$sid = 'tL7NZFoTY5HX4a4phhMw';
    // $url = "https://".$ip.":4343/rest/show-cmd?iap_ip_addr=".$ip."&cmd=show%20clients&sid=".$sid;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = array(
        "Content-Type: application/json",
    );
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    //echo $resp;
    $ex = explode(" ", $resp);

    $data = array_chunk($ex, 4);
    
    if(isset($_GET['page1']) && isset($_GET['s']) && isset($_GET['e'])){
     $page = $_GET['page1'];
     $s = $_GET['s'];
     $e = $_GET['e'];
    }else{
        $page = 1;
        $s = 0;
        $e = 9;
    }
    
   
    $page1 = 0;
    $rows = 10;
    if ($page1 == 1) {
        $page1 = 1;
    }
    $total = count($data) - 1;
    $total_page = ceil($total / $rows);

    ?>
    <div class="table-responsive fs-3">
        <table class="table table-striped gy-7 gs-7" id="test">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                <!-- <th class="min-w-200px fs-3">#</th> -->
                    <th class="min-w-200px fs-3">Max IP</th>
                    <th class="min-w-200px fs-3">Status</th>
                    <th class="min-w-200px fs-3">Day/Month/Year</th>
                    <th class="min-w-200px fs-3">Time</th>


                </tr>
            </thead>
            <tbody>
                <?php
              
                for ($i = 0; $i < count($data)-1 ; $i++) {
                ?>
                    <tr class=" fs-5">
                        
                        <?php for ($y = 0; $y < 4; $y++) {
                            $arr = $data[$i][$y];
                        ?> <td><?php print_r($arr) ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<ul class="pagination">

    <li class="page-item previous disabled"><a href="#" class="page-link"><i class="previous"></i></a></li>
    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
        <li class="page-item "><a href=" #" class="page-link"><?php echo $i; ?></a></li>
    <?php } ?>
    <li class="page-item next"><a href="#" class="page-link"><i class="next"></i></a></li>

</ul>