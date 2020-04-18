using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using MySql.Data.MySqlClient;
using TrafikkSkole;

namespace Trafikkskole.Account
{
    public partial class Register : Page
    {


        Database db = new Database();


        protected void Page_Load(object sender, EventArgs e)
        {

        }

        public void RegisterButton_Click(object sender, EventArgs e)
        {
            db.RegisterUser(username.Text, password.Text, firstName.Text, lastName.Text, tlfNumber.Text, profilePicture.Text);
        }
    }
}