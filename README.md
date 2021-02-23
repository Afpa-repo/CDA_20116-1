# CDA_20116-1


***********
Instructions pour un clônage ou un download:

Pour installer composer dans le dossier
clic droit sur le dossier Git Bash Here
Puis dans la console tapez:
composer install

Pour créer la base de données :
php bin/console doctrine:database:create

Pour construire la bdd :
php bin/console doctrine:migrations:migrate

Pour installer easy admin:
 composer require easycorp/easyadmin-bundle

Pour installer les assets manquants:
 composer require symfony/asset

Pour lancer le server:
Symfony server:start

