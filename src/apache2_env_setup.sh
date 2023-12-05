#!/usr/bin/env bash

# This script is only to be used on your live server to help source your .env file. 
#
# To make this file executable, run `chmod +x apache2_env_setup.sh`.
#
# This file is to be run as root from within your code repository,
# where your `.env` resides. Any changes to your `.env` will take hold when you
# perform a `sudo service apache2 restart`.
#
# After making the file executable run it with `sudo ./apache2_env_setup.sh`

echo "set -o allexport
. `pwd`/.env
set +o allexport" >> /etc/apache2/envvars
