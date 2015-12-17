--------------------------------------------------------
--  DDL for Trigger DB_HUMAN_TRG
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SYSTEM"."DB_HUMAN_TRG" 
BEFORE INSERT ON DB_HUMAN 
FOR EACH ROW 
BEGIN
  <<COLUMN_SEQUENCES>>
  BEGIN
    NULL;
  END COLUMN_SEQUENCES;
END;
/
ALTER TRIGGER "SYSTEM"."DB_HUMAN_TRG" ENABLE;
