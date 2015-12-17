--------------------------------------------------------
--  Ref Constraints for Table DB_STAFF_HIS_LOG
--------------------------------------------------------

  ALTER TABLE "SYSTEM"."DB_STAFF_HIS_LOG" ADD CONSTRAINT "DB_STAFF_HIS_LOG_FK" FOREIGN KEY ("S_ID")
	  REFERENCES "SYSTEM"."DB_HUMAN" ("H_ID") ON DELETE CASCADE ENABLE;
