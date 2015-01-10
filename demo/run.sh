#!/bin/bash

if [ ! -d ZendSkeletonApplication ]
then
    git clone https://github.com/zendframework/ZendSkeletonApplication.git;
    cd ZendSkeletonApplication;
else
    cd ZendSkeletonApplication;
    git reset --hard origin/master;
fi;

composer install --no-dev;

cp ../files/application.config.php.dist config/application.config.php;
cp ../files/*.local.php ../files/*.global.php config/autoload;

cd module;
rm LdcContentBlock 2>/dev/null;
ln -s ../../../ LdcContentBlock 2>/dev/null;
rm BlockProviderModule 2>/dev/null;
ln -s ../../BlockProviderModule;
rm BlockExtensionModule 2>/dev/null;
ln -s ../../BlockExtensionModule;
cd - >/dev/null;

php -S 0.0.0.0:8080 -t public

