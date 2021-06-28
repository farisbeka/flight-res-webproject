<?php

class Config {

    const DB_HOST = "localhost";
    const DB_USERNAME= "root";
    const DB_PASSWORD= "risfakralj1";
    const DB_SCHEME = "flight_reservation";
    const DATE_FORMAT = "Y-m-d H:i:s";

/*
    const HEROKU_HOST = getenv("DB_HOST");
    const HEROKU_USERNAME= getenv("DB_USERNAME");
    const HEROKU_PASSWORD= getenv("DB_PASSWORD");
    const HEROKU_SCHEME = getenv("DB_SCHEME");
*/

    const SMTP_HOST = "smtp.mailgun.org";
    const SMTP_PORT = 587;
    const SMTP_USER = "postmaster@mail.bekta.me";
    const SMTP_PASSWORD = "98eb6d6d5835b9cfd39960a27951d813-b6d086a8-147d14d0";

    const JWT_TOKEN_TIME = 604800;




}


?>