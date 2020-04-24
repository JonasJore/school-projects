<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePålogging extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AnsattLogin', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('pålogingsid');
            $table->string('brukernavn', 45)->nullable();
            $table->string('passord',55);
            $table->integer('Ansatt_idAnsatt');
            $table->foreign('Ansatt_idAnsatt')->references('idAnsatt')->on('ansatt');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Påloggingsinfo');
    }
}
// CREATE TABLE IF NOT EXISTS `Påloggingsinfo` (
//     `idpåloggingsinfo` INT NOT NULL AUTO_INCREMENT,
//     `brukernavn` VARCHAR(45) NULL,
//     `passord` VARCHAR(256) NOT NULL,
//     `Ansatt_idAnsatt` INT NOT NULL,
//     PRIMARY KEY (`idpåloggingsinfo`, `Ansatt_idAnsatt`),
//     INDEX `fk_påloggingsinfo_Ansatt1_idx` (`Ansatt_idAnsatt` ASC),
//     CONSTRAINT `fk_påloggingsinfo [sensisitivt]_Ansatt1`
//       FOREIGN KEY (`Ansatt_idAnsatt`)
//       REFERENCES `Ansatt` (`idAnsatt`)
//       ON DELETE NO ACTION
//       ON UPDATE NO ACTION)
//   ENGINE = InnoDB;