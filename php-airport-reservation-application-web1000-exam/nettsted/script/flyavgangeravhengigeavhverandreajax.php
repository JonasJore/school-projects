<?php
$dbink = '../../vedlikehold/script/dbtilkobling.php';
$funksjonerink = '../../vedlikehold/script/funksjoner.php';
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
@$avreisested=$_GET["av"];
if($avreisested === "undefined"){
	$avreisested="";
}
@$ankomststed=$_GET["an"];
if($ankomststed === "undefined"){
	$ankomststed="";
}
@$fradato=$_GET["fra"];
if($fradato === "undefined"){
	$fradato="";
}
@$tildato=$_GET["til"];
if($tildato === "undefined"){
	$tildato="";
}
@$antbillett=$_GET["ant"];
if($antbillett === "undefined"){
	$antbillett="";
}
@$turretur=$_GET["turretur"];
if($turretur === "undefined"){
	$turretur="";
}
@$timestamp=$_GET["tid"];
@$kommerfra=$_GET["kommerfra"];
$idtildatatable=genererrandomnummer(23);
if($kommerfra){
	if($kommerfra==="fra"){
		listfligths($avreisested,$ankomststed,"til", $fradato, $timestamp, $idtildatatable );
	}
	if($kommerfra === "til"){
		if($turretur=="retur"){
			listfligths($ankomststed,$avreisested,"fra", $tildato, $timestamp, $idtildatatable);
		}
		
	}
}
?>
<script>
function datatables(){
    var startdatatable = $('#<?php echo $idtildatatable;?>').DataTable( {
		"dom": '<"top"l>t<"bottom"ip><"clear">',
		"language": {
			"sEmptyTable": "Ingen data tilgjengelig i tabellen",
			"sInfo": "Viser _START_ til _END_ av _TOTAL_ linjer",
			"sInfoEmpty": "Viser 0 til 0 av 0 linjer",
			"sInfoFiltered": "(filtrert fra _MAX_ totalt antall linjer)",
			"sInfoPostFix": "",
			"sInfoThousands": " ",
			"sLoadingRecords": "Laster...",
			"sLengthMenu": "Vis _MENU_ linjer",
			"sLoadingRecords": "Laster...",
			"sProcessing": "Laster...",
			"sSearch": "S&oslash;k:",
			"sUrl": "",
			"sZeroRecords": "Ingen linjer matcher s&oslash;ket",
			"oPaginate": {
				"sFirst": "F&oslash;rste",
				"sPrevious": "Forrige",
				"sNext": "Neste",
				"sLast": "Siste"
			},
			"oAria": {
				"sSortAscending": ": aktiver for Ã¥ sortere kolonnen stigende",
				"sSortDescending": ": aktiver for Ã¥ sortere kolonnen synkende"
			}
		}
	} );
}
$(document).ready(function(){
	datatables();
});;
$('#fraavgang .trykkbartabell').on('click', '.trykkbar', function(event) {
$(this).addClass('success').siblings().removeClass('success');
});

$('#tilavgang .trykkbartabell').on('click', '.trykkbar', function(event) {
$(this).addClass('success').siblings().removeClass('success');
});
</script>