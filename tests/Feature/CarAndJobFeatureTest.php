<?php

use App\Models\Car;
use App\Models\CarJob;
use App\Models\User;

uses(RefreshDatabase::class);


beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});


// Test Car CRUD Operations
describe('Car CRUD Operations', function () {

    it('can create a car', function () {
        $car = Car::factory()->create([
            'brand' => 'BMW',
            'model' => 'X5',
            'number_plate' => 'AB-1234',
        ]);

        expect($car)->toMatchArray([
            'brand' => 'BMW',
            'model' => 'X5',
            'number_plate' => 'AB-1234',
        ]);
    });

    it('can update a car', function () {
        $car = Car::factory()->create();

        $car->update(['brand' => 'Audi', 'model' => 'A6']);

        expect($car->fresh())->toMatchArray([
            'brand' => 'Audi',
            'model' => 'A6',
        ]);
    });

    it('can delete a car', function () {
        $car = Car::factory()->create();

        $car->delete();

        expect(Car::find($car->id))->toBeNull();
    });
});

// Test CarJob CRUD and Relationship
describe('CarJob CRUD and Relationships', function () {

    it('can assign a job to a car', function () {
        $car = Car::factory()->create();
        $job = CarJob::factory()->create([
            'car_id' => $car->id,
            'job_description' => 'Oil Change',
            'completed' => false,
        ]);

        expect($job)->toMatchArray([
            'job_description' => 'Oil Change',
            'completed' => false,
        ]);

        expect($car->jobs->first())->toBeInstanceOf(CarJob::class);
    });

    it('can mark a job as completed', function () {
        $job = CarJob::factory()->create(['completed' => false]);

        $job->update(['completed' => true]);

        expect($job->fresh()->completed)->toBeTrue();
    });

    it('can delete a job', function () {
        $job = CarJob::factory()->create();

        $job->delete();

        expect(CarJob::find($job->id))->toBeNull();
    });
});

// Test User-Side Job Display
describe('User-Side Job Display', function () {

    it('can fetch all jobs for a car', function () {
        $car = Car::factory()->create();
        $jobs = CarJob::factory()->count(3)->create(['car_id' => $car->id]);

        $response = $this->get("/user/cars/{$car->id}/jobs");

        $response->assertOk();
        foreach ($jobs as $job) {
            $response->assertSee($job->job_description);
        }
    });

    it('can show completed jobs separately', function () {
        $car = Car::factory()->create();
        $completedJob = CarJob::factory()->create(['car_id' => $car->id, 'completed' => true]);
        $pendingJob = CarJob::factory()->create(['car_id' => $car->id, 'completed' => false]);

        $response = $this->get("/user/cars/{$car->id}/jobs");

        $response->assertOk()
            ->assertSee('Completed')
            ->assertSee($completedJob->job_description)
            ->assertSee($pendingJob->job_description);
    });
});

// Test Job Completion Toggle
describe('Job Completion Toggle', function () {

    it('can toggle job completion via form', function () {
        $car = Car::factory()->create();
        $job = CarJob::factory()->create(['car_id' => $car->id, 'completed' => false]);

        $response = $this->put(route('admin/cars/jobs/update', $job->id), [
            'jobs' => [
                $job->id => 1,
            ],
        ]);

        $response->assertRedirect();

        expect($job->fresh()->completed)->toBeTrue();
    });
});
