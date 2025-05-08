<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\CarJob;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FullWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_and_mechanic_workflow()
    {
        // 1. Create admin and mechanic
        $admin = User::factory()->create(['usertype' => 'admin']);
        $mechanic = User::factory()->create(['usertype' => 'user']);

        // 2. Admin creates a car
        $this->actingAs($admin);
        $car = Car::create([
            'brand' => 'Audi',
            'model' => 'A4',
            'number_plate' => 'ABC-123',
        ]);

        // 3. Admin assigns a job to the mechanic
        $this->post(route('admin/car/jobs/store', $car->id), [
            'job_description' => 'Brake inspection',
            'worker_id' => $mechanic->id,
        ]);

        $this->assertDatabaseHas('car_jobs', [
            'job_description' => 'Brake inspection',
            'worker_id' => $mechanic->id,
            'car_id' => $car->id,
            'status' => 'assigned',
        ]);

        $job = CarJob::first();

        // 4. Mechanic sees the job in My Jobs
        $this->actingAs($mechanic);
        $response = $this->get('/my-jobs');
        $response->assertSee('Brake inspection');
        $response->assertSee('Audi');

        // 5. Mechanic marks job as completed
        $this->put(route('my/jobs/updateStatus', $job->id), [
            'status' => 'completed',
        ]);

        $job->refresh();
        $this->assertEquals('completed', $job->status);

        // 6. Job is gone from My Jobs
        $this->get('/my-jobs')->assertDontSee('Brake inspection');

        // 7. Admin sees job in archive
        $this->actingAs($admin);
        $response = $this->get('/admin/job-archive');
        $response->assertSee('Brake inspection');
        $response->assertSee('Completed');

        // 8. User is blocked from admin route
        $this->actingAs($mechanic);
        $this->get('/admin/cars')->assertRedirect(); // Or redirect depending on your middleware
    }
}
