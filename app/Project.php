<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
        "name" => "required",
    ];

    // Relationships
    public function programmer()
    {
        return $this->belongsTo(Programmer::class);
    }

}
