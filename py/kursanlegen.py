#!/usr/bin/python
import os 
import subprocess
import sys


kurs = str(sys.argv[1])
projekt = str(sys.argv[2])
anzahl = str(sys.argv[3])
netzwerk = str(sys.argv[4])
router = str(sys.argv[5])
#storage = str(sys.argv[6])
#ipadresse = str(sys.argv[7])

for a in xrange(1, int(float(anzahl)+1)):
	print (str(a))
	os.system("python create_project.py "+kurs+" "+projekt+" "+str(a))

