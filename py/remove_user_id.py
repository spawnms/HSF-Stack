#!/usr/bin/python

import os 
import subprocess
import sys


# Folgendes Skript loescht ein Projekt anhand seiner Tenant ID.



#Einlesen der Parameter
tenant = str(sys.argv[1]) #Parameter 1

#Ausfuehren des Linux Befehls
os.system("openstack user delete "+tenant+" --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-identity-api-version 3 --os-image-api-version 2 --os-project-domain-name default")


