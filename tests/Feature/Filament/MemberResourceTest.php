<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\MemberResource;
use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class MemberResourceTest extends TestCase
{
    use RefreshDatabase; // Wajib! Agar database bersih setiap tes dijalankan.

    protected User $adminUser;
    protected Member $testMember;

    /**
     * Method ini berjalan sebelum setiap tes di dalam file ini.
     * Kita siapkan user admin dan satu data anggota.
     */
    protected function setUp(): void
    {
        parent::setUp();
        // Buat & login sebagai admin
        $this->adminUser = User::factory()->create();
        $this->actingAs($this->adminUser);

        // Buat satu data member untuk dites (update & delete)
        $this->testMember = Member::factory()->create();
    }

    // Test 1: Bisakah kita melihat halaman daftar anggota? (READ)
    /** @test */
    public function can_render_member_list_page(): void
    {
        $this->get(MemberResource::getUrl('index'))->assertSuccessful();
    }

    // Test 2: Bisakah kita membuat anggota baru? (CREATE)
    /** @test */
    public function can_create_new_member(): void
    {
        $newMemberData = Member::factory()->make()->toArray();

        Livewire::test(MemberResource\Pages\CreateMember::class)
            ->fillForm($newMemberData)
            ->call('create')
            ->assertHasNoFormErrors();

        // Cek apakah data benar-benar ada di database
        $this->assertDatabaseHas('members', ['student_id' => $newMemberData['student_id']]);
    }

    // Test 3: Bisakah kita melihat halaman edit anggota? (READ specific)
    /** @test */
    public function can_render_member_edit_page(): void
    {
        $this->get(MemberResource::getUrl('edit', ['record' => $this->testMember]))
            ->assertSuccessful();
    }

    // Test 4: Bisakah kita mengubah data anggota? (UPDATE)
    /** @test */
    public function can_update_member_data(): void
    {
        $updatedData = [
            'name' => 'Nama Sudah Diubah',
            'major' => 'Jurusan Baru',
        ];

        Livewire::test(MemberResource\Pages\EditMember::class, ['record' => $this->testMember->getRouteKey()])
            ->fillForm($updatedData)
            ->call('save')
            ->assertHasNoFormErrors();

        // Cek di database, apakah datanya sudah berubah?
        $this->assertDatabaseHas('members', [
            'id' => $this->testMember->id,
            'name' => 'Nama Sudah Diubah',
            'major' => 'Jurusan Baru',
        ]);
    }

    // Test 5: Bisakah kita menghapus data anggota? (DELETE)
    /** @test */
    public function can_delete_member(): void
    {
        Livewire::test(MemberResource\Pages\EditMember::class, ['record' => $this->testMember->getRouteKey()])
            ->callAction(\Filament\Actions\DeleteAction::class); // Panggil aksi hapus

        // Cek di database, apakah datanya sudah hilang?
        $this->assertDatabaseMissing('members', ['id' => $this->testMember->id]);
    }
}