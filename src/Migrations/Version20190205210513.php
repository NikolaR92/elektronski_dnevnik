<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190205210513 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ocena_nastavnik (ocena_id INT NOT NULL, nastavnik_id INT NOT NULL, INDEX IDX_39E03DD6B216E087 (ocena_id), INDEX IDX_39E03DD6DBDFCEC1 (nastavnik_id), PRIMARY KEY(ocena_id, nastavnik_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ocena_predmet (ocena_id INT NOT NULL, predmet_id INT NOT NULL, INDEX IDX_10711B19B216E087 (ocena_id), INDEX IDX_10711B19B4810FC4 (predmet_id), PRIMARY KEY(ocena_id, predmet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ocena_nastavnik ADD CONSTRAINT FK_39E03DD6B216E087 FOREIGN KEY (ocena_id) REFERENCES ocena (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ocena_nastavnik ADD CONSTRAINT FK_39E03DD6DBDFCEC1 FOREIGN KEY (nastavnik_id) REFERENCES nastavnik (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ocena_predmet ADD CONSTRAINT FK_10711B19B216E087 FOREIGN KEY (ocena_id) REFERENCES ocena (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ocena_predmet ADD CONSTRAINT FK_10711B19B4810FC4 FOREIGN KEY (predmet_id) REFERENCES predmet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ocena DROP FOREIGN KEY FK_7B045140B4810FC4');
        $this->addSql('ALTER TABLE ocena DROP FOREIGN KEY FK_7B045140DBDFCEC1');
        $this->addSql('DROP INDEX UNIQ_7B045140B4810FC4 ON ocena');
        $this->addSql('DROP INDEX UNIQ_7B045140DBDFCEC1 ON ocena');
        $this->addSql('ALTER TABLE ocena DROP nastavnik_id, DROP predmet_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE ocena_nastavnik');
        $this->addSql('DROP TABLE ocena_predmet');
        $this->addSql('ALTER TABLE ocena ADD nastavnik_id INT DEFAULT NULL, ADD predmet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ocena ADD CONSTRAINT FK_7B045140B4810FC4 FOREIGN KEY (predmet_id) REFERENCES predmet (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ocena ADD CONSTRAINT FK_7B045140DBDFCEC1 FOREIGN KEY (nastavnik_id) REFERENCES nastavnik (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7B045140B4810FC4 ON ocena (predmet_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7B045140DBDFCEC1 ON ocena (nastavnik_id)');
    }
}
