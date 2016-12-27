#!/usr/bin/python

import os 
import subprocess
import sys


# Folgendes Skript legt ein neues Projekt an.
# Jedes Projekt enthaelt am Ende eine Ziffer die
# von einem uebergeordneten Skript uebergeben werden.

zustand = str(sys.argv[1])
test = "--"+zustand

#Ausfuehren des Linux Befehls
os.system("openstack project set rieger-test "+test+" --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-identity-api-version 3 --os-image-api-version 2 --os-project-domain-name default")
os.system("openstack project set Matti_Test2 "+test+" --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-identity-api-version 3 --os-image-api-version 2 --os-project-domain-name default")



