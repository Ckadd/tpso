@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a>
                <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                <span>{{__('menu_standard_of_tourism_personnel')}}</span>
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="col-xs-12 head_cshare_bgblue headnews_bgblue">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 head_cshare_detail">
                        <hgroup>
                            <h2>{{__('menu_standard_of_tourism_personnel')}}</h2>
                            <h1>TOURISM PERSONNEL</h1>
                        </hgroup>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 wrap_tab">
                <div class="border_tab">
                    <div class="tab_item active">
                        <div class="tab_num">01</div><div class="tab_head">ข้อตกลงร่วมว่าด้วยการยอมรับคุณสมบัติบุคลากรด้านการท่องเที่ยวอาเซียน หรือ MRA-TP คืออะไร และอาชีพมัคคุเทศก์เป็นตำแหน่งงานที่
    จะส่งเสริมหรืออนุญาตให้ชาวต่างประเทศเข้ามาทำงาน ในประเทศไทยได้ตามข้อตกลงดังกล่าวหรือไม่</div>
                    </div>
                    <div class="tab_detail">
                        <p>ข้อตกลงร่วมว่าด้วยการยอมรับคุณสมบัติบุคลากรด้านการท่องเที่ยวอาเซียน (ASEAN Mutual Recognition Arrangement on Tourism Professionals: ASEAN MRA 
    on TP: MRA-TP) จัดทำขึ้นโดยความเห็นชอบของประเทศสมาชิกอาเซียนทั้ง 10 ประเทศ โดยมีวัตถุประสงค์เพื่ออำนวยความสะดวกในการเคลื่อนย้ายผู้ประกอบอาชีพด้านการท่องเที่ยวระหว่าง
    ประเทศสมาชิกอาเซียน เพื่อแลกเปลี่ยนข้อมูล และแนวทางปฏิบัติที่ดีที่สุด และเพื่อยกระดับสมรรถนะและศักยภาพของบุคลากรทางการท่องเที่ยวในประเทศสมาชิกให้อยู่ในระดับสากล 
    โดยตำแหน่งงานที่ดำเนินการส่งเสริมและพัฒนาบุคลากร ในอุตสาหกรรมท่องเที่ยวภายใต้ข้อตกลงดังกล่าว ไม่รวมถึงอาชีพมัคคุเทศก์ (Tour Guide) ซึ่งเป็นอาชีพสงวนสำหรับคนไทยเท่านั้น 
    ซึ่งในปัจจุบัน การพัฒนาบุคลากรในอุตสาหกรรมท่องเที่ยวภายใต้ข้อตกลงดังกล่าวดำเนินการใน 2 สาขา 6 แผนก 32 ตำแหน่งงาน ดังนี้</p>
                        <p>
                            1. สาขาที่พัก (Hotel Services) ประกอบด้วย 4 แผนก 23 ตำแหน่งงาน ดังนี้<br>
    1.1 แผนกต้อนรับ (Front Office) มี 5 ตำแหน่งงาน คือ<br>
    1.1.1 ผู้จัดการฝ่ายต้อนรับ (Front Office Manager)<br>
    1.1.2 ผู้ควบคุมดูแลฝ่ายต้อนรับ (Front Office Supervisor)<br>
    1.1.3 พนักงานต้อนรับ (Receptionist)<br>
    1.1.4 พนักงานรับโทรศัพท์ (Telephone Operator)<br>
    1.1.5 พนักงานยกกระเป๋า (Bell Boy)<br>
    1.2 แผนกแม่บ้าน(House Keeping) มี 6 ตำแหน่งงาน คือ<br>
    1.2.1 ผู้จัดการแผนกแม่บ้าน (Executive Housekeeper)<br>
    1.2.2 ผู้จัดการฝ่ายซักรีด (Laundry Manager)<br>
    1.2.3 ผู้ควบคุมดูแลห้องพัก (Floor Supervisor)<br>
    1.2.4 พนักงานซักรีด (Laundry Attendant)<br>
    1.2.5 พนักงานดูแลห้องพัก (Room Attendant)<br>
    1.2.6 พนักงานทำความสะอาด (Public Area Cleaner)<br>
    1.3 แผนกประกอบอาหาร (Food Production) มี 7 ตำแหน่งงาน คือ<br>
    1.3.1 หัวหน้าพ่อครัว (Executive Chef)<br>
    1.3.2 พ่อครัวแต่ละงาน (Demi Chef)<br>
    1.3.3 ผู้ช่วยพ่อครัวฝ่ายอาหาร (Commis Chef)<br>
    1.3.4 พ่อครัวงานขนมหวาน (Chef de Partie)<br>
    1.3.5 ผู้ช่วยพ่อครัวขนมหวาน (Commis Pastry)<br>
    1.3.6 งานขนมปัง (Baker)<br>
    1.3.7 งานเนื้อ (Butcher)<br>
    1.4 แผนกอาหารและเครื่องดื่ม (Food and Beverage Service) มี 5 ตำแหน่งงาน คือ<br>
    1.4.1 ผู้อำนวยการแผนกอาหารและเครื่องดื่ม (F&B Director)<br>
    1.4.2 ผู้จัดการอาหารและเครื่องดื่ม (F&B Outlet Manager)<br>
    1.4.3 หัวหน้าพนักงานบริกร (Head Waiter)<br>
    1.4.4 พนักงานผสมเครื่องดื่ม (Bartender)<br>
    1.4.5 พนักงานบริกร (Waiter)<br>
    2. สาขาการเดินทาง (Travel Services) ประกอบด้วย 2 แผนก 9 ตำแหน่งงาน ดังนี้<br>
    2.1 แผนกธุรกิจนำเที่ยว (Travel Agencies) มี 4 ตำแหน่งงาน คือ<br>
    2.1.1 ผู้จัดการทั่วไป (General Manger)<br>
    2.1.2 ผู้ช่วยผู้จัดการทั่วไป (Assistant General Manager)<br>
    2.1.3 หัวหน้าผู้แนะนำการเดินทาง (Senior General Manager)<br>
    2.1.4 ผู้แนะนำการเดินทาง (Travel Consultant)<br>
    2.2 แผนกบริหารธุรกิจนำเที่ยว (Tour Operation) มี 5 ตำแหน่งงาน คือ<br>
    2.2.1 ผู้จัดการธุรกิจ (Product Manager)<br>
    2.2.2 ผู้จัดการฝ่ายขายและการตลาด (Sales and Marketing Manager)<br>
    2.2.3 ผู้จัดการฝ่ายบัญชี (Credit Manager)<br>
    2.2.4 ผู้จัดการฝ่ายตั๋ว (Ticketing Manager)<br>
    2.2.5 ผู้จัดการฝ่ายท่องเที่ยว (Tour Manager)
                        </p>
                    </div>
                </div>
                <div class="border_tab">
                    <div class="tab_item">
                        <div class="tab_num">02</div><div class="tab_head">ตำแหน่งงานที่มีการส่งเสริมและอำนวยความสะดวกในการเคลื่อนย้ายแรงงานภายใต้ข้อตกลงร่วมว่าด้วยการยอมรับคุณสมบัติบุคลากรด้าน
การท่องเที่ยวอาเซียน หรือ MRA-TP มีจำนวนกี่ตำแหน่งงาน อะไรบ้าง</div>
                    </div>
                    <div class="tab_detail">
                        <p>ข้อตกลงร่วมว่าด้วยการยอมรับคุณสมบัติบุคลากรด้านการท่องเที่ยวอาเซียน (ASEAN Mutual Recognition Arrangement on Tourism Professionals: ASEAN MRA 
    on TP: MRA-TP) จัดทำขึ้นโดยความเห็นชอบของประเทศสมาชิกอาเซียนทั้ง 10 ประเทศ โดยมีวัตถุประสงค์เพื่ออำนวยความสะดวกในการเคลื่อนย้ายผู้ประกอบอาชีพด้านการท่องเที่ยวระหว่าง
    ประเทศสมาชิกอาเซียน เพื่อแลกเปลี่ยนข้อมูล และแนวทางปฏิบัติที่ดีที่สุด และเพื่อยกระดับสมรรถนะและศักยภาพของบุคลากรทางการท่องเที่ยวในประเทศสมาชิกให้อยู่ในระดับสากล 
    โดยตำแหน่งงานที่ดำเนินการส่งเสริมและพัฒนาบุคลากร ในอุตสาหกรรมท่องเที่ยวภายใต้ข้อตกลงดังกล่าว ไม่รวมถึงอาชีพมัคคุเทศก์ (Tour Guide) ซึ่งเป็นอาชีพสงวนสำหรับคนไทยเท่านั้น 
    ซึ่งในปัจจุบัน การพัฒนาบุคลากรในอุตสาหกรรมท่องเที่ยวภายใต้ข้อตกลงดังกล่าวดำเนินการใน 2 สาขา 6 แผนก 32 ตำแหน่งงาน ดังนี้</p>
                    </div>
                </div>
                <div class="border_tab">
                    <div class="tab_item">
                        <div class="tab_num">03</div><div class="tab_head">ใครบ้างที่สามารถเข้ารับการพัฒนาสมรรถนะตามมาตรฐานสมรรถนะด้านการท่องเที่ยวของอาเซียน</div>
                    </div>
                    <div class="tab_detail">
                        <p>ข้อตกลงร่วมว่าด้วยการยอมรับคุณสมบัติบุคลากรด้านการท่องเที่ยวอาเซียน (ASEAN Mutual Recognition Arrangement on Tourism Professionals: ASEAN MRA 
    on TP: MRA-TP) จัดทำขึ้นโดยความเห็นชอบของประเทศสมาชิกอาเซียนทั้ง 10 ประเทศ โดยมีวัตถุประสงค์เพื่ออำนวยความสะดวกในการเคลื่อนย้ายผู้ประกอบอาชีพด้านการท่องเที่ยวระหว่าง
    ประเทศสมาชิกอาเซียน เพื่อแลกเปลี่ยนข้อมูล และแนวทางปฏิบัติที่ดีที่สุด และเพื่อยกระดับสมรรถนะและศักยภาพของบุคลากรทางการท่องเที่ยวในประเทศสมาชิกให้อยู่ในระดับสากล 
    โดยตำแหน่งงานที่ดำเนินการส่งเสริมและพัฒนาบุคลากร ในอุตสาหกรรมท่องเที่ยวภายใต้ข้อตกลงดังกล่าว ไม่รวมถึงอาชีพมัคคุเทศก์ (Tour Guide) ซึ่งเป็นอาชีพสงวนสำหรับคนไทยเท่านั้น 
    ซึ่งในปัจจุบัน การพัฒนาบุคลากรในอุตสาหกรรมท่องเที่ยวภายใต้ข้อตกลงดังกล่าวดำเนินการใน 2 สาขา 6 แผนก 32 ตำแหน่งงาน ดังนี้</p>
                    </div>
                </div>
                <div class="border_tab">
                    <div class="tab_item">
                        <div class="tab_num">04</div><div class="tab_head">หากสนใจจะขอใบรับรองมาตรฐานบุคลากรด้านการท่องเที่ยวตามข้อตกลงร่วมว่าด้วยการยอมรับคุณสมบัติของบุคลากร
ด้านการท่องเที่ยวอาเซียน (MRA on TP) มีวิธีการอย่างไร</div>
                    </div>
                    <div class="tab_detail">
                        <p>ข้อตกลงร่วมว่าด้วยการยอมรับคุณสมบัติบุคลากรด้านการท่องเที่ยวอาเซียน (ASEAN Mutual Recognition Arrangement on Tourism Professionals: ASEAN MRA 
    on TP: MRA-TP) จัดทำขึ้นโดยความเห็นชอบของประเทศสมาชิกอาเซียนทั้ง 10 ประเทศ โดยมีวัตถุประสงค์เพื่ออำนวยความสะดวกในการเคลื่อนย้ายผู้ประกอบอาชีพด้านการท่องเที่ยวระหว่าง
    ประเทศสมาชิกอาเซียน เพื่อแลกเปลี่ยนข้อมูล และแนวทางปฏิบัติที่ดีที่สุด และเพื่อยกระดับสมรรถนะและศักยภาพของบุคลากรทางการท่องเที่ยวในประเทศสมาชิกให้อยู่ในระดับสากล 
    โดยตำแหน่งงานที่ดำเนินการส่งเสริมและพัฒนาบุคลากร ในอุตสาหกรรมท่องเที่ยวภายใต้ข้อตกลงดังกล่าว ไม่รวมถึงอาชีพมัคคุเทศก์ (Tour Guide) ซึ่งเป็นอาชีพสงวนสำหรับคนไทยเท่านั้น 
    ซึ่งในปัจจุบัน การพัฒนาบุคลากรในอุตสาหกรรมท่องเที่ยวภายใต้ข้อตกลงดังกล่าวดำเนินการใน 2 สาขา 6 แผนก 32 ตำแหน่งงาน ดังนี้</p>
                    </div>
                </div>
                <div class="border_tab">
                    <div class="tab_item">
                        <div class="tab_num">05</div><div class="tab_head">ประโยชน์ที่ผู้ที่ผ่านการประเมินสมรรถนะและได้รับใบรับรองมาตรฐานบุคลากรด้านการท่องเที่ยวตามข้อตกลงร่วมว่าด้วยการยอมรับ
คุณสมบัติของบุคลากรด้านการท่องเที่ยวอาเซียน (MRA on TP) มีอะไรบ้าง</div>
                    </div>
                    <div class="tab_detail">
                        <p>ข้อตกลงร่วมว่าด้วยการยอมรับคุณสมบัติบุคลากรด้านการท่องเที่ยวอาเซียน (ASEAN Mutual Recognition Arrangement on Tourism Professionals: ASEAN MRA 
    on TP: MRA-TP) จัดทำขึ้นโดยความเห็นชอบของประเทศสมาชิกอาเซียนทั้ง 10 ประเทศ โดยมีวัตถุประสงค์เพื่ออำนวยความสะดวกในการเคลื่อนย้ายผู้ประกอบอาชีพด้านการท่องเที่ยวระหว่าง
    ประเทศสมาชิกอาเซียน เพื่อแลกเปลี่ยนข้อมูล และแนวทางปฏิบัติที่ดีที่สุด และเพื่อยกระดับสมรรถนะและศักยภาพของบุคลากรทางการท่องเที่ยวในประเทศสมาชิกให้อยู่ในระดับสากล 
    โดยตำแหน่งงานที่ดำเนินการส่งเสริมและพัฒนาบุคลากร ในอุตสาหกรรมท่องเที่ยวภายใต้ข้อตกลงดังกล่าว ไม่รวมถึงอาชีพมัคคุเทศก์ (Tour Guide) ซึ่งเป็นอาชีพสงวนสำหรับคนไทยเท่านั้น 
    ซึ่งในปัจจุบัน การพัฒนาบุคลากรในอุตสาหกรรมท่องเที่ยวภายใต้ข้อตกลงดังกล่าวดำเนินการใน 2 สาขา 6 แผนก 32 ตำแหน่งงาน ดังนี้</p>
                    </div>
                </div>
                <div class="border_tab">
                    <div class="tab_item">
                        <div class="tab_num">06</div><div class="tab_head">กรมการท่องเที่ยวมีแนวทางในการพัฒนาบุคลากรในอุตสาหกรรมท่องเที่ยว 32 ตำแหน่งงานตามข้อตกลงร่วมว่าด้วยการยอมรับ
คุณสมบัติบุคลากรด้านการท่องเที่ยวอาเซียนอย่างไร</div>
                    </div>
                    <div class="tab_detail">
                        <p>ข้อตกลงร่วมว่าด้วยการยอมรับคุณสมบัติบุคลากรด้านการท่องเที่ยวอาเซียน (ASEAN Mutual Recognition Arrangement on Tourism Professionals: ASEAN MRA 
    on TP: MRA-TP) จัดทำขึ้นโดยความเห็นชอบของประเทศสมาชิกอาเซียนทั้ง 10 ประเทศ โดยมีวัตถุประสงค์เพื่ออำนวยความสะดวกในการเคลื่อนย้ายผู้ประกอบอาชีพด้านการท่องเที่ยวระหว่าง
    ประเทศสมาชิกอาเซียน เพื่อแลกเปลี่ยนข้อมูล และแนวทางปฏิบัติที่ดีที่สุด และเพื่อยกระดับสมรรถนะและศักยภาพของบุคลากรทางการท่องเที่ยวในประเทศสมาชิกให้อยู่ในระดับสากล 
    โดยตำแหน่งงานที่ดำเนินการส่งเสริมและพัฒนาบุคลากร ในอุตสาหกรรมท่องเที่ยวภายใต้ข้อตกลงดังกล่าว ไม่รวมถึงอาชีพมัคคุเทศก์ (Tour Guide) ซึ่งเป็นอาชีพสงวนสำหรับคนไทยเท่านั้น 
    ซึ่งในปัจจุบัน การพัฒนาบุคลากรในอุตสาหกรรมท่องเที่ยวภายใต้ข้อตกลงดังกล่าวดำเนินการใน 2 สาขา 6 แผนก 32 ตำแหน่งงาน ดังนี้</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row bg_related_content wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 head_related_content">
                <h1>RELATED CONTENT</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="owl-news owl-carousel owl-theme">
                    <div>
                        <figure class="detail_news_item"><a href="#"><img src="{{ ThemeService::path('assets/images/related01.jpg') }}"></a>
                            <figcaption>
                                <h4 class="dotmaster">การประชุมแนวทางการจัดระเบียน และแก้ไขปัญหา...</h4>
                                <p class="dotmaster">สนช. ได้ดำเนินการพัฒนางานวิจัยที่ได้รับ
การสนับสนุนจากหน่วยงานหลักของประเทศ 
สำนักงานคณะกรรมการ...</p>
                            </figcaption>
                            <a href="#" class="btnmore">{{__('read_more')}}</a>
                        </figure>
                    </div>
                    <div>
                        <figure class="detail_news_item"><a href="#"><img src="{{ ThemeService::path('assets/images/related02.jpg') }}"></a>
                            <figcaption>
                                <h4 class="dotmaster">การประชุมเพื่อพิจารณามาตรการ
และแนวทางรักษา...</h4>
                                <p class="dotmaster">เป็นการบูรณาการความร่วมมือของหน่วยงาน
สังกัดกระทรวงวิทยาศาสตร์และเทคโนโลยี 
เพื่อสนับสนุนการพัฒนา...</p>
                            </figcaption>
                            <a href="#" class="btnmore">{{__('read_more')}}</a>
                        </figure>
                    </div>
                    <div>
                        <figure class="detail_news_item"><a href="#"><img src="{{ ThemeService::path('assets/images/related03.jpg') }}"></a>
                            <figcaption>
                                <h4 class="dotmaster">การประชุมเพื่อพิจารณามาตรการ
และแนวทางรักษา...
</h4>
                                <p class="dotmaster">สนช. มุ่งสร้างความสามารถทางนวัตกรรม 
(Innovation Capability) ของนวัตกร ผู้ประกอบ
การนวัตกรรม ...</p>
                            </figcaption>
                            <a href="#" class="btnmore">{{__('read_more')}}</a>
                        </figure>
                    </div>
                    <div>
                        <figure class="detail_news_item"><a href="#"><img src="{{ ThemeService::path('assets/images/related04.jpg') }}"></a>
                            <figcaption>
                                <h4 class="dotmaster">การประชุมเพื่อพิจารณามาตรการ
และแนวทางรักษา...</h4>
                                <p class="dotmaster">สนช. มุ่งประยุกต์ใช้วิทยาศาสตร์ข้อมูล 
(Data Science) ในการดึงเอาความรู้ออก
จากข้อมูล วิเคราะห์...</p>
                            </figcaption>
                            <a href="#" class="btnmore">{{__('read_more')}}</a>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 
@push('scripts')
 <script src="js/toursim-personnel/form.js"></script>
@endpush