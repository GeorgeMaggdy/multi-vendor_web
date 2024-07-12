<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $primaryKey='user_id';
    //i let the model know that my id is no longer called id , its user_id so by this way the model will change it to user_id
    //cuz the default is id.
    protected $fillable = [

        'user_id',
        'first_name',
        'last_name',
        'birthdate',
        'gender',
        'street_address',
        'city',
        'state',
        'postal_code',
        'country',
        'locale'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}