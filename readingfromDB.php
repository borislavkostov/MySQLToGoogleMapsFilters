<?php
require("db_info.php");
$conn = mysql_connect("localhost", $username, $password)or die("No connection.");
mysql_select_db("wordpress") or die(mysql_error());

	
$sql=mysql_query("SELECT DISTINCT country_name FROM markers");
if(mysql_num_rows($sql)){
$select='<form>';
$select.= '<select name="searchByCountry" onchange="this.form.submit()">';
$select.='<option value=" ">Enter Country</option>';
while($rs=mysql_fetch_array($sql)){
      $select.='<option value="'.$rs['country_name'].'">'.$rs['country_name'].'</option>';
  }
}
$select.='</select>';
$select.='</form>';
echo $select;

$sqlR=mysql_query("SELECT DISTINCT region_name FROM markers WHERE country_name LIKE '".$_GET['searchByCountry']."' ");

$selectR='<form>';
$selectR.='<select name="searchByRegion" onchange="this.form.submit()">';
$selectR.='<option value=" ">Enter Region</option>';
while($rs=mysql_fetch_array($sqlR)){
      $selectR.='<option value="'.$rs['region_name'].'">'.$rs['region_name'].'</option>';
  }

$selectR.='</select>';
$selectR.='</form>';
echo $selectR;

$sqlC=mysql_query("SELECT DISTINCT city_name FROM markers WHERE region_name LIKE '".$_GET['searchByRegion']."' ");
if(mysql_num_rows($sqlC)){
$selectC='<form>';
$selectC.='<select name="searchByCity" onchange="this.form.submit()">';
$selectC.='<option value=" ">Enter City</option>';
while($rs=mysql_fetch_array($sqlC)){
      $selectC.='<option value="'.$rs['city_name'].'">'.$rs['city_name'].'</option>';
  }
}
$selectC.='</select>';
$selectC.='</form>';
echo $selectC;
$sqlC=mysql_query("SELECT * FROM markers WHERE city_name LIKE '".$_GET['searchByCity']."' ");
while($row = mysql_fetch_assoc($sqlC))
{
   $latitude[]=$row["latitude"];
   $longitude[]=$row["longitude"];
   $title[]=$row["title"];
   $start_time[]=$row["start_time"];
}
?>
