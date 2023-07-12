<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $career = "`**PGs.Ts.Bs.Nguyễn Thị Hoài An - Phẫu thuật cắt Amidan/nạo VA**

        * Chuyên gia đầu ngành về Tai mũi họng và phẫu thuật Tai mũi họng 
        
        * Nguyên Trưởng khoa Tai Mũi Họng trẻ em, Bệnh viện Tai Mũi Họng Trung ương
        
        * Trên 25 năm công tác tại Bệnh viện Tai Mũi Họng Trung ương 
        
        **Thông tin phẫu thuật cắt Amidan/nạo VA**
        
        **Phương pháp phẫu thuật**
        
        Cắt amidan/nạo VA bằng coblator công nghệ plasma, đây gần như là phương pháp hiện đại nhất trong phẫu thuật Amidan, VA. Phương pháp này giúp bệnh nhân rút ngắn thời gian phẫu thuật và thời gian hồi phục sau phẫu thuật.
        
        **Thời gian phẫu thuật:  ** Khoảng 30 - 45 phút 
        
        **Quy trình phẫu thuật **
        
        * Bước 1: Thăm khám với PGs.Ts.Bs. Nguyễn Thị Hoài An
        
        * Bước 2: Thực hiện các dịch vụ cận lâm sàng theo chỉ định để đảm bảo an toàn trước phẫu thuật.
        
        * Bước 3: Nếu sức khỏe đủ điều kiện sẽ được sắp xếp lịch phẫu thuật trong cùng ngày 
        
        **Thời gian xuất viện:** Trong ngày hoặc sau 24h (tùy thuộc tình trạng sức khỏe bệnh nhân) 
        
        **Chế độ bảo hiểm**
        
        * Bảo hiểm y tế nhà nước: Bệnh nhân được chi trả theo quy định nhà nước. Thông thường danh mục được chi trả tại các bệnh viện tư nhân tương đối thấp.
        
        * Bảo hiểm tư nhân: Với bảo hiểm bảo lãnh trực tiếp sẽ được bệnh viện hướng dẫn để khấu trừ trực tiếp khi thực hiện phẫu thuật. Trường hợp còn lại sẽ được hỗ trợ hoàn thành giấy tờ để bệnh nhân tự thanh toán với công ty bảo hiểm.
        
        **Địa chỉ phẫu thuật**
        
        Bệnh nhân thực hiện phẫu thuật tại Bệnh viện Đa khoa An Việt. Tai Mũi Họng là chuyên khoa mũi nhọn của Bệnh viện An Việt với sự góp mặt của nhiều PGS.TS đầu ngành, đã công tác nhiều năm tại Bệnh viện Tai mũi họng Trung ương.
        
        Hiện nay, Bệnh viện An Việt áp dụng công nghệ Plasma hiện đại để phẫu thuật cắt amidan cho trẻ. Đây là kỹ thuật tiên tiến, an toàn, hiệu quả, nhanh chóng nhất hiện nay, được giới chuyên môn ưu tiên áp dụng.
        
        Phương pháp được thực hiện bởi những bác sỹ chuyên môn cao.`";
        $introduce = "`###  GIỚI THIỆU

        Bệnh viện An Việt là bệnh viện đa khoa tư nhân đã hoạt động được trên 10 năm. Bệnh viện là địa chỉ khám và điều trị uy tín về một số mặt bệnh chuyên khoa như Tai Mũi Họng, Thần kinh, Sản phụ khoa, Nam khoa,...
        
        Đội ngũ bác sĩ của bệnh viện đều là các bác sĩ nhiều năm kinh nghiệm và được bệnh nhân phản hồi tích cực về quá trình khám và điều trị. Bên cạnh đó, bệnh viện còn đầu tư cơ sở hạ tầng và trang thiết bị hỗ trợ thăm khám và điều trị hiệu quả cho người bệnh: Hệ thống nội soi tai mũi họng, máy chụp cắt lớp vi tính, phòng phẫu thuật đảm bảo vô trùng,...
        
        **Địa chỉ:** Số 1E Trường Chinh, Thanh Xuân, Hà Nội
        
        **Thời gian làm việc:** Thứ 2 đến Chủ Nhật
        
        * Sáng: Từ 7h30 – 12h00
        
        * Chiều: Từ 13h30 – 16h30
        
        **Hình thức thanh toán:** Tiền mặt, Thẻ ngân hàng
        
        **Bảo hiểm bảo lãnh:** Hiện tại, bệnh viện hỗ trợ thanh toán bảo hiểm y tế nhà nước với các danh mục cho phép và bảo lãnh trực tiếp nhiều loại bảo hiểm y tế tư nhân như: Insmart, VIB, PTI, Baoviet,...
        
        ###  THẾ MẠNH CHUYÊN MÔN
        
        Bệnh viện có thế mạnh chẩn đoán và điều trị về các vấn đề:
        
        * Tai mũi họng
        
        * Thận tiết niệu
        
        * Nam học
        
        * Thần kinh
        
        * Sản phụ khoa
        
        * Cơ xương khớp
        
        Trong đó, bệnh viện đặc biệt có thế mạnh trong khám, chẩn đoán và điều trị viêm VA, nạo Amidan bằng phương pháp phẫu thuật với phương pháp coblator/plasma, giúp bệnh nhân phục hồi nhanh, hạn chế chảy máu tối đa trong quá trình phẫu thuật.
        
        ###  TRANG THIẾT BỊ
        
        Bệnh viện sở hữu hệ thống trang các thiết bị máy móc hiện đại, được đồng bộ từ các nước tiên tiến trên thế giới như Mỹ, Đức, Nhật…
        
        ![](https://bookingcare.vn/files/image/2018/06/22/084654pgs-hoai-an-nao-va1.jpg?w=1000)
        
        (Hệ thống plasma, coblator cho cắt amidan và nạo VA)
        
        ![](https://bookingcare.vn/files/image/2018/06/23/152509may-do-thinh-luc1.jpg?w=1000)
        
        (Máy đo thính lực chẩn đoán của Siemens -Đức)
        
        ###  VỊ TRÍ
        
        Bệnh viện Đa khoa An Việt cách cầu vượt Ngã tư Vọng khoảng 100m về hướng Đại La.
        
        ![](https://bookingcare.vn/files/blog/2021/05/19/092657-vi-tri-bv-an-viet.png?w=1000)
        
        ###  QUY TRÌNH ĐI KHÁM
        
        ![](https://bookingcare.vn/files/image/2018/06/18/110936quy-trinh-benh-vien-an-viet.png?w=1000)`";
        $ten = ['Thanh', 'Tuấn', 'Nam', 'Bình', 'Trọng', 'Việt', 'Quốc', 'Khoa', 'Thái', 'Hà'];
        $ho = ['Nguyễn', 'Trần', 'Phạm', 'Dương', 'Mai', 'Lê'];
        $dem = ['Văn', 'Khánh', 'Tiến', 'Mai', 'Hà'];
        $district = ['Quận 1', 'Quận 2', 'Quận 3', 'Hoàng Mai', 'Thanh Xuân', 'Đống Đa', 'Thừa Thiên', 'Thanh Trì', 'Tây Hồ', 'Bình Thạnh'];
        $cities = ['Hà Nội', 'Thành phố Hồ Chí Minh', 'Đà Nẵng', 'Vũng Tàu', 'Thừa Thiên - Huế'];

        $clinictype = ['Phòng Khám', 'Bệnh Viện'];
        $status = ['working', 'pending', 'notworking'];
        $degree = ['Cử nhân', 'Thạc sĩ', 'Tiến sĩ', 'Phó Giáo Sư', 'Giáo sư'];
        $specialize = ['Xương khớp', 'Tiêu hóa', 'Nội tiết', 'Phụ Sản', 'Nam Học', 'Thần kinh', 'Huyết Học', 'Da liễu', 'Tim mạch'];
        $number = 10;
        // seed 10 user là admin 10 user là clinic và 50 user là doctor (70)
        for ($i = 0; $i < $number; $i++) {
            DB::table('users')->insert([
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password1'),
                'role' => 3
            ]);
        }
        for ($i = 0; $i < $number; $i++) {
            DB::table('users')->insert([
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password1'),
                'role' => 2
            ]);
        }
        for ($i = 0; $i < $number + 40; $i++) {
            DB::table('users')->insert([
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password1'),
                'role' => 1
            ]);
        }
        // tạo 10 admin tương đương 10 user admin
        for ($i = 0; $i < $number; $i++) {
            DB::table('admins')->insert([
                'name' => $ho[rand(0, count($ho) - 1)] . ' ' . $dem[rand(0, count($dem) - 1)] . ' ' . $ten[rand(0, count($ten) - 1)],
                'address' => rand(1, 99) . ' ' . Str::random(5) . ' ' . $district[rand(0, count($district) - 1)] . ' ' . $cities[rand(0, count($cities) - 1)],
                'gender' => 'Nam',
                'phone' => rand(1000000000, 9999999999),
                'status' => 'working'
            ]);
        }
        // tạo 10 clinic tương đương 10 user loại clinic
        for ($i = $number + 1; $i <= $number + 10; $i++) {
            $name = $ho[rand(0, count($ho) - 1)] . ' ' . $ten[rand(0, count($ten) - 1)];
            $fullname = $clinictype[rand(0, count($clinictype) - 1)] . ' ' . $name;
            DB::table('clinics')->insert([
                'id' => $i,
                'name' => $name,
                'fullname' => $fullname,
                'address' => rand(1, 99) . ' ' . Str::random(5) . ' ' . $district[rand(0, count($district) - 1)] . ' ' . $cities[rand(0, count($cities) - 1)],
                'introduce' => $introduce,
                'status' => 'working',
            ]);
        }
        // tạo 50 doctor tương đương 50 user loại doctor

        for ($i = $number + 11; $i <= $number + 60; $i++) {
            DB::table('doctors')->insert([
                'id' => $i,
                'name' => $ho[rand(0, count($ho) - 1)] . ' ' . $dem[rand(0, count($dem) - 1)] . ' ' . $ten[rand(0, count($ten) - 1)],
                'address' => rand(1, 99) . ' ' . Str::random(5) . ' ' . $district[rand(0, count($district) - 1)] . ' ' . $cities[rand(0, count($cities) - 1)],
                'phone' => rand(1000000000, 9999999999),
                'gender' => 'nam',
                'price' => rand(400000, 1000000),
                'clinicid' => rand($number + 1, $number + 10),
                'career' => $career,
                'specialize' => $specialize[rand(0, count($specialize) - 1)],
                'degree' => $degree[rand(0, count($degree) - 1)],
                'status' => $status[rand(0, count($status) - 1)],
            ]);
        }
    }
}