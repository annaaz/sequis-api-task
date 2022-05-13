<p align="center"><img src="https://www.bisnisjakarta.co.id/wp-content/uploads/2017/08/IMG_20170817_170254.jpg"></p>
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

- [Installation](#installation)
- [Docker [Installation](#installation)
- [Routes](#routes) and Documentations

### Basic Installation

1. Clone repository
```
~/laravel-api$ php artisan migrate
```
### Routes

##### List API 
<strong>Ask Request </strong>
```
- POST ::  /api/ask-request
  
  Handle user request send method via post data body form parameter
  
  Exception : 
    Validate data  with string required , recognize Mail string , Max character 255
    Check if mail already send request ,
    Check if mail is not blocked
    
   Form Parameter : 
   
   requestor,to
   
  
```
<strong>Success Request </strong>

![image](https://user-images.githubusercontent.com/25476195/168025622-7a1c5359-5cdd-4378-88b0-bd42abea3e77.png)

<strong>Failed because requestor mail is blocked</strong>

![image](https://user-images.githubusercontent.com/25476195/168025776-7ca002ef-b068-4432-835d-84d2b5676517.png)

<strong>Failed because already sent request </strong>
![image](https://user-images.githubusercontent.com/25476195/168022212-427381cd-4eea-4f32-8596-a9af11f63774.png)

<hr />


<strong>Manage Request </strong>
```
- POST ::  /api/manage-request
  
  Handle user request send method via post data body form parameter
  
  Exception : 
    Validate data with string required , recognize Mail string , Max character 255
    Validate if mail exist 
    
   Form Parameter : 
   
   requestor{mail},to{mail}, accept{true or false}
   
  
```
<strong>Success Request </strong>

![image](https://user-images.githubusercontent.com/25476195/168028539-ebffa10c-afed-4f51-9b9a-b7b7b34da498.png) 

<strong>Failed mail is not exist  </strong>

![image](https://user-images.githubusercontent.com/25476195/168028752-4c9d880a-cae0-423c-985e-f845b5c4d85c.png)

<hr />

<strong>List All Request </strong>
```
- POST ::  /api/list-request
  
  Show all requester for user 
  
  Exception : 
    Validate data with string required , recognize Mail string , Max character 255
    Validate if mail exist 
    
   Form Parameter : 
   
   request_for{mail}
   
  
```
<strong>Success Request </strong>

![image](https://user-images.githubusercontent.com/25476195/168032381-e17bd133-4f0d-4b2e-bd01-693dc70eb339.png)

<strong>Failed mail is not exist  </strong>

![image](https://user-images.githubusercontent.com/25476195/168035899-1f2277f8-f85c-4f1b-932f-93346d665127.png)

<hr />

<strong>List Friends </strong>
```
- POST ::  /api/list-friends
  
  Show all friends with emails paramter sent
  
  Exception : 
    Validate data with string required , recognize Mail string , Max character 255
    Validate if mail exist 
    
   Form Parameter : 
   
   email{mail}
   
  
```
![image](https://user-images.githubusercontent.com/25476195/168036041-e82c138f-ee73-4dad-aebe-1f8ecac94bcf.png)

<hr />


<strong>List retrieve between two mails </strong>
```
- POST ::  /api/retrieve-friends
  
  Show all relatives between two mails with json body parameter
  
  Exception : 
    Validate if body json is active
    Validate data with string required , recognize Mail string , Max character 255
    Validate if mail exist 
    
   Form Parameter : 
   
   email{mail}
   
  
```

![image](https://user-images.githubusercontent.com/25476195/168036327-c4d1cf02-c784-4c3d-845e-65fa29b13510.png)

![image](https://user-images.githubusercontent.com/25476195/168036532-8ea928da-8c9c-4e56-b69d-eb17abde4545.png)

<hr />

<strong>Block user  </strong>
```
- POST ::  /api/block-user
  
  Block specified user 
  
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
