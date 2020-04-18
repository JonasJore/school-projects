namespace Oblig_1_dotNET
{
    partial class Form1
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.components = new System.ComponentModel.Container();
            this.timer = new System.Windows.Forms.Timer(this.components);
            this.skjerm = new System.Windows.Forms.Panel();
            this.overlay = new System.Windows.Forms.Panel();
            this.Tid_igjen = new System.Windows.Forms.Label();
            this.PoengValue = new System.Windows.Forms.Label();
            this.Poeng = new System.Windows.Forms.Label();
            this.menuStrip1 = new System.Windows.Forms.MenuStrip();
            this.valgToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.avsluttToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.pauseToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.startToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.omToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.hvordanSpilleToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.omToolStripMenuItem1 = new System.Windows.Forms.ToolStripMenuItem();
            this.poenglisteToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.contextMenuStrip1 = new System.Windows.Forms.ContextMenuStrip(this.components);
            this.skjerm.SuspendLayout();
            this.overlay.SuspendLayout();
            this.menuStrip1.SuspendLayout();
            this.SuspendLayout();
            // 
            // timer
            // 
            this.timer.Interval = 50;
            this.timer.Tick += new System.EventHandler(this.timer_Tick);
            // 
            // skjerm
            // 
            this.skjerm.BackColor = System.Drawing.Color.White;
            this.skjerm.Controls.Add(this.overlay);
            this.skjerm.Dock = System.Windows.Forms.DockStyle.Fill;
            this.skjerm.Location = new System.Drawing.Point(0, 24);
            this.skjerm.Name = "skjerm";
            this.skjerm.Size = new System.Drawing.Size(784, 709);
            this.skjerm.TabIndex = 0;
            this.skjerm.Paint += new System.Windows.Forms.PaintEventHandler(this.skjerm_Paint);
            // 
            // overlay
            // 
            this.overlay.BackColor = System.Drawing.Color.White;
            this.overlay.Controls.Add(this.Tid_igjen);
            this.overlay.Controls.Add(this.PoengValue);
            this.overlay.Controls.Add(this.Poeng);
            this.overlay.Dock = System.Windows.Forms.DockStyle.Top;
            this.overlay.Location = new System.Drawing.Point(0, 0);
            this.overlay.Name = "overlay";
            this.overlay.Size = new System.Drawing.Size(784, 33);
            this.overlay.TabIndex = 0;
            // 
            // Tid_igjen
            // 
            this.Tid_igjen.AutoSize = true;
            this.Tid_igjen.Location = new System.Drawing.Point(723, 9);
            this.Tid_igjen.Name = "Tid_igjen";
            this.Tid_igjen.Size = new System.Drawing.Size(49, 13);
            this.Tid_igjen.TabIndex = 2;
            this.Tid_igjen.Text = "00:00:00";
            // 
            // PoengValue
            // 
            this.PoengValue.AutoSize = true;
            this.PoengValue.Location = new System.Drawing.Point(59, 9);
            this.PoengValue.Name = "PoengValue";
            this.PoengValue.Size = new System.Drawing.Size(13, 13);
            this.PoengValue.TabIndex = 1;
            this.PoengValue.Text = "0";
            // 
            // Poeng
            // 
            this.Poeng.AutoSize = true;
            this.Poeng.Location = new System.Drawing.Point(12, 9);
            this.Poeng.Name = "Poeng";
            this.Poeng.Size = new System.Drawing.Size(41, 13);
            this.Poeng.TabIndex = 0;
            this.Poeng.Text = "Poeng:";
            // 
            // menuStrip1
            // 
            this.menuStrip1.Items.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.valgToolStripMenuItem,
            this.omToolStripMenuItem});
            this.menuStrip1.Location = new System.Drawing.Point(0, 0);
            this.menuStrip1.Name = "menuStrip1";
            this.menuStrip1.Size = new System.Drawing.Size(784, 24);
            this.menuStrip1.TabIndex = 1;
            this.menuStrip1.Text = "menuStrip1";
            // 
            // valgToolStripMenuItem
            // 
            this.valgToolStripMenuItem.DropDownItems.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.avsluttToolStripMenuItem,
            this.pauseToolStripMenuItem,
            this.startToolStripMenuItem});
            this.valgToolStripMenuItem.Name = "valgToolStripMenuItem";
            this.valgToolStripMenuItem.Size = new System.Drawing.Size(41, 20);
            this.valgToolStripMenuItem.Text = "Valg";
            // 
            // avsluttToolStripMenuItem
            // 
            this.avsluttToolStripMenuItem.Name = "avsluttToolStripMenuItem";
            this.avsluttToolStripMenuItem.Size = new System.Drawing.Size(111, 22);
            this.avsluttToolStripMenuItem.Text = "Avslutt";
            this.avsluttToolStripMenuItem.Click += new System.EventHandler(this.avsluttToolStripMenuItem_Click);
            // 
            // pauseToolStripMenuItem
            // 
            this.pauseToolStripMenuItem.Name = "pauseToolStripMenuItem";
            this.pauseToolStripMenuItem.Size = new System.Drawing.Size(111, 22);
            this.pauseToolStripMenuItem.Text = "Pause";
            this.pauseToolStripMenuItem.Click += new System.EventHandler(this.pauseToolStripMenuItem_Click);
            // 
            // startToolStripMenuItem
            // 
            this.startToolStripMenuItem.Name = "startToolStripMenuItem";
            this.startToolStripMenuItem.Size = new System.Drawing.Size(111, 22);
            this.startToolStripMenuItem.Text = "Start";
            this.startToolStripMenuItem.Click += new System.EventHandler(this.startToolStripMenuItem_Click);
            // 
            // omToolStripMenuItem
            // 
            this.omToolStripMenuItem.DropDownItems.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.hvordanSpilleToolStripMenuItem,
            this.omToolStripMenuItem1,
            this.poenglisteToolStripMenuItem});
            this.omToolStripMenuItem.Name = "omToolStripMenuItem";
            this.omToolStripMenuItem.Size = new System.Drawing.Size(40, 20);
            this.omToolStripMenuItem.Text = "Info";
            // 
            // hvordanSpilleToolStripMenuItem
            // 
            this.hvordanSpilleToolStripMenuItem.Name = "hvordanSpilleToolStripMenuItem";
            this.hvordanSpilleToolStripMenuItem.Size = new System.Drawing.Size(150, 22);
            this.hvordanSpilleToolStripMenuItem.Text = "Hvordan spille";
            this.hvordanSpilleToolStripMenuItem.Click += new System.EventHandler(this.hvordanSpilleToolStripMenuItem_Click);
            // 
            // omToolStripMenuItem1
            // 
            this.omToolStripMenuItem1.Name = "omToolStripMenuItem1";
            this.omToolStripMenuItem1.Size = new System.Drawing.Size(150, 22);
            this.omToolStripMenuItem1.Text = "Om";
            this.omToolStripMenuItem1.Click += new System.EventHandler(this.omToolStripMenuItem1_Click);
            // 
            // poenglisteToolStripMenuItem
            // 
            this.poenglisteToolStripMenuItem.Name = "poenglisteToolStripMenuItem";
            this.poenglisteToolStripMenuItem.Size = new System.Drawing.Size(150, 22);
            this.poenglisteToolStripMenuItem.Text = "Poengliste";
            this.poenglisteToolStripMenuItem.Click += new System.EventHandler(this.poenglisteToolStripMenuItem_Click);
            // 
            // contextMenuStrip1
            // 
            this.contextMenuStrip1.Name = "contextMenuStrip1";
            this.contextMenuStrip1.Size = new System.Drawing.Size(61, 4);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(784, 733);
            this.Controls.Add(this.skjerm);
            this.Controls.Add(this.menuStrip1);
            this.DoubleBuffered = true;
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.MainMenuStrip = this.menuStrip1;
            this.Name = "Form1";
            this.Text = "UbatSpill";
            this.Load += new System.EventHandler(this.Form1_Load);
            this.KeyDown += new System.Windows.Forms.KeyEventHandler(this.Form1_KeyDown);
            this.skjerm.ResumeLayout(false);
            this.overlay.ResumeLayout(false);
            this.overlay.PerformLayout();
            this.menuStrip1.ResumeLayout(false);
            this.menuStrip1.PerformLayout();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion
        private System.Windows.Forms.Timer timer;
        public System.Windows.Forms.Panel skjerm;
        private System.Windows.Forms.Panel overlay;
        private System.Windows.Forms.Label Poeng;
        public System.Windows.Forms.Label PoengValue;
        private System.Windows.Forms.MenuStrip menuStrip1;
        private System.Windows.Forms.ToolStripMenuItem valgToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem avsluttToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem omToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem hvordanSpilleToolStripMenuItem;
        private System.Windows.Forms.ContextMenuStrip contextMenuStrip1;
        private System.Windows.Forms.ToolStripMenuItem pauseToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem startToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem omToolStripMenuItem1;
        private System.Windows.Forms.Label Tid_igjen;
        private System.Windows.Forms.ToolStripMenuItem poenglisteToolStripMenuItem;
    }
}

