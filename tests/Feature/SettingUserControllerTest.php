<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\SettingUserService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Mockery;
use Illuminate\Pagination\LengthAwarePaginator;

class SettingUserControllerTest extends TestCase
{
    use WithFaker;

    protected $validUser;

    public function setUp(): void
    {
        parent::setUp();

        $this->validUser = User::factory()->create([
            'role' => 'superadmin',
            'Status' => 'active',
        ]);

        $this->actingAs($this->validUser);
    }

    public function testIndexLoadsCorrectViewWithData()
    {
        $items = collect([]);
        $paginator = new LengthAwarePaginator($items, $items->count(), 15, 1, [
            'path' => '/setting-user',
        ]);

        $mockedService = Mockery::mock(SettingUserService::class);
        $mockedService->shouldReceive('getAll')
                      ->once()
                      ->with(null)
                      ->andReturn($paginator);

        $this->app->instance(SettingUserService::class, $mockedService);

        $response = $this->get('/setting-user');

        $response->assertStatus(200);
        $response->assertViewIs('Settinguser.index');
        $response->assertViewHas('settingUser');
        $response->assertViewHas('active', 'setting_user');
    }

    public function testCreatePageLoadsWithRoles()
    {
        $mockedService = Mockery::mock(SettingUserService::class);
        $mockedService->shouldReceive('getDataRoles')
                      ->once()
                      ->andReturn([
                          ['id' => 'user', 'label' => 'User'],
                          ['id' => 'staff', 'label' => 'Staff'],
                          ['id' => 'superadmin', 'label' => 'Superadmin'],
                      ]);

        $this->app->instance(SettingUserService::class, $mockedService);

        $response = $this->get('/setting-user/create');

        $response->assertStatus(200);
        $response->assertViewIs('Settinguser.create');
        $response->assertViewHas('getDataRole');
    }

    public function testStoreUserCallsServiceAndRedirects()
    {
        $mockedService = Mockery::mock(SettingUserService::class);
        $mockedService->shouldReceive('create')
                      ->once()
                      ->with(Mockery::subset([
                          'name'  => 'John Doe',
                          'email' => 'john@example.com',
                          'role'  => 'user'
                      ]));

        $this->app->instance(SettingUserService::class, $mockedService);

        $response = $this->post('/setting-user', [
            'name'  => 'John Doe',
            'email' => 'john@example.com',
            'role'  => 'user'
        ]);

        $response->assertRedirect('/setting-user');
    }

    public function testEditLoadsCorrectViewWithData()
    {
        $mockedService = Mockery::mock(SettingUserService::class);

        $mockedService->shouldReceive('getDataRoles')
                    ->once()
                    ->andReturn([
                        ['id' => 'user', 'label' => 'User'],
                        ['id' => 'staff', 'label' => 'Staff']
                    ]);

        $mockedService->shouldReceive('find')
                    ->once()
                    ->with(1)
                    ->andReturn((object)[
                        'id'    => 1,
                        'name'  => 'John Doe',
                        'email' => 'john@example.com',
                        'role'  => 'user'
                    ]);

        $this->app->instance(SettingUserService::class, $mockedService);

        $response = $this->get('/setting-user/1/edit');

        $response->assertStatus(200);
        $response->assertViewIs('Settinguser.edit');
        $response->assertViewHas('settingUser');
        $response->assertViewHas('getDataRole');
    }

    public function testUpdateUserCallsServiceAndRedirects()
    {
        $mockedService = Mockery::mock(SettingUserService::class);

        $mockedService->shouldReceive('update')
                    ->once()
                    ->with(1, Mockery::subset([
                        'name'  => 'John Updated',
                        'email' => 'updated@example.com',
                        'role'  => 'staff'
                    ]));

        $this->app->instance(SettingUserService::class, $mockedService);
        $this->withoutMiddleware(\App\Http\Requests\SettingUser\UpdateRequest::class);

        $response = $this->put('/setting-user/1', [
            'name'  => 'John Updated',
            'email' => 'updated@example.com',
            'role'  => 'staff'
        ]);

        $response->assertRedirect('/setting-user');
    }

    public function testDestroyUserCallsServiceAndRedirects()
    {
        $mockedService = Mockery::mock(SettingUserService::class);

        $mockedService->shouldReceive('delete')
                    ->once()
                    ->with(1);

        $this->app->instance(SettingUserService::class, $mockedService);

        $response = $this->delete('/setting-user/1');

        $response->assertRedirect('/setting-user');
    }

}