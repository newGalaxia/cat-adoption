
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


## Lancer l'API 

```
Docker compose up -d 
```

## Stopper l'API

```
Docker compose down -d 
```