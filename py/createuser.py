# Folgendes Skript legt einen neuen User an.
# Jeder User enthaelt am Ende eine Ziffer die
# von einem uebergeordneten Skript uebergeben werden.
#!/usr/bin/python
import os 
import subprocess
import sys

#Parameter einlesen
name = str(sys.argv[1])#Parameter 1
password = str(sys.argv[2]) #Parameter 2
description = str(sys.argv[3]) #Parameter 3
projekt = str(sys.argv[4]) #Parameter 4

#Linux Befehl ausfuehren user anlegen
os.system("openstack user create "+name+" --password "+password+" --description "+description+" --enable --project "+projekt+" --domain default --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-identity-api-version 3 --os-image-api-version 2 --os-project-domain-name default -f json")
#Linux Befehl ausfuehren user rolle zuweisen
##os.system("openstack role add --project "+name+""+anzahl+" --user "+name+""+anzahl+" _member_ --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-identity-api-version 3 --os-image-api-version 2 --os-project-domain-name default")

##os.system("openstack group add user "+name+" "+name+""+anzahl+" --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-identity-api-version 3 --os-image-api-version 2 --os-project-domain-name default")

