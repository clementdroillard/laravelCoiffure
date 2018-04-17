# laravelCoiffure

Tout d'abord il vous faut une machine linux avec mysql et php.

Ensuite avec le terminal exécuter cette commande:
git clone https://github.com/clementdroillard/laravelCoiffure.git

Positionné vous dans le dossier : 
cd laravelCoiffure/

Puis faire :
composer install

Dans le fichier .env entrer vos paramètres de connexion à votre bdd.

Pour générer la base de données :
php artisan migrate

Pour lancer le serveur :
php artisan serve

Puis aller à l'application : 
https://github.com/clementdroillard/coiffure
