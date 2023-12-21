<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator;
use App\Models\Project;
use App\Models\User;

// Dashboard
Breadcrumbs::for('dashboard', function (Generator $trail) {
    // $trail->push('Dashboard', route('dashboard',['space_id' => session('current_space_id')]));
    $trail->push('Dashboard', route('dashboard', ['space_id' => session('current_space_id')]));
});

// Projects
Breadcrumbs::for('projects.index', function (Generator $trail) {
    $trail->parent('dashboard'); // projects page accessible from the dashboard
    $trail->push('Projects', route('projects.index'));
});

//Create Project
Breadcrumbs::for('projects.create', function (Generator $trail) {
    $trail->parent('dashboard'); 
    $trail->push('Create Project', route('projects.create'));
});

// Project Details
Breadcrumbs::for('project_details_routeA', function (Generator $trail, $id) {
    $project = Project::findOrFail($id); // Fetch project details using your model
    // $trail->parent('dashboard');
    $trail->parent('applications');
    // $trail->parent('projects');
    $trail->push($project->name, route('projects.show', $id));
});

Breadcrumbs::for('project_details_routeB', function (Generator $trail, $id) {
    $project = Project::findOrFail($id); // Fetch project details using your model
    $trail->parent('projects');
    $trail->push($project->name, route('projects.show', $id));
});

// Applications
Breadcrumbs::for('applications.index', function (Generator $trail) {
    $trail->parent('dashboard'); // Assuming 'Applications' is accessible from the dashboard
    $trail->push('Applications', route('applications.index'));
});

// Deadlines
Breadcrumbs::for('deadlines.index', function (Generator $trail) {
    $trail->parent('dashboard'); // Assuming 'Deadlines' is accessible from the dashboard
    $trail->push('Deadlines', route('deadlines.index'));
});

Breadcrumbs::for('deadlines.create', function (Generator $trail) {
    $trail->parent('deadlines.index'); // Assuming 'Deadlines' is accessible from the dashboard
    $trail->push('Create', route('deadlines.create'));
});

// Spaces
Breadcrumbs::for('spaces.index', function (Generator $trail) {
    $trail->parent('dashboard'); // Assuming 'Spaces' is accessible from the dashboard
    $trail->push('Spaces', route('spaces.index'));
});

// Students
Breadcrumbs::for('students.index', function (Generator $trail) {
    $trail->parent('dashboard'); // Assuming 'Students' is accessible from the dashboard
    $trail->push('Students', route('students.index'));
});

// Student Information
Breadcrumbs::for('students.show', function (Generator $trail, $id) {
    $student = User::findOrFail($id); // Fetch student details using your mode

    $trail->parent('students.index');
    $trail->push($student->name, route('students.show', $id));
});

// Feedback 



?>