<?php
require_once "lib/db.php";

class User extends ActiveRecord\Model
{
    static $table_name = "usuario";
    static $primary_key = "id";
}