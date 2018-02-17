<?php 
	$json_sch_url = file_get_contents('http://api.railwayapi.com/route/train/'.$_POST['txtTrainNo'].'/apikey/f09v6zr5/');
	$data_sch = json_decode($json_sch_url,true);

	if($data_sch['response_code']==200){
		echo '

				<div class="container-fluid">
				<div class="alert alert-info">
				<section style="color:green;padding=0px;text-align:center">
					<h3>Showing Train Schedule of <span class="label label-warning">'.$data_sch['train']['name'].'</span></h3>
					<h4>Train Number : <span class="label label-danger">'.$_POST['txtTrainNo'].'</span></h4>
					<h4>Runs On : 
			';
		
		for($i = 0; $i < count($data_sch['train']['days']); $i++){
			if( 'Y' == $data_sch['train']['days'][$i]['runs']){
				echo '<span class="badge">'.$data_sch['train']['days'][$i]['day-code'].'</span> ';
			}
		}
		echo  '
				</h4>
				<h4>Available Classes : 
			';

		for($i = 0; $i < count($data_sch['train']['classes']); $i++){
			if( 'Y' == $data_sch['train']['classes'][$i]['available']){
				echo '<span class="label label-info">'.$data_sch['train']['classes'][$i]['class-code'].'</span> ';
			}
		}
		echo  '
				</h4>
				</section>	
				</div>
				</div>
				<table class="table table-responsive table-striped table-bordered table-hover table-condensed text-center bg-info">
				<thead>
					<tr class="success">
						<th>Stop No.</th>
						<th>Station (CODE)</th>
						<th>Arrival</th>
						<th>Departure</th>
						<th>Day</th>
						<th>Distance</th>
						<th>Halt Time</th>
					</tr>
				</thead>
				<tbody>
			';
			for($i=0;$i<count($data_sch['route']);$i++){
				if($data_sch['route'][$i]['no'] == 1){
					echo '
						<tr>
							<td>'.$data_sch['route'][$i]['no'].'</td>
							<td>'.$data_sch['route'][$i]['fullname'].' ('.$data_sch['route'][$i]['code'].')</td>
							<td>'.$data_sch['route'][$i]['scharr'].'</td>
							<td>'.$data_sch['route'][$i]['schdep'].'</td>
							<td>'.$data_sch['route'][$i]['day'].'</td>
							<td>'.$data_sch['route'][$i]['distance'].'</td>
							<td>Source</td>
						</tr>
						';
				}else if($data_sch['route'][$i]['no'] == count($data_sch['route'])){
					echo '
						<tr>
							<td>'.$data_sch['route'][$i]['no'].'</td>
							<td>'.$data_sch['route'][$i]['fullname'].' ('.$data_sch['route'][$i]['code'].')</td>
							<td>'.$data_sch['route'][$i]['scharr'].'</td>
							<td>'.$data_sch['route'][$i]['schdep'].'</td>
							<td>'.$data_sch['route'][$i]['day'].'</td>
							<td>'.$data_sch['route'][$i]['distance'].'</td>
							<td>Destination</td>
						</tr>
						';
				}else{
					echo '
						<tr>
							<td>'.$data_sch['route'][$i]['no'].'</td>
							<td>'.$data_sch['route'][$i]['fullname'].' ('.$data_sch['route'][$i]['code'].')</td>
							<td>'.$data_sch['route'][$i]['scharr'].'</td>
							<td>'.$data_sch['route'][$i]['schdep'].'</td>
							<td>'.$data_sch['route'][$i]['day'].'</td>
							<td>'.$data_sch['route'][$i]['distance'].'</td>
							<td>'.$data_sch['route'][$i]['halt'].' min</td>
						</tr>
						';
				}

			}
		echo '</tbody></table></div>';
	}
?>


