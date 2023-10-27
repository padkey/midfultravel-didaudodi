<?php

namespace DDDD\CatalogCategory\Models;

use DDDD\EAVAttribute\Models\EavAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CatalogCategoryValue extends Model
{
    protected $table = 'catalog_category_value_entity';

    protected $primaryKey = 'value_id';

    protected $fillable = ['value_id', 'value', 'entity_id', 'attribute_id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CatalogCategory::class, 'entity_id', 'entity_id');
    }

    public function attribute(): HasOne
    {
        return $this->hasOne(EavAttribute::class, 'attribute_id', 'attribute_id');
    }
}
