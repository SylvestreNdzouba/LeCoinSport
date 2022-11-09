<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221031100049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acheteur DROP FOREIGN KEY acheteur_ibfk_1');
        $this->addSql('DROP INDEX id_ville ON acheteur');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY commande_ibfk_2');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY commande_ibfk_1');
        $this->addSql('DROP INDEX id_paiement ON commande');
        $this->addSql('DROP INDEX id_acheteur ON commande');
        $this->addSql('ALTER TABLE produit ADD id_user_1 INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acheteur ADD CONSTRAINT acheteur_ibfk_1 FOREIGN KEY (id_ville) REFERENCES ville (id)');
        $this->addSql('CREATE UNIQUE INDEX id_ville ON acheteur (id_ville)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT commande_ibfk_2 FOREIGN KEY (id_paiement) REFERENCES mode_paiement (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT commande_ibfk_1 FOREIGN KEY (id_acheteur) REFERENCES acheteur (id)');
        $this->addSql('CREATE UNIQUE INDEX id_paiement ON commande (id_paiement)');
        $this->addSql('CREATE UNIQUE INDEX id_acheteur ON commande (id_acheteur)');
        $this->addSql('ALTER TABLE produit DROP id_user_1');
    }
}
