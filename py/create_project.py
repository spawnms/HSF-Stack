#!/usr/bin/python

import os 
import subprocess
import sys


# Folgendes Skript legt ein neues Projekt an.
# Jedes Projekt enthaelt am Ende eine Ziffer die
# von einem uebergeordneten Skript uebergeben werden.


#Einlesen der Parameter
name = str(sys.argv[1]) #Parameter 1
postfix = str(sys.argv[2]) #Parameter 2
anzahl = str(sys.argv[3]) #Parameter 3

#Ausfuehren des Linux Befehls
os.system("openstack project create "+name+"_"+postfix+""+anzahl+" --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-identity-api-version 3 --os-image-api-version 2 --os-project-domain-name default --or-show -f json")



