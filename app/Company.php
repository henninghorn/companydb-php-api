<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'address',
        'city',
        'country',
        'email',
        'phone'
    ];

    public static $createRules = [
        'name' => 'required|string',
        'address' => 'required|string',
        'city' => 'required|string',
        'country' => 'required|string',
        'email' => 'sometimes|email',
        'phone' => 'sometimes|string'
    ];

    public static $updateRules = [
        'name' => 'sometimes|string',
        'address' => 'sometimes|string',
        'city' => 'sometimes|string',
        'country' => 'sometimes|string',
        'email' => 'sometimes|email',
        'phone' => 'sometimes|string'
    ];

    public function people() {
        return $this->belongsToMany(Person::class)
            ->withTimestamps()
            ->orderBy('id', 'asc')
            ->withPivot('role');
    }

    public function founders() {
        return $this->people()->wherePivot('role', 'founder');
    }
}