<?php

namespace App\Http\Interfaces\Admin;

interface AdminProductInterface
{
    public function index();
    public function create($request);
    public function import($request);
    public function exportDummyData();
    public function delete($request);
    public function update($request);
}
