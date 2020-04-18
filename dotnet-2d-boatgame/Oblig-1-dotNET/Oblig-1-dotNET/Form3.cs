using System;
using System.Windows.Forms;
using System.Xml;

namespace Oblig_1_dotNET
{
    public partial class Form3 : Form
    {
        public Form3()
        {
            InitializeComponent();
        }

        private void Form3_Load(object sender, EventArgs e)
        {
            FormBorderStyle = FormBorderStyle.FixedSingle;
            LesXml();
        }

        private void LesXml()
        {
            string filSti = "Resources/PoengListe.xml";

            XmlTextReader xr = new XmlTextReader(filSti);

            PoengListeFelt.AppendText("HighScores!");

            while (xr.Read())
            {
                if (xr.NodeType == XmlNodeType.Element)
                {
                    xr.Read();
                    PoengListeFelt.Text += " " + xr.Value;
                }
            }
        }

    }
}
