<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WarungTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_can_see_warung()
    {
        $this->seed();

        $user = User::first();

        $response = $this->actingAs($user)
            ->withSession([])
            ->get($this->baseUrl . "/warung");

        $response->assertSeeText("Daftar Warung");
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_can_create_warung()
    {
        $this->seed();

        $user = User::first();

        $response = $this->actingAs($user)
            ->withSession([])
            ->post($this->baseUrl . "/warung", [
                "nama_pemohon" => "Torrey Konopelski",
                "email_pemohon" => "schuppe.jasen@gmail.com",
                "nik" => 123456789012,
                "no_kk" => 1234,
                "tanggal_lahir" => "13-04-1986",
                "tempat_lahir" => "New Lillianbury",
                "jenis_kelamin" => "P",
                "status_perkawinan" => "",
                "alamat" => "44987 McGlynn Rest Apt. 698 Magdalenmouth",
                "kode_pos" => 5337,
                "kota" => "batu",
                "provinsi" => "jawa timur",
                "no_handphone" => "17857215083",
                "no_telpon" => "17638854202",
                "nama_warung" => "warung kita",
                "profil_warung" => "lorem ipsum dolor sit amet",
                "bidang_usaha" => "",
                "berdiri_sejak" => 2010,
                "status_bangunan" => "",
            ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas("warungs", [
            "nama_pemohon" => "Torrey Konopelski",
            "email_pemohon" => "schuppe.jasen@gmail.com",
            "nik" => "123456789012",
            "no_kk" => "1234",
            "tanggal_lahir" => "1986-04-13",
            "tempat_lahir" => "New Lillianbury",
            "jenis_kelamin" => "P",
            "status_perkawinan" => null,
            "alamat" => "44987 McGlynn Rest Apt. 698 Magdalenmouth",
            "kode_pos" => "5337",
            "kota" => "batu",
            "provinsi" => "jawa timur",
            "no_handphone" => "17857215083",
            "no_telpon" => "17638854202",
            "nama_warung" => "warung kita",
            "profil_warung" => "lorem ipsum dolor sit amet",
            "bidang_usaha" => null,
            "berdiri_sejak" => "2010",
            "status_bangunan" => null,
        ]);
    }
}
