<?php

namespace App\Constants;

class NavItems
{
    const TEACHER = [
        'Dashboard' => 'dashboard.teacher',
        'Projects' => 'approvedProject',
        'Applicaties' => 'application.index',
        'Deadlines' => 'deadlines.index',
        'Students' => 'studentsOverview',
        'Make your project' => 'projects.create',
    ];

    const STUDENT = [
        'Dashboard' => 'dashboard.student',
        'Projects' => 'approvedProject',
        'Make your project' => 'projects.create',
    ];
}
