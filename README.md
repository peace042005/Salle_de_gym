# FitSense — Gestion de salles de sport

Plateforme web qui référence des **salles de sport** : les visiteurs trouvent une salle sur la carte et s'y abonnent, les **gérants** publient leurs salles et vendent des équipements, et un **administrateur** gère les formules d'abonnement. Les paiements passent par **FedaPay** (Mobile Money, carte bancaire).

> **Démo en ligne :** _lien à ajouter après le déploiement_
> L'hébergement gratuit met l'application en veille : le premier chargement peut prendre environ une minute.

## Comptes de démonstration

| Rôle | E-mail | Mot de passe |
|---|---|---|
| Administrateur | `admin@admin.com` | `123` |
| Gérant de salle | `manager@manager.com` | `123` |
| Utilisateur | `user@user.com` | `123` |

Les données de démonstration sont réinitialisées à chaque redémarrage du serveur.

## Fonctionnalités

**Visiteur / utilisateur**
- Recherche de salles et carte interactive des salles à proximité
- Fiche détaillée d'une salle : équipements, formules d'abonnement
- Abonnement à une salle et achat d'équipements, payés via FedaPay
- Tableau de bord : abonnements en cours, achats et suivi de livraison
- Passage au statut de gérant (paiement unique)

**Gérant**
- Gestion de ses salles : photos, description, position sur la carte, formules proposées
- Gestion de ses équipements à vendre
- Suivi des abonnés et des achats de ses salles

**Administrateur**
- Tableau de bord global (salles, équipements, abonnés, achats)
- Gestion des formules d'abonnement (durée, prix)
- Accès à l'ensemble des salles, équipements, achats et abonnements

## Sécurité

- **Contrôle d'accès par rôle** : middlewares dédiés (`AdminMiddleware`, `ManagerMiddleware`, `UserMiddleware`, `AdminManagerMiddleware`).
- **Cloisonnement des données** : un gérant ne peut consulter, modifier ou supprimer que ses propres salles et équipements.
- **Vérification des paiements côté serveur** : après un paiement, le serveur interroge l'API FedaPay pour confirmer que la transaction est approuvée, qu'elle appartient à l'utilisateur connecté et que le montant correspond au prix en base. Rien n'est accepté sur la seule foi du navigateur.

## Technologies

| Couche | Outils |
|---|---|
| Backend | Laravel 11 (PHP 8.3), Eloquent |
| Frontend | Blade, Bootstrap, Vite, Google Maps (positionnement des salles) |
| Paiement | FedaPay (SDK PHP + widget Checkout) |
| Base de données | SQLite (MySQL possible) |
| Déploiement | Docker (PHP + Apache), Render |

## Installation en local

Prérequis : PHP 8.2+, Composer, Node.js 20+.

```bash
git clone https://github.com/peace042005/Salle_de_gym.git
cd Salle_de_gym

composer install
npm install

cp .env.example .env
php artisan key:generate
touch database/database.sqlite   # sous Windows : type nul > database\database.sqlite

php artisan migrate --seed       # tables, comptes et données de démonstration
php artisan storage:link         # rend les images accessibles

npm run dev                      # dans un premier terminal
php artisan serve                # dans un second terminal
```

L'application est alors disponible sur http://localhost:8000.

Pour tester les paiements, créer un compte sur [sandbox.fedapay.com](https://sandbox.fedapay.com) et renseigner `FEDAPAY_PUBLIC_KEY` et `FEDAPAY_SECRET_KEY` (clés du mode test) dans `.env`. La carte du formulaire des salles utilise `GOOGLE_MAPS_KEY` (clé à restreindre au domaine du site).

## Déploiement (Render, offre gratuite)

Le dépôt contient un `Dockerfile` et un fichier `render.yaml`.

1. Sur [render.com](https://render.com) : **New → Blueprint**, puis choisir ce dépôt.
2. Render demande les clés FedaPay du mode test et la clé Google Maps : les coller (ou laisser vide, le site fonctionne sans le paiement ni la carte).
3. Ouvrir l'URL fournie une fois le déploiement terminé.

Au démarrage, `docker/start.sh` génère la clé de l'application, met en cache la configuration et recrée la base SQLite avec les données de démonstration.

## Auteure

**Marcella Chanhoun** — [GitHub](https://github.com/peace042005)

Projet réalisé dans le cadre de ma licence en informatique.
