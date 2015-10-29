vmrun -T ws stop "C:\Labs\A178\vm1\A178.vmx" hard \r\n
ping 127.0.0.1 -n 5 > nul
taskkill /f /im vmware.exe
