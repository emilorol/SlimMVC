#
# Deployment script for Developement Environment.
#
#!/bin/bash

RED='\033[41;1;37m'
NC='\033[0m' # No Color

# Remove old distribution
echo -e $"\nRemove old distribution ( START ) \n"
rm -rf /tmp/SlimMVC-distro.tar.gz

# Compress the www
echo -e $"\nCompress files\n"
COPYFILE_DISABLE=true tar -c --exclude-from=.tarignore -vzf /tmp/SlimMVC-distro.tar.gz src

# Move it to the server
echo -e $"\nMoving to ${RED} Developement ${NC} server\n"
cat /tmp/SlimMVC-distro.tar.gz | ssh -i ~/.ssh/secret_key_rsa user@server_name_ip "tar xzf - -C /opt/webapps/website --strip 1 --overwrite;chmod -R +x /opt/webapps/website/*"

# Remove old distribution
echo -e $"\nRemove old distribution ( END ) \n"
rm -rf /tmp/SlimMVC-distro.tar.gz
