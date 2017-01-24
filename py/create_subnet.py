# Folgendes Skirpt legt ein neues Netzwerk und zugehoeriges Subnet
# an. Jedes Netzwerk und Subnetz enthaelt den Projektnamen und Ziffer die
# von einem uebergeordneten Skript uebergeben.

import os
import subprocess
import sys

#Parameter einlesen
tenant_id = str(sys.argv[1]) # ID des Projekts einlesen
projekt = str(sys.argv[2]) # Name des Projekts einlesen, um Router aehnlich zu benennen
ipadresse = "192.168.0.0/24" #Statische Adresse um Netzwerk anzulegen 

#Ausfuehren des Linux Befehls Subnetz anlegen
os.system("neutron subnet-create "+projekt+" "+ipadresse+" --name "+projekt+"-subnet1 --tenant-id "+tenant_id+" --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-project-domain-name default -f json")
