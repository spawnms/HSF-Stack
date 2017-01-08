import sys
import os


def test(myList=[],*args):
        for index, x in enumerate(myList):
                if index != 0:
                        os.system("openstack usage show --project e385b38b831c4c4ca58b4ddda15a7a67 --os-username admin --os-password 0penStack-BPIE --os-auth-url https://public.fuel.local:5000/v3 --os-project-name admin --os-cacert /etc/ssl/certs/cacert-openstack.pem --os-user-domain-name default --os-identity-api-version 3 --os-image-api-version 2 --os-project-domain-name default -f json")

test(sys.argv)