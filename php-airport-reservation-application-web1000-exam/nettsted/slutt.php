


</div>
</div>
</div>
</div>


	<footer class="footer-distributed" style="position:relative;">

		<div class="footer-left">
			<div>
			<a class="navbar-brand" href="#">Bjarum Airlines</a><img style="max-width:100px; max-height:70px; margin-top: -7px;"  src="bilder/litenlogo.png" alt="logo">
		</div>

			<p class="footer-company-name">Bjarum Airlines &copy; 2016</p>
		</div>

		<div class="footer-center">

			<div>
				<i class="fa fa-map-marker"></i>
				<p><span>Bjarmumsgate 666</span> Tønsberg, Norge</p>
			</div>

			<div>
				<i class="fa fa-phone"></i>
				<p>+47 455 65 445</p>
			</div>

			<div>
				<i class="fa fa-envelope"></i>
				<p><a href="mailto:admin@bjarumairlines.no">admin@bjarumairlines.no</a></p>
			</div>

		</div>

		<div class="footer-right">

			<p class="footer-company-about">
				<span>Hvorfor fly med oss?</span>
				Vi er europas dessidert beste lavpris-selskap. Vi er dedikert til å gi våre kunder den beste opplevelsen i luften.
			</p>

			<div class="footer-icons">

			</div>

		</div>

	</footer>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script src="js/animertscroll.js"></script>
	<script src="js/spin.min.js"></script>
	<script src="js/ladda.min.js"></script>
    <script>
    Ladda.bind( '.ladda-button', { timeout: 2000 } );
	function datatables(){
    var startdatatable = $('table').DataTable( {
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
    </script>
	<script src="../vedlikehold/js/custom.js"></script>
	</body>
</html>
