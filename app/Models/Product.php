<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use KingOfCode\Upload\Uploadable;

/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     title="Product",
 *     properties={
 *         @OA\Property(property="id", type="integer", example=1),
 *         @OA\Property(property="name", type="string", example="Product Name"),
 *         @OA\Property(property="brand", type="string", example="Product brand"),
 *         @OA\Property(property="price", type="number", format="float", example=99.99),
 *     }
 * )
 */

class Product extends Model
{
    use HasFactory, Uploadable;

    protected $table = 'products';
    protected $guarded = ['id'];


    protected $uploadableImages = [
        'image' => ['thumb' => 150, 'medium' => 500, 'normal' => 700]
    ];

    protected $uploadableFiles = [
        'pdf'
    ];

    protected $imageResizeTypes = [
        'medium' => false,
        'thumb' => false,
    ];

    public $uploadFolderName = 'products';


    public function getNormalImagePath()
    {
        return $this->getImagePath('image');
    }

    public function getPdfPath()
    {
        return $this->getFilePath('pdf');
    }
}
