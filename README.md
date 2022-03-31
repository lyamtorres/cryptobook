<h1 align="center">Bienvenu-e à Cryptobook 👋</h1>
<p>
</p>

> Application qui permet l'échange entre des personnes intéressées par les cryptomonnaies et le métavers.

## Installation

Afin de pouvoir utiliser notre application, vous allez avoir besoin de quelques outils et paramétrages :

1- Un serveur Web/PHP/MySQL pour la base de données, Symfony embarque son propre serveur Web.
    - XAMPP, cet ensemble de logiciels libres vous offrira l'accès à une base de données MySQL : https://www.apachefriends.org/fr/download.html

2- Composer, le logiciel gestionnaire de dépendances libre, écrit en PHP, qui vous fournira de plus un autoloader (chargeur de classes PHP automatique) : https://getcomposer.org
    2.1- Une fois l'installation par Composer-Setup.exe terminée, ouvrez un terminal et tapez la commande : composer

3- Un IDE (environnement de dévloppement intégré) pour la connexion à la base de données. Vous pourrez aussi vous servir du terminal intégré.
    - VSC (Visual Studio Code) : https://code.visualstudio.com/download

4- Symfony, le framework MVC libre, écrit en PHP.
    4.1- Pour installer Symfony, il vous faudra aussi installer gofish, le gestionnaire de packages de systèmes multiplateformes en tapant les commandes suivantes après avoir ouvert votre terminal Windows Power Shell en tant qu'administrateur :
```bash
        - Set-ExecutionPolicy Bypass -Scope Process -Force
          iex ((New-Object System.Net.WebClient).DownloadString('https://raw.githubusercontent.com/fishworks/gofish/main/scripts/install.ps1'))
        - gofish install gofish
        - gofish upgrade gofish
        - gofish rig add https://github.com/symfony-cli/fish-food
        - gofish install github.com/symfony-cli/fish-food/symfony-cli
```

5- Ouvrez le dossier, cryptobook-master, de notre application avec votre IDE préféré, et utilisez son terminal pour vous placer dedans.

6- Dans le terminal de votre IDE, tapez les commandes suivantes : 
```bash
    - composer install
    - composer require symfony/polyfill-intl-messageformatter
```

7- Grâce à votre IDE, connectez-vous à votre base de donnée MySQL (si vous utilisez XAMP) dans le fichier ".env" en rajoutant dans la partie ###> doctrine/doctrine-bundle ### le code  suivant avec vos informations :
    - DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"

8- Dans le terminal de votre IDE, tapez les commandes suivantes : 
```bash
    - php bin/console doctrine:schema:update --force
    - php bin/console doctrine:fixtures:load
```

Vous pouvez maintenant lancer le serveur web, toujours à travers le terminal, à l'aide de la commande : php bin/console doctrine:fixtures:load

Maintenant, plus qu'à vous connectez sur l'application en tapant dans votre navigateur l'url suivant : http://localhost:8000/fr


## Utilisation

Une page web s'ouvre donnant la liste des cryptomonnaies mises en lignes par leurs créateurs, un système de filtre sur cette liste et des onglets "Acceuil", "Langue", "Inscription" et "Connexion".
Choisissez la langue qui vous convient en cliquant sur le symbole "Langue".

Sans être connecté, vous pouvez déjà voir les caractéristiques détaillées des cryptomonnaies et les commentaires des utilisateurs sur celles-ci en cliquant sur leurs noms. 

Pour ajouter une cryptomonnaie en ligne, ou poster un commentaire, il faudra au préalable vous connecter et donc vous inscrire, grâce à l'onglet "Inscription".

Pour créer un nouveau compte, il faut compléter le formulaire en rentrant votre nom d'utilisateur, votre adresse mail, votre mot de passe et cocher la case "Agree Terms".

Vous arrivez sur la page de votre portefeuille de cryptomonnaies.
De nouveaux onglets sont apparus : "Ajouter une crypto" (Pour ajouter votre propre cryptomonnaie en ligne), "Portefeuille" (votre portefeuille de cryptomonnaies), "Déconnexion".

Allez sur "Ajouter une crypto" et remplissez le formulaire qui correspond aux caractéristiques de la cryptomonnaie.
Vous pouvez annuler l'ajout à tout moment.

Une fois votre cryptomonnaie enregistrée, elle apparaît dans votre portefeuille.
à la place, tu peux mettre : Vous pouvez modifier, supprimer et accéder aux pages dédiées à vos cryptomonnaies. 
Lors de la suppression, un pop-up de confirmation apparît.

Vous pouvez aussi retourner à l'accueil, grâce à l'onglet "Accueil", afin d'étudier les nombreuses cryptomonnaies mises en ligne par la communauté, et cette fois poster des commentaires sous chacune de celles-ci après avoir cliqué sur leurs noms.

Déconnectez-vous et reconnectez-vous quand bon vous semble.

## Auteurs

👤 **Lyam Torres**
👤 **Noélie Darras**
👤 **Brice Grivet**

***
_This README was generated with ❤️ by [readme-md-generator](https://github.com/kefranabg/readme-md-generator)_