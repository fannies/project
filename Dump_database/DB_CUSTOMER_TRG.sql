--------------------------------------------------------
--  DDL for Trigger DB_CUSTOMER_TRG
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SYSTEM"."DB_CUSTOMER_TRG" 
BEFORE INSERT ON DB_CUSTOMER 
FOR EACH ROW 
BEGIN
  <<COLUMN_SEQUENCES>>
  BEGIN
    NULL;
  END COLUMN_SEQUENCES;
END;
/
ALTER TRIGGER "SYSTEM"."DB_CUSTOMER_TRG" ENABLE;
