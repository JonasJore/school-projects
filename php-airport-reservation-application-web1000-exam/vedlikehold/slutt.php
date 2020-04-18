		</div>
		</div>
	</div>
</div>

<div class="navbar navbar-fixed-bottom">
	<footer class="text-center">Bjarum Airlines - <a href="../nettsted/index.php"><strong>BjarumAirlines.no</strong></a></footer>
</div>
<!-- /.modal -->
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.js"></script>
		<script src="js/jquery-ui.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
		<script src="js/custom.js"></script>
		<script>
		$(document).ready(function () {
			$('.datatable').DataTable( {
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
		} );
		</script>
	</body>
</html>
