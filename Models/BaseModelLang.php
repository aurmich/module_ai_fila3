<?php

declare(strict_types=1);

namespace Modules\Lang\Models;

// //use Laravel\Scout\Searchable;
// ---------- traits
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Lang\Models\Traits\LinkedTrait;
use Modules\Xot\Services\FactoryService;
use Modules\Xot\Traits\Updater;

/**
 * Class BaseModelLang.
 *
 * @property string|null $post_type
 */
abstract class BaseModelLang extends Model
{
    use HasFactory;

    // use Searchable;
    use LinkedTrait;
    use Updater;

    /**
     * Indicates whether attributes are snake cased on arrays.
     *
     * @see  https://laravel-news.com/6-eloquent-secrets
     *
     * @var bool
     */
    public static $snakeAttributes = true;

    /**
     * @var int
     */
    protected $perPage = 30;

    /** @var string */
    protected $connection = 'mysql'; // this will use the specified database connection

    /** @var array<int, string> */
    protected $fillable = ['id'];

    /** @var array<string, string> */
    protected $casts = ['published_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    /** @var string */
    protected $primaryKey = 'id';

    /** @var bool */
    public $incrementing = true;

    /** @var array<int, string> */
    protected $hidden = [
        // 'password'
    ];

    /** @var bool */
    public $timestamps = true;

    // -----------
    /*
    protected $id;
    protected $post;
    protected $lang;
    */
    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory()
    {
        return FactoryService::newFactory(static::class);
        // return FactoryService::newFactory(get_called_class());
    }
}
