#Billie PHP Test

Laravel 5.7

A Restful API Service to manage transactions

Assumtions - 
  Docker is installed (including docker-compose)

two folders to be viewed are 

Billie-Technical-Task-Backend-Engineer (the main dir)
->docker-for-billie    # this is where to go to run Docker. - 
->billie               # This is the Larvel project

Enter the docker-for-billie folder in a shell and type

```
docker-compose up --build
```

The first time you do this it could take maybe 10 mins

Once this process completes again Enter the docker-for-billie folder in a shell and type

```
docker exec -it billiephpserver bash
```

And you should get to a folder inside the billiephpserver container, first things first run composer install 

```
[root@185a69a21e5e:/var/www/billie] (master)# composer install 
```

The env file has been set up to point to the db that will come up with docker.

The API will be available on billie.local. 

You will need to add it to your hosts file

```
127.0.0.1 billie.local
```
