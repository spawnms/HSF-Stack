# Folgendes Skript legt einen neuen User an.
# Jeder User enthaelt am Ende eine Ziffer die
# von einem uebergeordneten Skript uebergeben werden.
#!/usr/bin/python
import os 
import subprocess
import sys

#Parameter einlesen
name = str(sys.argv[1])#Name des Nutzers
password = str(sys.argv[2]) #Passwort des Nutzers
description = str(sys.argv[3]) #Zusaetzliche Beschreibung des Nutzers
projekt = str(sys.argv[4]) #Zuweisung zu einem Projekt

#Linux Befehl ausfuehren user anlegen
os.system("openstack user create "+name+" --password "+password+" --description "+description+" --enable --project "+projekt+" --domain default --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-identity-api-version 3 --os-image-api-version 2 --os-project-domain-name default -f json")


