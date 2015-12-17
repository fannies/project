--------------------------------------------------------
--  DDL for Trigger DB_ORDER_TRG
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SYSTEM"."DB_ORDER_TRG" 
BEFORE INSERT ON DB_ORDER 
FOR EACH ROW 
BEGIN
  <<COLUMN_SEQUENCES>>
  BEGIN
    NULL;
  END COLUMN_SEQUENCES;
END;
/
ALTER TRIGGER "SYSTEM"."DB_ORDER_TRG" ENABLE;
