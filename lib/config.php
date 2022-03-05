<?php
require_once 'php-activerecord/activerecord.php';
// $con = 'mysql://username:password@localhost/database_name'

activerecord\config::initialize(function ($cfg) {
    $cfg->set_model_directory('models');
    $cfg->set_connections(array(
        'development' => 'mysql://root:@localhost/farm_db',
        'production' => 'mysql://uirisr12clmusp3o:K9G7TL1VTJfoOQ2dYN5I@bxeqtmxp82uhia8didlv-mysql.services.clever-cloud.com:3306/bxeqtmxp82uhia8didlv'
    ));
});
