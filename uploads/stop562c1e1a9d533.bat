vmrun -T ws stop "C:\Labs\A001\vm1\RHEL64-32bit.vmx" hard \r\n
ping 127.0.0.1 -n 5 > nul
taskkill /f /im vmware.exe
