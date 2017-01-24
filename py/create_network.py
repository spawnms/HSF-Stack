# Folgendes Skirpt legt ein neues Netzwerk und zugehoeriges Subnet
# an. Jedes Netzwerk und Subnetz enthaelt den Projektnamen und Ziffer die
# von einem uebergeordneten Skript uebergeben.

import os
import subprocess
import sys

#Parameter einlesen
tenant_id = str(sys.argv[1]) # Eindeutige Id des Projektes
projekt = str(sys.argv[2]) # Netzwerkname, der aehnlich dem Projektnamen ist

#Ausfuehren des Linux Befehls Netzwerk anlegen
os.system("neutron net-create --tenant-id "+tenant_id+" "+projekt+" --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-project-domain-name default -f json");
