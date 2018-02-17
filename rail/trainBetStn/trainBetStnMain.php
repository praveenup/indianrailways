
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width," intitial-scale="1" maximum-scale="1">
    <title>Railway Adda</title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../jqueryui/jquery-ui.css">
    <link rel="stylesheet" href="../css/bootstrap-datepicker.min.css">
    <script src="../js/jquery-1.11.3.min.js"></script>
    <script src="../jqueryui/jquery-ui.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap-datepicker.min.js"></script>

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

<div class="alert alert-info" style="margin-top: 50px;margin-left: 10%;margin-right: 10%">
    <div class="container">
        <h1 class="text-center" style="margin-top: 0;">Check Train Between Two Stations</h1>
        <form class="form-horizontal"  action="trainBetStnMain.php" method="POST">
            <div class="form-group">
                <div class="col-sm-12">
                    <?php
                    if($_SERVER["REQUEST_METHOD"] == "POST") {

                        if(empty($_POST["txtSrcCode"]) && empty($_POST["txtDestCode"]) && empty($_POST["txtTrainDate"])){
                            echo "<div class='alert alert-danger text-center'>Please Enter Source, Destination Stn and Date In Specified Field</div>";
                        }elseif (empty($_POST["txtSrcCode"])) {
                            echo "<div class='alert alert-danger text-center'>Please Enter Source Stn In Specified Field</div>";
                        }elseif (empty($_POST["txtDestCode"])){
                            echo "<div class='alert alert-danger text-center'>Please Enter Destination Stn In Specified Field</div>";
                        }elseif (empty($_POST["txtTrainDate"])){
                            echo "<div class='alert alert-danger text-center'>Please Select Train Date From Specified Field</div>";
                        }
                    }
                    ?>

                    <label class="control-label col-sm-2">Source Stn Code : </label>
                    <div class="col-sm-3">
                        <input id="stnSrcCode" name="txtSrcCode" class="form-control" style="border-radius: 0;" type="text" placeholder="Enter Source Code " value="<?php if(isset($_POST['txtSrcCode'])) { echo htmlentities ($_POST['txtSrcCode']); }?>"/>
                    </div>

                    <label class="control-label col-sm-2">Destination Stn Code : </label>
                    <div class="col-sm-3">
                        <input id="stnDestCode" name="txtDestCode" class="form-control" style="border-radius: 0;" type="text" placeholder="Enter Destination Code " value="<?php if(isset($_POST['txtDestCode'])) { echo htmlentities ($_POST['txtDestCode']); }?>"/>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label class="control-label col-sm-2">Train Date : </label>
                    <div class="col-sm-8 has-feedback">
                        <input id="trainDate" name="txtTrainDate" class="form-control" style="border-radius: 0;" type="text" placeholder="Select Train Date " value="<?php if(isset($_POST['txtTrainDate'])) { echo htmlentities ($_POST['txtTrainDate']); }?>"/>
                        <span class="form-control-feedback glyphicon glyphicon-calendar"></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-8 col-sm-offset-2">
                        <input  name="btnGetTrains" class="form-control btn btn-info" type="submit" style="border-bottom-left-radius: 0;border-bottom-right-radius: 0" value="Get Trains" />
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
            dateFormat: 'dd-mm-yy',
            autoclose: true,
            todayBtn: "linked",
            orientation: "bottom right"

        }).datepicker('setDate', date)
    });


</script>
<?php
if(!empty($_POST['txtSrcCode']) && !empty($_POST['txtDestCode']) && !empty($_POST['txtTrainDate'])){
    include 'trainBetStn.php';
}
?>
</body>
<?php
    include '../include/footer.php';
?>
</html>