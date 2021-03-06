<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Music extends Model
{
    protected $table = 'music';

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'url',
    ];



     public function getAll($offset = 0, $limit = 10, $search = [])
    {   

        $music =  new static;

        if(isset($search["all"])){
            return $music->get();
        }else{
             if(isset($search['name'])){
                $music = $music->where('name','like', '%'.$search['name'].'%');
            }

            $music = $music->offset($offset)->limit($limit);
            return $music->get();
        }
    }

    public function findMusic($id)
    {	
        return static::find($id);
    }

     public function InsertMusic($data)
    {
        return static::create($data);
    }

    public function deleteMusic($id)
    {
        return static::find($id)->delete();
    }

   
    public function updateMusic($data)
    {
        return static::find($data['id'])->update($data);
    }

    public function countMusic(){
        return static::count();
    }
}
