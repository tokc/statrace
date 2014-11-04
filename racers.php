<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"  "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>Frigate Race - Races</title>
<link href="css.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="pagewrap">
	
	<div id="header">
		<div class="menucenter">
		<?php include("menu.php"); ?>
		</div>
	</div>

	<div class="container3">
		<div class="container1">
			
				<div id="header2">
					<div class="text">
										
<? 
include("config.php");

//

$resulch = mysql_query("SELECT * FROM srv_races") or die(mysql_error());  

while ($bow = mysql_fetch_array($resulch))
{
	$resurr = mysql_query("SELECT * FROM srv_scores WHERE race='".$bow['race']."' && season='".$bow['season']."' ") or die(mysql_error()); 

	while($jaay = mysql_fetch_array($resurr))
	{

		$zc ++;

		$zkey = ($jaay['season'].'-'.$jaay['race']);
	}

	if ($zc != 0) {$zrace[$zkey]  = $zc;} // This pesky little sucker should end up with 9 entries, but the 9th one has the right key but not the right value.

	$zc = 0;
}

$result = mysql_query("SELECT * FROM srv_racers") or die(mysql_error());  

while($row = mysql_fetch_array($result))
{
	$stuff1 = "";

	$resut = mysql_query("SELECT * FROM srv_scores WHERE racer='".$row['id']."' ORDER BY season, race") or die(mysql_error());  
	
	unset($palces);
	
	while($jay = mysql_fetch_array($resut))
	{
		$pri = ($jay['season'].'-'.$jay['race']);
		
		$scorray[] = $jay['score'];

		$races[] = $jay['position'];

		$palces[$pri] = $jay['position'];
	}

	foreach ($races as $a) { if ($a == "1") $i ++; }

	if ( $row['captain'] == 1 ) {$stuff1 = "Captain ";}

	$Avg = round(array_sum($scorray)/count($scorray), 1);

	$Races = count($races);

	if ($i != 0) {$Wins = $i;} else {$Wins = "0";}

	$AvgPos = round(array_sum($races)/count($races), 1);
	
	unset($array);
	
	foreach ($palces as $k => $v)
	{
		//number of participants.
		$f = $zrace[$k];
		//finishing position divided by participants.
		$c = ($v / $f);
		
		$array[] = ($c * $v);
	}
	
	//print_r ($array);
	$Perf = round(array_sum($array)/count($array), 1);
	//echo $Perf;
	$arrayMulti[$row['racer_name']]  = array($Avg, $Races, $Wins, $AvgPos, $stuff1, $row['id'], $Perf);

	$raceray[$row['racer_name']] = round(array_sum($races)/count($races), 1);

	$scorray = "";
	$races = "";
	$i = "";
}

foreach ($raceray as $d => $g)  {if ($g == 0) unset ($raceray[$d]); }

asort($raceray);

echo '<center>Statistics sorted by average overall position.<br><table>';

echo '<tr><td><div class="blue"><b>Racer</b></div></td>
<td width="50"><div class="blue"><b>Avg.</b></div></td>
<td width="50"><div class="blue"><b>Races</b></div></td>
<td width="50"><div class="blue"><b>Wins</b></div></td>
<td width="70"><div class="blue"><b>Avg. Pos.</b></div></td>
<td width="70"><div class="blue"><b>Perf.</b></div></td>
';

foreach ($raceray as $sdf => $fds)
{
	echo '<tr><td><div class="blue"><a href="viewracer.php?racer=' .$arrayMulti[$sdf][5].  '">' .$arrayMulti[$sdf][4].$sdf.' </a></div></td>
	<td width="50"><div class="blue">'  .$arrayMulti[$sdf][0].  '</div></td>
	<td width="50"><div class="blue">'  .$arrayMulti[$sdf][1].   '</div></td>
	<td width="50"><div class="blue">'  .$arrayMulti[$sdf][2].   '</div></td>
	<td width="70"><div class="blue">'  .$arrayMulti[$sdf][3].   '</div></td>
	<td width="70"><div class="blue">'  .$arrayMulti[$sdf][6].   '</div></td></tr>';
}

echo '</table></center>';

 ?>
					</div>
				</div>
			
		</div>
	</div>

		<div id="rightbar"><?php include('rand.php'); ?></div>
		
	<div>
<div id="footer"></div>
</div>
</body>
</html>
