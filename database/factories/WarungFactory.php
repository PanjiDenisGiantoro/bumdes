<?php

namespace Database\Factories;

use App\Models\Warung;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarungFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Warung::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nama_pemohon" => "Torrey Konopelski",
            "email_pemohon" => "schuppe.jasen@gmail.com",
            "nik" => 123456789012,
            "no_kk" => 1234,
            "tanggal_lahir" => "13-04-1986",
            "tempat_lahir" => "New Lillianbury",
            "jenis_kelamin" => "P",
            "status_perkawinan" => null,
            "alamat" => "44987 McGlynn Rest Apt. 698 Magdalenmouth",
            "kode_pos" => 5337,
            "kota" => "batu",
            "provinsi" => "jawa timur",
            "no_handphone" => "17857215083",
            "no_telpon" => "17638854202",
            "nama_warung" => "warung kita",
            "profil_warung" => "lorem ipsum dolor sit amet",
            "bidang_usaha" => null,
            "berdiri_sejak" => 2010,
            "status_bangunan" => null,
        ];
    }
}
