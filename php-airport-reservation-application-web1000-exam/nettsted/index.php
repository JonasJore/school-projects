<?php
include 'start.php';
 ?>


    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <img class="img-responsive img-rounded" src="bilder/flyvertinne.jpg" alt="flyvertinne">
            </div>
            <div class="col-md-4">
                <h1>Bjarum Airlines</h1>
                <p>Trenger du et avbrekk i hverdagen? Trenger du en billig og pålitelig flytur til en Europeisk hovedstad? Bestill online og få biletten på sekunder.</p>
                <a name="finnbilett"></a>
                <a class="btn btn-primary btn-lg" href="flyavganger.php">Våre ruter</a>
            </div>
          </div>
          <a name="#finnbilett"></a>
        <hr>

<!--  OLA SITT FORSLAG??-->
<?php include'indexsok.php';?>
<hr>

        <div class="row">
            <div class="col-md-4" style="padding-right:20px; border-right: 1px solid #ccc;">
                <h2>Reisemål</h2>
                <p>Er du på leting etter nye steder å utforske? Vi har både innelandsflygninger, men også til europeiske hovedstader. Se komplett liste over alle av Bjarum Airlines reisemål.</p>
                <a href="flyavganger.php" class="btn btn-primary btn-info"><span class="glyphicon glyphicon-list"></span> Se alle flygninger</a>
            </div>
            <div class="col-md-4" style="padding-right:20px; border-right: 1px solid #ccc;">
                <h2>Kundeomtaler</h2>
                <p>Usikker på om Bjarum Airlines er riktig flyselskap for deg? Les våre brukeranmeldelser lagt igjen av andre reisende. Både ris og ros er viktig for at vi skal kunne levere det best mulige produktet.</p>
                <a href="#" class="btn btn-primary btn-info"><span class="glyphicon glyphicon-pencil"></span> Hvorfor reise med oss?</a>
            </div>
            <div class="col-md-4">
                <h2>Din reise</h2>
                <p>Husker du ikke når ditt fly går?</p>
                <p>Har du oppgitt feil personinformasjon?</p>
                <p>Gjør endringer i din reise!</p>
                <a href="minbooking.php" class="btn btn-primary btn-info"><span class="glyphicon glyphicon-plane"></span> Din Booking</a>
            </div>
          </div>


<?php
include 'slutt.php';
?>
