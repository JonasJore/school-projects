using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using MySql.Data.MySqlClient;
using TrafikkSkole;

namespace Trafikkskole
{
    public partial class ResultatPanel : System.Web.UI.Page
    {
        Database db;
        protected void Page_Load(object sender, EventArgs e)
        
            {
                db = new Database();

                object sesh = Session["userName"];

                if ((string)sesh == "admin" && sesh != null)
                {
                    velkomstMelding.Text = "du er logget inn som " + Session["userName"].ToString() + " velkommen";
                }
                else
                {
                    velkomstMelding.Text = "Du er ikke admin. Dette er ikke interessant";
                    Response.AddHeader("REFRESH", "5;URL=Login.aspx");
                }
            }

            protected void sokKnapp_Click(object sender, EventArgs e)
            {
                db.ResultatListe(brukerInput.Text, brukerResultat);

            }
        
    }
}