<?php    
$url = "http://127.0.0.2:8000/api/view";
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
//echo ($resp);
curl_close($curl);
$ex = explode(" ",$resp);

$data = array_chunk($ex, 4);
// echo("<pre>");
// print_r($data);
// echo("</pre>");

?>

											<div class="card-body p-0">
												<!--begin::Chart-->
												
												<!--end::Chart-->
												<!--begin::Stats-->
												<div class="card-p mt-n20 position-relative">
													<!--begin::Row-->
													
													
													<!--begin::Row-->
													<div class="row g-0">
														<!--begin::Col-->
														<div class="col  bg-light-success px-6 py-8 rounded-2 me-7">
															<!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
															<?php echo"<h1>"; print_r($data[count($data)-1][0])?> 
															<!--end::Svg Icon-->
															<a href="#" class="text-success fw-bold fs-6 mt-2">Up</a>
														</div>
														<!--end::Col-->
														<!--begin::Col-->
														<div class="col bg-light-danger px-6 py-8 rounded-2 me-7">
															<?php echo"<h1>";  print_r($data[count($data)-1][1]) ?> 
															<!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->															
															<!--end::Svg Icon-->
															<a href="#" class="text-danger fw-bold fs-6 me-2">Down</a>
														</div>
														<!--end::Col-->
														
														
													</div>
													<!--end::Row-->
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Body-->
										
										<!--end::Mixed Widget 2-->
										