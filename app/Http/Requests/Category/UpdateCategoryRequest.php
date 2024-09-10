<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends StoreCategoryRequest
{

    protected function ruleUniqueCategory()
    {
        return parent::ruleUniqueCategory()->ignore( $this->category->id );
    }
}
