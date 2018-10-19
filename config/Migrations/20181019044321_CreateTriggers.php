<?php

use Migrations\AbstractMigration;

class CreateTriggers extends AbstractMigration
{

    public function up()
    {
        $this->execute("
        CREATE TRIGGER email_phone_number_not_both_null
          BEFORE INSERT
          ON accounts
          FOR EACH ROW
          BEGIN
            IF (NEW.email IS NULL AND NEW.phone_number IS NULL)
            THEN
              SIGNAL SQLSTATE '45000'
              SET MESSAGE_TEXT = 'email_address and phone_number cannot both be null';
            END IF;
          END;"
        );

        $this->execute("
        CREATE TRIGGER increase_tag_count
          AFTER INSERT
          ON activity_tags
          FOR EACH ROW
          BEGIN
            DECLARE current_tag_id INT UNSIGNED DEFAULT NEW.tag_id;

            WHILE (current_tag_id IS NOT NULL) DO
              UPDATE tag SET count = count + 1 WHERE tag_id = current_tag_id;
              SELECT parent_id INTO current_tag_id FROM tag WHERE tag.tag_id = current_tag_id;
            END WHILE;

            UPDATE tag SET count = count + 1 WHERE tag_id = current_tag_id;
          END;
        ");

        $this->execute("
        CREATE TRIGGER decrease_tag_count
          AFTER DELETE
          ON activity_tags
          FOR EACH ROW
          BEGIN
            DECLARE current_tag_id INT UNSIGNED DEFAULT OLD.tag_id;

            WHILE (current_tag_id IS NOT NULL) DO
              UPDATE tag SET count = count - 1 WHERE tag_id = current_tag_id;
              SELECT parent_id INTO current_tag_id FROM tag WHERE tag.tag_id = current_tag_id;
            END WHILE;

            UPDATE tag SET count = count - 1 WHERE tag_id = current_tag_id;
          END;
        ");

        $this->execute("
        CREATE TRIGGER create_filter
          AFTER INSERT
          ON users
          FOR EACH ROW
          BEGIN
            DECLARE age TINYINT;
            SET age = YEAR(UTC_DATE()) - YEAR(NEW.birthdate);
            INSERT INTO activity_filter (user_id, from_age, to_age) VALUE (NEW.id, GREATEST(18, age - 8), age + 8);
          END;
        ");
    }

    public function down()
    {
        $this->execute("DROP TRIGGER IF EXISTS email_phone_number_not_both_null;");
        $this->execute("DROP TRIGGER IF EXISTS increase_tag_count;");
        $this->execute("DROP TRIGGER IF EXISTS decrease_tag_count;");
        $this->execute("DROP TRIGGER IF EXISTS create_filter;");
    }
}
