Guide d’installation du projet Connexion_By_Phoenix

Ce projet nécessite plusieurs outils pour fonctionner correctement : XAMPP, PHP 8.1 ou supérieur, Composer, Symfony CLI, Git et Visual Studio Code.

1️⃣ Installer XAMPP

Site officiel : https://www.apachefriends.org/fr/index.html

Étapes :

Cliquez sur le bouton « Télécharger » correspondant à votre système d’exploitation.

Lancez l’installateur téléchargé.

Suivez les instructions à l’écran et laissez les options par défaut.

Une fois installé, ouvrez XAMPP.

Cliquez sur Start pour Apache et MySQL (les deux premiers boutons).

2️⃣ Installer PHP 8.1 ou supérieur

⚠️ Si vous utilisez XAMPP, PHP est déjà inclus. Il n’est donc pas nécessaire de le réinstaller.

Site officiel : https://www.php.net/downloads

Étapes :

Téléchargez la version correspondante à votre OS.

Installez PHP en suivant les instructions par défaut.

Vérifiez l’installation : ouvrez un terminal et tapez :

php -v

Vous devriez voir la version installée.

3️⃣ Installer Composer

Site officiel : https://getcomposer.org/download/

Étapes :

Téléchargez l’installateur Windows (.exe) ou suivez les instructions pour macOS/Linux.

Lancez l’installateur et suivez les instructions.

Vérifiez l’installation :

composer -V

Vous devriez voir la version de Composer.

4️⃣ Installer Symfony CLI

Site officiel : https://symfony.com/download

Étapes :

Téléchargez l’installateur pour votre système.

Suivez les instructions pour installer Symfony CLI.

Vérifiez l’installation :

symfony -v

5️⃣ Installer Git

Site officiel : https://git-scm.com/downloads

Étapes :

Téléchargez Git pour votre système.

Installez-le en laissant les options par défaut.

Vérifiez l’installation :

git --version

6️⃣ Installer Visual Studio Code

Site officiel : https://code.visualstudio.com/

Étapes :

Téléchargez le programme d’installation correspondant à votre système.

Installez Visual Studio Code.

7️⃣ Télécharger et ouvrir le projet

🔹 1. Importer la base de données

Dans les fichiers du projet, il existe un fichier nommé : connexion_by_phoenix.sql

Étapes :
1.Ouvrez ce fichier avec Visual Studio Code.
2.Sélectionnez tout le contenu (CTRL + A).
3.Copiez tout le contenu (CTRL + C).

Ensuite :

Ouvrez votre navigateur et allez sur : http://127.0.0.1/phpmyadmin/

Identifiants :
  Nom d’utilisateur : root
  Mot de passe : (laisser vide)

Cliquez sur Se connecter.

Cliquez sur le logo maison en haut à gauche.

Cliquez sur Bases de données.

Dans le champ Nom de base de données, écrivez exactement : connexion_by_phoenix

Cliquez sur Créer.

Dans le menu de gauche, cliquez sur la base de données connexion_by_phoenix.

Cliquez sur l’onglet SQL.

Collez le code copié précédemment (CTRL + V).

Cliquez sur Exécuter.

La base de données est maintenant installée.

🔹 2. Lancer le projet

Ouvrez Visual Studio Code.

Cliquez sur Open Folder et sélectionnez le dossier du projet.

En haut, cliquez sur Terminal, puis New Terminal.

Une fenêtre noire apparaît en bas avec une ligne ressemblant à :

PS C:\chemin\vers\le\projet>

Tapez les commandes suivantes une par une en appuyant sur Entrée après chaque ligne :

composer install
php bin/console doctrine:migrations:migrate

Si un message demande confirmation, tapez :

yes

Lancez ensuite le serveur local avec :

symfony serve

Cette commande lance le serveur local de Symfony.

Ouvrez votre navigateur internet et tapez dans la barre d’adresse :

http://127.0.0.1:8000/login

Le site devrait maintenant s’afficher.

✅ Avec ces étapes, votre projet Symfony devrait fonctionner correctement.
