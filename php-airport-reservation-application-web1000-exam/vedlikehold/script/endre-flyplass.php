<?php
$dbink = 'dbtilkobling.php';
$funksjonerink = 'funksjoner.php';
$dbinkfinnes=false;
$funksjonerinkfinnes=false;
$ink = get_included_files();
foreach ($ink as $fil) {
    if($dag=strpos($fil, $dbink) !== false){
		$dbinkfinnes=true;
	}
	if($dag=strpos($fil, $funksjonerink) !== false){
		$funksjonerinkfinnes=true;
	}
}
if($dbinkfinnes===false)
{
	include $dbink;
}
if($funksjonerinkfinnes===false)
{
	include $funksjonerink;
}
?>
<div class="col-md-12">
  <div class="panel panel-default">
	  <?php panelheader("Endre/slett flyplasser",1);?>
		<div class="table-responsive">
		  <table class="table table-hover table-condensed datatable">
				<thead>
					<tr>
						<th>Navn</th>
						<th>By</th>
						<th>Land</th>
						<th>Forkortelse</th>
						<th class="text-center">Endre</th>
						<th class="text-center">Slett</th>
					</tr>
				</thead>
				<tbody>
				  <?php
				  $fra="flyplass";
				  $sql="SELECT * FROM christensen2.flyplass;";
				  $res=mysqli_query($db,$sql) or die("feil i sql kan ikke hente fra tabell.(1)");
				  $antall=antall($sql);
				  for($r=0;$r<$antall;$r++)
				  {
					$rad=mysqli_fetch_array($res);
					$id=$rad["id"];
					$navn=$rad["navn"];
					$by=$rad["by"];
					$land=$rad["land"];
					$forkortelse=$rad["forkortelse"];
					echo "<tr>
							<td>$navn</td>
							<td>$by</td>
							<td>$land</td>
							<td>$forkortelse</td>
							<td class='text-center'><a href='endre.php?fra=$fra&id=$id'><i class='glyphicon glyphicon-cog'></i></a></td>
							<td class='text-center'><a href='slett.php?fra=$fra&id=$id' onClick=\"return slett()\"><i class='glyphicon glyphicon-trash'></i></a></td>
						  </tr>";
				  }

				   ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
