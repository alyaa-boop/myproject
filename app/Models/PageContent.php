<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $table = 'page_contents';

    protected $fillable = ['page_slug', 'content'];

    protected $casts = ['content' => 'array'];

    public static function getContent(string $slug): array
    {
        $page = self::where('page_slug', $slug)->first();
        return $page ? $page->content : self::defaultContent($slug);
    }

    public static function defaultContent(string $slug): array
    {
        $defaults = [
            'home' => [
                'hero_title' => 'Selamat Datang ke Portal Alumni 4B Malaysia',
                'hero_subtitle' => 'Menghubungkan semua bekas ahli 4B di seluruh Malaysia untuk terus menyumbang kepada pembangunan masyarakat dan negara.',
                'services_title' => 'Perkhidmatan Kami',
                'services_subtitle' => 'Portal Alumni 4B menyediakan pelbagai perkhidmatan untuk memudahkan bekas ahli 4B untuk terus berhubung dan menyumbang.',
                'keahlian_title' => 'Keahlian',
                'keahlian_subtitle' => 'Daftar dan semak status keahlian anda',
                'keahlian_desc' => 'Sistem pengurusan keahlian yang komprehensif untuk memudahkan pendaftaran dan pengesahan keahlian alumni.',
                'aktiviti_title' => 'Aktiviti',
                'aktiviti_subtitle' => 'Program dan aktiviti terkini',
                'aktiviti_desc' => 'Maklumat mengenai program dan aktiviti yang dianjurkan oleh Alumni 4B di peringkat kebangsaan dan negeri.',
                'galeri_title' => 'Galeri',
                'galeri_subtitle' => 'Koleksi gambar aktiviti',
                'galeri_desc' => 'Galeri gambar aktiviti dan program yang telah dijalankan oleh Alumni 4B di seluruh Malaysia.',
                'latest_title' => 'Aktiviti Terkini',
                'latest_subtitle' => 'Sertai aktiviti-aktiviti terkini yang dianjurkan oleh Alumni 4B di seluruh Malaysia.',
                'activities' => [
                    ['title' => 'Program Khidmat Masyarakat 1', 'date' => '10 Jun 2025', 'location' => 'Kuala Lumpur', 'desc' => 'Program khidmat masyarakat yang dianjurkan oleh Alumni 4B Kuala Lumpur dengan kerjasama pihak berkuasa tempatan.'],
                    ['title' => 'Program Khidmat Masyarakat 2', 'date' => '10 Jun 2025', 'location' => 'Kuala Lumpur', 'desc' => 'Program khidmat masyarakat yang dianjurkan oleh Alumni 4B Kuala Lumpur dengan kerjasama pihak berkuasa tempatan.'],
                    ['title' => 'Program Khidmat Masyarakat 3', 'date' => '10 Jun 2025', 'location' => 'Kuala Lumpur', 'desc' => 'Program khidmat masyarakat yang dianjurkan oleh Alumni 4B Kuala Lumpur dengan kerjasama pihak berkuasa tempatan.'],
                    ['title' => 'Program Khidmat Masyarakat 4', 'date' => '10 Jun 2025', 'location' => 'Kuala Lumpur', 'desc' => 'Program khidmat masyarakat yang dianjurkan oleh Alumni 4B Kuala Lumpur dengan kerjasama pihak berkuasa tempatan.'],
                ],
            ],
            'latar-belakang' => [
                'title' => 'Latar Belakang Alumni 4B Malaysia',
                'intro' => 'Alumni 4B Malaysia merupakan sebuah pertubuhan yang ditubuhkan untuk menghimpunkan bekas ahli Pertubuhan Belia 4B Malaysia. Pertubuhan ini bertujuan untuk mengekalkan semangat kesukarelawanan dan khidmat masyarakat dalam kalangan bekas ahli 4B.',
                'sejarah_title' => 'Sejarah Penubuhan',
                'sejarah_1' => 'Pertubuhan Belia 4B Malaysia telah ditubuhkan pada tahun 1967 dengan matlamat untuk memupuk semangat kepimpinan, kesukarelawanan dan khidmat masyarakat dalam kalangan belia Malaysia. Setelah lebih 50 tahun penubuhannya, ramai bekas ahli 4B yang telah menyumbang kepada pembangunan masyarakat dan negara dalam pelbagai bidang.',
                'sejarah_2' => 'Pada tahun 2010, Alumni 4B Malaysia telah ditubuhkan secara rasmi untuk menghimpunkan bekas ahli 4B dan meneruskan semangat kesukarelawanan dan khidmat masyarakat yang telah dipupuk semasa mereka menjadi ahli 4B.',
                'objektif_title' => 'Objektif',
                'objektif' => ['Menghimpunkan bekas ahli Pertubuhan Belia 4B Malaysia', 'Meneruskan semangat kesukarelawanan dan khidmat masyarakat', 'Menyokong aktiviti dan program Pertubuhan Belia 4B Malaysia', 'Menjadi platform untuk bekas ahli 4B berkongsi pengalaman dan kepakaran', 'Menyumbang kepada pembangunan masyarakat dan negara'],
                'struktur_title' => 'Struktur Organisasi',
                'struktur' => 'Alumni 4B Malaysia diuruskan oleh satu Jawatankuasa Pusat yang dipilih setiap 2 tahun dalam Mesyuarat Agung. Di peringkat negeri pula, terdapat Jawatankuasa Negeri yang menguruskan aktiviti dan program di peringkat negeri.',
                'keahlian_title' => 'Keahlian',
                'keahlian' => 'Keahlian Alumni 4B Malaysia terbuka kepada semua bekas ahli Pertubuhan Belia 4B Malaysia. Ahli perlu mendaftar dan membayar yuran keahlian untuk menjadi ahli yang sah.',
                'tahun_penubuhan' => '2010',
                'bilangan_ahli' => '10,000+ di seluruh Malaysia',
                'alamat' => "Ibu Pejabat Alumni 4B Malaysia\nJalan Contoh, 50000 Kuala Lumpur",
                'hubungi' => "Tel: 03-1234 5678\nEmail: info@alumni4b.org.my",
            ],
            'carta-organisasi' => [
                'title' => 'Carta Organisasi Alumni 4B Malaysia',
                'subtitle' => 'Struktur organisasi Alumni 4B Malaysia yang menguruskan aktiviti dan program di peringkat kebangsaan dan negeri.',
                'pengerusi' => "Dato' Ahmad bin Abdullah",
                'tp' => 'Puan Siti binti Hassan',
                'setiausaha' => 'Encik Ravi a/l Chandran',
                'bendahari' => 'Puan Lim Mei Ling',
                'jk_keahlian' => 'Encik Azman bin Aziz',
                'jk_aktiviti' => 'Puan Nurul Huda binti Ismail',
                'jk_perhubungan' => 'Encik Chong Kok Wai',
                'executive' => [
                    ['position' => 'Pengerusi', 'name' => "Dato' Ahmad bin Abdullah", 'bio' => "Bekas Pengerusi 4B Malaysia (2010-2015). Mempunyai pengalaman lebih 30 tahun dalam bidang kepimpinan belia.", 'email' => 'ahmad@alumni4b.org.my', 'phone' => '012-345 6789'],
                    ['position' => 'Timbalan Pengerusi', 'name' => 'Puan Siti binti Hassan', 'bio' => "Bekas Timbalan Pengerusi 4B Selangor (2012-2018). Aktif dalam program pembangunan wanita dan keluarga.", 'email' => 'siti@alumni4b.org.my', 'phone' => '013-456 7890'],
                    ['position' => 'Setiausaha', 'name' => 'Encik Ravi a/l Chandran', 'bio' => "Bekas Setiausaha 4B Perak (2015-2020). Berpengalaman dalam pengurusan organisasi belia di peringkat kebangsaan.", 'email' => 'ravi@alumni4b.org.my', 'phone' => '014-567 8901'],
                    ['position' => 'Bendahari', 'name' => 'Puan Lim Mei Ling', 'bio' => "Bekas Bendahari 4B Pulau Pinang (2014-2019). Pakar dalam pengurusan kewangan organisasi bukan kerajaan.", 'email' => 'meiling@alumni4b.org.my', 'phone' => '015-678 9012'],
                ],
                'committees' => [
                    'Keahlian' => [['position' => 'Pengerusi', 'name' => 'Encik Azman bin Aziz'], ['position' => 'Setiausaha', 'name' => 'Puan Faridah binti Karim'], ['position' => 'Ahli', 'name' => 'Encik Tan Wei Ming']],
                    'Aktiviti' => [['position' => 'Pengerusi', 'name' => 'Puan Nurul Huda binti Ismail'], ['position' => 'Setiausaha', 'name' => 'Encik Jason Wong'], ['position' => 'Ahli', 'name' => 'Puan Aini binti Yusof']],
                    'Perhubungan' => [['position' => 'Pengerusi', 'name' => 'Encik Chong Kok Wai'], ['position' => 'Setiausaha', 'name' => 'Puan Noraini binti Hamzah'], ['position' => 'Ahli', 'name' => 'Encik Saiful bin Bahari']],
                ],
                'state_chapters' => [
                    ['state' => 'Johor', 'chairman' => 'Encik Abdul Rahim bin Ismail'],
                    ['state' => 'Kedah', 'chairman' => 'Puan Norhayati binti Hassan'],
                    ['state' => 'Kelantan', 'chairman' => 'Encik Mohd Fadzli bin Abdullah'],
                    ['state' => 'Melaka', 'chairman' => 'Puan Lim Siew Mei'],
                    ['state' => 'Negeri Sembilan', 'chairman' => 'Encik Suresh a/l Kumar'],
                    ['state' => 'Pahang', 'chairman' => 'Puan Azizah binti Yusof'],
                    ['state' => 'Perak', 'chairman' => 'Encik Chong Wei Liang'],
                    ['state' => 'Perlis', 'chairman' => 'Puan Siti Aminah binti Ali'],
                    ['state' => 'Pulau Pinang', 'chairman' => 'Encik Gopal a/l Krishnan'],
                    ['state' => 'Selangor', 'chairman' => 'Encik Azlan bin Aziz'],
                    ['state' => 'Terengganu', 'chairman' => 'Puan Faridah binti Ismail'],
                    ['state' => 'WP Kuala Lumpur', 'chairman' => 'Encik Tan Chee Keong'],
                    ['state' => 'WP Putrajaya', 'chairman' => 'Encik Mohd Nazri bin Ibrahim'],
                ],
            ],
            'aktiviti' => [
                'title' => 'Aktiviti Alumni 4B',
                'subtitle' => 'Senarai aktiviti dan program yang dianjurkan oleh Alumni 4B Malaysia di peringkat kebangsaan dan negeri.',
                'activities' => [
                    ['id' => 1, 'title' => 'Program Khidmat Masyarakat', 'date' => '10 Jun 2025', 'location' => 'Kuala Lumpur', 'description' => 'Program khidmat masyarakat yang dianjurkan oleh Alumni 4B Kuala Lumpur dengan kerjasama pihak berkuasa tempatan.', 'participants' => 50],
                    ['id' => 2, 'title' => 'Bengkel Kepimpinan', 'date' => '15 Julai 2025', 'location' => 'Selangor', 'description' => 'Bengkel kepimpinan untuk ahli Alumni 4B yang berminat untuk meningkatkan kemahiran kepimpinan mereka.', 'participants' => 30],
                    ['id' => 3, 'title' => 'Majlis Makan Malam Tahunan', 'date' => '20 Ogos 2025', 'location' => 'Putrajaya', 'description' => 'Majlis makan malam tahunan Alumni 4B Malaysia yang akan diadakan di Putrajaya International Convention Centre.', 'participants' => 200],
                    ['id' => 4, 'title' => 'Lawatan ke Rumah Anak Yatim', 'date' => '5 September 2025', 'location' => 'Melaka', 'description' => 'Lawatan ke rumah anak yatim di Melaka untuk menyampaikan sumbangan dan mengadakan aktiviti bersama anak-anak yatim.', 'participants' => 25],
                    ['id' => 5, 'title' => 'Program Motivasi Pelajar', 'date' => '12 Oktober 2025', 'location' => 'Johor', 'description' => 'Program motivasi untuk pelajar sekolah menengah di Johor yang akan disampaikan oleh ahli Alumni 4B yang berjaya dalam kerjaya mereka.', 'participants' => 100],
                    ['id' => 6, 'title' => 'Kursus Keusahawanan', 'date' => '18 November 2025', 'location' => 'Penang', 'description' => 'Kursus keusahawanan untuk ahli Alumni 4B yang berminat untuk memulakan perniagaan sendiri.', 'participants' => 40],
                ],
                'cadang_title' => 'Cadangkan Aktiviti',
                'cadang_subtitle' => 'Anda mempunyai cadangan untuk aktiviti Alumni 4B? Sila hubungi kami.',
            ],
            'galeri' => [
                'title' => 'Galeri',
                'subtitle' => 'Galeri gambar aktiviti dan program Alumni 4B Malaysia.',
                'items' => [],
            ],
        ];

        return $defaults[$slug] ?? [];
    }

    public static function ensureExists(string $slug): self
    {
        $page = self::where('page_slug', $slug)->first();
        if (!$page) {
            $page = self::create([
                'page_slug' => $slug,
                'content' => self::defaultContent($slug),
            ]);
        }
        return $page;
    }
}
