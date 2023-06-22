
# Cat Adoption API 

## Prérequis

- Intaller Docker version 24.0.2

Pour installer docker suivre la documentation officielle :

https://docs.docker.com/engine/install/debian/

```
$ docker -v
Docker version 24.0.2, build cb74dfc
```

- Docker s'exécute uniquement avec un user avec des privilège root donc voici un bout de code utile :

```
alias docker=sudo docker
```

- Installer Docker compose

https://docs.docker.com/compose/install/linux/

```
$ docker compose version
Docker Compose version v2.18.1
```


## Initialiser l'API 

```
cd ~
git clone git@github.com:newGalaxia/cat-adoption.git

```
mettre à jour votre kamarade dans le .env puis

```
docker compose up -d
docker exec -it hash-du-container-sf8 bash
symfony console doctrine:schema:create

```


## Stopper l'API

```
Docker compose down
```

## Démarrer l'API (quand linit a déjà été fait)

```
Docker compose up
```