<?php
namespace Youtech;
interface Routes
{
    public function getRoutes() : array;
    public function checkPermission($permission): bool;
    public function getAuthentication() : Authentication;
    public function getRoleTemplate ():string;

}