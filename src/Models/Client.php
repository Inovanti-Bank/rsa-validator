<?php

namespace InovantiBank\RSAValidator\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'rsa_validator';
    protected $fillable = ['client_id', 'public_key'];
}
