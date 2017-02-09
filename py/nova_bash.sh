#!/bin/bash

echo -e "$PWD"

nova --os-username admin --os-password 0penStack-BPIE --os-project-name admin \
--os-project-domain-name default --os-user-domain-name default \
--os-auth-url https://public.fuel.local:5000/v3 --os-cacert /etc/ssl/certs/cacert-openstack.pem \
list --all-tenants | sed '/^+/d'| awk -F "|" '{printf "%s:%s:%s,\n",$2,$4,$5}' > ./data.tmp
