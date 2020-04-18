using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using MySql.Data.MySqlClient;
using System.Data;
using System.Text;
using TrafikkSkole;

namespace Trafikkskole
{
    public partial class VelgQuiz : System.Web.UI.Page
    {
        Database db = new Database();
        protected void Page_Load(object sender, EventArgs e)
        {
            if (Session["userName"] != null)
            {
                brukerProfilNavn.Text = Session["userName"].ToString() + " er logget inn";

                db.FetchRows("quiz", quizListe);
            }
            else
            {
                brukerProfilNavn.Text = "Hvordan i all verden kom du deg hit?! :(<br/>Sender deg til index om 5 sek.";
                Response.AddHeader("REFRESH", "5;URL=Default.aspx");
            }
        }
        
        

        protected void loggUtKnapp_Click(object sender, EventArgs e)
        {
            Session.Clear();
            Response.AddHeader("REFRESH", "0;URL=Account/Login.aspx");
        }
    }
}
