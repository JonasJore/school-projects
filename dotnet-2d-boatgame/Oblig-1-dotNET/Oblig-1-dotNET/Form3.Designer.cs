namespace Oblig_1_dotNET
{
    partial class Form3
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
            this.PoengListeFelt = new System.Windows.Forms.RichTextBox();
            this.SuspendLayout();
            // 
            // PoengListeFelt
            // 
            this.PoengListeFelt.Location = new System.Drawing.Point(12, 12);
            this.PoengListeFelt.Name = "PoengListeFelt";
            this.PoengListeFelt.ReadOnly = true;
            this.PoengListeFelt.Size = new System.Drawing.Size(260, 452);
            this.PoengListeFelt.TabIndex = 0;
            this.PoengListeFelt.Text = "";
            // 
            // Form3
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(284, 476);
            this.Controls.Add(this.PoengListeFelt);
            this.Name = "Form3";
            this.Text = "PoengListe";
            this.Load += new System.EventHandler(this.Form3_Load);
            this.ResumeLayout(false);

        }

        #endregion
        public System.Windows.Forms.RichTextBox PoengListeFelt;
    }
}