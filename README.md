## Installation

##### Voici les étapes pour l'installation de la box vagrant (avec symfony3) :

```sh
$ git clone https://github.com/hpiso/vagrant-hackathon.git
$ cd vagrant-hackathon
$ vagrant up
```

Voilà, c'est tout !!! La première fois que vous allez lancer vagrant up, ca va être un peu long (entre 5 et 10min), car il va installer toutes les dépendances automatiquement (apt-get install mysql, apache2,...).

##### Bon, il reste encore 2 minis étapes pour accéder au projet
* Changer le host de votre propre pc (sur windows c'est genre system32/etc/driver/jesaisplus/...) avec exactement cette ip associée à ce nom : 192.168.33.99 hackathon.local
* Le fameux "composer install" (je vous conseil de le faire directement dans la VM avec les commandes suivantes)

```sh
$ vagrant ssh
$ cd /vagrant/www
$ composer install
```

Vous pouvez désormais accéder au projet via http://hackathon.local/app_dev.php

