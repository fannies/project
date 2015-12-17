--------------------------------------------------------
--  Ref Constraints for Table DB_STAFF
--------------------------------------------------------

  ALTER TABLE "SYSTEM"."DB_STAFF" ADD CONSTRAINT "DB_STAFF_FK" FOREIGN KEY ("S_ID")
	  REFERENCES "SYSTEM"."DB_HUMAN" ("H_ID") ON DELETE CASCADE ENABLE;
