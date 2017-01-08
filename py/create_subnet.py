# Folgendes Skirpt legt ein neues Netzwerk und zugehoeriges Subnet
# an. Jedes Netzwerk und Subnetz enthaelt den Projektnamen und Ziffer die
# von einem uebergeordneten Skript uebergeben.

import os
import subprocess
import sys

#Parameter einlesen
projekt = str(sys.argv[1]) #Parameter 1
ipadresse = str(sys.argv[2]) #Parameter 2
zaehler = str(sys.argv[3]) #Parameter 3

#Tenant ID des PRojekts ermitteln
proc = subprocess.Popen(["openstack project list --user "+kurs+"_"+projekt+""+zaehler+" -c ID  --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-identity-api-version 3 --os-image-api-version 2 --os-project-domain-name default"], stdout=subprocess.PIPE, shell=True)
(tenant, err) = proc.communicate()

tenant_id = tenant[113:145]
print (tenant_id)
#Ausfuehren des Linux Befehls Netzwerk anlegen
os.system("neutron net-create --tenant-id "+tenant_id+" "+projekt+""+zaehler+" --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-project-domain-name default -f json");
#Ausfuehren des Linux Befehls Subnetz anlegen
os.system("neutron subnet-create "+projekt+""+zaehler+" "+ipadresse+" --name "+projekt+""+zaehler+"-subnet1 --tenant-id "+tenant_id+" --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-project-domain-name default -f json")
