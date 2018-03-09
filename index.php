<?php

/**
 * Vous devez :
 *
 * 1 - Créer une base de donnée (php_is_best) avec une table utilisateur (users) (dans un fichier database.sql)
 * - La table doit avoir les colonnes suivantes :
 * -- id INCREMENT INT
 * -- username VARCHAR(50)
 * -- email VARCHAR(50)
 * -- note INT
 *
 * POINTS: 2
 *
 * 2 - Les commandes suivante doivent permettre l'ajout d'un utilisateur avec une note :
 * -- php index.php --username=USERNAME --email=EMAIL --note=NOTE_INTEGER
 * -- php index.php -u=USERNAME -e=EMAIL -n=NOTE_INTEGER
 *
 * - L'ajout d'un utilisateur doit être unique
 *
 * POINTS: 3
 *
 * 3 - Les commandes suivante doivent mettre à jour une note d'un utilisateur
 * -- php index.php --email=EMAIL --note=NOTE_INTEGER
 * -- php index.php -e=EMAIL -n=NOTE_INTEGER
 * -- php index.php --id=INTEGER -n=NOTE_INTEGER
 *
 * POINTS: 3
 *
 * 4 - Les commandes suivante doivent lister les utilisateurs
 * -- php index.php --list
 * -- php index.php -l
 *
 * - Le format de la liste doit être la suivante :
 * | id | USERNAME | EMAIL                | NOTE |
 * | 1  | John     | john.doe@domaine.tld | 10   |
 * | 2  | jane     | j.doe@domaine.tld    | 20   |
 *
 * POINTS: 8
 *
 * 5 - Les commandes suivante doivent permettre d'afficher la moyenne de toutes les notes
 * - php index.php --average
 * - php index.php -a
 *
 * POINTS: 2
 *
 * 6 - Le travail doit être pousser sur un repository contenant fichier un README.md
 * avec votre nom et prénom et le lien envoyer dans votre channel Teams avant 17 h 00.
 *
 * POINTS: 2
 *
 * 7 - Le code doit être organisé (fonctions, fichiers...)
 *
 * POINTS (bonus) : 1
 *
 * - Total des points 20 (avec bonus 21)
 *
 * Conseils :
 * - /!\ Poussez votre code avant 17 h 00 (toutes modifications après cette heure ne seront pas prises en compte dans l'évaluation)
 * - /!\ Vous pouvez vous aidez, mais pas copier le code du voisin
 *
 * - Créer votre repository en premier
 * - Lister vos tâches avant de commencer à coder
 * - Voir le point 7 en dernier, c'est du bonus
 * - Demander conseil au formateur
 * - Prendre des pauses et amusez-vous xD
 */