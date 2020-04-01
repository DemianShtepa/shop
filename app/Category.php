<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Kalnoy\Nestedset\NodeTrait;
use App\Services\PhotoManager;
use Illuminate\Support\Str;

class Category extends Model
{
    use NodeTrait;
    use SoftDeletes;

    protected $fillable = ["name", "desc", "is_active", "image", "slug", "parent_id"];

    public static function getTree()
    {
        return Category::withTrashed()->get()->toTree();
    }


    public function toggleActivate()
    {
        $this->is_active = !$this->is_active;
        $this->save();
        $this->toggleChildren();
    }

    protected function toggleChildren()
    {
        foreach ($this->children as $child) {
            $child->toggleActivate();
        }
    }


    public static function createCategory(array $attributes = [])
    {
        $category = new Category(
            [
                "name" => $attributes["name"],
                "desc" => $attributes["desc"],
                "parent_id" => $attributes["parent_id"],
                "image" => isset($attributes["image"]) ? $attributes["image"]->store("uploads", "public") : null,
                "slug" => Str::slug($attributes["name"])
            ]
        );
        $category->save();

        return $category;
    }

    public function updateCategory(array $attributes = [], array $options = [])
    {
        return $this->update([
            "name" => $attributes["name"],
            "desc" => $attributes["desc"],
            "parent_id" => $attributes["parent_id"],
            "image" => $this->image ?? (isset($attributes["image"]) ? $attributes["image"]->store("uploads", "public") : null),
            "slug" => Str::slug($attributes["name"])
        ]);
    }

}
