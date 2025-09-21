<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\EventResource;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EventResourceTest extends TestCase
{
    use RefreshDatabase;

    protected User $adminUser;
    protected Event $testEvent;

    /**
     * Method ini berjalan sebelum setiap tes di dalam file ini.
     * Kita siapkan user admin dan satu data event.
     */
    protected function setUp(): void
    {
        parent::setUp();
        // Buat & login sebagai admin
        $this->adminUser = User::factory()->create();
        $this->actingAs($this->adminUser);

        // Buat satu data event untuk dites (update & delete)
        $this->testEvent = Event::factory()->create();
    }

    // Test 1: Bisakah kita melihat halaman daftar event? (READ)
    /** @test */
    public function can_render_event_list_page(): void
    {
        $this->get(EventResource::getUrl('index'))->assertSuccessful();
    }

    // Test 2: Bisakah kita membuat event baru? (CREATE)
    /** @test */
    public function can_create_new_event(): void
    {
        $newEventData = Event::factory()->make()->toArray();

        Livewire::test(EventResource\Pages\CreateEvent::class)
            ->fillForm($newEventData)
            ->call('create')
            ->assertHasNoFormErrors();

        // Cek apakah data benar-benar ada di database
        $this->assertDatabaseHas('events', ['name' => $newEventData['name']]);
    }

    // Test 3: Bisakah kita melihat halaman edit event? (READ specific)
    /** @test */
    public function can_render_event_edit_page(): void
    {
        $this->get(EventResource::getUrl('edit', ['record' => $this->testEvent]))
            ->assertSuccessful();
    }

    // Test 4: Bisakah kita mengubah data event? (UPDATE)
    /** @test */
    public function can_update_event_data(): void
    {
        $updatedData = [
            'name' => 'Nama Event Diubah',
            'location' => 'Lokasi Baru',
            'date' => now()->addDays(10)->toDateString(),
        ];

        Livewire::test(EventResource\Pages\EditEvent::class, ['record' => $this->testEvent->getRouteKey()])
            ->fillForm($updatedData)
            ->call('save')
            ->assertHasNoFormErrors();

        // Cek di database, apakah datanya sudah berubah?
        $this->assertDatabaseHas('events', [
            'id' => $this->testEvent->id,
            'name' => 'Nama Event Diubah',
            'location' => 'Lokasi Baru',
            'date' => $updatedData['date'],
        ]);
    }

    // Test 5: Bisakah kita menghapus data event? (DELETE)
    /** @test */
    public function can_delete_event(): void
    {
        Livewire::test(EventResource\Pages\EditEvent::class, ['record' => $this->testEvent->getRouteKey()])
            ->callAction(\Filament\Actions\DeleteAction::class);

        // Cek di database, apakah datanya sudah hilang?
        $this->assertDatabaseMissing('events', ['id' => $this->testEvent->id]);
    }
}