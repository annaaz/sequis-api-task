<p align="center"><img width='230px' src="https://www.bisnisjakarta.co.id/wp-content/uploads/2017/08/IMG_20170817_170254.jpg"></p>
<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>


<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Sequis-api

Task : 
```
Develop an API server for below user stories.
You are required to :
    ● For each API endpoint, please propose JSON responses for any errors that might
occur.
    ● Provide a 1-step command to run your API server locally using a Makefile or Docker
for us to test run the APIs
    ● Write sufficient documentation for the APIs and explain your technical choices
    ● To simplify the problem, no user authentication is needed.
```

## Table of Contents

- [Basic Installation](#installation)
- [Docker Installation](#Docker)
- [Documentations and Routes](#routes)  

### Basic Installation

### Installation

1. Clone repository
```
$ git clone https://github.com/annaaz/sequis-api-task.git
```

2. Go to directories
```
$ cd sequis-api-task
```

3. Install composer dependencies
```
~/laravel-api$ composer install
```

4. Generate APP_KEY
```
~/laravel-api$ php artisan key:generate
```

5. Configure .env file, edit file with next command `$ nano .env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=root
DB_PASSWORD=
```

6. Run migrations
```
~/laravel-api$ php artisan migrate
```

Note : 
Please make the database first if you get error like this
<img width="600" alt="image" src="https://user-images.githubusercontent.com/25476195/168405490-76879da1-e193-425f-931f-8c60a27e5d48.png">

and re run {php artisan migrate}


### Docker


```
$ Having porblem on setup docker compose , docker desktopn have issue on my windows home edition
```

### Routes
### Documentation And Routes

##### List API 
<strong>1. Handle Ask Request </strong>
```
- POST ::  /api/ask-request
  
  Handle user request send method via post data body form parameter , In this api user can send request 
  to our application 
  
  Exception : 
    Validate data  with string required , recognize Mail string , Max character 255
    Check if mail already send request ,
    Check if mail is not blocked
    
   Parameter :
   Form data= requestor
   Form data= to
   
  
```
<strong>Success Request </strong>


![image](https://user-images.githubusercontent.com/25476195/168025622-7a1c5359-5cdd-4378-88b0-bd42abea3e77.png)

<strong>Failed because requestor mail is blocked</strong>

![image](https://user-images.githubusercontent.com/25476195/168025776-7ca002ef-b068-4432-835d-84d2b5676517.png)

<strong>Failed because already sent request </strong>
![image](https://user-images.githubusercontent.com/25476195/168022212-427381cd-4eea-4f32-8596-a9af11f63774.png)

<hr />


<strong>2. Handle Manage Request </strong>
```
- POST ::  /api/manage-request
  
  Handle user request send method via post data body form parameter , 
  In this api we can manage listed request wheteher we want to accept or reject it 
  
  Exception : 
    Validate data with string required , recognize Mail string , Max character 255
    Validate if mail exist 
    
   Parameter : 
   Form data = requestor{mail}
   Form data = to{mail}
   Form data = accept{true or false}
  
```
<strong>Success Request </strong>

![image](https://user-images.githubusercontent.com/25476195/168028539-ebffa10c-afed-4f51-9b9a-b7b7b34da498.png) 

<strong>Failed mail is not exist  </strong>

![image](https://user-images.githubusercontent.com/25476195/168028752-4c9d880a-cae0-423c-985e-f845b5c4d85c.png)

<hr />

<strong>3.Handle List All Request </strong>
```
- POST ::  /api/list-request
  
  Show all requester for user 
  
  Exception : 
    Validate data with string required , recognize Mail string , Max character 255
    Validate if mail exist 
    
   Parameter : 
   Form data = request_for{mail}
      
```
<strong>Success Request </strong>

![image](https://user-images.githubusercontent.com/25476195/168032381-e17bd133-4f0d-4b2e-bd01-693dc70eb339.png)

<strong>Failed mail is not exist  </strong>

![image](https://user-images.githubusercontent.com/25476195/168035899-1f2277f8-f85c-4f1b-932f-93346d665127.png)

<hr />

<strong>4. List Friends </strong>
```
- POST ::  /api/list-friends
  
  Show all friends with emails paramter sent
  
  Exception : 
    Validate data with string required , recognize Mail string , Max character 255
    Validate if mail exist 
    
   Parameter : 
   Form data = email{mail}
    
  
```
![image](https://user-images.githubusercontent.com/25476195/168036041-e82c138f-ee73-4dad-aebe-1f8ecac94bcf.png)

<hr />


<strong>5. List retrieve between two mails </strong>
```
- POST ::  /api/retrieve-friends
  
  Show all relatives between two mails with json body parameter
  
  Exception : 
    Validate if body json is active
    Validate data with string required , recognize Mail string , Max character 255
    Validate if mail exist 
    
   JSON Parameter : 
     {
        "friends": [
            "mail",
            "mail"
        ]
    }
   
```
![image](https://user-images.githubusercontent.com/25476195/168036327-c4d1cf02-c784-4c3d-845e-65fa29b13510.png)

![image](https://user-images.githubusercontent.com/25476195/168036532-8ea928da-8c9c-4e56-b69d-eb17abde4545.png)

<hr />

<strong>6. Block user  </strong>
```
- POST ::  /api/block-user
  
  Block specified user :
  This api is for block user so user cannot send anymore request to specified email
  
  Exception : 
    Validate if body json is active
    Validate data with string required , recognize Mail string , Max character 255
    Validate if mail exist 
    
   Form Parameter : 
   
   email{mail}
   
  
```

![image](https://user-images.githubusercontent.com/25476195/168036693-3bcc9d34-7864-423d-9617-114ffc7aa306.png)

![image](https://user-images.githubusercontent.com/25476195/168036758-d0ec40f0-d72e-4320-ac9a-4709a05f3dd7.png)

## License
The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
