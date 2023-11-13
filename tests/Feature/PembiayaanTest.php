<?php

namespace Tests\Feature;

use App\Models\Pembiayaan;
use App\Models\User;
use App\Models\Warung;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PembiayaanTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_see_pembiayaan()
    {
        $this->seed();

        $user = User::first();

        $response = $this->actingAs($user)
            ->withSession([])
            ->get($this->baseUrl . "/pembiayaan");

        $response->assertSeeText("Pembiayaan");
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_can_create_pembiayaan()
    {
        $this->seed();

        $user = User::first();

        $warung = Warung::create(Warung::factory()->make()->toArray());

        $response = $this->actingAs($user)
            ->withSession([])
            ->post($this->baseUrl . "/pembiayaan", [
                "tanggal_pengajuan" => "21-10-2021",
                "warung_id"         => $warung->id,
                "plafon"            => 1000,
                "batch"             => 1,
            ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas("pembiayaans", [
            "tanggal_pengajuan" => "2021-10-21",
            "warung_id"         => $warung->id,
            "plafon"            => 1000,
            "batch"             => 1,
        ]);

        $pembiayaan = Pembiayaan::with('warung')->first();

        $this->assertEquals($warung->nama_pemohon, $pembiayaan->warung->nama_pemohon);
    }
}
