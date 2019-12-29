
<?php
include('connection.php');
$sql = "UPDATE Incident SET Incident_Date = '".$_GET["date"]."',  Incident_Report = '".$_GET["report"]."',
                 Offence_ID = (SELECT Offence_ID FROM Offence WHERE Offence_description='".$_GET["offence"]."') WHERE Incident_ID =".$_GET['incidentID'];
echo $sql;
$result = mysqli_query($conn, $sql);
?>
<!-- <script type="text/javascript">
alert("Updated successfully!");
window.location = "report_list.php";
</script> -->