<?php
namespace Youtech;
interface Routes
{
    public function getRoutes() : array;
    public function checkPermission($permission): bool;
}