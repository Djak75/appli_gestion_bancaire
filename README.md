# Application de Gestion bancaire
Projet réalisé dans le cadre de mon ECF Développement Web

Organisation du projet :
J'ai suivi un plan bien défini pour structurer mon travail et assurer une progression fluide.


Jour 1 : Modélisation et préparation

Dictionnaire des données : Définition précise des tables, types de données et contraintes.
Modélisation MERISE : Création du MCD et MLD pour structurer correctement la base de données.
Script SQL : Création des tables en respectant le cahier des charges.

Point notable : Cette étape a été plus rapide que prévu, j’ai donc pu commencer l'architecture MVC dès le premier jour.


Jour 2 : Mise en place de l’architecture MVC et base de données
Installation de l’environnement de travail (PHP, MySQL, Apache avec XAMPP).
Création de l’arborescence du projet en suivant l’architecture MVC.
Création de la base de données et insertion de données de test.

Difficulté rencontrée :
Erreur 404 sur certaines pages → Résolu en ajustant les chemins relatifs (require_once __DIR__ . ...).
Création d'une classe Database.php pour la connexion proprement en POO.
Problème de connexion MySQL → XAMPP ne démarrait pas correctement, nécessitant un redémarrage


Jour 3 : Développement Back-End
Authentification de l’administrateur avec hachage du mot de passe (bcrypt).
Mise en place des DAO (Data Access Object) pour une interaction sécurisée avec la base.
Implémentation du CRUD Clients (Ajouter, Modifier, Supprimer, Lister).
Implémentation du CRUD Comptes bancaires.
Implémentation du CRUD Contrats.

Difficultés rencontrées :
Erreur sur la suppression des clients avec comptes liés → J’ai ajouté une double alerte avant suppression.
Affichage de l'identifiant du client & numéro client → Adaptation du modèle pour afficher SIMP202501, SIMP202502….
Erreur SQL lors de l’insertion des comptes et contrats → Correction des requêtes et ajustement des types de données


Jour 4 : Développement Front-End et intégration
Création de la page de connexion avec message erreur si mauvais identifiants.
Mise en page avec Bootstrap pour une meilleure ergonomie.

Affichage du tableau de bord avec :
Nombre total de clients.
Nombre total de comptes.
Nombre total de contrats.
Navigation fluide avec une barre navigation dynamique.

Difficulté rencontrée :
Le fichier CSS ne s'appliquait pas → Problème de chemin, résolu en ajoutant app/ dans le chemin relatif.
Affichage dynamique des statistiques → J’ai dû revoir les requêtes SQL pour bien récupérer les totaux
Correction du problème de redirection après connexion (qui menait sur la liste des comptes au lieu du tableau de bord)
Effacé la barre de navigation lorsque la Session est deconnecté


Jour 5 : Sécurité, tests et finalisation
Requêtes préparées pour éviter les injections SQL.
Tests approfondis sur toutes les fonctionnalités.
Ajout des messages de confirmation après chaque action.
Documentation et nettoyage du code avec des commentaires clairs.

Difficulté rencontrée :
Affichage du bon message de succès/erreur → Ajout d'un script pour masquer les messages après 3 secondes.
Problème de redirection après connexion admin → Corrigé en redirigeant vers le tableau de bord (index.php?controller=dashboard).
Ajout d’un bouton "Voir dossier" dans la liste des clients pour afficher les détails complets d’un client (j'avais oublié et je l'ai vu en relisant encore le cahier des charges)
Sur la modification d’un compte, affichage du nom du client en lecture seule pour éviter toute erreur.


Bilan du projet

Respect du cahier des charges : 100% conforme (j'espère)
Plan initial respecté : J’ai même terminé en avance jeudi soir.
Difficultés rencontrées : Résolues au fur et à mesure.
Expérience : Hyper satisfaisante, un vrai kiff de voir son travail à la fin

Voir son projet terminé et fonctionnel apporte une énorme satisfaction. 
J’ai beaucoup appris sur l’architecture MVC, la gestion des erreurs et l’importance de structurer son projet dès le début.


Technologies utilisées
✔️ Langage Back-End : PHP (avec PDO)
✔️ Langage Front-End : HTML, CSS, Bootstrap
✔️ Base de données : MySQL
✔️ Architecture : MVC (Modèle-Vue-Contrôleur)
✔️ Sécurité : Requêtes préparées, hachage des mots de passe


Se connecter en tant qu'admin :
Email : admin@banque.com
Mot de passe : admin123


Conclusion

J’ai énormément progressé sur la structuration d’un projet, la rigueur dans le développement et la gestion des bases de données.
Ce projet m’a conforté dans mon choix de poursuivre dans le développement web et l’IA après la formation

Prochaine étape ? Améliorer encore l’ergonomie et la sécurité pour des futurs projets plus ambitieux.


Jawad Berrhili
Vendredi 21 mars 2025