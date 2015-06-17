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
                VALUES ('&lt;p style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;color:#3399ff;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;font-size: 36px;&quot;&gt;แหล่งรวมพลคนรักษ์สุขภาพองค์รวม&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;

&lt;p style=&quot;text-align: center;&quot;&gt;&lt;br /&gt;
&lt;strong&gt;&lt;span style=&quot;font-size:28px;&quot;&gt;&lt;span style=&quot;color: rgb(0, 102, 204);&quot;&gt;รักษ์กาย ใจ และจิตวิญญาณ&lt;/span&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;

&lt;p style=&quot;text-align: center;&quot;&gt;&amp;nbsp;&lt;/p&gt;

&lt;p style=&quot;text-align: center;&quot;&gt;&lt;iframe allowfullscreen=&quot;&quot; frameborder=&quot;0&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/PvNB79bq8SE&quot; width=&quot;420&quot;&gt;&lt;/iframe&gt;&lt;/p&gt;

&lt;p&gt;&amp;nbsp;&lt;/p&gt;

&lt;p&gt;&lt;strong&gt;&lt;span style=&quot;font-size:22px;&quot;&gt;ขับพิษด้วยการล้างพิษตับ&amp;nbsp; (Liver flushing)&lt;/span&gt;&lt;/strong&gt;&lt;br /&gt;
&lt;span style=&quot;font-size:14px;&quot;&gt;โดย ทีมงาน &amp;quot;".$site_name."&amp;quot;&lt;/span&gt;&lt;/p&gt;

&lt;p&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &amp;quot; ยินดีต้อนรับ ... ผู้รักสุขภาพทุกท่าน ที่ต้องการ ล้างพิษตับ ด้วยวิธีธรรมชาติบำบัดกับกิจกรรมการฟื้นฟูสุขภาพ ทีมงาน".$site_name." จัดคอร์สล้างพิษตับนี้ขึ้นมาด้วยใจที่มุ่งหวังอยากจะให้ผู้ที่สนใจในเรื่องการล้างพิษตับ ได้มีสุขภาพที่ดี และได้รับความรู้ในการดูแลสุขภาพของตนโดยอาศัยวิธีธรรมชาติบำบัดเพื่อสามารถนำกลับไปปฎิบัติ ใช้ที่บ้านได้ ... โดยให้เสียค่าใช้จ่ายน้อยที่สุด แล้วพบกันที่ ".$site_name." นะค่ะ &amp;quot;&lt;/span&gt;&lt;/p&gt;
')");

    $last_id = $mysqli->insert_id;

    $result = $mysqli->query("INSERT INTO
                site_menu (menu_order, menu_name, display_menu, content_id, site_id)
                VALUES (1, 'หน้าหลัก', '0', $last_id, '$last_id_site')");

    /** Add menu about. */
    $result = $mysqli->query("INSERT INTO
                site_content (content_html)
                VALUES ('&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;span style=&quot;font-size:14px;&quot;&gt;การจัดคอร์สล้างพิษตับ นิ่วในถุงน้ำดี นิ่วในท่อน้ำดีตับ และล้างลำไส้ ด้วยวิธีธรรมชาติบำบัดนั้น เป็นการเข้าค่ายเพื่อฟื้นฟูร่างกาย จากการเจ็บป่วยเรื้อรังโดยไม่ทราบสาเหตุ ซึ่ง ไม่ใช่การรักษาโรค แต่เป็นการเรียนรู้ที่จะเป็นหมอเพื่อรักษาตัวเอง ซึ่งเหมาะสำหรับทุกคนที่สุขภาพร่างกายยังพอแข็งแรง สามารถช่วยเหลือตัวเองได้ และมีความมุ่งมั่นที่จะีมีสุขภาพที่ดีต่อไป&lt;/span&gt;&lt;/p&gt;

&lt;p&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;โดย &lt;span style=&quot;color: rgb(255, 140, 0);&quot;&gt;&amp;quot;".$site_name."&amp;quot;&lt;/span&gt; ได้อาศัยองค์ความรู้จากที่ได้รับการถ่ายทอดมา จากโครงการสุขภาพองค์รวม 8 อ. ของ อ.ขวัญดิน สิงห์คำ และ อ.แก่นฟ้า แสนเมือง ผู้ริเริ่ม &amp;quot;หลักสูตร ล้างพิษตับ&amp;quot; ซึ่งท่านได้ค้นคว้า วิจัย พัฒนาสูตร ทดลองกับทั้งตัวเองและจากประสบการณ์ดูแลสุขภาพให้กับชาวชุมชนสันติอโศก แล้วได้นำวิชาความรู้นั้นมาถ่ายทอด เผยแพร่ ทำให้ผู้เข้ารับการอบรมได้รับประโยชน์เป็นจำนวนมาก&lt;/span&gt;&lt;/p&gt;

&lt;p&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;บ้านสุขภาพล้างพิษตับ &lt;span style=&quot;color: rgb(255, 165, 0);&quot;&gt;&amp;quot;".$site_name."&amp;quot;&lt;/span&gt; จึงเกิดขึ้นด้วยคำแนะนำจากผู้เห็นประโยชน์จากการล้างพิษตับ และหวังอยากให้คนอื่นๆ หันมาดูแลตนเองด้วยการเรียนรู้ศาสตร์แห่งธรรมชาติบำบัดที่ไม่ต้องพึ่งพายาจากสถานพยาบาลจนต้องทานยาเป็นอาหาร แต่จะมาใส่ใจการกินอยู่เลือกอาหารเป็นยาแทน โดยจะใช้ระยะเวลา 3 วัน 2 คืน (ล้างพิษตับ แบบสั้น) ในการเข้าร่วมกิจกรรม&lt;/span&gt;&lt;/p&gt;
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

    /** Add sub menu. */
    $result = $mysqli->query("INSERT INTO
                site_content (content_html)
                VALUES ('&lt;div class=&quot;row marketing&quot; id=&quot;show_content&quot;&gt;
&lt;div&gt;&lt;span style=&quot;font-size:22px;&quot;&gt;&lt;strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;การเข้าคอร์สล้างพิษตับ (เข้าค่ายล้างพิษตับ)&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;black&quot;&gt;สิ่งแรกและสิ่งที่สำคัญที่สุดสำหรับผู้ไม่เคยผ่านการเข้าคอร์สมาก่อนเลย คือ&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;black&quot;&gt;-&amp;nbsp;&lt;strong&gt;เราควรรู้ก่อนว่า การล้างพิษตับนั้นคืออะไร?&amp;nbsp;&lt;/strong&gt;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;black&quot;&gt;-&amp;nbsp;&lt;strong&gt;แล้วการที่มาเข้าคอร์สล้างพิษตับนั้นเป็นอย่างไร ?&lt;/strong&gt;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;black&quot;&gt;&lt;font color=&quot;blue&quot;&gt;&lt;font color=&quot;#274e13&quot;&gt;&lt;strong&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; การล้างพิษตับ&lt;/strong&gt;&lt;/font&gt;&amp;nbsp;&lt;strong&gt;&lt;font color=&quot;#274e13&quot;&gt;ด้วยวิธีธรรมชาติบำบัด&lt;/font&gt;&lt;/strong&gt;&amp;nbsp;ไม่ ใช่การรักษาโรค แต่เป็นกระบวนการกรรมวิธีในการขับสารพิษที่สะสมอยู่ภายในร่างกาย (ในตับ ในถุงน้ำดี ในท่อน้ำดีตับ ในลำไส้) นั้นออกมา&lt;/font&gt;&amp;nbsp;ซึ่งพิษที่สะสมอยู่ใน ร่างกายของเรานี้เอง ที่มักจะเป็นสาเหตุหลักที่ทำให้เราเกิดโรคภัยไข้เจ็บต่างๆ ซึ่งถือเป็นการดูแลสุขภาพของเราทางหนึ่ง ให้กลับมาทำงานได้อย่างมีประสิทธิภาพดังเดิมหรือดีเท่าที่ควรจะเป็น&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;black&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; ถ้า หากจะเปรียบเทียบโดยอุปมา ให้เข้าใจได้ง่ายขึ้น เราอาจจะพอสามารถเปรียบเทียบ ตับของเราได้กับแอร์คอนดิชั่นเนอร์ เมื่อเราใช้แอร์ไปนานๆสิ่งสกปรกฝุ่นละอองก็จะเข้าไปอุดตัน ทำให้แอร์นั้นเย็นน้อยลงและบางทีก็ถึงขั้นทำให้แอร์เป็นน้ำแข็งซึ่งจะทำให้ กินไฟมากขึ้น ดังนั้นเราก็จำต้องเรียกช่างมาล้างแอร์ (อาจจะปีละ 1-2 ครั้ง) การล้างแอร์นั้นไม่ใช่การซ่อมแอร์ เราแค่ล้างสิ่งสกปรกออกไปแค่นั้น และโดยปกติแอร์ก็จะกลับมาเย็นเหมือนเดิมหลังจากได้รับการล้างแล้ว (ยกเว้นน้ำยาแอร์จะหมด หรือ รั่ว หรือ แอร์เสีย) ...&amp;nbsp;&lt;strong&gt;การล้างพิษตับ&lt;/strong&gt;&amp;nbsp;ก็เปรียบเทียบได้เช่นเดียวกับการล้างแอร์นั่นเอง ในเชิงอุปมา&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:22px;&quot;&gt;&lt;strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;หลักและวิธีปฎิบัติในการมาเข้าคอร์สล้างพิษตับ&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;black&quot;&gt;เพื่อให้เข้าใจง่ายๆ การมาเข้าค่ายล้างพิษตับนั้น สรุปภาพรวมโดยสังเขปแล้ว ก็คือ&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;black&quot;&gt;1. การอดอาหาร&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;black&quot;&gt;2. ดิ่มน้ำสมุนไพรและสารที่ช่วยขับพิษต่างๆ (&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#660000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;black&quot;&gt;ดีท็อกซ์)&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;black&quot;&gt;3. ทีมงานจะสอนและอธิบายวิธีการต่างๆให้ความรู้ในการล้างพิษตับและการทำดีท็อกซ์&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;black&quot;&gt;4. อบรบรับฟังการบรรยายเกี่ยวกับการดูแลสุขภาพจากวิทยากรผู้ทรงคุณวุฒิ เพื่อเพิ่มความรู้ให้กับตนเองให้สามารถนำกลับไปปฎิบัติใช้ที่บ้านได้ ในการดำเนินชีวิตประจำวัน&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;black&quot;&gt;5. ถือว่าเป็นการมาพักผ่อน สูดอากาศบริสุทธิ์ บรรยากาศร่มรื่น สัมผัสกับธรรมชาติ&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:22px;&quot;&gt;&lt;strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;ก่อนมาเข้าค่ายล้างพิษตับ&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; เพื่อ ให้ร่างกายลดความเป็นกรด พร้อมจะขับพิษมากที่สุด ก่อน 2 - 3 วัน ควรงดเว้นชา กาแฟ ชอกโกแลต น้ำอัดลม เหล้า บุหรี่ นมจากสัตว์ อาหารที่ต้องผัดน้ำมัน ของทอด อาหารรสจัด เนื้อสัตว์ และควรรับประทานอาหารที่ย่อยง่าย (ผักลวก น้ำพริกมะนาว ต้มจืดเต้าหู้อ่อน แอปเปิลเขียว ส้มทุกชนิด ) นอนพักผ่อนให้เพียงพอ&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;strong&gt;&lt;span style=&quot;font-size:22px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;สิ่งที่จำเป็นต้องเตรียมมา&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; เสื้อ ผ้าสำหรับผลัดเปลี่ยน สวมใส่สบาย สบู่ แปรงสีฟัน ยาสีฟัน ผ้าเช็ดตัว รองเท้าแตะ และ เสื้อกันหนาว (สำหรับฤดูหนาว อากาศจะเย็นมากโดยเฉพาะที่เขาใหญ่)&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;strong&gt;&lt;span style=&quot;font-size:22px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;แนะนำคุณสมบัติของผู้ที่จะมาเข้าค่ายล้างพิษตับ&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;- ผู้เข้าคอร์สล้างพิษต้องมีสุขภาพที่แข็งแรง สามารถที่จะอดอาหารได้&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;- สามารถช่วยเหลือตัวเองได้ เพราะไม่ใช่สถานพยาบาลรักษาคนป่วยที่ต้องมีผู้ดูแลชำนาญการ&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;- ไม่เป็นความดันสูงมากเกินไป หรือเบาหวานที่ฉีดอินซูลินแล้ว หรือโรคหัวใจขั้นร้ายแรง หรือมะเร็งขั้นสุดท้าย หรือฟอกไตแล้ว ไม่ควรเข้าคอร์สเพราะจะเป็นอันตรายได้&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;-&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;ผู้สูงอายุที่ช่วยเหลือตนเองไม่ได้&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;สตรีมีครรภ์ เด็กอายุตำว่า 17 ปี หรือผู้มีอาการไม่สบายกระทันหัน เช่น ปวดหัว ตัวร้อน เป็นไข้ &amp;nbsp;ยังไม่ควรเข้าคอร์สล้างพิษ&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;- ท่านที่มีโรคประจำตัวต้องทานยาประจำ...ควรพกยาประจำตัวมาด้วย&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;u&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;strong&gt;สรุปอาการที่ไม่ควรเข้าคอร์สล้างพิษตับ&lt;/strong&gt;&lt;/font&gt;&lt;/font&gt;&lt;/u&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;- ความดันสูงมากเกินไป&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;- เบาหวานที่ฉีดอินซูลินแล้ว&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;- โรคหัวใจขั้นร้ายแรง&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;- มะเร็งขั้นสุดท้าย&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;- ฟอกไตแล้ว&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;- โรคติดต่อร้ายแรง&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;- ผู้สูงอายุที่ช่วยเหลือตนเองไม่ได้&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;- สตรีมีครรภ์&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;- เด็กอายุต่ำกว่า 17 ปี&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;#cc0000&quot;&gt;หาก ท่านไม่มั่นใจ ... กรุณาติดต่อสอบถามข้อมูลเพิ่มเติม กับทางทีมงาน ก่อนจะตัดสินใจมาเข้าร่วมคอร์สล้างพิษตับ ... โปรดกรุณาอย่าปกปิดอาการไม่สบายของท่าน แก่ผู้ดูแลคอร์ส เพื่อประโยชน์ของตัวท่านเอง&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;strong&gt;&lt;span style=&quot;font-size:22px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;กำหนดการคอร์สล้างพิษ (สูตรสั้น)&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;#274e13&quot;&gt;ณ ".$site_name." [ระยะเวลา 3 วัน 2 คืน]&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;u&gt;วันที่ 1&lt;/u&gt;&lt;/font&gt;&lt;/font&gt;&lt;/strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&amp;nbsp;&amp;nbsp; &amp;nbsp;&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;blue&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;--- ที่บ้าน ---&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;blue&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;05.00 - ตื่นนอน ทำดีท็อกซ์สวนระบายล้างลำไส้ (หรือเตรียมน้ำอุ่น 1 ลิตร ผสมมะนาว 1-2 ลูก ดื่มให้หมดครั้งเดียว เพื่อกระตุ้นการขับถ่าย และล้างพิษที่ตับ) หรือดื่มน้ำมันมะพร้าวสกัดเย็น 1 ช้อนโต๊ะ และดื่มน้ำอุ่นตามให้มาก เพื่อช่วยขับระบายพิษ&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;blue&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;12.00 - หลังเที่ยง งดอาหารขบเคี้ยวทุกชนิด ดื่มน้ำผลไม้หรือน้ำแอปเปิลแยกกาก (ขนาด 1 ลิตร อาจดื่มมากว่าหนึ่งกล่องได้) สลับกับน้ำเปล่า&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;blue&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;--- และเตรียมตัวเดินทางไปล้างพิษตับ ---&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;blue&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;15.00 - ลงทะเบียน / กรอกข้อมูลสุขภาพ / วัดความดัน / ชั่งน้ำหนัก&lt;br /&gt;
&lt;br /&gt;
17.00 - แนะนำวิธีดีท็อกซ์ (สวนล้างระบายพิษจากลำไส้) / เข้าที่พัก / ทำดีท็อกซ์ (ครั้งที่ 1)&lt;br /&gt;
&lt;br /&gt;
19.30 - แนะวิธีปฏิบัติตัวระหว่างเข้าคอร์ส / พักผ่อนตามอัธยาศัย นอนไม่เกิน 21.00 น.&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;u&gt;วันที่ 2&lt;/u&gt;&lt;/font&gt;&lt;/font&gt;&lt;/strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;blue&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;05.00 - ตื่นนอน / ทำดีท็อกซ์ (สวนล้างระบายพิษจากลำไส้ ครั้งที่ 2)&lt;br /&gt;
&lt;br /&gt;
06.00 - อมน้ำมันมะพร้าว 1 ช.ต. ( 10-15 นาที) บ้วนทิ้ง ห้ามกลืนลงท้อง / ออกกำลังกาย&amp;nbsp;&lt;br /&gt;
&lt;br /&gt;
07.00 - ดื่มน้ำน้ำสมุนไพรชาข้าวเปลือกงอก /แช่เท้า / พอกหน้า ด้วยสมุนไพร&lt;br /&gt;
&lt;br /&gt;
08.30 - งดดื่มน้ำทุกชนิด หากกระหายให้ดื่มได้เล็กน้อย&lt;br /&gt;
&lt;br /&gt;
09.00 - ดื่มสมุนไพร (ลิดท็อกซ์) ล้างลำไส้&lt;br /&gt;
&lt;br /&gt;
09.30 - ดื่มน้ำสมุนไพรมะขาม /น้ำชามะละกอ /น้ำด่าง&lt;br /&gt;
&lt;br /&gt;
----- ฟังบรรยาย-ชมวิดีทัศน์ เกี่ยวกับสุขภาพ -----&amp;nbsp;&lt;br /&gt;
&lt;br /&gt;
11.30 - งดดื่มน้ำทุกชนิด หากกระหายให้ดื่มได้เล็กน้อย&lt;br /&gt;
&lt;br /&gt;
12.00 - ดื่มสมุนไพร (ลิดท็อกซ์) ล้างลำไส้ /พักผ่อนตามอัธยาศรัย&lt;br /&gt;
&lt;br /&gt;
12.30 - ดื่มน้ำสมุนไพรมะขาม/น้ำชามะละกอ /น้ำด่าง&lt;br /&gt;
&lt;br /&gt;
15.00 - ดื่มน้ำผลไม้ /พักผ่อนตามอัธยาศัย&lt;br /&gt;
&lt;br /&gt;
17.00 - ทำดีท็อกซ์ (สวนล้างระบายพิษจากลำไส้ ครั้งที่ 3)&lt;br /&gt;
&lt;br /&gt;
18.00 - ดื่มน้ำดีเกลือครั้งที่ 1 (งดดื่มน้ำ 30 นาที)&lt;br /&gt;
&lt;br /&gt;
----- ฟังบรรยาย-ชมวิดีทัศน์ เกี่ยวกับสุขภาพ -----&amp;nbsp;&lt;br /&gt;
&lt;br /&gt;
20.00 - ดื่มน้ำดีเกลือครั้งที่ 2 (งดดื่มน้ำ 30 นาที)&lt;br /&gt;
&lt;br /&gt;
21.30 - แนะนำวิธีดื่มน้ำมันมะกอก /การเก็บพิษจากตับ&lt;br /&gt;
&lt;br /&gt;
22.00 - ดื่มน้ำมันมะกอก+น้ำมะนาว (เขย่าให้เข้ากันแล้วดื่มทันที)&lt;br /&gt;
&lt;br /&gt;
22.15 - เข้านอนทันทีโดยนอนตะแคงขวา หรือนอนหงาย ใช้ถุงน้ำร้อนวางที่ท้อง&amp;nbsp;&lt;br /&gt;
&lt;br /&gt;
(หากอยากขับถ่ายลุกไปทำธุระแล้วรีบกลับมานอน)&lt;br /&gt;
&lt;br /&gt;
----- พิษที่ออกจากตับและของเสียอื่น&amp;nbsp;ๆ จากตัวจะเริ่มออกมาประมาณ 02.00 น. -----&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;u&gt;วันที่ 3&lt;/u&gt;&lt;/font&gt;&lt;/font&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;blue&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;05.00 - ตื่นนอน ทำกิจวัตรส่วนตัว ทำดีท็อกซ์ (ครั้งที่ 4) ใส่ถังเก็บไว้&lt;br /&gt;
&lt;br /&gt;
07.00 - อมน้ำมันมะพร้าว 1 ช.ต. ( 10-15 นาที) บ้วนทิ้ง ห้ามกลืนลงท้อง / ออกกำลังกาย&lt;br /&gt;
&lt;br /&gt;
- ดื่มน้ำสมุนไพรอื่นตามที่จัดให้&lt;br /&gt;
&lt;br /&gt;
- แลกเปลี่ยนประสบการณ์ / ถ่ายรูปร่วมกัน&lt;br /&gt;
&lt;br /&gt;
10.00 - สวนล้างลำไส้ (ครั้งที่ 5) ลงในถังเดิม นำไปตรวจ&lt;br /&gt;
&lt;br /&gt;
11.00 - รับประทานอาหารมังสวิรัติ&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;blue&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;- เดินทางกลับ โดยสวัสดิภาพ&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:22px;&quot;&gt;&lt;strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;วิธีปฎิบัติหลังจากมาเข้าค่ายล้างพิษตับแล้ว&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;ให้รับประทานอาหารย่อยง่ายอีก 3 วัน และสวนล้างลำไส้เช้า-เย็น 7 วันต่อเนื่อง&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;เพราะพิษที่ขับออกจากตับค้างอยู่ในลำไส้ อาจทำให้ไม่สบายหรือมีตุ่มคันตามผิวหนัง&lt;/font&gt;&lt;/font&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;strong&gt;&lt;span style=&quot;font-size:22px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;คำถามที่พบบ่อย&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;-&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;การล้างพิษสูตรสั้น คืออะไร?&lt;/font&gt;&lt;/font&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;ตอบ : การล้างพิษสูตรสั้น คือ การล้างพิษที่ตับและถุงน้ำดี ใช้เวลาเพียงวันเดียว&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;-&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;แล้วจะได้ผลเหมือนเข้าคอร์สยาวไหม?&lt;/font&gt;&lt;/font&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;ตอบ : ได้ผลเหมือนคอร์สยาว คือได้ล้างนิ่วจากถุงน้ำดี ไขมันจากตับและนิ่วจากท่อน้ำดีตับ โดยให้ท่านเตรียมตัวด้านการดีท็อกซ์มาจากที่บ้านอย่างน้อยหนึ่งวันหรือ มากกว่านั้นก็ได้&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;-&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;ขอคำแนะนำเกี่ยวกับการดีท็อกซ์&lt;/font&gt;&lt;/font&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;ตอบ : การดีท็อกซ์ทำได้ 2 วิธี&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;1 งดอาหารขบเคี้ยวทุกชนิด ดื่มเฉพาะน้ำผลไม้อย่างเดียว เช่น น้ำแอปเปิ้ลชนิดแยกกาก อย่างน้อย หนึ่งลิตรต่อวัน ดื่มสลับกับน้ำเปล่าตลอดวัน (อาจหาซื้อน้ำแอปเปิ้ลแยกกากตามห้างทั่วไป)&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&lt;span style=&quot;font-size:14px;&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;2 นอกจากทำตามข้อ 1 แล้ว เพิ่มการสวนทวารด้วยน้ำอุ่น หรือน้ำกาแฟ เช้า-เย็น&lt;/font&gt;&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;
&lt;/div&gt;
')");

    $last_id = $mysqli->insert_id;

    $result = $mysqli->query("INSERT INTO
                site_submenu (menu_order, menu_name, status_menu, main_menu_id, content_id, site_id)
                VALUES (2, 'การเตรียมตัวมาเข้าค่ายล้างพิษตับ', '0', '$last_menu_main', $last_id, '$last_id_site')");

    /** Add sub menu */
    $result = $mysqli->query("INSERT INTO
                site_content (content_html)
                VALUES ('&lt;div align=&quot;center&quot;&gt;&lt;img src=&quot;http://s.exaidea.com/upload2/1/20130710/ad74aed9ec4598611f66243abfca0078.jpg&quot; /&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;div align=&quot;center&quot;&gt;&lt;img src=&quot;http://www.manager.co.th/asp-bin/Image.aspx?ID=2653769&quot; /&gt;&lt;/div&gt;

&lt;div&gt;&amp;nbsp;&lt;/div&gt;

&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;&lt;/p&gt;
')");

    $last_id = $mysqli->insert_id;

    $result = $mysqli->query("INSERT INTO
                site_submenu (menu_order, menu_name, status_menu, main_menu_id, content_id, site_id)
                VALUES (3, 'รวมภาพกิจกรรมล้างพิษตับ', '0', '$last_menu_main', $last_id, '$last_id_site')");

    /** Add menu contact */
    $result = $mysqli->query("INSERT INTO
                site_content (content_html)
                VALUES ('&lt;div align=&quot;center&quot;&gt;&lt;font size=&quot;5&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;ช่องทางการติดต่อ &amp;quot;&lt;/font&gt;&lt;strong&gt;&lt;font color=&quot;#ff3366&quot;&gt;".$site_name."&lt;/font&gt;&lt;/strong&gt;&lt;font color=&quot;#000000&quot;&gt;&amp;quot;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/div&gt;

&lt;div align=&quot;center&quot;&gt;&lt;strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&lt;font color=&quot;#660000&quot;&gt;&lt;font size=&quot;4&quot;&gt;โทรศัพท์ : &lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/strong&gt;&lt;/div&gt;

&lt;p style=&quot;text-align: center;&quot;&gt;&lt;font size=&quot;4&quot;&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;- เวลาทำการ&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;08.30 - 18.00 น.&lt;/font&gt;&lt;/font&gt;&lt;/strong&gt;&lt;font color=&quot;#000000&quot;&gt;&lt;font face=&quot;Tahoma, sans-serif, Arial, Helvetica&quot;&gt;&amp;nbsp;(ทุกวัน..ไม่มีวันหยุด)&amp;nbsp;&lt;/font&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;
')");

    $last_id = $mysqli->insert_id;

    $result = $mysqli->query("INSERT INTO
                site_menu (menu_order, menu_name, display_menu, content_id, site_id)
                VALUES (4, 'ติดต่อเรา', '0', $last_id, '$last_id_site')");
?>

