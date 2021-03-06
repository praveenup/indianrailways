
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

	<div class="alert alert-info" style="margin-top: 50px;margin-left: 10%;margin-right: 10%">
		<div class="container-fluid">
			<h1 class="text-center" style="margin-top: 0;">Train Schedule Enquiry</h1>
			<form class="form-horizontal"  action="trainScheduleMain.php" method="POST">
				<div class="col-sm-12 form-group">
					<?php
						if($_SERVER["REQUEST_METHOD"] == "POST") {
							if (empty($_POST["txtTrainNo"])) {
								echo "<div class='alert alert-danger text-center'>Please Enter The Train Number In Specified Field</div>";
						  }
						}
					?>
					<label class="control-label col-sm-4 ">Train Number : </label>
					<div class="col-sm-4 has-feedback">
						<input id="trainNo" name="txtTrainNo" class="form-control" style="border-radius: 0;" type="number" placeholder="Enter Train Number Here... " value="<?php if(isset($_POST['txtTrainNo'])) { echo htmlentities ($_POST['txtTrainNo']); }?>"/>
					    <span class="form-control-feedback glyphicon glyphicon-pencil"></span>
                    </div>
					<div class="col-sm-2">
						<input  name="btnGetStatus" class="form-control btn btn-info" type="submit" style="border-bottom-left-radius: 0;border-bottom-right-radius: 0" value="Get Schedule" />
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
        });

    </script>
<?php 
	if(!empty($_POST['txtTrainNo'])){
		include 'trainSchedule.php';
	}
?>
</body>
<?php
include '../include/footer.php';
?>
</html>