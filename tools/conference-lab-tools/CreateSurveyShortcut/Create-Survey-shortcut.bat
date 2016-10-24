

@echo off

set SCRIPT="%TEMP%\%RANDOM%-%RANDOM%-%RANDOM%-%RANDOM%.vbs"
copy surveyicon.ico %windir%\surveyicon.ico"

echo Set oWS = WScript.CreateObject("WScript.Shell") >> %SCRIPT%
echo sLinkFile = "%USERPROFILE%\Desktop\Survey.lnk" >> %SCRIPT%
echo Set oLink = oWS.CreateShortcut(sLinkFile) >> %SCRIPT%
echo oLink.TargetPath = "C:\Program Files (x86)\Mozilla Firefox\firefox.exe" >> %SCRIPT%
echo oLink.Arguments = "http://www.surveygizmo.com/s3/2037767/InterConnect-2016-Open-Labs" >> %SCRIPT%
echo oLink.HotKey = "Ctrl+SHIFT+S" >> %SCRIPT%
echo oLink.IconLocation = "%windir%\surveyicon.ico" >> %SCRIPT%
echo oLink.Save >> %SCRIPT%

cscript /nologo %SCRIPT%
del %SCRIPT%