<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250924153943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE plats (id INT AUTO_INCREMENT NOT NULL, libelle LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE plats_menu (plats_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_C04609B9AA14E1C8 (plats_id), INDEX IDX_C04609B9CCD7E912 (menu_id), PRIMARY KEY(plats_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE plats_menu ADD CONSTRAINT FK_C04609B9AA14E1C8 FOREIGN KEY (plats_id) REFERENCES plats (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE plats_menu ADD CONSTRAINT FK_C04609B9CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE plats_menu DROP FOREIGN KEY FK_C04609B9AA14E1C8
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE plats_menu DROP FOREIGN KEY FK_C04609B9CCD7E912
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE plats
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE plats_menu
        SQL);
    }
}
