<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201130142818 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cars (id INT AUTO_INCREMENT NOT NULL, fk_car_user_id_id INT NOT NULL, make VARCHAR(45) NOT NULL, model VARCHAR(45) NOT NULL, INDEX IDX_95C71D14DA5702F7 (fk_car_user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventory_items (id INT AUTO_INCREMENT NOT NULL, fk_inventory_item_user_ticket_id_id INT DEFAULT NULL, name VARCHAR(45) NOT NULL, description VARCHAR(45) DEFAULT NULL, price NUMERIC(7, 2) NOT NULL, serial_number VARCHAR(10) NOT NULL, INDEX IDX_3D82424D86299CD5 (fk_inventory_item_user_ticket_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mechanics (id INT AUTO_INCREMENT NOT NULL, fk_mechanic_user_id_id INT DEFAULT NULL, specialization VARCHAR(45) NOT NULL, UNIQUE INDEX UNIQ_32A6314DC6B5714B (fk_mechanic_user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notes (id INT AUTO_INCREMENT NOT NULL, fk_note_progress_id_id INT DEFAULT NULL, message VARCHAR(300) DEFAULT NULL, INDEX IDX_11BA68C20DAA871 (fk_note_progress_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE progress (id INT AUTO_INCREMENT NOT NULL, fk_progress_user_ticket_id_id INT DEFAULT NULL, state VARCHAR(45) DEFAULT NULL, estimation_date DATETIME DEFAULT NULL, INDEX IDX_2201F24667A626B (fk_progress_user_ticket_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE talons (id INT AUTO_INCREMENT NOT NULL, fk_talon_car_id_id INT DEFAULT NULL, registration_plate VARCHAR(10) NOT NULL, vin VARCHAR(30) NOT NULL, cc NUMERIC(7, 4) NOT NULL, registartion_year DATETIME NOT NULL, expiration_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_852A12805156794B (fk_talon_car_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_tickets (id INT AUTO_INCREMENT NOT NULL, fk_user_ticket_car_id_id INT DEFAULT NULL, description VARCHAR(300) NOT NULL, date_started DATETIME NOT NULL, INDEX IDX_C4B83FE362C456 (fk_user_ticket_car_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_tickets_mechanics (id INT AUTO_INCREMENT NOT NULL, fk_user_ticket_id_id INT DEFAULT NULL, fk_mechanic_id_id INT DEFAULT NULL, INDEX IDX_9D30A43F198F0F26 (fk_user_ticket_id_id), INDEX IDX_9D30A43FA255C46C (fk_mechanic_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(45) NOT NULL, last_name VARCHAR(45) NOT NULL, phone VARCHAR(10) NOT NULL, adress VARCHAR(45) NOT NULL, email VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14DA5702F7 FOREIGN KEY (fk_car_user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE inventory_items ADD CONSTRAINT FK_3D82424D86299CD5 FOREIGN KEY (fk_inventory_item_user_ticket_id_id) REFERENCES user_tickets (id)');
        $this->addSql('ALTER TABLE mechanics ADD CONSTRAINT FK_32A6314DC6B5714B FOREIGN KEY (fk_mechanic_user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68C20DAA871 FOREIGN KEY (fk_note_progress_id_id) REFERENCES progress (id)');
        $this->addSql('ALTER TABLE progress ADD CONSTRAINT FK_2201F24667A626B FOREIGN KEY (fk_progress_user_ticket_id_id) REFERENCES user_tickets (id)');
        $this->addSql('ALTER TABLE talons ADD CONSTRAINT FK_852A12805156794B FOREIGN KEY (fk_talon_car_id_id) REFERENCES cars (id)');
        $this->addSql('ALTER TABLE user_tickets ADD CONSTRAINT FK_C4B83FE362C456 FOREIGN KEY (fk_user_ticket_car_id_id) REFERENCES cars (id)');
        $this->addSql('ALTER TABLE user_tickets_mechanics ADD CONSTRAINT FK_9D30A43F198F0F26 FOREIGN KEY (fk_user_ticket_id_id) REFERENCES user_tickets (id)');
        $this->addSql('ALTER TABLE user_tickets_mechanics ADD CONSTRAINT FK_9D30A43FA255C46C FOREIGN KEY (fk_mechanic_id_id) REFERENCES mechanics (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE talons DROP FOREIGN KEY FK_852A12805156794B');
        $this->addSql('ALTER TABLE user_tickets DROP FOREIGN KEY FK_C4B83FE362C456');
        $this->addSql('ALTER TABLE user_tickets_mechanics DROP FOREIGN KEY FK_9D30A43FA255C46C');
        $this->addSql('ALTER TABLE notes DROP FOREIGN KEY FK_11BA68C20DAA871');
        $this->addSql('ALTER TABLE inventory_items DROP FOREIGN KEY FK_3D82424D86299CD5');
        $this->addSql('ALTER TABLE progress DROP FOREIGN KEY FK_2201F24667A626B');
        $this->addSql('ALTER TABLE user_tickets_mechanics DROP FOREIGN KEY FK_9D30A43F198F0F26');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14DA5702F7');
        $this->addSql('ALTER TABLE mechanics DROP FOREIGN KEY FK_32A6314DC6B5714B');
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE inventory_items');
        $this->addSql('DROP TABLE mechanics');
        $this->addSql('DROP TABLE notes');
        $this->addSql('DROP TABLE progress');
        $this->addSql('DROP TABLE talons');
        $this->addSql('DROP TABLE user_tickets');
        $this->addSql('DROP TABLE user_tickets_mechanics');
        $this->addSql('DROP TABLE users');
    }
}
