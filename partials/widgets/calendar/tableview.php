<?php



if (isset($_SESSION['username'])) {
	//header('location: authentication/flows/basic/sign-in.php');
    echo $_SESSION['username'];
}


error_reporting(E_ALL ^ E_NOTICE);
 include  '../vendor/autoload.php';
  $mon = new MongoDB\Client();
  $conn = $mon->iparuba->ipaps;
  $apn = $conn->find()->toArray();

  $mon = new MongoDB\Client();
  $conn = $mon->iparuba->offline;
  $datas = $conn->find()->toArray();

  $mon = new MongoDB\Client();
  $conn = $mon->iparuba->ipaps;
  $aps = $conn->find()->toArray();

 
// $conn = new MongoDB\Client();
// $companydb  = $conn->iparuba;
// $empcollection = $companydb->ipaps;

// $documentlist = $empcollection->find(
//    [],[
//       'limit' => 10,
//       'skip' => 10
//    ]

// );
// foreach($documentlist as $doc){
//    var_dump($doc);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
    <link href="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"/>
  
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<link href="popup/style.css"/>


<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

   <title>Document</title>
</head>
<body>
<?php


//$url = "http://192.168.207.239:81/api/view";
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

$data = array_chunk($ex, 5);

for ($i = 0; $i < count($datas); $i++) {
    $ap[] = $datas[$i]['Max'];
}

for ($u = 0; $u < count($aps); $u++) {
    $apss[] = $aps[$u]['Max'];
}
$same = array_intersect($apss, $ap);
$today = [];
$totime = [];
$p = 9;
for ($v = 0; $v < count($apss); $v++) {
   
  for ($o = 0; $o < count($datas); $o++) {

      if ($same[$v] === $datas[$o]['Max']) {
        $toip[] = $datas[$o]['Max'];
        $tostatus[]= $datas[$o]['Status'];
        $today[] = $datas[$o]['d/m/y'];
        $totime[] =  $datas[$o]['time'];
      }
  }
  if ($today != false && $totime != false) {
    $showday[]  = [$v => end($today)];
    $showtime [] = [$v => end($totime)];
    // $showip = ([
    //   'ip' => end($toip),
    //   'day' => end($today)
    // ]) ;
    $showip[] = end($toip);
    $showdayN[] = end($today);
    $showtimeN[] =end($totime);
    $showstatus [] =end($tostatus);
     
  }

}

$l = -1;

?>
<div class=" fs-2   shadow p-3 mb-5 bg-body rounded">
    
<div class="container">
<h1> Router Status </h1>
<!--begin::Svg Icon | path: assets/media/icons/duotone/Devices/Router2.svg-->
<?php  print_r($data[count($data)-1][0])?>
<span class=" svg-icon  svg-icon-2x svg-icon-success "><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <rect fill="#000000" x="3" y="13" width="18" height="7" rx="2"/>
        <path d="M17.4029496,9.54910207 L15.8599014,10.8215022 C14.9149052,9.67549895 13.5137472,9 12,9 C10.4912085,9 9.09418404,9.67104182 8.14910121,10.8106159 L6.60963188,9.53388797 C7.93073905,7.94090645 9.88958759,7 12,7 C14.1173586,7 16.0819686,7.94713944 17.4029496,9.54910207 Z M20.4681628,6.9788888 L18.929169,8.25618985 C17.2286725,6.20729644 14.7140097,5 12,5 C9.28974232,5 6.77820732,6.20393339 5.07766256,8.24796852 L3.54017812,6.96885102 C5.61676443,4.47281829 8.68922234,3 12,3 C15.3153667,3 18.3916375,4.47692603 20.4681628,6.9788888 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
</svg></span>
<!--end::Svg Icon-->
<?php print_r($data[count($data)-1][1])?>
<span class=" svg-icon  svg-icon-2x svg-icon-danger "><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <rect fill="#000000" x="3" y="13" width="18" height="7" rx="2"/>
        <path d="M17.4029496,9.54910207 L15.8599014,10.8215022 C14.9149052,9.67549895 13.5137472,9 12,9 C10.4912085,9 9.09418404,9.67104182 8.14910121,10.8106159 L6.60963188,9.53388797 C7.93073905,7.94090645 9.88958759,7 12,7 C14.1173586,7 16.0819686,7.94713944 17.4029496,9.54910207 Z M20.4681628,6.9788888 L18.929169,8.25618985 C17.2286725,6.20729644 14.7140097,5 12,5 C9.28974232,5 6.77820732,6.20393339 5.07766256,8.24796852 L3.54017812,6.96885102 C5.61676443,4.47281829 8.68922234,3 12,3 C15.3153667,3 18.3916375,4.47692603 20.4681628,6.9788888 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
</svg></span>
<!--end::Svg Icon-->
<?php  print_r($data[count($data)-1][0]+$data[count($data)-1][1])?>
<span class=" svg-icon  svg-icon-2x svg-icon-primary "><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <rect fill="#000000" x="3" y="13" width="18" height="7" rx="2"/>
        <path d="M17.4029496,9.54910207 L15.8599014,10.8215022 C14.9149052,9.67549895 13.5137472,9 12,9 C10.4912085,9 9.09418404,9.67104182 8.14910121,10.8106159 L6.60963188,9.53388797 C7.93073905,7.94090645 9.88958759,7 12,7 C14.1173586,7 16.0819686,7.94713944 17.4029496,9.54910207 Z M20.4681628,6.9788888 L18.929169,8.25618985 C17.2286725,6.20729644 14.7140097,5 12,5 C9.28974232,5 6.77820732,6.20393339 5.07766256,8.24796852 L3.54017812,6.96885102 C5.61676443,4.47281829 8.68922234,3 12,3 C15.3153667,3 18.3916375,4.47692603 20.4681628,6.9788888 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
</svg></span>
<!--end::Svg Icon-->
</div>
<div class="table-responsive fs-3">
        <table class="table table-striped gy-7 gs-7" id="test">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                <!-- <th class="min-w-200px fs-3">#</th> -->
                    
                    <th class="min-w-200px fs-3">Max IP</th>
                    <th class="min-w-200px fs-3">Ap name</th>
                    <th class="min-w-200px fs-3">Status</th>
                    <th class="min-w-200px fs-3">Day/Month/Year</th>
                    <th class="min-w-200px fs-3">Time</th>
                    

                </tr>
            </thead>
            <tbody>
                <?php
                 //print_r($data[0][1]);
                for ($i = 0; $i < count($data)-1 ; $i++) :
                //echo ($data[$i][2]);
                ?>
                    <tr class=" fs-5">
                    
                    <td> <a href="?max=<?php echo ($data[$i][0])?>#divOne" ><?php echo ($data[$i][0]) ?></a></td>
                        <td><?php echo ($apn[$i]['Apname']) ?></td>
                        <?php if($data[$i][2] ==='Online') {?>
                        <td style="color:#65CF01"><?php echo ($data[$i][2]) ?></td>
                        <td><?php echo ($data[$i][3]) ?></td>
                        <td><?php echo ($data[$i][4]) ?></td>  
                        <?php } else if ($data[$i][2] ==='Offline'){
                              ?>
                        <td style="color:#E10808"><?php echo ($data[$i][2]) ?></td>
                          
                        <td><?php echo ($showdayN[$i]); ?></td>

                        <td><?php echo($showtimeN[$i]) ;?></td>
                        
                       

                        <?php } ?>
                        
                        
                    </tr>
                <?php endfor ?>
            </tbody>
        </table>
       
</div>
</div>

<div class="overlay"id="divOne" >
        <div class="wrappers">
            <h2><?php 
if (isset($_GET['max'])) {

  $max = $_GET['max'];
 echo $max;
 
}?></h2>

            
        <div class="contents">
        <a href="#" class="closes">&times;</a>
            <div class="containers">
                <form action="adddb.php?max=<?php echo $max;?>" method="POST">
               
                    <h1 style="color:#F69A0D"><?php 
                    if (isset($_GET['max'])) {

                      $max = $_GET['max'];
                    echo " MAX ".$max;
                    
                    }?></h1>
                    <label > AP name</label>
                    <input type="text" name="Ap" placeholder="Ap name">
                    <label > Serial number</label>
                    <input type="text"  name="Sn"   placeholder="serial number">
                    <input type="submit" value="SAVE">
                   
                </form>
            </div>
        </div>
        </div >
        
    </div>
<style>
    a:link {
      color: #000000;
      background-color: transparent;
      text-decoration: none
    }

    a:visited {
      color: #000000;
      background-color: transparent;
      text-decoration: none
    }

    a:hover {
      color: #ff0000;
      background-color: transparent;
      text-decoration: none
    }


h3{
    text-align: center;
    color: #431b3b;
    font-weight: 900;
    text-transform: uppercase;
    font-size: 80px;
    font-family: Arial, Helvetica, sans-serif;
}
h5{

    text-align: center;
 
}
.box{
    text-align: center;

}
.button{
    font-size: 1em;
    padding: 15px 35px;
    color: #fff;
    text-decoration:none ;
    cursor: pointer;
    transition: all 0.3s ease-out;
    background:#403e3d ;
    border-radius: 50px;
}
.overlay{
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0, 0, 0.8);
    transition: opacity 500ms;
    visibility: hidden;
    opacity: 0;

}
.overlay:target{
    visibility: visible;
    opacity: 1;
}
.wrappers{
    margin:70px auto ;
    padding: 20px;
    background: #e7e7e7;
    border-radius: 5px;
    width: 30%;
    position: relative;
    transition: all 5s ease-in-out;
}
.wrappers h2{
    margin-top: 0;
    color: #333;

}
.wrappers .closes{
   
    position:absolute ;
    right: 30px;
    transition: all 200ms;
    font-size: 30px;
    font-weight: bold;
    text-decoration: none;
    color: #E72903;
   
}

.wrappers .contents{
    max-height: 30%;
    overflow: auto;
}

.containers{
    border-radius: 5px;
    background-color: #e7e7e7;
    padding: 20px 0;

}

form label{
    font-size: 20px;
    font-weight: 700px;
    letter-spacing: 0px;

}

input[type=text], textarea{
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;

}

input[type = "submit"]{
    background-color: #F69A0D;
    color: #fff;
    padding: 15px 50px;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    font-size: 15px;
    
    letter-spacing: 0px;
}

  </style>
<script>
   $(document).ready( function () {
    $('.table').DataTable();
} );
</script>

</body>
</html>