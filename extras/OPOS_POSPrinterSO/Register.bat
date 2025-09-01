@echo off
echo **
echo ** Register or Unregister OPOS Common Control Objects.
echo **   Run from a command prompt with administrator privileges,
echo **   in the directory in which this batch file is located.
echo ** Formats:
echo **   Register        Register control objects.
echo **   Register -u     Unregister control objects.
echo **
echo --} Press Control-Break to exit, or
#pause

@echo on

RegComSvr.exe %1 Common\OPOS*.ocx Common\OPOS*.dll

rem ** End
#pause