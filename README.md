# Oblog Project

Ce projet est une ébauche de galerie commerçante sans la gestion du panier client. 

Contributors
--
- Ecole O'Clock : Singleton Pattern pour la connexion à la BDD, galerie d'images
- Guillaume S. : correction et conseils en vue d'améliorer le changement de devises, et la factorisation des méthodes 

Content
--
Le contenu est superficiel. Seules les fonctionnalités importent dans ce projet. 

Realisation
--
  Commentaires :
 - La page index.php et les controleurs sont commentés afin de mieux naviguer entre les différents fichiers. 

 - Pour les models, il faut se référer au model Brand.php afin de comprendre comment fonctionne les classes, leur propriété et leur méthode. (Quelques méthodes exceptionnelles dans product et type sont commentées dans leur classe directement)

- le header et le footer sont commentés 
- pour comprendre les views category, type, brand, product, il faut se référer à la view brand.tpl.php qui est entièrement commentée
--
J'ai pu m'exercer en travaillant sur la dynamisation du site à partir d'une intégration en dur. 
C'était un bel exercice pour travailler en POO/architecture MVC et des jointures SQL. 

- Temps pris : Deux jours en  Mars 2020
  
- Langages, frameworks et utilitaires:
  - PHP
  - SQL
  - Singleton Pattern
  - Active Records Pattern
  - Composer --> Symfony var-dumper, autoload, altorouter


- Difficultés rencontrées :
    - Gestion de la pagination
    - Gestion du tri
    - Gestion du changement de devises

- Evolutions possibles :
  - La gestion de la devise en cookie plutôt qu'en session
  - Le tri des produits (nom, prix) ne fonctionne pas avec la pagination
  -  La logique est à implémenter prioritairement via des méthodes plutôt que dans les views directement