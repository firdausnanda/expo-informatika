<?php

namespace App\Enums;

enum RoleEnum: string
{
  case Admin = 'admin';
  case User = 'user';
  case Dosen = 'dosen';
  
  public static function getRole(): array
  {
      return array_map(fn (RoleEnum $role) => $role->value, RoleEnum::cases());
  }
}

