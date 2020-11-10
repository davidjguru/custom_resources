# PROJECT_NAME
Welcome to the README file of the project Orona. This is a Drupal-based project, a web platform for showing the whole scenario of Orona, one of the largest elevator companies of the World.  

## 1- Introduction

For this site, we've thinking about a big Drupal 9 Site using i18n mixing [Domain Access module -domain-](https://www.drupal.org/project/domain) and the [Translatation Management Tool for Drupal -tmgmt-](https://www.drupal.org/project/tmgmt), in a Dockerized network of containers, using [DDEV-Local](https://ddev.readthedocs.io/en/stable/). 


## 2- Resources and Addresses
When you get the project deployed in local environment (following the nextsections), You will get a set of services in containers, with own addresses from your machine.   

### 2.1- List of addresses  
The set of available resources is as follows:  

Orona Deploy Resources for Local Environment   
---------------------------------------------   

* Web project Orona (https): https://PROJECT_NAME.ddev.site:9043/
* Web project Orona (http):  http://PROJECT_NAME.ddev.site:9080
* MailHog (https):   	     https://PROJECT_NAME.ddev.site:8026
* MailHog (http):            http://PROJECT_NAME.ddev.site:8025 
* phpMyAdmin (https):	     https://PROJECT_NAME.ddev.site:8037
* phpMyAdmin (http):         http://PROJECT_NAME.ddev.site:8036 
* Portainer (https): 	     https://PROJECT_NAME.ddev.site:8001
* Portainer (http):          http://PROJECT_NAME.ddev.site:9001 


### 2.2- Services, Tooling and Resources

* DDEV or DDEV-Local [ddev.readthedocs.io](https://ddev.readthedocs.io/en/stable/) is a Docker-related tool for building local-environments in a fast and comfortable way. It's a Open Source tool and requires Docker and Docker-Compose installed in your system. You can read more information about DDEV for local environments here:   
  * [Creating development environments for Drupal with DDEV](https://www.therussianlullaby.com/blog/creating-development-environments-for-drupal-with-ddev/).
  * [Docker, Docker-Compose and DDEV - Cheatsheet](https://www.therussianlullaby.com/blog/docker-docker-compose-and-ddev-cheatsheet/).
  * [How To Develop a Drupal 9 Website on Your Local Machine Using Docker and DDEV](https://www.digitalocean.com/community/tutorials/how-to-develop-a-drupal-9-website-on-your-local-machine-using-docker-and-ddev).

* Portainer [https://www.portainer.io/](https://www.portainer.io/) is a visual tool for management of Docker Networking. We're using Portainer in order to give a visual mode for the Docker / DDEV- Local deploy. You can see how is integrated here: [github.com/drud/ddev-contrib/docker-compose-services/portainer](https://github.com/drud/ddev-contrib/tree/master/docker-compose-services/portainer). Read more here: [portainer.readthedocs.io](https://portainer.readthedocs.io/en/stable/deployment.html).  

* MailHog [https://github.com/mailhog](https://github.com/mailhog) is a super simple SMTP server that hogs outgoing emails and you can see these hogged emails in a web interface. Is for development purposes only, if you need to test send of emails in the platform. Read more here: [https://github.com/mailhog/MailHog](https://github.com/mailhog/MailHog).  


## 3- Local Installation Process
For the local deploy, you will need to get installed some primary resources as Docker, Docker-Compose and DDEV. This project is build using these three tools. If you don't have the Docker Engine and DDEV installed, please, use a related script for these tools from the /scripts folder.     

### 3.1- Pre - Requisites
You wil need also have your own ssh keys located in the remote repository for authentication purposes.    
After that, get a local copy of the project using git clone, go to the scripting folder and launch the Docker-DDEV Engine related installer:               
```
$ git clone YOUR_URL_REPO
$ cd PROJECT_NAME/scripts/local_installers/
$ ./installing_docker_dockercompose_ddev
```
This will install the Docker Engine and DDEV in your Linux system (Debian, Ubuntu). 

### 3.2- TL;DR 
Copy and paste the next commands to your prompt and get the project ready-to-work.
```
$ git clone YOUR_URL_REPO
$ cd PROJECT_NAME
$ git checkout develop
$ ddev start
$ ddev composer install
$ cd ./backups/
$ latest_dump=$(ls -t | head -n 1)
$ ddev import-db --src=../backups/$latest_dump
$ ddev exec drush cr
$ ddev restart
$ ddev launch
```

### 3.3- Step by Step

1- Clone the remote repository getting your local copy using your custom URL from bitbucket. In my case:  
```
$ git clone https://URL/PROJECT_NAME.git
```
2- Then go to the main project folder:  
```
$ cd PROJECT_NAME
```
3- Move to your current location (branch master) to the working main branch (develop):   
```
$ git checkout develop
```
4- Init the DDEV local deploy:   
```
$ ddev start
```
5- Launch the Composer process for dependencies:   
```
$ ddev composer install
```
6- Go to the backups folder and load the last updated dump file:   
```
$ cd ./backups/
$ latest_dump=$(ls -t | head -n 1)
$ ddev import-db --src=../backups/$latest_dump
```
7- At last, clean the Drupal cache and launch the project in browser and prompt:    
```
$ ddev exec drush cr
$ ddev restart
$ ddev ssh
$ ddev launch
```

### 3.4- Using the provided scripting
We have a special script only for deploy the project in an automatized way. Just clone the project and launch this specific script:  

```
$ git clone YOUR_URL_REPO
$ git checkout develop
$ cd PROJECT_NAME/scripts/local_installers/
$ ./deploying_PROJECT_NAME_project

```
## 4- Interpreting the project
Now we're going to talk about some special folders included in the project and oriented to the daily life in development phases. Let's see.  

### 4.1- Complementary Folders
 You can see the next structure of folders:   

```
 /PROJECT_NAME/    
    /scripts/  
    /backups/  
    /docs/    
```

In these folder you can save and locate some aditional resources: bash tools in /scripts/, dump files in /backups/ (the most recent files, up to five max.) and related documents in /docs/. All of these are resources only for the development phase, after that and preparing the next environments (State, Pro, etc), will be deleted, for sure.  

### 4.2- Backups 
*How to get and save a database dump file for the project:*
```
cd /PROJECT_NAME
date=$(date +"%Y-%m-%d")
ddev export-db --file=./backups/db_PROJECT_NAME_$date.sql.gz

```
*How to get the last saved dump and loading in database:*
```
cd PROJECT_NAME/backups/
latest_dump=$(ls -t | head -n 1)
cd ..
ddev import-db --src=backups/$latest_dump
```


### 4.3- Keys for titles in commits
* (INI) - Initial commit in a repository.    
* (JVS) - Changes in JavaScript code or .js files.    
* (PHP) - Same as former but for PHP code or .php files.    
* (BSH) - Related with bash scripting.    
* (TXT) - Change content in text.    
* (MKD) - Change content in markdown files.    
* (FLD) - Adds a new folder or change its name.    
* (MDL) - Adds a new custom Drupal module or change it.    
* (GIT) - Alters gitignore or git-related files.    
* (SQL) - Adds a new database dump file.    
* (YML) - Commits a change over a YML file or set of files.    
* (CFG) - Uploads configuration files.    
* (HTL) - Changes over HTML.    
* (TWG) - Adds changes in TWIG templates or adds new files.    
* (IMG) - Adds an image file.    
* (TPL) - Uploads a template file or changes in one.    
* (DOC) - Adds more documentation.    
* (CSS) - Changes in the styling files.    
* (CMP) - Some specific changes in Composer related files.     
