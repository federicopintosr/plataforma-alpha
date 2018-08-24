
Rem if NOT EXIST "WebService\Register.bat"  goto WSAA
if NOT EXIST "GVS_NUEVAVERSION.EXE" goto FIN
Copy  "GVS.exe" "GVS_Anterior.exe"
del "GVS.exe"
ren "GVS_NUEVAVERSION.EXE " "GVS.exe"
goto FIN

:WSAA
rem WebService.exe
rem cd WebService
rem wsaa.exe --register
rem wsfev1.exe --register
rem cd..
:FIN
GVS.exe
