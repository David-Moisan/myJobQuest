<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220419155757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apply_job (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, jobs_id INT DEFAULT NULL, date_send DATE DEFAULT NULL, date_response DATE DEFAULT NULL, is_accepted TINYINT(1) NOT NULL, INDEX IDX_F12AAB7367B3B43D (users_id), INDEX IDX_F12AAB7348704627 (jobs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, types_id INT NOT NULL, name VARCHAR(180) NOT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(5) NOT NULL, city VARCHAR(100) NOT NULL, phone_number VARCHAR(10) DEFAULT NULL, email VARCHAR(180) NOT NULL, INDEX IDX_4FBF094F8EB23357 (types_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domain_company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_AD6810575E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_offer (id INT AUTO_INCREMENT NOT NULL, companies_id INT NOT NULL, type_job_id INT NOT NULL, title VARCHAR(255) NOT NULL, level_search VARCHAR(50) NOT NULL, salary VARCHAR(80) DEFAULT NULL, experience_required INT DEFAULT NULL, english_required TINYINT(1) NOT NULL, remote TINYINT(1) NOT NULL, comment LONGTEXT DEFAULT NULL, INDEX IDX_288A3A4E6AE4741E (companies_id), INDEX IDX_288A3A4E28372591 (type_job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_offer_stack (job_offer_id INT NOT NULL, stack_id INT NOT NULL, INDEX IDX_A1E91DCA3481D195 (job_offer_id), INDEX IDX_A1E91DCA37C70060 (stack_id), PRIMARY KEY(job_offer_id, stack_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stack (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, address VARCHAR(200) NOT NULL, postal_code VARCHAR(5) NOT NULL, city VARCHAR(100) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apply_job ADD CONSTRAINT FK_F12AAB7367B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE apply_job ADD CONSTRAINT FK_F12AAB7348704627 FOREIGN KEY (jobs_id) REFERENCES job_offer (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F8EB23357 FOREIGN KEY (types_id) REFERENCES domain_company (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E6AE4741E FOREIGN KEY (companies_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E28372591 FOREIGN KEY (type_job_id) REFERENCES job_type (id)');
        $this->addSql('ALTER TABLE job_offer_stack ADD CONSTRAINT FK_A1E91DCA3481D195 FOREIGN KEY (job_offer_id) REFERENCES job_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_offer_stack ADD CONSTRAINT FK_A1E91DCA37C70060 FOREIGN KEY (stack_id) REFERENCES stack (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E6AE4741E');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F8EB23357');
        $this->addSql('ALTER TABLE apply_job DROP FOREIGN KEY FK_F12AAB7348704627');
        $this->addSql('ALTER TABLE job_offer_stack DROP FOREIGN KEY FK_A1E91DCA3481D195');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E28372591');
        $this->addSql('ALTER TABLE job_offer_stack DROP FOREIGN KEY FK_A1E91DCA37C70060');
        $this->addSql('ALTER TABLE apply_job DROP FOREIGN KEY FK_F12AAB7367B3B43D');
        $this->addSql('DROP TABLE apply_job');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE domain_company');
        $this->addSql('DROP TABLE job_offer');
        $this->addSql('DROP TABLE job_offer_stack');
        $this->addSql('DROP TABLE job_type');
        $this->addSql('DROP TABLE stack');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
