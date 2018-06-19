# README

# Job Queue Web API Server built on Laravels Queue API 

Application allows you to defer time consuming task such as sending an email

Connection configurations and driver are set to Memcache but can be changed in app/config/cache.php

For email sending, I have used https://mailtrap.io. So if you want to use, go to the website and signup, and you will see your username and password, grab it and put in the .env file

Enque a Job: 
Endpoint: queue/email | submits a new email job to the queue and sets status to high 

Job Status: 
Get next available 
Endpoint: job/ | gets next available job with highest priority 

Get job status by {id}
Endpoint: job/$id | returns a status indicating whether job is in RUNNING, COMPLETE, FAILED 


Dequeue a Job: 

Processes jobs in the jobs table by high priority 
```sh
php artisan queue:work --queue=high
```


## Local Deployment Requirements 

Homebrew php72 [ php 7.2.4 ]
```sh
brew install homebrew/php/php72
```
Install Valet with Composer 
```sh
$ composer global require laravel/valet
```
Create symlink to public storage
```sh
php artisan storage:link
```
Run Valet install 
```sh
$ valet install 
```
Run valet 
```sh
$ valet start 
```
Composer Install  
```sh
$ composer install 
```
NPM 
local development 
```sh
npm run development
```



