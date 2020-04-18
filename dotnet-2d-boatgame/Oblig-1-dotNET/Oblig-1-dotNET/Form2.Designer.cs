namespace Oblig_1_dotNET
{
    partial class Form2
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
            this.SpillerNavn = new System.Windows.Forms.TextBox();
            this.FortsettKnapp = new System.Windows.Forms.Button();
            this.label1 = new System.Windows.Forms.Label();
            this.SuspendLayout();
            // 
            // SpillerNavn
            // 
            this.SpillerNavn.Location = new System.Drawing.Point(81, 75);
            this.SpillerNavn.Name = "SpillerNavn";
            this.SpillerNavn.Size = new System.Drawing.Size(120, 20);
            this.SpillerNavn.TabIndex = 0;
            // 
            // FortsettKnapp
            // 
            this.FortsettKnapp.Location = new System.Drawing.Point(81, 123);
            this.FortsettKnapp.Name = "FortsettKnapp";
            this.FortsettKnapp.Size = new System.Drawing.Size(120, 28);
            this.FortsettKnapp.TabIndex = 1;
            this.FortsettKnapp.Text = "Fortsett";
            this.FortsettKnapp.UseVisualStyleBackColor = true;
            this.FortsettKnapp.Click += new System.EventHandler(this.FortsettKnapp_Click);
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(102, 43);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(72, 13);
            this.label1.TabIndex = 2;
            this.label1.Text = "Spillet er slutt.";
            // 
            // Form2
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(284, 261);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.FortsettKnapp);
            this.Controls.Add(this.SpillerNavn);
            this.Name = "Form2";
            this.Text = "Spillsluttskjerm";
            this.Load += new System.EventHandler(this.Form2_Load);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion
        public System.Windows.Forms.Button FortsettKnapp;
        public System.Windows.Forms.TextBox SpillerNavn;
        private System.Windows.Forms.Label label1;
    }
}