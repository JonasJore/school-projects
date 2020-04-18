using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Data;
using MySql.Data.MySqlClient;
using System.Web.UI.WebControls;
using System.Text;
using System.Configuration;
using System.Data.SqlClient;
using System.Web.UI.HtmlControls;
using System.Web.UI;
using System.IO;
using System.Text.RegularExpressions;


namespace TrafikkSkole
{
    public class Database : System.Web.UI.Page
    {
        public MySqlConnection conn;
        public MySqlCommand msc;
        public MySqlCommand command;
        public MySqlCommand questionsCommand;
        public MySqlDataAdapter adapter;
        public MySqlCommandBuilder builder;
        public StringBuilder tables;
        public MySqlDataReader dataReader;
        public MySqlDataReader reader;
        public MySqlCommand commandCheck;
        public int point = 0;
        public string correct = "correct";
        public string questionId;

        public Database()
        {
            Login login = new Login();
            string connectionString = "server=jonasjore.mysql.domeneshop.no;" +
                                      "user id=jonasjore;" +
                                      "password=4AwmjLDVFVB4wE8;" +
                                      "persistsecurityinfo=True;" +
                                      "database=jonasjore";

            conn = new MySqlConnection(connectionString);
            conn.Open();
        }

        public void LoginCheck(string user, string pass)
        {
            string sql = "SELECT * FROM user WHERE username = @username AND password = @password";
            msc = new MySqlCommand(sql, conn);
            msc.CommandType = CommandType.Text;

            msc.Parameters.AddWithValue("@username", user);
            msc.Parameters.AddWithValue("@password", pass);

            dataReader = msc.ExecuteReader();
        }

        public void RegisterUser(string uN, string pwd, string fn, string ln, string tlf, string link)
        {
            using (conn)
            {
                string registerSql = "INSERT INTO user (`username`, `password`, `firstName`, `lastName`, `tlf_number`, `profilePicture`) " +
                                     "VALUES (@userName, @password, @firstname, @lastname, @tlf, @profilepic)";
                msc = new MySqlCommand(registerSql, conn);
                msc.CommandType = CommandType.Text;

                msc.Parameters.AddWithValue("@userName", uN);
                msc.Parameters.AddWithValue("@password", pwd);
                msc.Parameters.AddWithValue("@firstname", fn);
                msc.Parameters.AddWithValue("@lastname", ln);
                msc.Parameters.AddWithValue("@tlf", tlf);
                msc.Parameters.AddWithValue("@profilepic", link);

                dataReader = msc.ExecuteReader();
                conn.Close();

            }

        }

        public void RegisterQuizResults(string sC, string uN, string nC)
        {
            using (conn)
            {
                string registerQuizScoreSql = "INSERT INTO `jonasjore`.`results` (`Resultat`, `brukernavn`, `antall_riktige`) " +
                                              "VALUES (@score, @userName, @numCorrect)";
                msc = new MySqlCommand(registerQuizScoreSql, conn);
                msc.CommandType = CommandType.Text;

                msc.Parameters.AddWithValue("@score", sC);
                msc.Parameters.AddWithValue("@userName", uN);
                msc.Parameters.AddWithValue("@numCorrect", nC);

                dataReader = msc.ExecuteReader();
                conn.Close();
            }
        }

        public void FetchRows(string table, PlaceHolder holder)
        {
            using (conn)
            {
                using (command = new MySqlCommand("SELECT * FROM " + table, conn))
                {
                    tables = new StringBuilder();
                    var reader = command.ExecuteReader();
                    tables.Append("<table>");
                    tables.Append("<tr><th>Quiz Navn</th><th>Antall spørsmål</th></tr>");

                    if (reader.HasRows)
                    {
                        while (reader.Read())
                        {
                            tables.Append("<tr><td>" + reader[1] + "</td><td>" + reader[2] + "</td><td><a href='Quiz.aspx'>Velg quiz</a></td></tr>");
                        }
                    }
                    else
                    {
                        tables.Append("Ingen resultater. Sjekk spørring mot db");
                    }

                    tables.Append("</table>");
                    holder.Controls.Add(new Literal
                    {
                        Text = tables.ToString()
                    });

                    reader.Close();
                    reader.Dispose();
                    conn.Close();
                }
            }

        }

        public void Quiz(HtmlGenericControl questionsDiv, HtmlGenericControl answersDiv, RadioButton rb, Label questionLabel, PlaceHolder answers)
        {
            string quizSql = "SELECT idquestions, question, image, correct_answer, answer_1, asnwer_2, answer_3 " +
                             "FROM questions " +
                             "JOIN jonasjore.answers " +
                             "ON questions.idquestions = answers.questions_idquestions " +
                             "ORDER BY RAND()" +
                             "LIMIT 1";

            string fetchdat = "SELECT correct_answer, answer_1, asnwer_2, answer_3 FROM answers";

            StringBuilder sb = new StringBuilder();
            questionsCommand = new MySqlCommand(quizSql, conn);
            reader = questionsCommand.ExecuteReader();
            HtmlGenericControl newLine = new HtmlGenericControl("br");


            if (reader.HasRows)
            {
                while (reader.Read())
                {
                    questionsDiv.Controls.Add(questionLabel);
                    questionLabel.Text = reader.GetString("question");

                    //reader[3] peker mot correct_answer i gjeldende spørring.
                    rb.Text = reader[3].ToString();
                    rb.ID = "spm";
                    rb.GroupName = "spm";
                    rb.Checked = false;


                    string[] answersAlternativer = { reader[4].ToString(), reader[5].ToString(), reader[6].ToString() };

                    for (int i = 0; i < answersAlternativer.Length; i++)
                    {
                        RadioButton rbelse = new RadioButton();
                        rbelse.Text = answersAlternativer[i];
                        rbelse.GroupName = "spm";
                        rbelse.Checked = false;
                        answersDiv.Controls.Add(rbelse);
                        answersDiv.Controls.Add(new LiteralControl("<br/>"));

                    }

                    answersDiv.Controls.Add(rb);

                    sb.Append("<div ID='quizImg'>" +
                              "    <img src='" + reader[2] + "' width='292px' length='203px' value='" + reader[2] + "'/>" +
                              "</div><br>");


                    Label question = new Label();

                    questionsDiv.Controls.Add(question);

                    //question.Text = writeCorrectAnswer(correctAnswer);

                }

                answers.Controls.Add(new Literal
                {
                    Text = sb.ToString()
                });

            }
            else
            {
                questionLabel.Text = "Ingen spørsmål. Sjekk spørring mot db.";
            }
        }

        public void ResultatListe(string bN, PlaceHolder bR)
        {
            using (conn)
            {
                string finnBrukerNavnSql = "SELECT resultat, brukernavn, antall_riktige FROM results WHERE brukernavn = @brukernavn ORDER BY resultat DESC";
                msc = new MySqlCommand(finnBrukerNavnSql, conn);
                msc.CommandType = CommandType.Text;
                msc.Parameters.AddWithValue("@brukernavn", bN);
                StringBuilder sb = new StringBuilder();
                reader = msc.ExecuteReader();
                if (reader.HasRows)
                {

                    sb.Append("<table class='table table - striped'>");
                    sb.Append("<tr><th>Resultat</th><th>Brukernavn</th><th>Antall riktige</th></tr>");

                    while (reader.Read())
                    {
                        sb.Append("<tr><td>" + reader[0] + "</td><td>" + reader[1] + "</td><td>" + reader[2] + "</td></tr>");
                    }

                    sb.Append("</table>");


                }
                else
                {
                    sb.Append("Ingen resultater på brukernavn: " + bN.ToString());
                }
                bR.Controls.Add(new Literal { Text = sb.ToString() });
                conn.Close();
            }

        }

    }
}
