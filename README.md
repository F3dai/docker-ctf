# Temple CTF docker files

A repo to clone and build a vulnerable web app to pen test.

## Create Docker Image:

Build the image with the Dockerfile in this repo.

```
docker build -t templeimg .
```

## Run Temple Container:

Run a container with the image created:

```
docker run --name temple -d -p 8000:80 templeimg
```

## Spawn a shell:

If you want to bash into the container, run the following commands:

```
docker ps
docker exec -it <container ID> /bin/bash
```
