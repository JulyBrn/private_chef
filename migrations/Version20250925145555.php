<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250925145555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE article_menu (article_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_CD47BD927294869C (article_id), INDEX IDX_CD47BD92CCD7E912 (menu_id), PRIMARY KEY(article_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE article_menu ADD CONSTRAINT FK_CD47BD927294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE article_menu ADD CONSTRAINT FK_CD47BD92CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_article DROP FOREIGN KEY FK_8AE113D87294869C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_article DROP FOREIGN KEY FK_8AE113D8CCD7E912
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE menu_article
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE menu_article (menu_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_8AE113D87294869C (article_id), INDEX IDX_8AE113D8CCD7E912 (menu_id), PRIMARY KEY(menu_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_article ADD CONSTRAINT FK_8AE113D87294869C FOREIGN KEY (article_id) REFERENCES article (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_article ADD CONSTRAINT FK_8AE113D8CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE article_menu DROP FOREIGN KEY FK_CD47BD927294869C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE article_menu DROP FOREIGN KEY FK_CD47BD92CCD7E912
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE article_menu
        SQL);
    }
}
