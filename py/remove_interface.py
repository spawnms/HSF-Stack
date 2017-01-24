#!/usr/bin/python

import os 
import subprocess
import sys


# Folgendes Skript entfernt die Interfaces des Routers, damit dieser geloescht werden kann.


#Einlesen der Parameter
routername = str(sys.argv[1]) #Routername
subnet_ID = str(sys.argv[2]) #eindeutige Subnetz-ID

#Ausfuehren des Linux Befehls
os.system("neutron router-interface-delete "+routername+" "+subnet_ID+" --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-identity-api-version 3 --os-image-api-version 2 --os-project-domain-name default --or-show -f json")



