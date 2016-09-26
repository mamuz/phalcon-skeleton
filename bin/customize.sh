#!/bin/sh

read -p "Enter the new classnamespace identifier to use (e.g. Application): " FQCN
read -p "Enter composer namespace (e.g. user/application): " COMPOSERNAMESPACE
read -p "Enter a short project description: " PROJECTDESCRIPTION
read -p "Enable view support? (Y|n): " VIEW_SUPPORT

if [ $VIEW_SUPPORT != "Y" ]; then
    rm -rf ./view
    sed -i -e "/^\s*'view'./d" ./config/application.php
fi

find . -name "*.php" -print0 | xargs -0 sed -i -e "s/PhalconSkeleton/$FQCN/g"
sed -i -e "s:mamuz/phalcon-skeleton:$COMPOSERNAMESPACE:g" ./composer.json
sed -i -e "s/PhalconSkeleton/$FQCN/g" ./composer.json
sed -i -e "s/Simple skeleton application using the Phalcon3 Framework"/$PROJECTDESCRIPTION/g" ./composer.json
sed -i -e "s/PROJECT_NAME/$FQCN/g" ./bin/skeleton-templates/README.md
sed -i -e "s/PROJECT_DESCRIPTION/$PROJECTDESCRIPTION/g" ./bin/skeleton-templates/README.md

mv -f ./bin/skeleton-templates/* .
rm -rf ./bin/customize.sh ./bin/skeleton-templates

composer update --lock

echo "Customizing done!"
