<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'people';

    protected $fillable = [
        'name'
    ];

    public static $createRules = [
        'name' => 'required|string'
    ];

    public function companies() {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }
}