<?php




function isAdminRoute(){
    return request()->is('admin/*') || request()->is('admin') ? true : false ;
}
