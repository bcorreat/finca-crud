<?php
require_once 'php-activerecord/ActiveRecord.php';
// $con = 'mysql://username:password@localhost/database_name'

activerecord\config::initialize(function ($cfg) {
    $cfg->set_model_directory('models');
    $cfg->set_connections(array(
        'development' => 'mysql://root:@localhost/farm_db',
        'production' => 'mysql://b5979641148518:cacc6979@us-cdbr-east-05.cleardb.net/heroku_5adbccd2b7cd39b?reconnect=true'
    ));
});
