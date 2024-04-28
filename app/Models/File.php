<?php

namespace App\Models;

use App\Traits\HasCreatorAndUpdater;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class File extends Model
{
    use HasCreatorAndUpdater, HasFactory, NodeTrait, SoftDeletes;

    public function isOwnedBy($userId)
    {
        return $this->created_by == $userId;
    }

    public static function getDefaultRoot($userId)
    {
        return self::whereIsRoot()->where('created_by', $userId)->firstOrFail();
    }
}
