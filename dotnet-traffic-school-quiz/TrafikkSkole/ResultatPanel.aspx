<%@ Page Title="" Language="C#" MasterPageFile="~/Site.Master" AutoEventWireup="true" CodeBehind="ResultatPanel.aspx.cs" Inherits="Trafikkskole.ResultatPanel" %>
<asp:Content ID="BodyContent" ContentPlaceHolderID="MainContent" runat="server">

    <div class="jumbotron" style="background-image: url(http://www.driversgb.com/edit/files/u17_courses/u17-d1.jpg); background-size:100%">
        <h1>JorSen Trafikkskole</h1>
        <p class="lead">Velkommen til JorSen Trafikkskoleskole. Her kan du enkelt se hvordan du ligger ann til Teoriprøven, ved og teste dine kunnskaper.</p>
        <p><a href="Account/Login.aspx" class="btn btn-primary btn-lg">Logg Inn &raquo;</a></p>
    </div>

    
            <asp:Label ID="velkomstMelding" runat="server" Text="Label"></asp:Label><br />

        <div class="form-group">
                        Brukernavn<br />
                        <div class="col-md-10">
                            <asp:TextBox runat="server" ID="brukerInput" CssClass="form-control" />
                            <asp:RequiredFieldValidator runat="server" ControlToValidate="brukerInput"
                                CssClass="text-danger" ErrorMessage="Du må fylle inn et brukernavn" />
                            
                            </div>
            </div>
        <div class="form-group">
                        <div class=" col-md-10">
                            <asp:Button runat="server" ID="Button2" OnClick="sokKnapp_Click" Text="Søk" CssClass="btn btn-default" />
                        </div>
                    </div>
            <br />
            

            <asp:PlaceHolder ID="brukerResultat" runat="server"></asp:PlaceHolder>
            

    
    <br />
    <br />
    <br />

</asp:Content>
