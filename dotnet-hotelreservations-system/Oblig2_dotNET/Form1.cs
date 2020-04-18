using System;
using System.Data;
using System.Drawing;
using System.Windows.Forms;
using System.Xml;
using MySql.Data.MySqlClient;
using System.IO;
using System.Xml.Linq;

namespace Oblig2_dotNet {
	public partial class Form1 : Form {
        private MySqlConnection conn;
        private MySqlCommand command;
        private MySqlDataAdapter dataAdapter;
        private DataSet dataSet;
	    private DataSet romBestilling;
        private MySqlCommandBuilder commandBuilder;
        private String connectionString;
        private BindingSource bs = new BindingSource();
        
        public Form1() {
			InitializeComponent();
        }

		private void Form1_Load(object sender, EventArgs e) {
            connectionString = "Database=oblig2_prg;Data Source=localhost;user=root";
            conn = new MySqlConnection(connectionString);
            String visRader = "SELECT * FROM leietaker";
            command = new MySqlCommand(visRader, conn);
            dataAdapter = new MySqlDataAdapter(command);
            commandBuilder = new MySqlCommandBuilder(dataAdapter);
            dataSet = new DataSet("leietaker");
            HentGjesteListe(); //fyller datagridview fra dataset
            dataSet.WriteXml("leietakere.xml", XmlWriteMode.WriteSchema);
            ReglerDragDrop(); //tillater muligheter for drag&drop
            //debug
            Console.WriteLine("shits working yo");
        }

		private void registrerGjestKnapp_Click(object sender, EventArgs e) {
            try {
                DataRow dataRow;
                dataRow = dataSet.Tables["leietaker"].NewRow();
                dataRow["id"] = 0;
                dataRow["fornavn"] = fornavn1.Text;
                dataRow["etternavn"] = etternavn1.Text;
                dataRow["telefon_nr"] = tlf1.Text;
                dataRow["fra_dato"] = opphold1.Text;
                dataRow["til_dato"] = opphold2.Text;
                dataSet.Tables["leietaker"].Rows.Add(dataRow);
                dataAdapter.Update(dataSet, "leietaker");
                MessageBox.Show(fornavn1.Text + " " + etternavn1.Text + " Har reservert et rom fra " + opphold1.Text + " til " + opphold2.Text);
                conn.Close();
            } catch (Exception f) {
                MessageBox.Show(f.Message);
            }
        }

		private void monthCalendar1_DateChanged(object sender, DateRangeEventArgs e) {
			opphold1.Text = monthCalendar1.SelectionRange.Start.ToShortDateString();
		}

		private void monthCalendar2_DateChanged(object sender, DateRangeEventArgs e) {
			opphold2.Text = monthCalendar2.SelectionRange.Start.ToShortDateString();
		}
        
        public void forste_Paint(object sender, PaintEventArgs e) {
            int i, j;
            for (i = 1; i <= 5; i++) {
                for (j = 1; j <= 3; j++) {
                    Panel pan1 = new Panel();
                    pan1.Location = new Point(i * 110, j * 101);
                    pan1.Width = 100;
                    pan1.Height = 100;
                    pan1.Name = "Rom " + (((i * 4) - 3) + (j - 1));
                    pan1.BackColor = Color.Green;
                    pan1.AllowDrop = true;
                    pan1.Visible = true;

                    //hendelse for panel
                    pan1.DragEnter += new DragEventHandler(this.panel1_DragEnter);
                    pan1.DragDrop += new DragEventHandler(this.panel1_DragDrop);
                    //labels
                    Label lab = new Label();
                    lab.Location = new Point(10, 10);
                    lab.Width = 150;
                    lab.Text = pan1.Name;
                    pan1.Controls.Add(lab);
                    //legger til panelene i tabcontrol
                    forste.Controls.Add(pan1);
                }
            }
        }

        private void andre_Paint(object sender, PaintEventArgs e) {
             int k, l;
             for (k = 1; k <= 5; k++) {
                 for (l = 1; l <= 3; l++) {
                     Panel pan = new Panel();
                     pan.Location = new Point(k * 110, l * 101);
                     pan.Width = 100;
                     pan.Height = 100;
                     pan.Name = "2. etasje, rom " + (((k * 4) - 3) + (l - 1));
                     pan.BackColor = Color.Green;
                     pan.AllowDrop = true;
                     pan.Visible = true;

                     //hendelse for panel
                     pan.DragEnter += new DragEventHandler(this.panel2_DragEnter);
                     pan.DragDrop += new DragEventHandler(this.panel2_DragDrop);

                     //labels
                     Label lab = new Label();
                     lab.Location = new Point(10, 10);
                     lab.Width = 150;
                     lab.Text = pan.Name;
                     pan.Controls.Add(lab);
                     //legger til panelene i tabcontrol
                     andre.Controls.Add(pan);
                 }
             }
        }
        
        private void tredje_Paint(object sender, PaintEventArgs e) {
            int m, n;
            for (m = 1; m <= 5; m++) {
                for (n = 1; n <= 3; n++) {
                    Panel pan = new Panel();
                    pan.Location = new Point(m * 110, n * 101);
                    pan.Width = 100;
                    pan.Height = 100;
                    pan.Name = "3. etasje, rom " + (((m * 4) - 3) + (n - 1));
                    pan.BackColor = Color.Green;
                    pan.AllowDrop = true;
                    pan.Visible = true;

                    //hendelse for panel
                    pan.DragEnter += new DragEventHandler(this.panel3_DragEnter);
                    pan.DragDrop += new DragEventHandler(this.panel3_DragDrop);

                    //labels
                    Label lab = new Label();
                    lab.Location = new Point(10, 10);
                    lab.Width = 150;
                    lab.Text = pan.Name;
                    pan.Controls.Add(lab);
                    //legger til panelene i tabcontrol
                    tredje.Controls.Add(pan);
                }
            }
        }

        //drag & drop handlers:
        private void panel1_DragEnter(object sender, DragEventArgs e) {
            if (e.Data.GetDataPresent(DataFormats.Text)) e.Effect = DragDropEffects.Copy;
        }

        public void panel1_DragDrop(object sender, DragEventArgs e) {
            ReserverRom(sender, e);
        }

        private void panel2_DragEnter(object sender, DragEventArgs e) {
            if (e.Data.GetDataPresent(DataFormats.Text)) e.Effect = DragDropEffects.Copy;
        }

        public void panel2_DragDrop(object sender, DragEventArgs e) {
            ReserverRom(sender, e);
        }

        private void panel3_DragEnter(object sender, DragEventArgs e) {
            if (e.Data.GetDataPresent(DataFormats.Text)) e.Effect = DragDropEffects.Copy;
        }

        public void panel3_DragDrop(object sender, DragEventArgs e) {
            ReserverRom(sender,e);
        }

        private void textbox1_DragEnter(object sender, DragEventArgs e) {
            if(e.Data.GetDataPresent(DataFormats.Text)) e.Effect = DragDropEffects.Copy;
        }

        private void textbox1_DragDrop(object sender, DragEventArgs e) {
            textbox1.Text = (string) e.Data.GetData(DataFormats.Text);
        }
        
        private void dataGridView1_MouseDown(object sender, MouseEventArgs e) {
            if (e.Button.Equals(MouseButtons.Right)) {
                if (dataGridView1.SelectedCells.Count >= 5) { //dragdrop er kun tillat om du har valgt 5 eller fler celler
                    this.DoDragDrop(dataGridView1.CurrentCell.Value, DragDropEffects.Copy);
                }
            }
        }

        public void HentGjesteListe() {
            dataAdapter.Fill(dataSet, "leietaker");
            dataGridView1.DataSource = dataSet;
            dataGridView1.DataMember = "leietaker";
        }

        public void ReglerDragDrop() {
            textbox1.AllowDrop = true;
            dataGridView1.MouseDown += new MouseEventHandler(dataGridView1_MouseDown);            
            textbox1.DragEnter += new DragEventHandler(textbox1_DragEnter);
            textbox1.DragDrop += new DragEventHandler(textbox1_DragDrop);
        }

        private void ReserverRom(object sender, DragEventArgs e) {
            textbox1.Text = (string)e.Data.GetData(DataFormats.Text);
            Control c = (Control)sender;
            if (c != null) {
                //bruker drar et navn fra gjesteliste til et rom
                c.Controls[0].Text  = c.Controls[0].Text;
                c.BackColor = Color.Red;
                //når bruker drar navn til et rom, blir dette skrevet til en xml-fil i bin.
                string filSti = "Rombestillinger.xml";
                if (File.Exists(filSti) == false) {
                    XmlTextWriter xmlSkriver = new XmlTextWriter(filSti, null);
                    xmlSkriver.WriteStartElement("Bestillinger");
                    xmlSkriver.WriteEndElement();
                    xmlSkriver.Close();
                } else {
                    XElement xml = XElement.Load(filSti);
                    xml.Add(new XElement("Bestilling", new XElement("Navn", textbox1.Text), new XElement("Rom", c.Controls[0].Text)));
                    xml.Save(filSti); //todo: hvorfor blir dette skrevet til fil to ganger?
                    MessageBox.Show(textbox1.Text + " bor nå på rom: " + c.Controls[0].Text);
                }
            }
        }
    }

}