# NaurelliaCraft - Website

## Project - Web Programmation - Advanced 

---

### <ins>Description : </ins>

This project comes after one of my personal projects whose goal was to create from scratch a Minecraft Earth-RP server, so I decided to take the source code of the website created for this purpose to implement everything I learned about Symfony.

In particular :
- Twig templates | [Twig](https://twig.symfony.com/doc/3.x/)
- Entities | [Entities](https://symfony.com/doc/current/doctrine.html#creating-an-entity-class)
- Controllers | [Controllers](https://symfony.com/doc/current/controller.html)
- Routes / Assets / Paths | [Routes](https://symfony.com/doc/current/routing.html)
- A secure login page | [Security](https://symfony.com/doc/current/security.html)
- Connection to a database | [Database](https://symfony.com/doc/current/doctrine.html)
- CRUD (Create, Read, Update, Delete) system | [CRUD](https://symfony.com/doc/current/doctrine.html#creating-an-entity-class)
- Fixtures (for testing) | [Fixtures](https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html)
- PHPDoc (for documentation) | [PHPDoc](https://www.phpdoc.org/docs/latest/index.html)
- Api (for the shop items) | JSON format | [Api](https://symfony.com/doc/current/bundles/FOSRestBundle/index.html)

All this in order to make this website even better

---

### <ins>Commits :</ins>

```
Date - Commit name
--------------------

03/04/2023 - Initial Commit
03/04/2023 - Init SecurityController
03/04/2023 - Add readme.md file
03/04/2023 - Init Registration
04/04/2023 - Added Dashboard, added Users Entity, added Users CRUD, removed SecurityController and Registration (moved to Users CRUD) and added UsersFixtures (for testing) 
04/04/2023 - Added 2 Entities : UsersIG and InfractionsIG with CRUD controller for them
14/04/2023 - Deleting project content
14/04/2023 - Cleaned up the code, reset everything to the initial commit and started again but with a better structure
14/04/2023 - Added a file upload system for the users (skin) and modified the User entity to add the skin path
15/04/2023 - Added 2 new entities : UserIG and InfractionsIG also updated the User entity to handle french date format and started update the SecurityController to handle the new entities
17/04/2023 - Updated the SecurityController to handle the new entities, added CRUD controller for the new entities, the account page can now display player's infractions when its linked.Added PHPDoc for all the project.
17/04/2023 - Modified the readme.md file
19/04/2023 - Added a new Entity : ShopItem, added 2 new Controllers: ShopItemController and ApiController, added a new page to display the shop items and added a new page to display the shop items in JSON format
20/04/2023 - Update the Shop Page by adding new proctucts, added CRUD controller for the ShopItem entity and resolved the bugs due to the modification on the old entities in their CRUD controllers (UserIG, InfractionsIG)
```

---

### <ins>Installation : </ins>

```bash
git clone git@github.com:Armotik/NaurelliaCraftWebsite.git
cd NaurelliaCraftWebsite

cd NaurelliaCraftWebsite
composer install
npm install
npm run build # or npm run watch
```

---

### <ins>Structure : </ins>

``` 
.
├── assets (folder)
├── bin
│   └── console.php
├── config
│   ├── packages (folder)
│   ├── routes (folder)
│   ├── bundles.php
│   ├── preload.php
│   ├── routes.yaml
│   └── services.yaml
├── migration (folder)
├── public
│   ├── css
│   │   ├── main.css
│   │   ├── styles.css
│   │   ├── responsive.css
│   │   └── normalize.css
│   ├── doc
│   │   ├── css.md
│   │   ├── extand.md
│   │   ├── faq.md
│   │   ├── html.md
│   │   ├── js.md
│   │   ├── misc.md
│   │   ├── TOC.md
│   │   └── usage.md
│   ├── fonts
│   │   └── sensation_light (folder)
│   ├── img
│   │   ├── backgroundimage.jpg
│   │   └── Naurellia_logoComplet-redim.png
│   ├── js
│   │   ├── vendor (folder)
│   │   ├── main.js
│   │   └── plugins.js
│   ├── .editorconfig
│   ├── .htaccess
│   ├── 404.html
│   ├── browserconfig.xml
│   ├── favicon.ico
│   ├── humans.txt
│   ├── icon.png
│   ├── index.php
│   ├── package.json
│   ├── robots.txt
│   ├── site.webmanifest
│   ├── tile.png
│   └── tile-wide.png
├── src
│   ├── ApiResource (folder)
│   ├── Controller
│   │   ├── Admin
│   │   │   ├── DashboardController.php
│   │   │   ├── ShopItemCrudController.php
│   │   │   ├── InfractionsCrudController.php
│   │   │   ├── UserIGCrudController.php
│   │   │   └── UserCrudController.php
│   │   ├── ApiController.php
│   │   ├── DefaultController.php
│   │   ├── IngameShopController.php
│   │   ├── SecurityController.php
│   │   └── RegistrationController.php
│   ├── DataFixtures
│   │   └── AppFixtures.php
│   ├── Entity
│   │   ├── UserIG.php
│   │   ├── ShopItem.php
│   │   ├── InfractionIG.php
│   │   └── User.php
│   ├── Form
│   │   ├── ContactType.php
│   │   ├── NewPasswordFormType.php
│   │   ├── FileFormType.php
│   │   └── RegistrationFormType.php
│   ├── Repository
│   │   ├── UserIGRepository.php
│   │   ├── ShopItemRepository.php
│   │   ├── InfractionIGRepository.php
│   │   └── UserRepository.php
│   ├── Security
│   │   ├── EmailVerifier.php
│   │   └── LoginFormAuthenticator.php
│   └── Kernel.php
├── templates
│   ├── admin
│   │   └── dashboard.html.twig
│   ├── api
│   │   └── index.html.twig
│   ├── default
│   │   ├── account.html.twig
│   │   ├── index.html.twig
│   │   ├── play.html.twig
│   │   ├── wiki_rules.html.twig
│   │   └── contact.html.twig
│   ├── ingame_shop
│   │   ├── buy.html.twig
│   │   ├── index.html.twig
│   │   └── item.html.twig
│   ├── registration
│   │   ├── confirmation_email.html.twig
│   │   └── register.html.twig
│   ├── security
│   │   └── login.html.twig
│   └── base.html.twig
├── var (folder)
├── vendor (folder)
├── .env
├── .env.local
├── .gitignore
├── composer.json
├── composer.lock
├── docker-compose-overrides.yml
├── docker-compose.yml
├── readme.md
└── symfony.lock
```

### assets

This folder contains the assets files of the project.

### bin

This folder contains the console.php file which is used to launch the Symfony CLI.

### config

This folder contains the configuration files of the project (routes, services, etc.).

### migration

This folder contains the migration files of the project (database).

### public

This folder contains the public files of the project. It's a Boilerplate from HTML5UP (https://html5up.net/) and I modified it to make it work with Symfony and Twig.

- css : Contains the css files of the project.
- doc : Contains the documentation files of the project.
- fonts : Contains the fonts files of the project.
- img : Contains the images files of the project.
- js : Contains the javascript files of the project.
- uploads : Contains the uploads files of the project.
- .editorconfig : Contains the configuration of the editor.
- .htaccess : Contains the configuration of the server.
- 404.html : Contains the 404 page.
- browserconfig.xml : Contains the configuration of the browser.
- favicon.ico : Contains the favicon of the project.
- humans.txt : Contains the humans of the project.
- icon.png : Contains the icon of the project.
- index.php : Contains the index of the project.
- package.json : Contains the configuration of the project.
- robots.txt : Contains the robots of the project.
- site.webmanifest : Contains the configuration of the project.
- tile.png : Contains the tile of the project.
- tile-wide.png : Contains the tile of the project.

### src

This folder contains the source files of the project (Symfony).

- Controller : Contains the controllers of the project
  - Admin : Contains the admin controllers of the project
    - DashboardController.php : Contains the dashboard controller of the project
    - InfractionsCrudController.php : Contains the infractions crud controller of the project
    - ShopItemCrudController.php : Contains the shop item crud controller of the project
    - UserIGCrudController.php : Contains the user IG crud controller of the project
    - UserCrudController.php : Contains the user crud controller of the project 
  - SecurityController.php : Contains the security controller of the project
  - ApiController.php : Contains the api controller of the project
  - IngameShopController.php : Contains the ingame shop controller of the project
  - RegistrationController.php : Contains the registration controller of the project
  - DefaultController.php : Contains the default controller of the project
- DataFixtures : Contains the data fixtures of the project
  - AppFixtures.php : Contains the fixtures of the project
- Entity : Contains the entities of the project*
    - User.php : Contains the user entity of the project
    - UserIG.php : Contains the user IG (Minecraft) entity of the project
    - ShopItem.php : Contains the shop item entity of the project
    - InfractionIG.php : Contains the infraction IG entity for the user IG entity of the project
- Form : Contains the forms of the project
  - ContactType.php : Contains the contact form of the project
  - NewPasswordFormType.php : Contains the new password form of the project
  - FileFormType.php : Contains the file form of the project
  - RegistrationFormType.php : Contains the registration form of the project
- Repository : Contains the repositories of the project
    - UserRepository.php : Contains the user repository of the project
    - ShopItemRepository.php : Contains the shop item repository of the project
    - UserIGRepository.php : Contains the user IG repository of the project
    - InfractionIGRepository.php : Contains the infraction IG repository of the project
- Security : Contains the security files of the project
    - EmailVerifier.php : Contains the email verifier of the project
    - LoginFormAuthenticator.php : Contains the login authenticator of the project
- Kernel.php : Contains the kernel of the project

### templates

This folder contains the templates files of the project (Twig).

- default : Contains the default templates of the project
  - index.html.twig : Contains the index template of the project
  - play.html.twig : Contains the play template of the project
  - wiki_rules.html.twig : Contains the wiki_rules template of the project
  - contact.html.twig : Contains the contact template of the project
  - account.html.twig : Contains the account template of the project
- admin : Contains the admin templates of the project
  - dashboard.html.twig : Contains the dashboard template of the project
- api : Contains the api templates of the project
  - index.html.twig : Contains the index template of the project
- ingame_shop : Contains the ingame shop templates of the project
    - buy.html.twig : Contains the buy template of the project
    - index.html.twig : Contains the index template of the project
    - item.html.twig : Contains the item template of the project
- registration : Contains the registration templates of the project
    - register.html.twig : Contains the register template of the project
    - confirmation_email.html.twig : Contains the confirmation email template of the project
- security : Contains the security templates of the project
    - login.html.twig : Contains the login template of the project
- base.html.twig : Contains the base template of the project

### var

This folder contains the var files of the project (cache, logs, sessions, etc.).

### vendor

This folder contains the vendor files of the project (Symfony, Twig, etc.).

### .env

This file contains the environment variables of the project (database, etc.).

### .env.local

This file contains the environment variables of the project (database, etc.).

---

### <ins>Authors : </ins>

- **Armotik** - *Initial work* - [Armotik] 

---

https://github.com/Armotik/NaurelliaCraftWebsite

Copyright (c) 2021 Armotik - All rights reserved - Last update : 20/04/2023

La Rochelle Université - France