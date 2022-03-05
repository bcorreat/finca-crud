<?php
require_once "lib/config.php";

class User extends ActiveRecord\Model
{
    static $table_name = "usuario";
    static $primary_key = "id";
}