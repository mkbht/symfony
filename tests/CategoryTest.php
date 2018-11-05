<?php

namespace App\Tests;

use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{

    /**
     * @test
     */
    public function category_name_is_not_empty() {
        $category = new Category();

        $category->setCategoryName("test");
        $this->assertNotEmpty($category->getCategoryName());
    }


}
