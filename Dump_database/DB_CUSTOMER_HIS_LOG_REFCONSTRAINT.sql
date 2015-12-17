--------------------------------------------------------
--  Ref Constraints for Table DB_CUSTOMER_HIS_LOG
--------------------------------------------------------

  ALTER TABLE "SYSTEM"."DB_CUSTOMER_HIS_LOG" ADD CONSTRAINT "DB_CUSTOMER_HIS_LOG_FK" FOREIGN KEY ("C_ID")
	  REFERENCES "SYSTEM"."DB_HUMAN" ("H_ID") ON DELETE CASCADE ENABLE;
