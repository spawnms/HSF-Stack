#!/usr/bin/python
import os 
import subprocess
import sys


name = str(sys.argv[1])
anzahl = str(sys.argv[2])
password = str(sys.argv[3])
description = str(sys.argv[4])
ipadresse = str(sys.argv[5])

for a in xrange(1, int(float(anzahl)+1)):
	print (str(a))
	os.system("python create_project.py "+name+" "+str(a))
	os.system("python create_user.py "+name+""+str(a)+" "+password+" "+description+" "+name+""+str(a))
	os.system("python create_subnet.py "+name+" "+ipadresse+" "+str(a))
	os.system("python create_router.py "+name+" "+str(a))
