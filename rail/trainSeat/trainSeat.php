<?php
$json_fare_url = file_get_contents('http://api.railwayapi.com/fare/train/'.$_POST['txtTrainNo'].'/source/'.$_POST['txtSrcCode'].'/dest/'.$_POST['txtDestCode'].'/age/'.str_replace(' ','',substr($_POST['selAge'],strpos($_POST['selAge'],'(')+1,2)).'/quota/'.substr($_POST['selQuota'],0,2).'/doj/'.$_POST['txtTrainDate'].'/apikey/f09v6zr5/');
$data_fare = json_decode($json_fare_url,true);

if($data_fare['response_code']==200){
    echo substr($_POST['selAge'],strpos($_POST['selAge'],'(')+1,2).'

				<div class="container-fluid">
				<div class="alert alert-info">
				<section style="color:green;padding=0px;text-align:center">
				<h3>Showing Fare Of Train <span class="label label-warning">'.$data_fare['train']['name'].'</span><span class="badge">('.$data_fare['train']['number'].')</span> From Station <span class="label label-warning">'.$data_fare['from']['name'].'</span><span class="badge">('.$data_fare['from']['code'].')</span> To Station <span class="label label-warning">'.$data_fare['to']['name'].'</span><span class="badge">('.$data_fare['to']['code'].')</span></h3>
				</section>
				</div>
			
				<table class="table table-responsive table-striped table-bordered table-hover table-condensed text-center bg-info">
				<thead>
					<tr class="success">
						<th>S.No.</th>
						<th>Class Name</th>
						<th>Fare (Rs.)</th>
					</tr>
				</thead>
				<tbody>
			';
    for($i=0;$i<count($data_fare['fare']);$i++){
        echo '
            <tr>
                <td>'.($i+1).'</td>
                <td>'.ucfirst(strtolower($data_fare['fare'][$i]['name'])).' ('.$data_fare['fare'][$i]['code'].')</td>
                <td>'.$data_fare['fare'][$i]['fare'].'</td>
            ';
    }
    echo '</tbody></table></div>';
}
?>


