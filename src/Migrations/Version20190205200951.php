<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190205200951 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE plan (id INT AUTO_INCREMENT NOT NULL, razred_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_DD5A5B7D5679F83C (razred_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE razredni (id INT AUTO_INCREMENT NOT NULL, ime VARCHAR(255) NOT NULL, prezime VARCHAR(255) NOT NULL, jmbg VARCHAR(255) NOT NULL, telefon VARCHAR(255) NOT NULL, adresa VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, sifra VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE administrator (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, sifra VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ucenik (id INT AUTO_INCREMENT NOT NULL, odeljenje_id INT NOT NULL, ime VARCHAR(255) NOT NULL, prezime VARCHAR(255) NOT NULL, adresa VARCHAR(255) NOT NULL, telefon VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, sifra VARCHAR(255) NOT NULL, INDEX IDX_1451B969A0A6A8CC (odeljenje_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ucenik_cas (ucenik_id INT NOT NULL, cas_id INT NOT NULL, INDEX IDX_788A0A8F82C4118 (ucenik_id), INDEX IDX_788A0A8F7B7A91FA (cas_id), PRIMARY KEY(ucenik_id, cas_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE predmet (id INT AUTO_INCREMENT NOT NULL, naziv VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE predmet_plan (predmet_id INT NOT NULL, plan_id INT NOT NULL, INDEX IDX_8B1EF6B1B4810FC4 (predmet_id), INDEX IDX_8B1EF6B1E899029B (plan_id), PRIMARY KEY(predmet_id, plan_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE predmet_nastavnik (predmet_id INT NOT NULL, nastavnik_id INT NOT NULL, INDEX IDX_ED5C5FB9B4810FC4 (predmet_id), INDEX IDX_ED5C5FB9DBDFCEC1 (nastavnik_id), PRIMARY KEY(predmet_id, nastavnik_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE razred (id INT AUTO_INCREMENT NOT NULL, oznaka VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nastavnik (id INT AUTO_INCREMENT NOT NULL, ime VARCHAR(255) NOT NULL, prezime VARCHAR(255) NOT NULL, jmbg VARCHAR(255) NOT NULL, telefon VARCHAR(255) NOT NULL, adresa VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, sifra VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nastavnik_odeljenje (nastavnik_id INT NOT NULL, odeljenje_id INT NOT NULL, INDEX IDX_CC4FAF71DBDFCEC1 (nastavnik_id), INDEX IDX_CC4FAF71A0A6A8CC (odeljenje_id), PRIMARY KEY(nastavnik_id, odeljenje_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cas (id INT AUTO_INCREMENT NOT NULL, odeljenje_id INT NOT NULL, predmet_id INT DEFAULT NULL, nastavnik_id INT DEFAULT NULL, opis VARCHAR(255) NOT NULL, datum DATE NOT NULL, INDEX IDX_3AD60BA0A6A8CC (odeljenje_id), UNIQUE INDEX UNIQ_3AD60BB4810FC4 (predmet_id), UNIQUE INDEX UNIQ_3AD60BDBDFCEC1 (nastavnik_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE odeljenje (id INT AUTO_INCREMENT NOT NULL, razredni_id INT DEFAULT NULL, razred_id INT NOT NULL, oznaka VARCHAR(5) NOT NULL, UNIQUE INDEX UNIQ_A833C0F4CBD3A9BF (razredni_id), INDEX IDX_A833C0F45679F83C (razred_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ocena (id INT AUTO_INCREMENT NOT NULL, ucenik_id INT NOT NULL, nastavnik_id INT DEFAULT NULL, predmet_id INT DEFAULT NULL, datum DATE NOT NULL, value INT NOT NULL, gradivo VARCHAR(255) NOT NULL, INDEX IDX_7B04514082C4118 (ucenik_id), UNIQUE INDEX UNIQ_7B045140DBDFCEC1 (nastavnik_id), UNIQUE INDEX UNIQ_7B045140B4810FC4 (predmet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plan ADD CONSTRAINT FK_DD5A5B7D5679F83C FOREIGN KEY (razred_id) REFERENCES razred (id)');
        $this->addSql('ALTER TABLE ucenik ADD CONSTRAINT FK_1451B969A0A6A8CC FOREIGN KEY (odeljenje_id) REFERENCES odeljenje (id)');
        $this->addSql('ALTER TABLE ucenik_cas ADD CONSTRAINT FK_788A0A8F82C4118 FOREIGN KEY (ucenik_id) REFERENCES ucenik (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ucenik_cas ADD CONSTRAINT FK_788A0A8F7B7A91FA FOREIGN KEY (cas_id) REFERENCES cas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE predmet_plan ADD CONSTRAINT FK_8B1EF6B1B4810FC4 FOREIGN KEY (predmet_id) REFERENCES predmet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE predmet_plan ADD CONSTRAINT FK_8B1EF6B1E899029B FOREIGN KEY (plan_id) REFERENCES plan (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE predmet_nastavnik ADD CONSTRAINT FK_ED5C5FB9B4810FC4 FOREIGN KEY (predmet_id) REFERENCES predmet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE predmet_nastavnik ADD CONSTRAINT FK_ED5C5FB9DBDFCEC1 FOREIGN KEY (nastavnik_id) REFERENCES nastavnik (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nastavnik_odeljenje ADD CONSTRAINT FK_CC4FAF71DBDFCEC1 FOREIGN KEY (nastavnik_id) REFERENCES nastavnik (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nastavnik_odeljenje ADD CONSTRAINT FK_CC4FAF71A0A6A8CC FOREIGN KEY (odeljenje_id) REFERENCES odeljenje (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cas ADD CONSTRAINT FK_3AD60BA0A6A8CC FOREIGN KEY (odeljenje_id) REFERENCES odeljenje (id)');
        $this->addSql('ALTER TABLE cas ADD CONSTRAINT FK_3AD60BB4810FC4 FOREIGN KEY (predmet_id) REFERENCES predmet (id)');
        $this->addSql('ALTER TABLE cas ADD CONSTRAINT FK_3AD60BDBDFCEC1 FOREIGN KEY (nastavnik_id) REFERENCES nastavnik (id)');
        $this->addSql('ALTER TABLE odeljenje ADD CONSTRAINT FK_A833C0F4CBD3A9BF FOREIGN KEY (razredni_id) REFERENCES razredni (id)');
        $this->addSql('ALTER TABLE odeljenje ADD CONSTRAINT FK_A833C0F45679F83C FOREIGN KEY (razred_id) REFERENCES razred (id)');
        $this->addSql('ALTER TABLE ocena ADD CONSTRAINT FK_7B04514082C4118 FOREIGN KEY (ucenik_id) REFERENCES ucenik (id)');
        $this->addSql('ALTER TABLE ocena ADD CONSTRAINT FK_7B045140DBDFCEC1 FOREIGN KEY (nastavnik_id) REFERENCES nastavnik (id)');
        $this->addSql('ALTER TABLE ocena ADD CONSTRAINT FK_7B045140B4810FC4 FOREIGN KEY (predmet_id) REFERENCES predmet (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE predmet_plan DROP FOREIGN KEY FK_8B1EF6B1E899029B');
        $this->addSql('ALTER TABLE odeljenje DROP FOREIGN KEY FK_A833C0F4CBD3A9BF');
        $this->addSql('ALTER TABLE ucenik_cas DROP FOREIGN KEY FK_788A0A8F82C4118');
        $this->addSql('ALTER TABLE ocena DROP FOREIGN KEY FK_7B04514082C4118');
        $this->addSql('ALTER TABLE predmet_plan DROP FOREIGN KEY FK_8B1EF6B1B4810FC4');
        $this->addSql('ALTER TABLE predmet_nastavnik DROP FOREIGN KEY FK_ED5C5FB9B4810FC4');
        $this->addSql('ALTER TABLE cas DROP FOREIGN KEY FK_3AD60BB4810FC4');
        $this->addSql('ALTER TABLE ocena DROP FOREIGN KEY FK_7B045140B4810FC4');
        $this->addSql('ALTER TABLE plan DROP FOREIGN KEY FK_DD5A5B7D5679F83C');
        $this->addSql('ALTER TABLE odeljenje DROP FOREIGN KEY FK_A833C0F45679F83C');
        $this->addSql('ALTER TABLE predmet_nastavnik DROP FOREIGN KEY FK_ED5C5FB9DBDFCEC1');
        $this->addSql('ALTER TABLE nastavnik_odeljenje DROP FOREIGN KEY FK_CC4FAF71DBDFCEC1');
        $this->addSql('ALTER TABLE cas DROP FOREIGN KEY FK_3AD60BDBDFCEC1');
        $this->addSql('ALTER TABLE ocena DROP FOREIGN KEY FK_7B045140DBDFCEC1');
        $this->addSql('ALTER TABLE ucenik_cas DROP FOREIGN KEY FK_788A0A8F7B7A91FA');
        $this->addSql('ALTER TABLE ucenik DROP FOREIGN KEY FK_1451B969A0A6A8CC');
        $this->addSql('ALTER TABLE nastavnik_odeljenje DROP FOREIGN KEY FK_CC4FAF71A0A6A8CC');
        $this->addSql('ALTER TABLE cas DROP FOREIGN KEY FK_3AD60BA0A6A8CC');
        $this->addSql('DROP TABLE plan');
        $this->addSql('DROP TABLE razredni');
        $this->addSql('DROP TABLE administrator');
        $this->addSql('DROP TABLE ucenik');
        $this->addSql('DROP TABLE ucenik_cas');
        $this->addSql('DROP TABLE predmet');
        $this->addSql('DROP TABLE predmet_plan');
        $this->addSql('DROP TABLE predmet_nastavnik');
        $this->addSql('DROP TABLE razred');
        $this->addSql('DROP TABLE nastavnik');
        $this->addSql('DROP TABLE nastavnik_odeljenje');
        $this->addSql('DROP TABLE cas');
        $this->addSql('DROP TABLE odeljenje');
        $this->addSql('DROP TABLE ocena');
    }
}
