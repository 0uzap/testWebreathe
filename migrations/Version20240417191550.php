<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240417191550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mesures (id INT AUTO_INCREMENT NOT NULL, module_id INT DEFAULT NULL, donnees_numeriques_id INT DEFAULT NULL, valeur VARCHAR(100) DEFAULT NULL, INDEX IDX_4B54A559AFC2B591 (module_id), INDEX IDX_4B54A559959E93B9 (donnees_numeriques_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mesures ADD CONSTRAINT FK_4B54A559AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE mesures ADD CONSTRAINT FK_4B54A559959E93B9 FOREIGN KEY (donnees_numeriques_id) REFERENCES donnees_numeriques (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mesures DROP FOREIGN KEY FK_4B54A559AFC2B591');
        $this->addSql('ALTER TABLE mesures DROP FOREIGN KEY FK_4B54A559959E93B9');
        $this->addSql('DROP TABLE mesures');
    }
}
