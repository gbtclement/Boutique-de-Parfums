# Boutique-de-Parfums


aller sur mongoCompase -> add new connection

url : mongodb://localhost:27017
name : boutiqueDeParfums

-> save and connect

en haut a droit tu as un shell, tu l'ouvres, tu écris les commandes suivantes

use admin 

db.createUser({
    _id: 'admin.admin',
    userId: UUID('e55fd818-f57c-4ec7-beda-77386c0c193f'),
    user: 'admin',
    db: 'admin',
    roles: [
        { role: 'userAdminAnyDatabase', db: 'admin' }
    ],
    mechanisms: [ 'SCRAM-SHA-1', 'SCRAM-SHA-256' ],
    pwd: 'admin'
});

use boutiqueDeparfums

db.createCollection("articles")

et normalement c'est bon 


