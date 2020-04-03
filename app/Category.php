<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Str;

class Category extends Model
{
    use NodeTrait;
    use SoftDeletes;

    protected $fillable = ["name", "desc", "image", "slug", "parent_id"];

    public static function getTree()
    {
        return Category::withTrashed()->orderBy("_lft")->get()->toTree();
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

    public function getChildrenCount()
    {
        return $this->children->count();
    }

    public function resort($prevId, $nextId)
    {
        if (isset($prevId)) {
            $category = Category::where("id", $prevId)->withTrashed()->firstOrFail();
            $this->insertAfterNode($category);
            return "YES";
        } else {
            $category = Category::where("id", $nextId)->withTrashed()->firstOrFail();
            $this->insertBeforeNode($category);
            return "NO";
        }
    }
}
