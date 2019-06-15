<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Programmer extends Model
{

    protected $fillable = ["name", "username", "email"];

    protected $dates = [];

    public static $rules = [
        "name" => "required",
        "email" => "unique:programmers",
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function delete()
    {
        // delete all related photos
        $this->projects()->delete();
        // as suggested by Dirk in comment,
        // it's an uglier alternative, but faster
        // Photo::where("user_id", $this->id)->delete()

        // delete the user
        return parent::delete();
    }

}
