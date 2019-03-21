<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190321221653 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE salaries (from_date DATE NOT NULL, emp_no INT NOT NULL, salary INT NOT NULL, to_date DATE NOT NULL, INDEX IDX_E6EEB84BA2F57F47 (emp_no), PRIMARY KEY(from_date, emp_no)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employees (emp_no INT AUTO_INCREMENT NOT NULL, birth_date DATE NOT NULL, first_name VARCHAR(14) NOT NULL, last_name VARCHAR(16) NOT NULL, gender VARCHAR(255) NOT NULL, hire_date DATE NOT NULL, PRIMARY KEY(emp_no)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE titles (title VARCHAR(50) NOT NULL, from_date DATE NOT NULL, emp_no INT NOT NULL, to_date DATE DEFAULT NULL, INDEX IDX_C14541A3A2F57F47 (emp_no), PRIMARY KEY(title, from_date, emp_no)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dept_manager (emp_no INT NOT NULL, dept_no CHAR(4) NOT NULL, from_date DATE NOT NULL, to_date DATE NOT NULL, INDEX IDX_C14AA78EA2F57F47 (emp_no), INDEX IDX_C14AA78EE6B0AD08 (dept_no), PRIMARY KEY(emp_no, dept_no)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departments (dept_no CHAR(4) NOT NULL, dept_name VARCHAR(40) NOT NULL, UNIQUE INDEX dept_name (dept_name), PRIMARY KEY(dept_no)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dept_emp (emp_no INT NOT NULL, dept_no CHAR(4) NOT NULL, from_date DATE DEFAULT NULL, to_date DATE DEFAULT NULL, INDEX IDX_B2592B4DA2F57F47 (emp_no), INDEX IDX_B2592B4DE6B0AD08 (dept_no), PRIMARY KEY(emp_no, dept_no)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE salaries ADD CONSTRAINT FK_E6EEB84BA2F57F47 FOREIGN KEY (emp_no) REFERENCES employees (emp_no)');
        $this->addSql('ALTER TABLE titles ADD CONSTRAINT FK_C14541A3A2F57F47 FOREIGN KEY (emp_no) REFERENCES employees (emp_no)');
        $this->addSql('ALTER TABLE dept_manager ADD CONSTRAINT FK_C14AA78EA2F57F47 FOREIGN KEY (emp_no) REFERENCES employees (emp_no)');
        $this->addSql('ALTER TABLE dept_manager ADD CONSTRAINT FK_C14AA78EE6B0AD08 FOREIGN KEY (dept_no) REFERENCES departments (dept_no)');
        $this->addSql('ALTER TABLE dept_emp ADD CONSTRAINT FK_B2592B4DA2F57F47 FOREIGN KEY (emp_no) REFERENCES employees (emp_no)');
        $this->addSql('ALTER TABLE dept_emp ADD CONSTRAINT FK_B2592B4DE6B0AD08 FOREIGN KEY (dept_no) REFERENCES departments (dept_no)');

        $this->addSql('CREATE OR REPLACE VIEW dept_emp_latest_date AS
            SELECT emp_no, MAX(from_date) AS from_date, MAX(to_date) AS to_date
            FROM dept_emp
            GROUP BY emp_no;');

        $this->addSql('CREATE OR REPLACE VIEW current_dept_emp AS
            SELECT l.emp_no, dept_no, l.from_date, l.to_date
            FROM dept_emp d
                INNER JOIN dept_emp_latest_date l
                ON d.emp_no=l.emp_no AND d.from_date=l.from_date AND l.to_date = d.to_date;');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE salaries DROP FOREIGN KEY FK_E6EEB84BA2F57F47');
        $this->addSql('ALTER TABLE titles DROP FOREIGN KEY FK_C14541A3A2F57F47');
        $this->addSql('ALTER TABLE dept_manager DROP FOREIGN KEY FK_C14AA78EA2F57F47');
        $this->addSql('ALTER TABLE dept_emp DROP FOREIGN KEY FK_B2592B4DA2F57F47');
        $this->addSql('ALTER TABLE dept_manager DROP FOREIGN KEY FK_C14AA78EE6B0AD08');
        $this->addSql('ALTER TABLE dept_emp DROP FOREIGN KEY FK_B2592B4DE6B0AD08');
        $this->addSql('DROP TABLE salaries');
        $this->addSql('DROP TABLE employees');
        $this->addSql('DROP TABLE titles');
        $this->addSql('DROP TABLE dept_manager');
        $this->addSql('DROP TABLE departments');
        $this->addSql('DROP TABLE dept_emp');
    }
}
