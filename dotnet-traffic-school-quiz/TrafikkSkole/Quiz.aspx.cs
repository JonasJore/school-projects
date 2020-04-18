using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;
using MySql.Data.MySqlClient;
using System.Web.UI.HtmlControls;
using TrafikkSkole;

namespace Trafikkskole
{
    public partial class Quiz : System.Web.UI.Page
    {
        private Database db = new Database();
        private int numberOfQuestionsanswered;
        private int antallPoeng;
        private int quizQuestion;



        protected void Page_Load(object sender, EventArgs e)
        {
            string userName = Session["userName"].ToString();

            if (userName != null)
            {
                db.Quiz(questionsDiv, answerDiv, correct, questionText, answerChoice);

                if (Session["QuestionsAnswered"] != null)
                {
                    object something = Session["QuestionsAnswered"];
                    string QuestionsAnswered = something.ToString();
                    numberOfQuestionsanswered = int.Parse(QuestionsAnswered);

                    if (Session["marks"] != null)
                    {
                        object something2 = Session["marks"];
                        string ddd = something2.ToString();
                        antallPoeng = int.Parse(ddd);
                    }

                }

            }
        }

        protected void nesteKnapp_Click(object sender, EventArgs e)
        {
            numberOfQuestionsanswered++;
            Session["QuestionsAnswered"] = numberOfQuestionsanswered;
            Label1.Text = numberOfQuestionsanswered.ToString();

            CheckQuizFinished();
            CheckCorrecto();

        }

        private void CheckQuizFinished()
        {
            if (numberOfQuestionsanswered >= 16)
            {
                Response.Redirect("~/QuizDone.aspx");
            }
        }

        private void CheckCorrecto()
        {
            if (correct.Checked == true)
            {
                antallPoeng++;
                Session["marks"] = antallPoeng;
                Label2.Text = antallPoeng.ToString();
                Label2.BackColor = System.Drawing.Color.White;
                Label2.ForeColor = System.Drawing.Color.Black;

            }
            else
            {
                Label2.Text = "Forrige var feil";
                Label2.ForeColor = System.Drawing.Color.White;
                Label2.BackColor = System.Drawing.Color.Red;
            }
        }

    }
}