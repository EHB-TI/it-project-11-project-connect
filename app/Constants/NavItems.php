<?php

namespace App\Constants;

class NavItems
{
    const TEACHER = [
        // 'Dashboard' => 'dashboard',
        'Projects' => 'projects.index',
        'Applications' => 'applications.index',
        'Deadlines' => 'deadlines.index',
        'Students' => 'students.index',
        'Make your project' => 'projects.create',
    ];

    const STUDENT = [
        // 'Dashboard' => 'dashboard',
        'Projects' => 'projects.index',
        'Make your project' => 'projects.create',
    ];
}
