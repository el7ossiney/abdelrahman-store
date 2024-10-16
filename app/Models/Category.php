<?php

namespace App\Models;

use App\Rules\FilterRule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
      'name','parent_id','description','image','status','slug'  
    ];

    public static function rules(){
      return [
        'name' =>['required','string','min:3','max:255',new FilterRule()],
        'parent_id' => ['nullable','int',Rule::exists('categories','id')],
        'description' =>['nullable','min:3','max:255'],
        'image' => ['image','dimensions=max:10480000'],
        
      ];

    }
}
