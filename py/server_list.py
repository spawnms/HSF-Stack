#!/usr/bin/python

import os 
import subprocess
import sys


# Folgendes Skript zeigt alle aktuellen Projekt an bzw. gibt diese im JSON-Format aus.


#Ausfuehren des Linux Befehls
os.system("openstack server list --long --all-projects --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-identity-api-version 3 --os-image-api-version 2 --os-project-domain-name default -f json")



