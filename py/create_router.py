#!/usr/bin/env python 
# Folgendes Skript legt einen Router und ein zugehoeriges Gateway.
# Jeder Router und Gateway enthaelt den Projektnamen und eine Ziffer 
# die von einem uebergeordneten Skript uebergeben werden.

import os
import subprocess
import sys

#Einlesen der Parameter
tenant_id = str(sys.argv[1]) #Parameter 1
projekt = str(sys.argv[2]) #Parameter 2
anzahl = str(sys.argv[3]) #Parameter 3

# #Tenant ID des Projekts auslesen
# proc = subprocess.Popen(["openstack project list --user "+projekt+""+anzahl+" -c ID  --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-identity-api-version 3 --os-image-api-version 2 --os-project-domain-name default"], stdout=subprocess.PIPE, shell=True)
# (tenant, err) = proc.communicate()

# tenant_id = tenant[113:145]

#Ausfuehren des Linux Befehls Anlegen de Router
os.system("neutron router-create --tenant-id "+tenant_id+" "+projekt+""+anzahl+"-Router --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-project-domain-name default -f json")
#Ausfuehren des Linux Befehls Anlegen des Gateways fuer Router
os.system("neutron router-gateway-set "+projekt+""+anzahl+"-Router admin_floating_net --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-project-domain-name default -f json")
print(tenant_id)

#Ausfuehren des Linux Befehls Gateway fuer Subnetz setzen
os.system("neutron router-interface-add "+projekt+""+anzahl+"-Router "+projekt+""+anzahl+"-subnet1 --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-project-domain-name default -f json")

