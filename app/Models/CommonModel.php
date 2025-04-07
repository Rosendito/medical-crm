<?php

namespace App\Models;

use App\Concerns\Models\HasTenant;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonModel extends Model
{
    use HasFactory, HasTenant, HasUuids;
}
