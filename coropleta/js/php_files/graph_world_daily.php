<?php
$serverName = "LAPTOP-GALINDO";
$connectionOptions = [
  "Database"=>"covid",
  "Uid"=>"sa",
  "PWD"=>"sa"
]; 
$conn = sqlsrv_connect($serverName, $connectionOptions);
if($conn == false)
  die(print_r(sqlsrv_errors(),true));
else // echo "Connection Successful";

$sql = "SELECT SUM(daily_cases) as deaths, date 
        FROM world_covid_data 
        where date >= '2020-06-01' AND date <= '2021-06-01' 
        GROUP BY date 
        order by date for json auto";

$res = sqlsrv_query($conn, $sql);

$json= '';


while($row = sqlsrv_fetch_array($res)){
  $json = $row[0]; 
}

echo ($json);



/*SELECT MAX(suma)as maximo FROM (SELECT SUM(daily_cases) as suma FROM world_covid_data 
where date >= '20200501' and date <= '20210501'
GROUP BY country)z *7
         String query  = "Select Max(sum) From(SELECT SUM(daily_"+request.getParameter("parameter")+") as sum FROM world_covid_data where date >= '"+request.getParameter("date1")+"' AND date <= '"+request.getParameter("date2")+"' GROUP BY country_name) z";
*/
?>