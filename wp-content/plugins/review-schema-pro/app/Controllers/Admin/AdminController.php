<?php

namespace Rtrsp\Controllers\Admin; 

use Rtrsp\Controllers\Admin\Meta\MetaController;

class AdminController {

    public function __construct() {  
        new MetaController();
        new ScriptLoader(); 
        new HookFilter(); 
        RtrsLicensing::init();
    } 
}