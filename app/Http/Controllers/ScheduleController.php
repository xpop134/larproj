<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Http\Requests\ScheduleEmp;

class ScheduleController extends Controller
{
    // Show all schedules
    public function index()
    {
        return view('admin.schedule')->with('schedules', Schedule::all());
    }

    // Store a new schedule
    public function store(ScheduleEmp $request)
    {
        $request->validated(); // Validate the input from the request
    
        // Create a new Schedule
        $schedule = new Schedule;
        $schedule->slug = $request->slug;
        $schedule->time_in = $request->time_in;
        $schedule->time_out = $request->time_out;
        $schedule->save(); // Save to the database
    
        // Flash success message
        flash()->success('Success', 'Schedule has been created successfully!');
    
        // Redirect back to the schedule index page
        return redirect()->route('schedule.index');
    }

    // Update an existing schedule
    public function update(ScheduleEmp $request, Schedule $schedule)
    {
        // Adjust the time format for storage
        $request['time_in'] = str_split($request->time_in, 5)[0];
        $request['time_out'] = str_split($request->time_out, 5)[0];

        // Validate the input
        $request->validated();

        // Update schedule
        $schedule->slug = $request->slug;
        $schedule->time_in = $request->time_in;
        $schedule->time_out = $request->time_out;
        $schedule->save();  // Save the updated schedule

        // Flash success message
        flash()->success('Success', 'Schedule has been updated successfully!');

        // Redirect to the schedule index page
        return redirect()->route('schedule.index');
    }

    // Delete a schedule
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();  // Delete the schedule

        // Flash success message
        flash()->success('Success', 'Schedule has been deleted successfully!');

        // Redirect back to the schedule index page
        return redirect()->route('schedule.index');
    }
}
