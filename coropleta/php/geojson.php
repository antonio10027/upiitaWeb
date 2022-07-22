<?php
$serverName = "LAPTOP-GALINDO";
$connectionOptions = [
  "Database"=>"geoserver",
  "Uid"=>"sa",
  "PWD"=>"sa"
]; 
$conn = sqlsrv_connect($serverName, $connectionOptions);
if($conn == false)
  die(print_r(sqlsrv_errors(),true));
else  //echo "Connection Successful";


$sql = "SELECT  top 1  covid.dbo.[geomToGeoJSONWrapped]('CO_MAX')";

$res = sqlsrv_query($conn, $sql);
//sqlsrv_exec($sql);
//echo ($res);

$data = ''; 

while($row = sqlsrv_fetch_array($res)){
    $data = $row[0];
    
}
print_r ($data);
?>