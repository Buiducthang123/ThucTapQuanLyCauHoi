<?php
namespace App\Repositories;

use GuzzleHttp\Psr7\Request;

interface RepositoryInterface{
    function getAll();
    function create($data=[]);
    function show($id);
    function update($data=[],$id);

    function findById($id);
    function delete($id);

    function search(string $column,$value);
}
