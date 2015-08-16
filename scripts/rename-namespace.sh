#!/bin/sh

read -p "Enter the new namespace to use: " GLOBALNAMESPACE
find . -name "*.php" -print0 | xargs -0 sed -i -e "s/PhalconSkeleton/$GLOBALNAMESPACE/g"
sed -i -e "s/PhalconSkeleton/$GLOBALNAMESPACE/g" ./composer.json
