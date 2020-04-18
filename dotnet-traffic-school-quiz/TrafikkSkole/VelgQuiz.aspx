<%@ Page Title="" Language="C#" MasterPageFile="~/Site.Master" AutoEventWireup="true" CodeBehind="VelgQuiz.aspx.cs" Inherits="Trafikkskole.VelgQuiz" %>
<asp:Content runat="server" ID="BodyContent" ContentPlaceHolderID="MainContent">

    <div class="jumbotron" style="background-image: url(http://www.driversgb.com/edit/files/u17_courses/u17-d1.jpg); background-size:100%">
        <h1>JorSen Trafikkskole</h1>
        <p class="lead">Velkommen til JorSen Trafikkskoleskole. Her kan du enkelt se hvordan du ligger ann til Teoriprøven, ved og teste dine kunnskaper.</p>
        <p><a href="Account/Login.aspx" class="btn btn-primary btn-lg">Logg Inn &raquo;</a></p>
    </div>

    <div class="row">
        <div class="col-md-10">
            <strong>Innstruksjoner:</strong><br />
            <br />
            Det vil dukke opp et og et spørsmål på skjermen din. Hvert spørsmål kan ha 1 eller flere riktig svaralternativer. Trykk på radioknapp eller avkryssningsboks for å markere ditt svar.
            <br />
            Trykk på &quot;Neste&quot; for og gå videre.<br />
            <br />
        </div>
    </div>
    
    <br />
    <br />
    <br />

    
    <div class="row">
        <div class="col-md-10">
             
        <div>
           
            <asp:Label ID="brukerProfilNavn" runat="server" Text="Label"></asp:Label><br />
            <asp:Button ID="loggUtKnapp" runat="server" Text="LOGG UT!" OnClick="loggUtKnapp_Click" /><br />
            
            <asp:PlaceHolder ID="quizListe" runat="server"></asp:PlaceHolder>
               
        </div>
        


    </div>
</asp:Content>

