vmrun -T ws stop "C:\Labs\I97\vm1\RHEL64-64bit.vmx" hard \r\n
ping 127.0.0.1 -n 5 > nul
taskkill /f /im vmware.exe
