<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221111153443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, message VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, adresse VARCHAR(255) NOT NULL, tel VARCHAR(12) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE acheteur DROP FOREIGN KEY acheteur_ibfk_1');
        $this->addSql('DROP INDEX id_ville ON acheteur');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY commande_ibfk_2');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY commande_ibfk_1');
        $this->addSql('DROP INDEX id_paiement ON commande');
        $this->addSql('DROP INDEX id_acheteur ON commande');
        $this->addSql('ALTER TABLE est_livre DROP FOREIGN KEY est_livre_ibfk_1');
        $this->addSql('ALTER TABLE est_livre DROP FOREIGN KEY est_livre_ibfk_2');
        $this->addSql('DROP INDEX id_commande ON est_livre');
        $this->addSql('DROP INDEX id_livraison ON est_livre');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY produit_ibfk_1');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY produit_ibfk_4');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY produit_ibfk_2');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY produit_ibfk_3');
        $this->addSql('DROP INDEX id_commande ON produit');
        $this->addSql('DROP INDEX id_user_1 ON produit');
        $this->addSql('DROP INDEX id_user ON produit');
        $this->addSql('DROP INDEX id_categorie ON produit');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER TABLE acheteur ADD CONSTRAINT acheteur_ibfk_1 FOREIGN KEY (id_ville) REFERENCES ville (id)');
        $this->addSql('CREATE UNIQUE INDEX id_ville ON acheteur (id_ville)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT commande_ibfk_2 FOREIGN KEY (id_acheteur) REFERENCES acheteur (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT commande_ibfk_1 FOREIGN KEY (id_paiement) REFERENCES mode_paiement (id)');
        $this->addSql('CREATE UNIQUE INDEX id_paiement ON commande (id_paiement)');
        $this->addSql('CREATE UNIQUE INDEX id_acheteur ON commande (id_acheteur)');
        $this->addSql('ALTER TABLE est_livre ADD CONSTRAINT est_livre_ibfk_1 FOREIGN KEY (id_livraison) REFERENCES livraison (id)');
        $this->addSql('ALTER TABLE est_livre ADD CONSTRAINT est_livre_ibfk_2 FOREIGN KEY (id_commande) REFERENCES commande (id)');
        $this->addSql('CREATE UNIQUE INDEX id_commande ON est_livre (id_commande)');
        $this->addSql('CREATE UNIQUE INDEX id_livraison ON est_livre (id_livraison)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT produit_ibfk_1 FOREIGN KEY (id_user) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT produit_ibfk_4 FOREIGN KEY (id_categorie) REFERENCES categorie_produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT produit_ibfk_2 FOREIGN KEY (id_user_1) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT produit_ibfk_3 FOREIGN KEY (id_commande) REFERENCES commande (id)');
        $this->addSql('CREATE UNIQUE INDEX id_commande ON produit (id_commande)');
        $this->addSql('CREATE UNIQUE INDEX id_user_1 ON produit (id_user_1)');
        $this->addSql('CREATE UNIQUE INDEX id_user ON produit (id_user)');
        $this->addSql('CREATE UNIQUE INDEX id_categorie ON produit (id_categorie)');
    }
}
