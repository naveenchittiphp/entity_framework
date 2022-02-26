Select :  
First define the database connection: 

 projectDatabaseContext db = new projectDatabaseContext(); 

Do operations : 

var userAndRole = db.AspNetUserRoles.Where(x => (x.UserId == UserId)).First();

Add : 

  Audit auditLogs = new Audit();
                                auditLogs.Username = username;
                                auditLogs.AuditDateTime = DateTime.UtcNow;
                                auditLogs.AuditEventType = "Coding";
                                auditLogs.AuditEventDescription = "Reviewed";
                                auditLogs.Bdosid = model.AssignCodingInquiryCases[a].BDOSID;
                                auditLogs.PatientId = int.Parse(dtPatient.Rows[0]["PatientID"].ToString());
                                auditLogs.NoteText = model.AssignCodingInquiryCases[a].ReviewedComments;
                                auditLogs.UpdateFrom = userRoleDetais.Name;
                                db.Audit.Add(auditLogs);

-----------------
Update : 
---------------

  var codingInquiry = db.CodingInquiry.Where(x => (x.Bdosid == model.AssignCodingInquiryCases[a].BDOSID)).First();
                            codingInquiry.ReviewedComments = model.AssignCodingInquiryCases[a].ReviewedComments;
                            codingInquiry.ReviewedStatus = "Reviewed";
                           db.SaveChanges();

Delete : 
----------

 CodingInquiry rc = db.CodingInquiry.Where(x => x.Id == model.Id).SingleOrDefault();
  db.CodingInquiry.Remove(rc);

Save all changes to the database.
 db.SaveChanges();
