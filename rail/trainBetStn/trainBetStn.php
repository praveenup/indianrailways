<?php
$json_bet_stn_url = file_get_contents('http://api.railwayapi.com/between/source/'.$_POST['txtSrcCode'].'/dest/'.$_POST['txtDestCode'].'/date/'.date('d-m', strtotime($_POST['txtTrainDate'])).'/apikey/f09v6zr5/');
$data_bet_stn = json_decode($json_bet_stn_url,true);

if($data_bet_stn['response_code']==200){
    echo '

				<div class="container-fluid">
				<div class="alert alert-info">
				<section style="color:green;padding=0px;text-align:center">
				<h3>Showing Trains Runs From <span class="label label-warning">'.$data_bet_stn['train'][0]['from']['name'].'</span><span class="badge">('.$data_bet_stn['train'][0]['from']['code'].')</span> to <span class="label label-warning">'.$data_bet_stn['train'][0]['to']['name'].'</span><span class="badge">('.$data_bet_stn['train'][0]['to']['code'].')</span> on Date <span class="label label-danger">'.date('d-M-y', strtotime($_POST['txtTrainDate'])).'</h3>
				</section>
				</div>
			
				<table class="table table-responsive table-striped table-bordered table-hover table-condensed text-center bg-info">
				<thead>
					<tr class="success">
						<th>S.No.</th>
						<th>Train No.</th>
						<th>Name</th>
						<th>Source Departure Time</th>
						<th>Destination Arrival Time</th>
						<th>Travel Time</th>
						<th>Classes</th>
						<th>Days</th>
						<th>View More</th>
					</tr>
				</thead>
				<tbody>
			';
    for($i=0;$i<count($data_bet_stn['train']);$i++){
        echo '
            <tr>
                <td>'.$data_bet_stn['train'][$i]['no'].'</td>
                <td>'.$data_bet_stn['train'][$i]['number'].'</td>
                <td>'.$data_bet_stn['train'][$i]['name'].'</td>
                <td>'.$data_bet_stn['train'][$i]['src_departure_time'].'</td>
                <td>'.$data_bet_stn['train'][$i]['dest_arrival_time'].'</td>
                <td>'.$data_bet_stn['train'][$i]['travel_time'].'</td>
                
            ';

        echo '<td>';
        for($j = 0; $j < count($data_bet_stn['train'][$i]['classes']); $j++){
            if( 'Y' == $data_bet_stn['train'][$i]['classes'][$j]['available']){
                echo '<span class="badge">'.$data_bet_stn['train'][$i]['classes'][$j]['class-code'].'</span> ';
            }
        }
        echo '</td>';

        echo '<td>';
        $count=0;
        for($k = 0; $k < count($data_bet_stn['train'][$i]['days']); $k++) {
            if ('Y' == $data_bet_stn['train'][$i]['days'][$k]['runs']) {
                $count++;
            }
        }
        if($count == 7){
            echo '<span class="label label-info">Daily</span> ';
        }else{
            for($j = 0; $j < count($data_bet_stn['train'][$i]['days']); $j++){
                if( 'Y' == $data_bet_stn['train'][$i]['days'][$j]['runs']) {
                    echo '<span class="label label-info">' . $data_bet_stn['train'][$i]['days'][$j]['day-code'] . '</span> ';
                }
            }
        }
        echo '</td>
        <td>
            <div class="dropdown">
              <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" type="button" name="btnDetails" style="border-bottom-left-radius: 0;border-bottom-right-radius: 0">View More
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <!--<li><a href="#" data-toggle="modal" data-target="#myModal">Schedule</a></li>-->
                <li><a href="#">Schedule</a></li>
                <li><a href="#">Seat Availability</a></li>
                <li><a href="#">Running Status</a></li>
              </ul>
            </div>
        </td>
        
 
            
            ';

    }
    echo '</tbody></table>


<style type="text/css">
    @media screen and (min-width: 768px) {
        .modal-dialog {
          width: 900px; /* New width for default modal */
        }
        .modal-sm {
          width: 350px; /* New width for small modal */
        }
    }
    @media screen and (min-width: 992px) {
        .modal-lg {
          width: 950px; /* New width for large modal */
        }
    }
</style>



    <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header alert alert-warning">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h2 class="text-center model-title" style="margin-top: 0;">Train Schedule Enquiry</h2>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="../iFarme/schedule.php"></iframe>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
      </div>
</div>';
}
?>


