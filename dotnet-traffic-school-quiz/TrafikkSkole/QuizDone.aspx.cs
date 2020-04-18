using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using TrafikkSkole;

namespace Trafikkskole
{
    public partial class QuizDone : System.Web.UI.Page
    {
        private double passeGrense;
        private string numCorrect;
        private string uN;
        private string QuizPoints;

        public Database db = new Database();
        protected void Page_Load(object sender, EventArgs e)
        {
            uN = Session["userName"].ToString();
            QuizPoints = Session["marks"].ToString();
            numCorrect = QuizPoints + " / 15";
            passeGrense = 15 * 0.60;

            if (int.Parse(QuizPoints) > passeGrense)
            {
                Label1.Text = "Gratulerer " + uN + "! Du besto quizzen med glans. Nå er du klar for oppkjøring";
                Label2.Text = "Din poengsum ble: " + QuizPoints;
                db.RegisterQuizResults(QuizPoints, uN, numCorrect);
            }
            else
            {
                Label1.Text = "Du  gjorde så godt du kunne " + uN + " men det var ikke godt nok til å bestå testen.";
                Label2.Text = "Din poengsum ble: " + QuizPoints + " - Du må svare riktig på minst 60% av spørsmålene for å bestå";
            }
        }
    }
}