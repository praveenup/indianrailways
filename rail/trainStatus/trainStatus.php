<?php 
	$json_running_status_url = file_get_contents('http://api.railwayapi.com/live/train/'.$_POST['txtTrainNo'].'/doj/'.date('Ymd', strtotime($_POST['trainDate'])).'/apikey/f09v6zr5/');
	//$json_running_status_url = file_get_contents('../json/trainStatus.json');
	$json_train_name_url = file_get_contents('http://api.railwayapi.com/name_number/train/'.$_POST['txtTrainNo'].'/apikey/f09v6zr5/');
	$data = json_decode($json_running_status_url);
	$data_name = json_decode($json_train_name_url);


	function getStatus(){
        global $data;
        global $data_name;

        function rescheduled(){
            global $data;
            global $data_name;
            echo '
                
                <div class="container-fluid">
                <div class="alert alert-info">
                <section style="color:green;padding=0px;text-align:center">
                    <h3>Train Running Status of '.$data_name->train->name.'</h3>
                    <h4>Train Number : '.$_POST['txtTrainNo'].'</h4>
                    <h4>Start Date : '.$data->start_date.'</h4>
                    <h4>Train Has Been Reschedule To '.$data->current_station->actdep.', '.$data->current_station->actarr_date.' at '.$data->current_station->station_->name.'('.$data->current_station->station_->code.')</h4>
                </section>	
                </div>
                </div>
                <table class="table table-responsive table-striped table-bordered table-hover table-condensed text-center bg-info">
                <thead>
                    <tr class="success">
                        <th>S.No.</th>
                        <th>Stn Code</th>
                        <th>Station</th>
                        <th>Arrival</th>
                        <th>Departure</th>
                        <th>Exp. Arrival</th>
                        <th>Exp. Departure</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
            ';
            for($i=0;$i<count($data->route);$i++){
                echo '
                    <tr class="danger">
                        <td>'.($i+1).'</td>
                        <td>'.$data->route[$i]->station_->code.'</td>
                        <td>'.$data->route[$i]->station_->name.'</td>
                        <td>'.$data->route[$i]->scharr.'</td>
                        <td>'.$data->route[$i]->schdep.'</td>
                        <td>'.$data->route[$i]->actarr.'</td>
                        <td>'.$data->route[$i]->actdep.'</td>
                        <td>'.$data->route[$i]->status.'</td>
                    </tr>
                    ';
            }
        }

        function cancelled(){
            global $data;
            global $data_name;
            $json_schedule_url = file_get_contents('http://api.railwayapi.com/route/train/'.$_POST['txtTrainNo'].'/apikey/f09v6zr5/');
            $data_schedule = json_decode($json_schedule_url);
            echo '
                <div class="container-fluid">
                <div class="alert alert-info">
                <section style="color:green;padding=0px;text-align:center">
                    <h3>Train Running Status of '.$data_name->train->name.'</h3>
                    <h4>Train Number : '.$_POST['txtTrainNo'].'</h4>
                    <h4>Start Date : '.$_POST['trainDate'].'</h4>
                    <h4>Train Has Been Cancelled By Indian Railways</h4>
                </section>	
                </div>
                </div>
                <table class="table table-responsive table-striped table-bordered table-hover table-condensed text-center">
                <thead>
                    <tr class="success">
                        <th>S.No.</th>
                        <th>Stn Code</th>
                        <th>Station</th>
                        <th>Arrival</th>
                        <th>Departure</th>
                        <th>Exp. Arrival</th>
                        <th>Exp. Departure</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
            ';
            for($i=0;$i<count($data_schedule->route);$i++){
                echo '
                    <tr class="danger">
                        <td>'.($i+1).'</td>
                        <td>'.$data_schedule->route[$i]->code.'</td>
                        <td>'.$data_schedule->route[$i]->fullname.'</td>
                        <td>'.$data_schedule->route[$i]->scharr.'</td>
                        <td>'.$data_schedule->route[$i]->schdep.'</td>
                        <td>Cancelled</td>
                        <td>Cancelled</td>
                        <td>-</td>
                    </tr>
                    ';

            }
        }

        function running(){
            global $data;
            global $data_name;
            echo '
                <div class="container-fluid">
                <div class="alert alert-info">
                <section style="color:green;padding=0px;text-align:center">
                    <h3>Train Running Status of '.$data_name->train->name.'</h3>
                    <h4>Train Number : '.$_POST['txtTrainNo'].'</h4>
                    <h4>Start Date : '.$data->start_date.'</h4>
                    <h4>'.$data->position.'</h4>
                </section>	
                </div>
                </div>
                <table class="table table-responsive table-striped table-bordered table-hover table-condensed text-center">
                <thead>
                    <tr class="success">
                        <th>S.No.</th>
                        <th>Stn Code</th>
                        <th>Station</th>
                        <th>Arrival</th>
                        <th>Departure</th>
                        <th>Exp. Arrival</th>
                        <th>Exp. Departure</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
            ';
            for($i=0;$i<count($data->route);$i++){
                if($data->route[$i]->has_arrived == true){
                    if(strcasecmp('00:00',$data->route[$i]->actarr)==0 && $i==0){
                        echo '
                        <tr>
                            <td>'.($i+1).'</td>
                            <td>'.$data->route[$i]->station_->code.'</td>
                            <td class="info">'.$data->route[$i]->station_->name.'</td>
                            <td>'.$data->route[$i]->scharr.'</td>
                            <td>'.$data->route[$i]->schdep.'</td>
                            <td>Source</td>
                            <td>'.$data->route[$i]->actdep.'</td>
                            ';
                            if(strcasecmp('-',$data->route[$i]->status[0])==0){
                                echo '
                                    <td class="info">'.-($data->route[$i]->latemin).' min before</td>
                                ';
                            }else if(strcasecmp('0 mins late',$data->route[$i]->status)==0){
                                echo '
                                    <td class="info">RT</td>
                                ';
                            }else{
                                echo '
                                    <td class="warning">'.$data->route[$i]->status.'</td>
                                ';
                            }
                        echo '</tr>';

                    }else if(strcasecmp('-',$data->route[$i]->status[0])==0){
                        echo '
                        <tr>
                            <td>'.($i+1).'</td>
                            <td>'.$data->route[$i]->station_->code.'</td>
                            <td class="info">'.$data->route[$i]->station_->name.'</td>
                            <td>'.$data->route[$i]->scharr.'</td>
                            <td>'.$data->route[$i]->schdep.'</td>
                            <td>'.$data->route[$i]->actarr.'</td>
                            <td>'.$data->route[$i]->actdep.'</td>
                            <td class="info">'.-($data->route[$i]->latemin).' min before</td>
                        </tr>
                        ';
                    }else if(strcasecmp('0 mins late',$data->route[$i]->status)==0){
                        echo '
                        <tr>
                            <td>'.($i+1).'</td>
                            <td>'.$data->route[$i]->station_->code.'</td>
                            <td class="info">'.$data->route[$i]->station_->name.'</td>
                            <td>'.$data->route[$i]->scharr.'</td>
                            <td>'.$data->route[$i]->schdep.'</td>
                            <td>'.$data->route[$i]->actarr.'</td>
                            <td>'.$data->route[$i]->actdep.'</td>
                            <td class="info">RT</td>
                        </tr>
                        ';
                    }else{
                        echo '
                        <tr>
                            <td>'.($i+1).'</td>
                            <td>'.$data->route[$i]->station_->code.'</td>
                            <td class="info">'.$data->route[$i]->station_->name.'</td>
                            <td>'.$data->route[$i]->scharr.'</td>
                            <td>'.$data->route[$i]->schdep.'</td>
                            <td>'.$data->route[$i]->actarr.'</td>
                            <td>'.$data->route[$i]->actdep.'</td>
                            <td class="warning">'.$data->route[$i]->status.'</td>
                        </tr>
                        ';
                    }
                }elseif($data->route[$i]->has_arrived == false && $data->current_station->no == 1){
                    echo '
                        <tr class="danger">
                            <td>'.($i+1).'</td>
                            <td>'.$data->route[$i]->station_->code.'</td>
                            <td>'.$data->route[$i]->station_->name.'</td>
                            <td>'.$data->route[$i]->scharr.'</td>
                            <td>'.$data->route[$i]->schdep.'</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        ';
                }elseif(($data->route[$i]->has_arrived == false ) && ($data->current_station->no > $data->route[$i]->no)){
                    echo '
                        <tr>
                            <td>'.($i+1).'</td>
                            <td>'.$data->route[$i]->station_->code.'</td>
                            <td class="info">'.$data->route[$i]->station_->name.'</td>
                            <td>'.$data->route[$i]->scharr.'</td>
                            <td>'.$data->route[$i]->schdep.'</td>
                            <td>'.$data->route[$i]->actarr.'</td>
                            <td>'.$data->route[$i]->actdep.'</td>
                            <td class="warning">'.$data->route[$i]->status.'</td>
                        </tr>
                        ';
                }else{
                    echo '
                        <tr class="danger">
                            <td>'.($i+1).'</td>
                            <td>'.$data->route[$i]->station_->code.'</td>
                            <td>'.$data->route[$i]->station_->name.'</td>
                            <td>'.$data->route[$i]->scharr.'</td>
                            <td>'.$data->route[$i]->schdep.'</td>
                            <td>'.$data->route[$i]->actarr.'</td>
                            <td>'.$data->route[$i]->actdep.'</td>
                            <td>'.$data->route[$i]->status.'</td>
                        </tr>
                        ';
                }

            }
        }


        if($data->response_code == 204){
            //check schedule
            $flag = false;
            $json_sch_url = file_get_contents('http://api.railwayapi.com/route/train/'.$_POST['txtTrainNo'].'/apikey/f09v6zr5/');
            $data_sch = json_decode($json_sch_url,true);
            if($data_sch['response_code'] == 200){
                $output = "<h4>Railways Server Not Responding</h4>";

                echo '
                            <div class="container-fluid">
                            <div class="alert alert-info">
                            <section style="color:green;padding=0px;text-align:center">
                                <h3>Train Running Status of '.$data_name->train->name.'</h3>
                                <h4>Train Number : '.$_POST['txtTrainNo'].'</h4>
                                <h4>Start Date : '.$_POST['trainDate'].'</h4>
                                '.$output.'
                            </section>	
                            </div>
                            </div>
                            <table class="table table-responsive table-striped table-bordered table-hover table-condensed text-center">
                            <thead>
                                <tr class="success">
                                    <th>S.No.</th>
                                    <th>Stn Code</th>
                                    <th>Station</th>
                                    <th>Arrival</th>
                                    <th>Departure</th>
                                    <th>Exp. Arrival</th>
                                    <th>Exp. Departure</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                        ';
                for($i=0;$i<count($data_sch['route']);$i++){
                    echo '
                                <tr class="danger">
                                    <td>'.($i+1).'</td>
                                    <td>'.$data_sch['route'][$i]['code'].'</td>
                                    <td>'.$data_sch['route'][$i]['fullname'].'</td>
                                    <td>'.$data_sch['route'][$i]['scharr'].'</td>
                                    <td>'.$data_sch['route'][$i]['schdep'].'</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                ';

                }
            }
        }else if($data->response_code == 200 ){
            if( ($data->current_station->no == 1) && $data->current_station->schdep != $data->current_station->actdep ){
                //reschedule
                $flag=false;
                $json_resch_url = file_get_contents('http://api.railwayapi.com/rescheduled/date/'.date('d-m-Y', strtotime($_POST['trainDate'])).'/apikey/f09v6zr5/');
                $data_resch = json_decode($json_resch_url);
                //echo"200 1";
                if($data_resch->response_code ==200){
                    for($x = 0; $x < count($data_resch->trains); $x++){
                        if($data_resch->trains[$x]->number == $_POST['txtTrainNo']){
                            $flag=true;
                            break;
                        }
                    }
                    if($flag){
                        //echo "Train Has Been Rescheduled";
                        rescheduled();
                    }else{
                        echo "Server Not Responding Reschedule";
                    }
                }

            }else if($data->current_station->has_arrived == 'true'){
                //on way
                running();
            }else{
                $flag = false;
                $json_cancel_url = file_get_contents('http://api.railwayapi.com/cancelled/date/'.date('d-m-Y', strtotime($_POST['trainDate'])).'/apikey/f09v6zr5/');
                $data_cancel = json_decode($json_cancel_url);
                if($data_cancel->response_code ==200){
                    for($x = 0; $x < count($data_cancel->trains); $x++){
                        if($data_cancel->trains[$x]->train->number == $_POST['txtTrainNo']){
                            $flag=true;
                            break;
                        }
                    }
                    if($flag){
                        //echo "Train Has Been Cancelled";
                        cancelled();
                    }else{
                        //echo "Not Started Yet";
                        running();
                    }
                }
            }

        }else{
            $flag = false;
            $json_cancel_url = file_get_contents('http://api.railwayapi.com/cancelled/date/'.date('d-m-Y', strtotime($_POST['trainDate'])).'/apikey/f09v6zr5/');
            $data_cancel = json_decode($json_cancel_url);
            if($data_cancel->response_code ==200){
                for($x = 0; $x < count($data_cancel->trains); $x++){
                    if($data_cancel->trains[$x]->train->number == $_POST['txtTrainNo']){
                        $flag=true;
                        break;
                    }
                }
                if($flag){
                    //echo "Train Has Been Cancelled";
                    cancelled();
                }else  if($data->response_code == 510){
                    //check schedule
                    $flag = false;
                    $json_sch_url = file_get_contents('http://api.railwayapi.com/route/train/'.$_POST['txtTrainNo'].'/apikey/f09v6zr5/');
                    $data_sch = json_decode($json_sch_url,true);
                    if($data_sch['response_code'] == 200){
                        $day = strtoupper(date('D',strtotime($_POST['trainDate'])));
                        for($i = 0; $i < count($data_sch['train']['days']); $i++){
                            if( $day == $data_sch['train']['days'][$i]['day-code']){
                                if($data_sch['train']['days'][$i]['runs'] == 'Y'){
                                    $flag = true;
                                    break;
                                }
                            }
                        }

                    if($_POST['trainDate'] < date('d-m-Y')) {
                        $output = "<h4>Railway Server is Not Responding</h4>";
                    }else if($flag == true){
                        $output = "<h4>Train Not Yet Started</h4>";
                    }else{
                        $output = "<h4>Train Not Schedule To Run On This Date</h4>";
                    }
                    echo '
                            <div class="container-fluid">
                            <div class="alert alert-info">
                            <section style="color:green;padding=0px;text-align:center">
                                <h3>Train Running Status of '.$data_name->train->name.'</h3>
                                <h4>Train Number : '.$_POST['txtTrainNo'].'</h4>
                                <h4>Start Date : '.$_POST['trainDate'].'</h4>
                                '.$output.'
                            </section>	
                            </div>
                            </div>
                            <table class="table table-responsive table-striped table-bordered table-hover table-condensed text-center">
                            <thead>
                                <tr class="success">
                                    <th>S.No.</th>
                                    <th>Stn Code</th>
                                    <th>Station</th>
                                    <th>Arrival</th>
                                    <th>Departure</th>
                                    <th>Exp. Arrival</th>
                                    <th>Exp. Departure</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                        ';
                        for($i=0;$i<count($data_sch['route']);$i++){
                            echo '
                                <tr class="danger">
                                    <td>'.($i+1).'</td>
                                    <td>'.$data_sch['route'][$i]['code'].'</td>
                                    <td>'.$data_sch['route'][$i]['fullname'].'</td>
                                    <td>'.$data_sch['route'][$i]['scharr'].'</td>
                                    <td>'.$data_sch['route'][$i]['schdep'].'</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                ';

                        }


                    }
                }else{
                    //check schedule
                    $flag = false;
                    $json_sch_url = file_get_contents('http://api.railwayapi.com/route/train/'.$_POST['txtTrainNo'].'/apikey/f09v6zr5/');
                    $data_sch = json_decode($json_sch_url,true);
                    if($data_sch['response_code'] == 200){
                        $day = strtoupper(date('D',strtotime($_POST['trainDate'])));
                        for($i = 0; $i < count($data_sch['train']['days']); $i++){
                            if( $day == $data_sch['train']['days'][$i]['day-code']){
                                if($data_sch['train']['days'][$i]['runs'] == 'Y'){
                                    $flag = true;
                                    break;
                                }
                            }
                        }
                        if($flag == true){
                            $output = "<h4>Train Not Yet Started</h4>";
                        }else{
                            $output = "<h4>Railways Server Not Responding</h4>";
                        }
                        echo '
                            <div class="container-fluid">
                            <div class="alert alert-info">
                            <section style="color:green;padding=0px;text-align:center">
                                <h3>Train Running Status of '.$data_name->train->name.'</h3>
                                <h4>Train Number : '.$_POST['txtTrainNo'].'</h4>
                                <h4>Start Date : '.$_POST['trainDate'].'</h4>
                                '.$output.'
                            </section>	
                            </div>
                            </div>
                            <table class="table table-responsive table-striped table-bordered table-hover table-condensed text-center">
                            <thead>
                                <tr class="success">
                                    <th>S.No.</th>
                                    <th>Stn Code</th>
                                    <th>Station</th>
                                    <th>Arrival</th>
                                    <th>Departure</th>
                                    <th>Exp. Arrival</th>
                                    <th>Exp. Departure</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                        ';
                        for($i=0;$i<count($data_sch['route']);$i++){
                            echo '
                                <tr class="danger">
                                    <td>'.($i+1).'</td>
                                    <td>'.$data_sch['route'][$i]['code'].'</td>
                                    <td>'.$data_sch['route'][$i]['fullname'].'</td>
                                    <td>'.$data_sch['route'][$i]['scharr'].'</td>
                                    <td>'.$data_sch['route'][$i]['schdep'].'</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                ';

                        }
                    }
                }
            }else if($data->response_code == 204){
                echo "Railway Server Not Responding";
            }
        }
        echo '    </tbody>
                  </table>
                  </div>';
    }
    getStatus();
?>
