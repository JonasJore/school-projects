<%@ Page Title="" Language="C#" MasterPageFile="~/Site.Master" AutoEventWireup="true" CodeBehind="Quiz.aspx.cs" Inherits="Trafikkskole.Quiz" %>
<asp:Content runat="server" ID="BodyContent" ContentPlaceHolderID="MainContent">

    <div class="jumbotron" style="background-image: url(http://www.driversgb.com/edit/files/u17_courses/u17-d1.jpg); background-size:100%">
        <h1>JorSen Trafikkskole</h1>
        <p class="lead">Velkommen til JorSen Trafikkskoleskole. Her kan du enkelt se hvordan du ligger ann til Teoriprøven, ved og teste dine kunnskaper.</p>
        <p><a href="Account/Login.aspx" class="btn btn-primary btn-lg">Logg Inn &raquo;</a></p>
    </div>

    <div class="row">
        <div class="col-md-10">
            <strong>Velkommen Til Teoriprøven</strong><br />
            <br />
           Du må ha en riktig svarprosent på 60% for at highscore skal bli lagret.
            <br />
            Trykk på &quot;Neste&quot; for og gå videre.<br />
            <br />
        </div>
    </div>
    
    <br />
    <br />
    <br />

    
    <div class="row">
     
       
            
        <div id="questionsDiv" runat="server">
            <asp:Label ID="questionText" runat="server" Text="Label"></asp:Label><br />
        </div>
            
        <div id="answerDiv" runat="server">
            <asp:RadioButton ID="correct" name="spm" runat="server" />
            <asp:PlaceHolder ID="answerChoice" runat="server"></asp:PlaceHolder>
            
        </div>
        <asp:Button ID="nesteKnapp" runat="server" Text="Button" OnClick="nesteKnapp_Click" />

        Antall spørsmål besvart:    <asp:Label ID="Label1" runat="server" Text="0"></asp:Label> / 15 <br />
        Antall riktige hittil:      <asp:Label ID="Label2" runat="server" Text="0"></asp:Label>
                

         
    </div>

    </asp:Content>


