<?php

interface CategoriaDao{
    
    public function findAll();
    
    public function findById($id);
}