<?php
    require_once '../_theme/util.inc.php';
    chk_login();

    include_once "../_connection/db_base.php";

    $result_id_card = $mysqli->query("SELECT COUNT(*) check_id_card
        FROM site_user_id_card
        WHERE user_id = '".$_SESSION[SESSIONPREFIX.'puser_id']."'");
    $row_id_card = $result_id_card->fetch_assoc();

    if (0 == $row_id_card['check_id_card']) {
        echo "กรุณาแนบภาพถ่ายบัตรประจำตัวประชาชน";
        exit;
    }

    $site_url = $_POST['site_url'];
    $site_url = str_replace("_", "", $site_url);
    $site_name = $_POST['site_name'];
    $site_province = $_POST['site_province'];
    $site_amphur = $_POST['site_amphur'];
    $site_district = $_POST['site_district'];
    $site_house_no = $_POST['site_house_no'];
    $site_village_no = $_POST['site_village_no'];
    $site_muban = $_POST['site_muban'];
    $site_postal_code = $_POST['site_postal_code'];
    $site_telephone = $_POST['site_telephone'];
    $site_mobile = $_POST['site_mobile'];
    $site_user = $_SESSION[SESSIONPREFIX.'puser_id'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];

    $result = $mysqli->query("INSERT INTO
                site_detail (site_name, site_url, site_province, site_amphur, site_district, site_house_no, site_village_no, site_muban,
                            site_postal_code, site_telephone, site_mobile, create_user, lat, lng)
                VALUES ('$site_name', '$site_url', '$site_province', '$site_amphur', '$site_district',
                        '$site_house_no', '$site_village_no', '$site_muban', '$site_postal_code',
                        '$site_telephone', '$site_mobile', '$site_user', '$lat', '$lng')");

    $last_id_site = $mysqli->insert_id;

    /** Add menu main. */
    $result = $mysqli->query("INSERT INTO
                site_content (content_html)
                VALUES ('[center][color=#126a9d][size=5][font=Tahoma, sans-serif, Arial, Helvetica, Garuda][b][img]http://s.exaidea.com/upload2/1/20130710/ad74aed9ec4598611f66243abfca0078.jpg[/img][/b][/font][/size][/color][/center]



[color=#126a9d][size=5][font=Tahoma, sans-serif, Arial, Helvetica, Garuda][b]\"ล้างพิษตับ\" โดย ทีมงาน \"".$site_name."\"[/b][/font][/size][/color]

[color=#595959][size=2][font=Tahoma, sans-serif, Arial, Helvetica]        \" ยินดีต้อนรับ ... ผู้รักสุขภาพทุกท่าน ที่ต้องการ ล้างพิษตับ ด้วยวิธีธรรมชาติบำบัด[/font][/size][/color][color=#595959][size=2][font=Tahoma, sans-serif, Arial, Helvetica]กับกิจกรรมการฟื้นฟูสุขภาพ [/font][/size][/color][color=#595959][size=2][font=Tahoma, sans-serif, Arial, Helvetica]ทีมงาน".$site_name." จัดคอร์สล้างพิษตับนี้ขึ้นมาด้วยใจที่มุ่งหวังอยากจะให้ผู้ที่สนใจในเรื่องการล้างพิษตับ ได้มีสุขภาพที่ดี และได้รับความรู้ในการดูแลสุขภาพของตนโดยอาศัยวิธีธรรมชาติบำบัดเพื่อสามารถนำกลับไปปฎิบัติ ใช้ที่บ้านได้ ... โดยให้เสียค่าใช้จ่ายน้อยที่สุด แล้วพบกันที่ ".$site_name." นะค่ะ \"[/font][/size][/color]')");

    $last_id = $mysqli->insert_id;

    $result = $mysqli->query("INSERT INTO
                site_menu (menu_order, menu_name, display_menu, content_id, site_id)
                VALUES (1, 'หน้าหลัก', '0', $last_id, '$last_id_site')");

    /** Add menu about. */
    $result = $mysqli->query("INSERT INTO
                site_content (content_html)
                VALUES ('[left][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]        การจัด [/font][/size][/color][b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]คอร์สล้างพิษตับ[/font][/size][/color][/b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica] นิ่วในถุงน้ำดี นิ่วในท่อน้ำดีตับ และล้างลำไส้ ด้วยวิธีธรรมชาติบำบัดนั้น เป็นการเข้าค่ายเพื่อฟื้นฟูร่างกาย จากการเจ็บป่วยเรื้อรังโดยไม่ทราบสาเหตุ ซึ่ง [/font][/size][/color][u][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]ไม่ใช่การรักษาโรค แต่เป็นการเรียนรู้ที่จะเป็นหมอเพื่อรักษาตัวเอง[/font][/size][/color][/u][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica] ซึ่งเหมาะสำหรับทุกคนที่สุขภาพร่างกายยังพอแข็งแรง สามารถช่วยเหลือตัวเองได้ และมีความมุ่งมั่นที่จะีมีสุขภาพที่ดีต่อไป[/font][/size][/color][/left]

[left][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]โดย \"[/font][/size][/color][color=#126a9d][font=Tahoma, sans-serif, Arial, Helvetica, Garuda][b][size=2]".$site_name."[/size][/b][/font][/color][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]\"[/font][/size][/color][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica] ได้อาศัยองค์ความรู้จากที่ได้รับการถ่ายทอดมา จากโครงการสุขภาพองค์รวม 8 อ. ของ [/font][/size][/color][b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]อ.ขวัญดิน สิงห์คำ[/font][/size][/color][/b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica] และ [/font][/size][/color][b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]อ.แก่นฟ้า แสนเมือง[/font][/size][/color][/b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica] ผู้ริเริ่ม \"[/font][/size][/color][b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]หลักสูตร ล้างพิษตับ[/font][/size][/color][/b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]\" ซึ่ง[/font][/size][/color][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]ท่านได้ค้นคว้า วิจัย พัฒนาสูตร ทดลองกับทั้งตัวเองและจากประสบการณ์ดูแลสุขภาพให้กับชาวชุมชนสันติอโศก แล้วได้นำวิชาความรู้นั้นมาถ่ายทอด เผยแพร่ ทำให้ผู้เข้ารับการอบรมได้รับประโยชน์เป็นจำนวนมาก [/font][/size][/color][/left]
[left]
[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]บ้านสุขภาพล้างพิษตับ \"[/font][/size][/color][b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][color=#274e13]".$site_name."[/color][/font][/size][/color][/b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]\" จึงเกิดขึ้นด้วยคำแนะนำจากผู้เห็นประโยชน์จากการล้างพิษตับ และหวังอยากให้คนอื่นๆ หันมาดูแลตนเองด้วยการเรียนรู้ศาสตร์แห่งธรรมชาติบำบัดที่ไม่ต้องพึ่งพายาจากสถานพยาบาลจนต้องทานยาเป็นอาหาร แต่จะมาใส่ใจการกินอยู่เลือกอาหารเป็นยาแทน โดยจะใช้ระยะเวลา 3 วัน 2 คืน (ล้างพิษตับ แบบสั้น) ในการเข้าร่วมกิจกรรม[/font][/size][/color][/left]
')");

    $last_id = $mysqli->insert_id;

    $result = $mysqli->query("INSERT INTO
                site_menu (menu_order, menu_name, display_menu, content_id, site_id)
                VALUES (2,'เกี่ยวกับเรา', '0', $last_id, '$last_id_site')");

    /** Add menu course. */
    $result = $mysqli->query("INSERT INTO
                site_content (content_html)
                VALUES ('เพิ่มเนื้อหาเว็บไซต์')");

    $last_id = $mysqli->insert_id;

    $result = $mysqli->query("INSERT INTO
                site_menu (menu_order, menu_name, display_menu, content_id, site_id)
                VALUES (3, 'เกี่ยวกับการล้างพิษ', '0', $last_id, '$last_id_site')");
    $last_menu_main = $mysqli->insert_id;

    /*$result = $mysqli->query("INSERT INTO
                site_content (content_html)
                VALUES ('[color=#000000][font=Tahoma, sans-serif, Arial, Helvetica][color=#660000]ปฎิทินกิจกรรมของบ้านสุขภาพล้างพิษตับ ปี 2558[/color][/font][/color]

[b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][color=red][อัพเดท ณ วันที่ 29 เมษายน 2558][/color][/font][/size][/color][/b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica] [/font][/size][/color]

[b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][u]เดือน พฤษภาคม 2558[/u]
...
 [/font][/size][/color][/b]
[b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][u]เดือน มิถุนายน 2558[/u]
...[/font][/size][/color][/b]')");

    $last_id = $mysqli->insert_id;

    $result = $mysqli->query("INSERT INTO
                site_submenu (menu_order, menu_name, status_menu, main_menu_id, content_id, site_id)
                VALUES (1, 'ปฎิทินกิจกรรมล้างพิษตับ', '0', '$last_menu_main', $last_id, '$last_id_site')");*/

    /** Add sub menu. */
    $result = $mysqli->query("INSERT INTO
                site_content (content_html)
                VALUES ('[color=#000000][font=Tahoma, sans-serif, Arial, Helvetica][color=#660000]การเข้าคอร์สล้างพิษตับ (เข้าค่ายล้างพิษตับ)[/color][/font][/color]

[color=#660000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][color=black]สิ่งแรกและสิ่งที่สำคัญที่สุดสำหรับผู้ไม่เคยผ่านการเข้าคอร์สมาก่อนเลย คือ [/color][/font][/size][/color]
[color=#660000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][color=black]- [b]เราควรรู้ก่อนว่า การล้างพิษตับนั้นคืออะไร? [/b][/color][/font][/size][/color]
[color=#660000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][color=black]- [b]แล้วการที่มาเข้าคอร์สล้างพิษตับนั้นเป็นอย่างไร ?[/b][/color][/font][/size][/color]

[color=#660000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][color=black][color=blue][color=#274e13][b]การล้างพิษตับ[/b][/color] [b][color=#274e13]ด้วยวิธีธรรมชาติบำบัด[/color][/b] ไม่ใช่การรักษาโรค แต่เป็นกระบวนการกรรมวิธีในการขับสารพิษที่สะสมอยู่ภายในร่างกาย (ในตับ ในถุงน้ำดี ในท่อน้ำดีตับ ในลำไส้) นั้นออกมา[/color] ซึ่งพิษที่สะสมอยู่ในร่างกายของเรานี้เอง ที่มักจะเป็นสาเหตุหลักที่ทำให้เราเกิดโรคภัยไข้เจ็บต่างๆ ซึ่งถือเป็นการดูแลสุขภาพของเราทางหนึ่ง ให้กลับมาทำงานได้อย่างมีประสิทธิภาพดังเดิมหรือดีเท่าที่ควรจะเป็น [/color][/font][/size][/color]

[color=#660000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][color=black]ถ้าหากจะเปรียบเทียบโดยอุปมา ให้เข้าใจได้ง่ายขึ้น เราอาจจะพอสามารถเปรียบเทียบ ตับของเราได้กับแอร์คอนดิชั่นเนอร์ เมื่อเราใช้แอร์ไปนานๆสิ่งสกปรกฝุ่นละอองก็จะเข้าไปอุดตัน ทำให้แอร์นั้นเย็นน้อยลงและบางทีก็ถึงขั้นทำให้แอร์เป็นน้ำแข็งซึ่งจะทำให้กินไฟมากขึ้น ดังนั้นเราก็จำต้องเรียกช่างมาล้างแอร์ (อาจจะปีละ 1-2 ครั้ง) การล้างแอร์นั้นไม่ใช่การซ่อมแอร์ เราแค่ล้างสิ่งสกปรกออกไปแค่นั้น และโดยปกติแอร์ก็จะกลับมาเย็นเหมือนเดิมหลังจากได้รับการล้างแล้ว (ยกเว้นน้ำยาแอร์จะหมด หรือ รั่ว หรือ แอร์เสีย) ... [b]การล้างพิษตับ[/b] ก็เปรียบเทียบได้เช่นเดียวกับการล้างแอร์นั่นเอง ในเชิงอุปมา[/color][/font][/size][/color]

[color=#000000][font=Tahoma, sans-serif, Arial, Helvetica][color=#660000]หลักและวิธีปฎิบัติในการมาเข้าคอร์สล้างพิษตับ [/color][/font][/color]

[color=#660000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][color=black]เพื่อให้เข้าใจง่ายๆ การมาเข้าค่ายล้างพิษตับนั้น สรุปภาพรวมโดยสังเขปแล้ว ก็คือ [/color][/font][/size][/color]
[color=#660000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][color=black]1. การอดอาหาร [/color][/font][/size][/color]
[color=#660000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][color=black]2. ดิ่มน้ำสมุนไพรและสารที่ช่วยขับพิษต่างๆ ([/color][/font][/size][/color][color=#660000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][color=black]ดีท็อกซ์) [/color][/font][/size][/color]
[color=#660000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][color=black]3. ทีมงานจะสอนและอธิบายวิธีการต่างๆให้ความรู้ในการล้างพิษตับและการทำดีท็อกซ์ [/color][/font][/size][/color]
[color=#660000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][color=black]4. อบรบรับฟังการบรรยายเกี่ยวกับการดูแลสุขภาพจากวิทยากรผู้ทรงคุณวุฒิ เพื่อเพิ่มความรู้ให้กับตนเองให้สามารถนำกลับไปปฎิบัติใช้ที่บ้านได้ ในการดำเนินชีวิตประจำวัน[/color][/font][/size][/color]
[color=#660000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][color=black]5. ถือว่าเป็นการมาพักผ่อน สูดอากาศบริสุทธิ์ บรรยากาศร่มรื่น สัมผัสกับธรรมชาติ[/color][/font][/size][/color]
[color=#660000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][color=black] [/color] [/font][/size][/color]
[color=#000000][font=Tahoma, sans-serif, Arial, Helvetica][color=#660000]ก่อนมาเข้าค่ายล้างพิษตับ[/color][/font][/color]

[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]เพื่อ ให้ร่างกายลดความเป็นกรด พร้อมจะขับพิษมากที่สุด ก่อน 2 - 3 วัน ควรงดเว้นชา กาแฟ ชอกโกแลต น้ำอัดลม เหล้า บุหรี่ นมจากสัตว์ อาหารที่ต้องผัดน้ำมัน ของทอด อาหารรสจัด เนื้อสัตว์ และควรรับประทานอาหารที่ย่อยง่าย (ผักลวก น้ำพริกมะนาว ต้มจืดเต้าหู้อ่อน แอปเปิลเขียว ส้มทุกชนิด ) นอนพักผ่อนให้เพียงพอ[/font][/size][/color]

[color=#000000][font=Tahoma, sans-serif, Arial, Helvetica][color=#660000]สิ่งที่จำเป็นต้องเตรียมมา [/color][/font][/color]

[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]เสื้อผ้าสำหรับผลัดเปลี่ยน สวมใส่สบาย สบู่ แปรงสีฟัน ยาสีฟัน ผ้าเช็ดตัว รองเท้าแตะ และ เสื้อกันหนาว (สำหรับฤดูหนาว อากาศจะเย็นมากโดยเฉพาะที่เขาใหญ่)[/font][/size][/color]

[color=#000000][font=Tahoma, sans-serif, Arial, Helvetica][color=#660000]แนะนำคุณสมบัติของผู้ที่จะมาเข้าค่ายล้างพิษตับ[/color][/font][/color]

[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- ผู้เข้าคอร์สล้างพิษต้องมีสุขภาพที่แข็งแรง สามารถที่จะอดอาหารได้[/font][/size][/color]

[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- สามารถช่วยเหลือตัวเองได้ เพราะไม่ใช่สถานพยาบาลรักษาคนป่วยที่ต้องมีผู้ดูแลชำนาญการ [/font][/size][/color]

[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- ไม่เป็นความดันสูงมากเกินไป หรือเบาหวานที่ฉีดอินซูลินแล้ว หรือโรคหัวใจขั้นร้ายแรง หรือมะเร็งขั้นสุดท้าย หรือฟอกไตแล้ว ไม่ควรเข้าคอร์สเพราะจะเป็นอันตรายได้[/font][/size][/color][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica] [/font][/size][/color]

[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- [/font][/size][/color][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]ผู้สูงอายุที่ช่วยเหลือตนเองไม่ได้ [/font][/size][/color][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]สตรีมีครรภ์ เด็กอายุตำว่า 17 ปี หรือผู้มีอาการไม่สบายกระทันหัน เช่น ปวดหัว ตัวร้อน เป็นไข้  ยังไม่ควรเข้าคอร์สล้างพิษ[/font][/size][/color]

[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- ท่านที่มีโรคประจำตัวต้องทานยาประจำ...ควรพกยาประจำตัวมาด้วย[/font][/size][/color]

[u][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][b]สรุปอาการที่ไม่ควรเข้าคอร์สล้างพิษตับ[/b][/font][/size][/color][/u]
[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- ความดันสูงมากเกินไป[/font][/size][/color]
[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- เบาหวานที่ฉีดอินซูลินแล้ว[/font][/size][/color]
[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- โรคหัวใจขั้นร้ายแรง[/font][/size][/color]
[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- มะเร็งขั้นสุดท้าย[/font][/size][/color]
[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- ฟอกไตแล้ว[/font][/size][/color]
[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- โรคติดต่อร้ายแรง[/font][/size][/color]
[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- ผู้สูงอายุที่ช่วยเหลือตนเองไม่ได้[/font][/size][/color]
[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- สตรีมีครรภ์[/font][/size][/color]
[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- เด็กอายุต่ำกว่า 17 ปี [/font][/size][/color]

[b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][color=#cc0000]หากท่านไม่มั่นใจ ... กรุณาติดต่อสอบถามข้อมูลเพิ่มเติม กับทางทีมงาน ก่อนจะตัดสินใจมาเข้าร่วมคอร์สล้างพิษตับ ... โปรดกรุณาอย่าปกปิดอาการไม่สบายของท่าน แก่ผู้ดูแลคอร์ส เพื่อประโยชน์ของตัวท่านเอง[/color][/font][/size][/color][/b]

[color=#000000][font=Tahoma, sans-serif, Arial, Helvetica][color=#660000]กำหนดการคอร์สล้างพิษ (สูตรสั้น)[/color][/font][/color]

[b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][color=#274e13]ณ ".$site_name." [ระยะเวลา 3 วัน 2 คืน][/color][/font][/size][/color][/b]

[b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][u]วันที่ 1[/u][/font][/size][/color][/b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]     [/font][/size][/color]

[color=blue][size=2][font=Tahoma, sans-serif, Arial, Helvetica]--- ที่บ้าน --- [/font][/size][/color]
[color=blue][size=2][font=Tahoma, sans-serif, Arial, Helvetica]05.00 - ตื่นนอน ทำดีท็อกซ์สวนระบายล้างลำไส้ (หรือเตรียมน้ำอุ่น 1 ลิตร ผสมมะนาว 1-2 ลูก ดื่มให้หมดครั้งเดียว เพื่อกระตุ้นการขับถ่าย และล้างพิษที่ตับ) หรือดื่มน้ำมันมะพร้าวสกัดเย็น 1 ช้อนโต๊ะ และดื่มน้ำอุ่นตามให้มาก เพื่อช่วยขับระบายพิษ[/font][/size][/color]
[color=blue][size=2][font=Tahoma, sans-serif, Arial, Helvetica]12.00 - หลังเที่ยง งดอาหารขบเคี้ยวทุกชนิด ดื่มน้ำผลไม้หรือน้ำแอปเปิลแยกกาก (ขนาด 1 ลิตร อาจดื่มมากว่าหนึ่งกล่องได้) สลับกับน้ำเปล่า[/font][/size][/color]

[color=blue][size=2][font=Tahoma, sans-serif, Arial, Helvetica]--- และเตรียมตัวเดินทางไปล้างพิษตับ ---[/font][/size][/color]
[color=blue][size=2][font=Tahoma, sans-serif, Arial, Helvetica]15.00 - ลงทะเบียน / กรอกข้อมูลสุขภาพ / วัดความดัน / ชั่งน้ำหนัก
17.00 - แนะนำวิธีดีท็อกซ์ (สวนล้างระบายพิษจากลำไส้) / เข้าที่พัก / ทำดีท็อกซ์ (ครั้งที่ 1)
19.30 - แนะวิธีปฏิบัติตัวระหว่างเข้าคอร์ส / พักผ่อนตามอัธยาศัย นอนไม่เกิน 21.00 น.[/font][/size][/color]

[b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][u]วันที่ 2[/u][/font][/size][/color][/b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]   [/font][/size][/color]

[color=blue][size=2][font=Tahoma, sans-serif, Arial, Helvetica]05.00 - ตื่นนอน / ทำดีท็อกซ์ (สวนล้างระบายพิษจากลำไส้ ครั้งที่ 2)
06.00 - อมน้ำมันมะพร้าว 1 ช.ต. ( 10-15 นาที) บ้วนทิ้ง ห้ามกลืนลงท้อง / ออกกำลังกาย 
07.00 - ดื่มน้ำน้ำสมุนไพรชาข้าวเปลือกงอก /แช่เท้า / พอกหน้า ด้วยสมุนไพร
08.30 - งดดื่มน้ำทุกชนิด หากกระหายให้ดื่มได้เล็กน้อย
09.00 - ดื่มสมุนไพร (ลิดท็อกซ์) ล้างลำไส้
09.30 - ดื่มน้ำสมุนไพรมะขาม /น้ำชามะละกอ /น้ำด่าง
----- ฟังบรรยาย-ชมวิดีทัศน์ เกี่ยวกับสุขภาพ ----- 
11.30 - งดดื่มน้ำทุกชนิด หากกระหายให้ดื่มได้เล็กน้อย
12.00 - ดื่มสมุนไพร (ลิดท็อกซ์) ล้างลำไส้ /พักผ่อนตามอัธยาศรัย
12.30 - ดื่มน้ำสมุนไพรมะขาม/น้ำชามะละกอ /น้ำด่าง
15.00 - ดื่มน้ำผลไม้ /พักผ่อนตามอัธยาศัย
17.00 - ทำดีท็อกซ์ (สวนล้างระบายพิษจากลำไส้ ครั้งที่ 3)
18.00 - ดื่มน้ำดีเกลือครั้งที่ 1 (งดดื่มน้ำ 30 นาที)
----- ฟังบรรยาย-ชมวิดีทัศน์ เกี่ยวกับสุขภาพ ----- 
20.00 - ดื่มน้ำดีเกลือครั้งที่ 2 (งดดื่มน้ำ 30 นาที)
21.30 - แนะนำวิธีดื่มน้ำมันมะกอก /การเก็บพิษจากตับ
22.00 - ดื่มน้ำมันมะกอก+น้ำมะนาว (เขย่าให้เข้ากันแล้วดื่มทันที)
22.15 - เข้านอนทันทีโดยนอนตะแคงขวา หรือนอนหงาย ใช้ถุงน้ำร้อนวางที่ท้อง 
(หากอยากขับถ่ายลุกไปทำธุระแล้วรีบกลับมานอน)
----- พิษที่ออกจากตับและของเสียอื่น ๆ จากตัวจะเริ่มออกมาประมาณ 02.00 น. -----[/font][/size][/color]

[b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica][u]วันที่ 3[/u][/font][/size][/color][/b]

[color=blue][size=2][font=Tahoma, sans-serif, Arial, Helvetica]05.00 - ตื่นนอน ทำกิจวัตรส่วนตัว ทำดีท็อกซ์ (ครั้งที่ 4) ใส่ถังเก็บไว้
07.00 - อมน้ำมันมะพร้าว 1 ช.ต. ( 10-15 นาที) บ้วนทิ้ง ห้ามกลืนลงท้อง / ออกกำลังกาย
- ดื่มน้ำสมุนไพรอื่นตามที่จัดให้
- แลกเปลี่ยนประสบการณ์ / ถ่ายรูปร่วมกัน
10.00 - สวนล้างลำไส้ (ครั้งที่ 5) ลงในถังเดิม นำไปตรวจ
11.00 - รับประทานอาหารมังสวิรัติ [/font][/size][/color]
[color=blue][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- เดินทางกลับ โดยสวัสดิภาพ[/font][/size][/color]

[color=#000000][font=Tahoma, sans-serif, Arial, Helvetica][color=#660000]วิธีปฎิบัติหลังจากมาเข้าค่ายล้างพิษตับแล้ว[/color][/font][/color]

[b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]ให้รับประทานอาหารย่อยง่ายอีก 3 วัน และสวนล้างลำไส้เช้า-เย็น 7 วันต่อเนื่อง [/font][/size][/color][/b]
[b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]เพราะพิษที่ขับออกจากตับค้างอยู่ในลำไส้ อาจทำให้ไม่สบายหรือมีตุ่มคันตามผิวหนัง[/font][/size][/color][/b]

[color=#000000][font=Tahoma, sans-serif, Arial, Helvetica][color=#660000]คำถามที่พบบ่อย[/color][/font][/color]

[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- [/font][/size][/color][b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]การล้างพิษสูตรสั้น คืออะไร?[/font][/size][/color][/b]
[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]ตอบ : การล้างพิษสูตรสั้น คือ การล้างพิษที่ตับและถุงน้ำดี ใช้เวลาเพียงวันเดียว[/font][/size][/color]

[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- [/font][/size][/color][b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]แล้วจะได้ผลเหมือนเข้าคอร์สยาวไหม?[/font][/size][/color][/b]
[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]ตอบ : ได้ผลเหมือนคอร์สยาว คือได้ล้างนิ่วจากถุงน้ำดี ไขมันจากตับและนิ่วจากท่อน้ำดีตับ โดยให้ท่านเตรียมตัวด้านการดีท็อกซ์มาจากที่บ้านอย่างน้อยหนึ่งวันหรือมากกว่านั้นก็ได้[/font][/size][/color]

[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]- [/font][/size][/color][b][color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]ขอคำแนะนำเกี่ยวกับการดีท็อกซ์[/font][/size][/color][/b]
[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]ตอบ : การดีท็อกซ์ทำได้ 2 วิธี[/font][/size][/color]

[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]1 งดอาหารขบเคี้ยวทุกชนิด ดื่มเฉพาะน้ำผลไม้อย่างเดียว เช่น น้ำแอปเปิ้ลชนิดแยกกาก อย่างน้อย หนึ่งลิตรต่อวัน ดื่มสลับกับน้ำเปล่าตลอดวัน (อาจหาซื้อน้ำแอปเปิ้ลแยกกากตามห้างทั่วไป)[/font][/size][/color]

[color=#000000][size=2][font=Tahoma, sans-serif, Arial, Helvetica]2 นอกจากทำตามข้อ 1 แล้ว เพิ่มการสวนทวารด้วยน้ำอุ่น หรือน้ำกาแฟ เช้า-เย็น[/font][/size][/color]')");

    $last_id = $mysqli->insert_id;

    $result = $mysqli->query("INSERT INTO
                site_submenu (menu_order, menu_name, status_menu, main_menu_id, content_id, site_id)
                VALUES (2, 'การเตรียมตัวมาเข้าค่ายล้างพิษตับ', '0', '$last_menu_main', $last_id, '$last_id_site')");

    /** Add sub menu */
    $result = $mysqli->query("INSERT INTO
                site_content (content_html)
                VALUES ('[center][img]http://s.exaidea.com/upload2/1/20130710/ad74aed9ec4598611f66243abfca0078.jpg[/img][/center]

[center][img]http://www.manager.co.th/asp-bin/Image.aspx?ID=2653769[/img][/center]

[center][img]http://www.wellnesscity.co.th/images/program-liver-flush-1.jpg[/img][/center]
')");

    $last_id = $mysqli->insert_id;

    $result = $mysqli->query("INSERT INTO
                site_submenu (menu_order, menu_name, status_menu, main_menu_id, content_id, site_id)
                VALUES (3, 'รวมภาพกิจกรรมล้างพิษตับ', '0', '$last_menu_main', $last_id, '$last_id_site')");

    /** Add menu contact */
    /** Add menu about. */
    $result = $mysqli->query("INSERT INTO
                site_content (content_html)
                VALUES ('[center][size=5][font=Tahoma, sans-serif, Arial, Helvetica][color=#000000]ช่องทางการติดต่อ \"[/color][b][color=#ff3366]".$site_name."[/color][/b][color=#000000]\"[/color][/font][/size][/center]

[center][b][color=#000000][font=Tahoma, sans-serif, Arial, Helvetica][color=#660000][size=4]โทรศัพท์ : ".$site_telephone."[/size][/color][/font][/color][/b][/center]

[center][size=4][color=#000000][font=Tahoma, sans-serif, Arial, Helvetica]- เวลาทำการ [/font][/color][b][color=#000000][font=Tahoma, sans-serif, Arial, Helvetica]08.30 - 18.00 น.[/font][/color][/b][color=#000000][font=Tahoma, sans-serif, Arial, Helvetica] (ทุกวัน..ไม่มีวันหยุด) [/font][/color][/size][/center]
')");

    $last_id = $mysqli->insert_id;

    $result = $mysqli->query("INSERT INTO
                site_menu (menu_order, menu_name, display_menu, content_id, site_id)
                VALUES (4, 'ติดต่อเรา', '0', $last_id, '$last_id_site')");
?>

