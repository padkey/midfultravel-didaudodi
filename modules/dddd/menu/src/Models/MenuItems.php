<?php

namespace DDDD\Menu\Models;

use DDDD\Banner\Models\Banner;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;


class MenuItems extends Model
{
    use ModelTree;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu_items';

    protected $fillable = [
        'menu_id',
        'name',
        'url',
        'image',
        'icon',
        'color',
        'parent_id',
        'path_level',
        'position',
        'target_attr'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent_id');
        $this->setOrderColumn('position');
        $this->setTitleColumn('name');
    }

    /**
     * Get the items for the banner.
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Banner::class, 'menu_id', 'id');
    }

    /**
     * Get options for Select field in form.
     *
     * @param \Closure|null $closure
     * @param string        $rootText
     *
     * @return array
     */
    public static function selectOptions(\Closure $closure = null, $rootText = 'ROOT', string $menu_id = null)
    {
        $nodes = [];

        if ($menu_id != null) {
            $connection = config('admin.database.connection') ?: config('database.default');
            $orderColumn = DB::connection($connection)->getQueryGrammar()->wrap('position');
            $byOrder = 'ROOT ASC,'.$orderColumn;
            $query = static::query();

            $nodes = $query->where('menu_id', $menu_id)
                ->selectRaw('*, '.$orderColumn.' ROOT')
                ->orderByRaw($byOrder)->get()->toArray();
        }

        $options = (new static())->withQuery($closure)->buildSelectOptions($nodes);

        return collect($options)->prepend($rootText, 0)->all();
    }
}
