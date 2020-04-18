using System;
using MySql.Data.MySqlClient;
using System.Data;
using TrafikkSkole;

namespace Trafikkskole.Account
{
    public partial class  Login : System.Web.UI.Page 
    {

        Database db;
        public MySqlConnection conn;
        public MySqlCommand msc;
        public MySqlDataAdapter adapter;
        private string sql;
        private bool existingUser;
        private DataTable table = new DataTable();
        private DataSet dataset = new DataSet();
        public string user;
        public string pass;


        public void Page_Load(object sender, EventArgs e)
        {
           db = new Database();
        }

       

        protected void LogIn(object sender, EventArgs e)
        {
            user = userName.Text.ToString();
            pass = userPassword.Text.ToString();

            db.LoginCheck(user, pass);

            if (db.dataReader != null && db.dataReader.HasRows)
            {
                existingUser = true;
                Session["userName"] = this.userName.Text;
                Session["password"] = this.userPassword.Text;
                Response.Redirect("~/VelgQuiz.aspx");
                conn.Close();
            }
            else
            {
                //existingUser = false;
                //labelbrukernavn.Text = "Noe gikk feil. dobbeltsjekk";
            }
        }
    }
}
