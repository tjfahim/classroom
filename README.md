1.	in ".env.example" file name shoud be ".env"
2.	set database name in .env file
3.	composer.lock file and vendor folder delete(vendor delete for ios)
4.	in folder command "composer update"
5.	databash connent "php artisan migrate:fresh"
6.	run server "php artisan serve"

if jwt error found then goto ".env"file and past the code in last

JWT_SECRET=iI3aWFLGBfQ6LBpjTdcyyt0xgKtqQmxj3o2962MZ9aJpo0LJzGkCy2tXeYps32SC
JWT_TTL=7200
