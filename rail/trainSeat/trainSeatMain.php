
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width," intitial-scale="1" maximum-scale="1">
    <title>Railway Adda</title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../jqueryui/jquery-ui.css">
    <script src="../js/jquery-1.11.3.min.js"></script>
    <script src="../jqueryui/jquery-ui.js"></script>
    <script src="../js/bootstrap.js"></script>
    <style>
        .ui-autocomplete{
            max-height: 200px;
            overflow-x: hidden;
            overflow-y: auto;
        }
    </style>
</head>
<body>

<?php
include '../include/nav.php';
?>

<div class="alert alert-info" style="margin-top: 50px;">
    <div class="container-fluid">
        <h1 class="text-center" style="margin-top: 0;">Check Train Seat Availability</h1>
        <form class="form-horizontal"  action="trainSeatMain.php" method="POST">
            <div class="form-group">
                <div class="col-sm-12">
                    <?php
                    if($_SERVER["REQUEST_METHOD"] == "POST") {

                        if(empty($_POST["txtSrcCode"]) && empty($_POST["txtDestCode"])){
                            echo "<div class='alert alert-danger text-center'>Please Enter Source And Destination Stn In Specified Field</div>";
                        }elseif (empty($_POST["txtSrcCode"])) {
                            echo "<div class='alert alert-danger text-center'>Please Enter Source Stn In Specified Field</div>";
                        }elseif (empty($_POST["txtDestCode"])){
                            echo "<div class='alert alert-danger text-center'>Please Enter Destination Stn In Specified Field</div>";
                        }
                    }
                    ?>

                    <label class="control-label col-sm-1">Train No. : </label>
                    <div class="col-sm-2">
                        <input id="trainNo" name="txtTrainNo" class="form-control" style="border-radius: 0;" type="number" placeholder="Enter Train No." value="<?php if(isset($_POST['txtTrainNo'])) { echo htmlentities ($_POST['txtTrainNo']); }?>"/>
                    </div>

                    <label class="control-label col-sm-2">Source Stn Code : </label>
                    <div class="col-sm-2">
                        <input id="stnSrcCode" name="txtSrcCode" class="form-control" style="border-radius: 0;" type="text" placeholder="Enter Source Code " value="<?php if(isset($_POST['txtSrcCode'])) { echo htmlentities ($_POST['txtSrcCode']); }?>"/>
                    </div>

                    <label class="control-label col-sm-2">Destination Stn Code : </label>
                    <div class="col-sm-2">
                        <input id="stnDestCode" name="txtDestCode" class="form-control" style="border-radius: 0;" type="text" placeholder="Enter Destination Code " value="<?php if(isset($_POST['txtDestCode'])) { echo htmlentities ($_POST['txtDestCode']); }?>"/>
                    </div>

                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">

                    <label class="control-label col-sm-1 " for="sel1">Age :</label>
                    <div class="col-sm-2">
                        <select name="selAge" class="form-control" style="border-radius: 0;" id="sel1">
                            <option>Child (5 - 11)</option>
                            <option selected>Adult (12 and above)</option>
                            <option>Senior Citizen Female (58 and above)</option>
                            <option>Senior Citizen Male (60 and above)</option>
                        </select>
                    </div>

                    <label class="control-label col-sm-2 " for="sel1">Quota :</label>
                    <div class="col-sm-2">
                        <select name="selQuota" class="form-control" style="border-radius: 0;" id="sel1">
                            <option selected>GN	General Quota</option>
                            <option>LD	Ladies Quota</option>
                            <option>TQ Tatkal Quota</option>
                            <option>DF	Defence Quota</option>
                            <option>PT Premium Tatkal Quota</option>
                            <option>FT	Foreign Tourist Quota</option>
                            <option>HP	Physically Handicapped Quota</option>
                            <option>LB	Lower Berth</option>
                            <option>DP	Duty Pass Quota</option>
                            <option>PH	Parliament house Quota</option>
                        </select>
                    </div>

                    <label class="control-label col-sm-2">Train Date : </label>
                    <div class="col-sm-2 has-feedback">
                        <input id="trainDate" name="txtTrainDate" class="form-control" style="border-radius: 0;" type="text" placeholder="Select Train Date " value="<?php if(isset($_POST['txtTrainDate'])) { echo htmlentities ($_POST['txtTrainDate']); }?>"/>
                        <span class="form-control-feedback glyphicon glyphicon-th"></span>
                    </div>


                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-12 ">
                        <input  name="btnGetFare" class="form-control btn btn-info" type="submit" style="border-bottom-left-radius: 0;border-bottom-right-radius: 0" value="Get Train Fare" />
                    </div>
                </div>
            </div>


        </form>
    </div>
</div>
<script>

    $(document).ready(function(){
        $('#trainNo').autocomplete({
            source : '../trainAutocomplete.php',
            minLength : 3,
            autoFocus:true

        });

        var date = new Date();
        $("#trainDate").datepicker({
            dateFormat: 'mm-dd-yy'
        }).datepicker('setDate', date)
    });


</script>
<?php
if(!empty($_POST['txtSrcCode']) && !empty($_POST['txtDestCode'])){
    include 'trainFare.php';
}
?>
</body>
<?php
include '../include/footer.php';
?>
</html>