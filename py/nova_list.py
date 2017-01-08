#!/usr/bin/python

import os 
import subprocess
import sys


# Folgendes Skript legt ein neues Projekt an.
# Jedes Projekt enthaelt am Ende eine Ziffer die
# von einem uebergeordneten Skript uebergeben werden.


#Ausfuehren des Linux Befehls
os.system("nova --os-username admin --os-password 0penStack-BPIE --os-project-name admin --os-project-domain-name default --os-user-domain-name default --os-auth-url https://public.fuel.local:5000/v3 --os-cacert /etc/ssl/certs/cacert-openstack.pem list --all-tenants")



