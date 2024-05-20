<?php
  
namespace App\Enums;
 
enum UserRole:int 
{
    case Admin = 1;
    case Writer = 2;
    case User = 3;
}