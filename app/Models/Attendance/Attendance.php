<?php

namespace App\Models\Attendance;

use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance\Traits\Attribute\AttendanceAttribute;
use App\Models\Attendance\Traits\Relationship\AttendanceRelationship;

class Attendance extends Model
{
    use AttendanceAttribute, AttendanceRelationship;
    //
}
