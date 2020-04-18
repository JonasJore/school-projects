using System;
using System.Windows.Forms;

namespace Oblig_1_dotNET
{
    public partial class Form2 : Form
    {
        public Form1 form1;

        public bool trykket;

        public string spillerNavn {
            get { return SpillerNavn.Text; }
        }
        

        public Form2()
        {
            InitializeComponent();
        }

        private void Form2_Load(object sender, EventArgs e)
        {
            
        }

    

        private void FortsettKnapp_Click(object sender, EventArgs e)
        {
            trykket = true; 
            this.Close();
        }
    }
}

