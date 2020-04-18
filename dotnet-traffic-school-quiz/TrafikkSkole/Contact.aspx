<%@ Page Title="Contact" Language="C#" MasterPageFile="~/Site.Master" AutoEventWireup="true" CodeBehind="Contact.aspx.cs" Inherits="Trafikkskole.Contact" %>

<asp:Content ID="BodyContent" ContentPlaceHolderID="MainContent" runat="server">
    <h2><%: Title %>.</h2>
    <h3>Har du spørsmål, ta kontakt!</h3>
    <address>
        Jorsen Trafikkskole<br />
        Bakkenteigen, Borre<br />
        <abbr title="Phone">TLF</abbr>
        959 59 559
    </address>

    <address>
        <strong>Support:</strong>   <a href="mailto:Support@JorsenTS.no">Support@JorsenTS.no</a><br />
        <strong>Marketing:</strong> <a href="mailto:Bestilling@JorsenTS.no">Bestilling@JorsenTS.no</a>
    </address>
</asp:Content>
