<?php

class ExampleModel
{
    private $DB;

    public function __construct()
    {
        $this->DB = PdoConnection::getInstance();
    }

    public function index()
    {
        return true;
    }

    public function show($data)
    {

        return true;
    }

    public function store($data)
    {
        return true;
    }

    public function update($data)
    {
        return true;
    }

    public function destroy($data)
    {
        return true;
    }
}
