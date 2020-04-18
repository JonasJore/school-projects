using System;
using System.Collections.Generic;
using System.Drawing;
using System.IO;
using System.Media;
using System.Windows.Forms;
using System.Xml;
using System.Xml.Linq;

namespace Oblig_1_dotNET
{
    public partial class Form1 : Form
    {
        private bool fiendeTreff;
        private Fiende fiende;
        private int sekundTeller;
        private List<Fiende> fiendeListe = new List<Fiende>();
        public Form2  form2 = new Form2();
        public Form3 form3 = new Form3();

        
        public Form1()
        {
            InitializeComponent();
            
            Random r = new Random();
            spiller = new spiller();
            fiende = new Fiende(r);

            //bestemmer hvor mange fiendebåter som blir tegnet på brettet.
            for(int i = 0; i < 4; i++)
            {
                fiendeListe.Add(new Fiende(r));
            }
            
        }
        
        private spiller spiller;
        
        private void Form1_Load(object sender, EventArgs e)
        {
            
            FormBorderStyle = FormBorderStyle.FixedSingle;
            Size s = new Size(800,780);
            ClientSize = s;

            timer.Enabled = true;
        }

        private void Form1_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.Escape)
            {
                this.Close();
            }

            if (e.KeyCode == Keys.Right)
            {
                spiller.SpillerFlyttHoyre();
            }

            if (e.KeyCode == Keys.Left)
            {
                spiller.SpillerFlyttVenstre();
            }

            if (e.KeyCode == Keys.Space)
            {
                if(spiller.skuddAvfyrt == false)
                {
                    spiller.AvfyrSkudd();
                }
            }

            if(e.KeyCode == Keys.P) //Spiller kan trykke på P for å pause
            {
                timer.Stop();
                spiller.StoppSkuddLyd();
            }

            if (e.KeyCode == Keys.R) //Spiller kan trykke R for å gjennoppta et spill
            {
                timer.Start();
            }

        }

        public void skjerm_Paint(object sender, PaintEventArgs e)
        {
            spiller.tegnSpiller(e);
            
            foreach(Fiende f in fiendeListe)
            {
                f.TegnFiende(e);
            }

            if (spiller.skuddAvfyrt)
            {
                spiller.TegnSkudd(e);
                spiller.FlyttSkudd();
            }
        }
        /*
        * Under finner du en metode som gjør at fiender ikke blinker når de beveger seg over skjermen
        * Denne koden bidrar til at bevegelse i form ser mer smooth ut.
        * Kilde: http://stackoverflow.com/questions/2612487/how-to-fix-the-flickering-in-user-controls
        */
        protected override CreateParams CreateParams {
            get {
                CreateParams cp = base.CreateParams;
                cp.ExStyle = 0x02000000;
                return cp;
            }
        }

        public void timer_Tick(object sender, EventArgs e)
        {
            sekundTeller = sekundTeller + 1;
            Tid_igjen.Text = TidIgjenKlokke(sekundTeller);

            SpillOverSjekk();
                
            foreach(var f in fiendeListe)
            {
                //finner hjørneverdiene til skudd og fiendebåter for å kunne sjekke om bildene kolliderer med hverandre.
                int fiendeX1 = f.x;
                int fiendeX2 = f.x + f.fiendeBredde;
                int fiendeY1 = f.y;
                int fiendeY2 = f.y + f.fiendeHoyde;
                int skuddX1 = spiller.xSkudd;
                int skuddX2 = spiller.xSkudd + spiller.skuddBredde;
                int skuddY1 = spiller.ySkudd;
                int skuddY2 = spiller.ySkudd + spiller.skuddHoyde;

                f.flyttFiende();

                if ((fiendeX2 >= skuddX1 && fiendeX1 <= skuddX2) && (fiendeY2 >= skuddY1 && fiendeY1 <= skuddY2))
                {
                    for (int i = fiendeListe.Count; i >= 0; i--)
                    {
                        f.x = -100; //fiendebåt blir satt tilbake til x: -100 når spiller treffer
                        spiller.ySkudd = -5;
                        fiendeTreff = true;
                        
                        if(f.y <= 200)
                        {
                            PoengValue.Text = (int.Parse(PoengValue.Text) + 2).ToString();
                        } else
                        {
                            PoengValue.Text = (int.Parse(PoengValue.Text) + 1).ToString();
                        }

                        spiller.StoppSkuddLyd();
                    }
                }
            }
            this.Refresh();
        }
        
        

        private void pauseToolStripMenuItem_Click(object sender, EventArgs e)
        {
            timer.Stop();
            spiller.StoppSkuddLyd();
        }

        private void startToolStripMenuItem_Click(object sender, EventArgs e)
        {
            timer.Start();
        }

        private void hvordanSpilleToolStripMenuItem_Click(object sender, EventArgs e)
        {
            MessageBox.Show("Hvordan spille:\n" + "Treff gir 5 poeng\n" + "Treff på båter som er lenger unna gir 10 poeng\n" + "Bevegelse: Høyre og Venstre\n" + "Skudd: SPACEBAR\n" + "Skyt så mange båter du kan før tiden renner ut.\n" + "LYKKE TIL!");
        }

        private void avsluttToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void omToolStripMenuItem1_Click(object sender, EventArgs e)
        {
            MessageBox.Show("Om:\n" + "Dette spillet er laget som obligatorisk oppgave i faget IS-PRG2000\n" + "Programmert av Jonas Jore");
        }

        private String TidIgjenKlokke(int i)
        {
            int t, m, s;
            string ts, ms, ss;
            t = (i / 3600) % 24;
            m = (i / 60) % 60;
            s = i % 60;

            if (t < 10) { ts = "0" + t; } else { ts = t.ToString(); }
            if (m < 10) { ms = "0" + m; } else { ms = m.ToString(); }
            if (s < 10) { ss = "0" + s; } else { ss = s.ToString(); }

            return (ts + ":" + ms + ":" + ss);
        }

        //Metode som gjør en sjekk for hvert tick på timer om spillet er slutt.
        private void SpillOverSjekk()
        {
            if (sekundTeller >= 1200)
            {
                timer.Stop();
                SpilletErSlutt();
            }
        }

        private void SpilletErSlutt()
        {
            var spillOverSkjerm = new Form2();
            spillOverSkjerm.ShowDialog(this);
            form2.SpillerNavn.Text = spillOverSkjerm.spillerNavn;

            //skriver poengsum og spillerens navn til .xml-fil
            try
            {
                string filSti = "Resources/PoengListe.xml";

                if (!File.Exists(filSti))
                {
                    XmlTextWriter writer = new XmlTextWriter(filSti, null);
                    writer.WriteStartElement("SpillerListe");
                    writer.WriteEndElement();
                    writer.Close();
                }
                XElement xml = XElement.Load(filSti);
                xml.Add(new XElement("Spiller",
                new XElement("Brukernavn", spillOverSkjerm.spillerNavn),
                new XElement("Poeng", this.PoengValue.Text)));
                xml.Save(filSti);
            }
            catch (Exception)
            {
                MessageBox.Show("Noe gikk galt under registrering til .xml fil.");
            }
        }

        private void poenglisteToolStripMenuItem_Click(object sender, EventArgs e)
        {
            var poengListeSkjerm = new Form3();
            poengListeSkjerm.ShowDialog(this);
        }

    }

    class Fiende
    {
        private Image fiendeBilde = Image.FromFile("Resources/Freighter.png");
        private int fiendeFart = 3;
        private Form1 form1;
        private bool truffet;
        private Random r;
        public int x, y;
        public int fiendeBredde = 100;
        public int fiendeHoyde = 20;

        public Fiende(Random r)
        {
            this.r = r;
            truffet = false;
            x = 10;
            y = r.Next(20, 600);
        }

        //tegner fiender på tilfeldige nivåer vertikalt.
        public void TegnFiende(PaintEventArgs e)
        {
            Graphics fiendeRect = e.Graphics;
            fiendeRect.DrawImage(fiendeBilde, x, y, fiendeBredde, fiendeHoyde);
        }
        
        public void flyttFiende()
        {
            x += r.Next(5, 10);

            if (x >= 800)
            {
                x = -100;
            }
        }

    }

    class spiller
    {
        private SoundPlayer skuddLyd = new SoundPlayer("Resources/SkuddLyd.wav");
        private Image spillerBilde = Image.FromFile("Resources/Spiller.png"); 
        private Image skuddBilde = Image.FromFile("Resources/Skudd.png");
        private Fiende fiende;
        private Graphics skudd;
        private Form1 form;
        private int xSpiller = 400;
        private int ySpiller = 710;
        private int spillerBredde = 100;
        private int spillerHoyde = 10;
        private int spillerFart = 5;
        private int skuddFart = 10;
        public int skuddBredde = 10;
        public int skuddHoyde = 10;
        public int ySkudd;
        public int xSkudd;
        public bool skuddAvfyrt;

        Random r = new Random();

        public void tegnSpiller(PaintEventArgs e)
        {
            Graphics spiller = e.Graphics;
            Pen p = new Pen(Color.Black);
            spiller.DrawImage(spillerBilde, xSpiller, ySpiller, spillerBredde, spillerHoyde);
        }

        public void SpillerFlyttHoyre()
        {
            xSpiller += spillerFart;

            if (xSpiller > 700)
            {
                xSpiller = 700;
            }
        }

        public void SpillerFlyttVenstre()
        {
            xSpiller -= spillerFart;

            if (xSpiller < 0)
            {
                xSpiller = 0;
            }
        }

        public void TegnSkudd(PaintEventArgs e)
        {
            Graphics skudd = e.Graphics;
            Pen p = new Pen(Color.Black);
            skudd.DrawImage(skuddBilde, xSkudd, ySkudd, 10, 10);      
        }
        
        public void AvfyrSkudd()
        {
            skuddAvfyrt = true;
            ySkudd = 700;
            xSkudd = xSpiller + (spillerBredde / 2);
    
            StartSkuddLyd();

            if (skuddAvfyrt == false)
            {
                StoppSkuddLyd();
            }
        }

        public void FlyttSkudd()
        {
            ySkudd -= skuddFart;
            
            //Når spillerens skudd kommer til toppen av vinduet, er det mulig å fyre av et nytt skudd.
            if (ySkudd < 0)
            {
                skuddAvfyrt = false;
            }
        }

        public void StoppSkuddLyd()
        {
            skuddLyd.Stop();
        }

        public void StartSkuddLyd()
        {
            skuddLyd.Play();
        }
    }

}
