
if NOT EXIST "WebService\Register.bat"  goto WSAA
if NOT EXIST "ULTRALIGHT_NUEVAVERSION.EXE" goto FIN
Copy  "UltraLight.exe" "UltraLight_Anterior.exe"
del "UltraLight.exe"
ren "ULTRALIGHT_NUEVAVERSION.EXE " "UltraLight.exe"
goto FIN

:WSAA
WebService.exe
cd WebService
wsaa.exe --register
wsfev1.exe --register
cd..
:FIN
UltraLight.exe
