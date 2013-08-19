EXEC master.dbo.sp_addlinkedserver 
@server = N'MYSQL', 
@srvproduct=N'MySQL', 
@provider=N'MSDASQL', 
@provstr=N'DRIVER={MySQL ODBC 5.1 Driver}; SERVER=localhost; _
	DATABASE=c1r36new; USER=root; PASSWORD=; OPTION=3'