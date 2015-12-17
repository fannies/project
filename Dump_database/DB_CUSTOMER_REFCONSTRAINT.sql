--------------------------------------------------------
--  Ref Constraints for Table DB_CUSTOMER
--------------------------------------------------------

  ALTER TABLE "SYSTEM"."DB_CUSTOMER" ADD CONSTRAINT "DB_CUSTOMER_FK" FOREIGN KEY ("C_ID")
	  REFERENCES "SYSTEM"."DB_HUMAN" ("H_ID") ON DELETE CASCADE ENABLE;
