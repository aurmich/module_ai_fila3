<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Nwidart\Modules\Facades\Module as ModuleFacade;
use Sushi\Sushi;

/**
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
 *
 *
=======
>>>>>>> 0275d76 (🔧 (XotData.php): Remove unnecessary conflict markers from the file)
=======
 * 
 *
>>>>>>> 4a6b3ad (📝 (Models): Remove unnecessary empty lines and comments for better code readability and cleanliness.)
>>>>>>> 4df604f (📝 (Models): Remove unnecessary empty lines and comments for better code readability and cleanliness.)
 * @property int         $id
 * @property string|null $name
 * @property string|null $description
 * @property bool|null   $status
 * @property int|null    $priority
 * @property string|null $path
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
 *
>>>>>>> 0275d76 (🔧 (XotData.php): Remove unnecessary conflict markers from the file)
=======
>>>>>>> 4a6b3ad (📝 (Models): Remove unnecessary empty lines and comments for better code readability and cleanliness.)
>>>>>>> 4df604f (📝 (Models): Remove unnecessary empty lines and comments for better code readability and cleanliness.)
 * @method static \Illuminate\Database\Eloquent\Builder|Module newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Module newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Module query()
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereStatus($value)
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
 *
>>>>>>> 0275d76 (🔧 (XotData.php): Remove unnecessary conflict markers from the file)
=======
>>>>>>> 4a6b3ad (📝 (Models): Remove unnecessary empty lines and comments for better code readability and cleanliness.)
>>>>>>> 4df604f (📝 (Models): Remove unnecessary empty lines and comments for better code readability and cleanliness.)
 * @mixin \Eloquent
 */
class Module extends Model
{
    use Sushi;

    protected $fillable = [
        'name',
        // 'alias',
        // 'description',
        'status',
        'priority',
        'path',
    ];

    protected $casts = [
        'status' => 'boolean',
        'priority' => 'integer',
    ];

    /**
     * @return array
     */
    public function getRows()
    {
        $modules = ModuleFacade::all();
        $modules = Arr::map($modules, function ($module) {
            return [
                'name' => $module->getName(),
                // 'alias' => $module->getAlias(),
                'description' => $module->getDescription(),
                'status' => $module->isEnabled(),
                'priority' => $module->get('priority', 0),
                'path' => $module->getPath(),
            ];
        });

        return array_values($modules);
    }
}
