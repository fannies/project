--------------------------------------------------------
--  Ref Constraints for Table DB_RECEIPT
--------------------------------------------------------

  ALTER TABLE "SYSTEM"."DB_RECEIPT" ADD CONSTRAINT "DB_RECEIPT_FK" FOREIGN KEY ("C_ID")
	  REFERENCES "SYSTEM"."DB_HUMAN" ("H_ID") ON DELETE CASCADE ENABLE;
