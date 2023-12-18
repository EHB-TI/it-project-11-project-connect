<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator;
use App\Models\Project;
use App\Models\User;

// Dashboard
Breadcrumbs::for('dashboard', function (Generator $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Projects
Breadcrumbs::for('projects', function (Generator $trail) {
    $trail->parent('dashboard'); // Assuming 'Projects' is accessible from the dashboard
    $trail->push('Projects', route('projects.index'));
});

// Project Details
Breadcrumbs::for('project_details', function (Generator $trail, $id) {
    $project = Project::findOrFail($id); // Fetch project details using your model
    $trail->parent('projects');
    $trail->push($project->name, route('projects.show', $id));
});

// Applications
Breadcrumbs::for('applications', function (Generator $trail) {
    $trail->parent('dashboard'); // Assuming 'Applications' is accessible from the dashboard
    $trail->push('Applications', route('applications.index'));
});

// Deadlines
Breadcrumbs::for('deadlines', function (Generator $trail) {
    $trail->parent('dashboard'); // Assuming 'Deadlines' is accessible from the dashboard
    $trail->push('Deadlines', route('deadlines.index'));
});

// Spaces
Breadcrumbs::for('spaces', function (Generator $trail) {
    $trail->parent('dashboard'); // Assuming 'Spaces' is accessible from the dashboard
    $trail->push('Spaces', route('spaces.index'));
});

// Students
Breadcrumbs::for('students', function (Generator $trail) {
    $trail->parent('dashboard'); // Assuming 'Students' is accessible from the dashboard
    $trail->push('Students', route('students.index'));
});

// Student Information
Breadcrumbs::for('student_info', function (Generator $trail, $id) {
    $student = User::findOrFail($id); // Fetch student details using your mode

    $trail->parent('students');
    $trail->push($student->name, route('students.show', $id));
});

// Feedback 



?>