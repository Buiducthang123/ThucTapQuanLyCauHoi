<?php
namespace App\Repositories\Test;
use App\Repositories\RepositoryInterface;

interface TestRepositoryInterface extends RepositoryInterface{
    function show($id);
}
