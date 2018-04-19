<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class LotTagProcessFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $list = array(
            ['id'=> 1,'lot_tag_id' => 1,'process_id' => 12 ,'img' => null],
            ['id'=> 2,'lot_tag_id' => 1,'process_id' => 56 ,'img' => null],
            ['id'=> 3,'lot_tag_id' => 1,'process_id' => 82 ,'img' => null],
            ['id'=> 4,'lot_tag_id' => 1,'process_id' => 84 ,'img' => null],
            ['id'=> 5,'lot_tag_id' => 1,'process_id' => 85 ,'img' => null],
            ['id'=> 6,'lot_tag_id' => 1,'process_id' => 26 ,'img' => null],

            ['id'=> 7,'lot_tag_id' => 2,'process_id' => 6 , 'img' => null],
            ['id'=> 8,'lot_tag_id' => 2,'process_id' => 12 ,'img' => null],
            ['id'=> 9,'lot_tag_id' => 2,'process_id' => 56 ,'img' => null],
            ['id'=> 10,'lot_tag_id' => 2,'process_id' => 82 ,'img' => null],
            ['id'=> 11,'lot_tag_id' => 2,'process_id' => 84 ,'img' => null],
            ['id'=> 12,'lot_tag_id' => 2,'process_id' => 85 ,'img' => null],
            ['id'=> 13,'lot_tag_id' => 2,'process_id' => 26 ,'img' => null],

            ['id'=> 14,'lot_tag_id' => 3,'process_id' => 16,'img' => '65685-TBA-A000-H1-FO.png'],
            ['id'=> 15,'lot_tag_id' => 3,'process_id' => 86,'img' => '65685-TBA-A000-H1-BE.png'],
            ['id'=> 16,'lot_tag_id' => 3,'process_id' => 8,'img' => '65685-TBA-A000-H1-BE-REST.png'],
            ['id'=> 17,'lot_tag_id' => 3,'process_id' => 14,'img' => '65685-TBA-A000-H1-PI-C-PI.png'],
            ['id'=> 18,'lot_tag_id' => 3,'process_id' => 14,'img' => null],

            ['id'=> 19,'lot_tag_id' => 4,'process_id' => 15,'img' => '61522-TBA-A000-H1-BL-PI.png'],
            ['id'=> 20,'lot_tag_id' => 4,'process_id' => 16,'img' => '61522-TBA-A000-H1-FO.png'],
            ['id'=> 21,'lot_tag_id' => 4,'process_id' => 27,'img' => '61522-TBA-A000-H1-PI.png'],
            ['id'=> 22,'lot_tag_id' => 4,'process_id' => 45,'img' => '61522-TBA-A000-H1-BUR-REST.png'],
            ['id'=> 23,'lot_tag_id' => 4,'process_id' => 88,'img' => '61522-TBA-A000-H1-PI(SELECT).png'],

            ['id'=> 24,'lot_tag_id' => 5,'process_id' => 6,'img' => ''],
            ['id'=> 25,'lot_tag_id' => 5,'process_id' => 58,'img' => ''],
            ['id'=> 26,'lot_tag_id' => 5,'process_id' => 16,'img' => ''],
            ['id'=> 27,'lot_tag_id' => 5,'process_id' => 57,'img' => ''],
            ['id'=> 28,'lot_tag_id' => 5,'process_id' => 38,'img' => ''],
            ['id'=> 29,'lot_tag_id' => 5,'process_id' => 92,'img' => ''],

            ['id'=> 30,'lot_tag_id' => 6,'process_id' => 58,'img' => ''],
            ['id'=> 31,'lot_tag_id' => 6,'process_id' => 16,'img' => ''],
            ['id'=> 32,'lot_tag_id' => 6,'process_id' => 57,'img' => ''],
            ['id'=> 33,'lot_tag_id' => 6,'process_id' => 38,'img' => ''],
            ['id'=> 34,'lot_tag_id' => 6,'process_id' => 92,'img' => ''],

            ['id'=> 35,'lot_tag_id' => 7,'process_id' => 58,'img' => ''],
            ['id'=> 36,'lot_tag_id' => 7,'process_id' => 16,'img' => ''],
            ['id'=> 37,'lot_tag_id' => 7,'process_id' => 57,'img' => ''],
            ['id'=> 38,'lot_tag_id' => 7,'process_id' => 38,'img' => ''],
            ['id'=> 39,'lot_tag_id' => 7,'process_id' => 92,'img' => ''],

            ['id'=> 40,'lot_tag_id' => 8,'process_id' => 58,'img' => ''],
            ['id'=> 41,'lot_tag_id' => 8,'process_id' => 16,'img' => ''],
            ['id'=> 42,'lot_tag_id' => 8,'process_id' => 57,'img' => ''],
            ['id'=> 43,'lot_tag_id' => 8,'process_id' => 38,'img' => ''],
            ['id'=> 44,'lot_tag_id' => 8,'process_id' => 92,'img' => ''],

            ['id'=> 45,'lot_tag_id' => 9,'process_id' => 1,'img' => ''],
            ['id'=> 46,'lot_tag_id' => 9,'process_id' => 2,'img' => ''],
            ['id'=> 47,'lot_tag_id' => 9,'process_id' => 7,'img' => ''],
            ['id'=> 48,'lot_tag_id' => 9,'process_id' => 93,'img' => ''],
            ['id'=> 49,'lot_tag_id' => 9,'process_id' => 17,'img' => ''],

            ['id'=> 50,'lot_tag_id' => 10,'process_id' => 1,'img' => ''],
            ['id'=> 51,'lot_tag_id' => 10,'process_id' => 2,'img' => ''],
            ['id'=> 52,'lot_tag_id' => 10,'process_id' => 7,'img' => ''],
            ['id'=> 53,'lot_tag_id' => 10,'process_id' => 93,'img' => ''],
            ['id'=> 54,'lot_tag_id' => 10,'process_id' => 17,'img' => ''],

            ['id'=> 55,'lot_tag_id' => 11,'process_id' => 1,'img' => ''],
            ['id'=> 56,'lot_tag_id' => 11,'process_id' => 2,'img' => ''],
            ['id'=> 57,'lot_tag_id' => 11,'process_id' => 7,'img' => ''],
            ['id'=> 58,'lot_tag_id' => 11,'process_id' => 93,'img' => ''],
            ['id'=> 59,'lot_tag_id' => 11,'process_id' => 47,'img' => ''],
            ['id'=> 60,'lot_tag_id' => 11,'process_id' => 17,'img' => ''],

            ['id'=> 61,'lot_tag_id' => 12,'process_id' => 1,'img' => ''],
            ['id'=> 62,'lot_tag_id' => 12,'process_id' => 2,'img' => ''],
            ['id'=> 63,'lot_tag_id' => 12,'process_id' => 7,'img' => ''],
            ['id'=> 64,'lot_tag_id' => 12,'process_id' => 93,'img' => ''],
            ['id'=> 65,'lot_tag_id' => 12,'process_id' => 47,'img' => ''],
            ['id'=> 66,'lot_tag_id' => 12,'process_id' => 17,'img' => ''],

            ['id'=> 67,'lot_tag_id' => 13,'process_id' => 1,'img' => ''],
            ['id'=> 68,'lot_tag_id' => 13,'process_id' => 2,'img' => ''],
            ['id'=> 69,'lot_tag_id' => 13,'process_id' => 7,'img' => ''],
            ['id'=> 70,'lot_tag_id' => 13,'process_id' => 93,'img' => ''],
            ['id'=> 71,'lot_tag_id' => 13,'process_id' => 47,'img' => ''],
            ['id'=> 72,'lot_tag_id' => 13,'process_id' => 17,'img' => ''],

            ['id'=> 73,'lot_tag_id' => 14,'process_id' => 1,'img' => ''],
            ['id'=> 74,'lot_tag_id' => 14,'process_id' => 2,'img' => ''],
            ['id'=> 75,'lot_tag_id' => 14,'process_id' => 7,'img' => ''],
            ['id'=> 76,'lot_tag_id' => 14,'process_id' => 93,'img' => ''],
            ['id'=> 77,'lot_tag_id' => 14,'process_id' => 47,'img' => ''],
            ['id'=> 78,'lot_tag_id' => 14,'process_id' => 17,'img' => ''],

            ['id'=> 79,'lot_tag_id' => 15,'process_id' => 1,'img' => ''],
            ['id'=> 80,'lot_tag_id' => 15,'process_id' => 28,'img' => ''],
            ['id'=> 81,'lot_tag_id' => 15,'process_id' => 29,'img' => ''],
            ['id'=> 82,'lot_tag_id' => 15,'process_id' => 30,'img' => ''],
            ['id'=> 83,'lot_tag_id' => 15,'process_id' => 31,'img' => ''],
            ['id'=> 84,'lot_tag_id' => 15,'process_id' => 32,'img' => ''],
            ['id'=> 85,'lot_tag_id' => 15,'process_id' => 33,'img' => ''],
            ['id'=> 86,'lot_tag_id' => 15,'process_id' => 9,'img' => ''],

            ['id'=> 87,'lot_tag_id' => 16,'process_id' => 1,'img' => ''],
            ['id'=> 88,'lot_tag_id' => 16,'process_id' => 28,'img' => ''],
            ['id'=> 89,'lot_tag_id' => 16,'process_id' => 29,'img' => ''],
            ['id'=> 90,'lot_tag_id' => 16,'process_id' => 30,'img' => ''],
            ['id'=> 91,'lot_tag_id' => 16,'process_id' => 31,'img' => ''],
            ['id'=> 92,'lot_tag_id' => 16,'process_id' => 32,'img' => ''],
            ['id'=> 93,'lot_tag_id' => 16,'process_id' => 33,'img' => ''],
            ['id'=> 94,'lot_tag_id' => 16,'process_id' => 9,'img' => ''],

            ['id'=> 95,'lot_tag_id' => 17,'process_id' => 58,'img' => ''],
            ['id'=> 96,'lot_tag_id' => 17,'process_id' => 8,'img' => ''],
            ['id'=> 97,'lot_tag_id' => 17,'process_id' => 86,'img' => ''],
            ['id'=> 98,'lot_tag_id' => 17,'process_id' => 18,'img' => ''],

            ['id'=> 99,'lot_tag_id' => 18,'process_id' => 58,'img' => ''],
            ['id'=> 100,'lot_tag_id' => 18,'process_id' => 8,'img' => ''],
            ['id'=> 101,'lot_tag_id' => 18,'process_id' => 86,'img' => ''],
            ['id'=> 102,'lot_tag_id' => 18,'process_id' => 18,'img' => ''],

            ['id'=> 103,'lot_tag_id' => 19,'process_id' => 6,'img' => null],
            ['id'=> 104,'lot_tag_id' => 19,'process_id' => 2,'img' => '65674-TBA-A000-H1-DR.png'],
            ['id'=> 105,'lot_tag_id' => 19,'process_id' => 56,'img' => '65674-TBA-A000-H1-TR.png'],
            ['id'=> 106,'lot_tag_id' => 19,'process_id' => 13,'img' => '65674-TBA-A000-H1-BE-REST-MARK.png'],
            ['id'=> 107,'lot_tag_id' => 19,'process_id' => 24,'img' => '65674-TBA-A000-H1-PI-CUT.png'],

            ['id'=> 108,'lot_tag_id' => 20,'process_id' => 6,'img' => null],
            ['id'=> 109,'lot_tag_id' => 20,'process_id' => 2,'img' => '65624-TBA-A000-H1-DR.png'],
            ['id'=> 110,'lot_tag_id' => 20,'process_id' => 56,'img' => '65624-TBA-A000-H1-TR.png'],
            ['id'=> 111,'lot_tag_id' => 20,'process_id' => 13,'img' => '65624-TBA-A000-H1-BE-REST-MARK.png'],
            ['id'=> 112,'lot_tag_id' => 20,'process_id' => 24,'img' => '65624-TBA-A000-H1-PI-CUT.png'],

            ['id'=> 113,'lot_tag_id' => 21,'process_id' => 1,'img' => null],
            ['id'=> 114,'lot_tag_id' => 21,'process_id' => 12,'img' => '64336-736-TEA-T001-H1-DRAW.png'],
            ['id'=> 115,'lot_tag_id' => 21,'process_id' => 7,'img' => '64336-736-TEA-T001-H1-TR-PI.png'],
            ['id'=> 116,'lot_tag_id' => 21,'process_id' => 94,'img' => '64336-736-TEA-T001-H1-BE-BUR-SEP.png'],
            ['id'=> 117,'lot_tag_id' => 21,'process_id' => 13,'img' => null],

            ['id'=> 118,'lot_tag_id' => 22,'process_id' => 26,'img' => '66518-TBA-A000-H1-CUT.png'],
            ['id'=> 119,'lot_tag_id' => 22,'process_id' => 41,'img' => '66518-TBA-A000-H1-BE-1.png'],
            ['id'=> 120,'lot_tag_id' => 22,'process_id' => 42,'img' => '66518-TBA-A000-H1-BE-2.png'],

            ['id'=> 121,'lot_tag_id' => 23,'process_id' => 15,'img' => ''],
            ['id'=> 122,'lot_tag_id' => 23,'process_id' => 22,'img' => ''],
            ['id'=> 123,'lot_tag_id' => 23,'process_id' => 95,'img' => ''],
            ['id'=> 124,'lot_tag_id' => 23,'process_id' => 14,'img' => ''],
            ['id'=> 125,'lot_tag_id' => 23,'process_id' => 96,'img' => ''],

            ['id'=> 126,'lot_tag_id' => 24,'process_id' => 15,'img' => ''],
            ['id'=> 127,'lot_tag_id' => 24,'process_id' => 22,'img' => ''],
            ['id'=> 128,'lot_tag_id' => 24,'process_id' => 95,'img' => ''],
            ['id'=> 129,'lot_tag_id' => 24,'process_id' => 14,'img' => ''],
            ['id'=> 130,'lot_tag_id' => 24,'process_id' => 96,'img' => ''],

            ['id'=> 131,'lot_tag_id' => 25,'process_id' => 1,'img' => ''],
            ['id'=> 132,'lot_tag_id' => 25,'process_id' => 16,'img' => ''],
            ['id'=> 133,'lot_tag_id' => 25,'process_id' => 97,'img' => ''],
            ['id'=> 134,'lot_tag_id' => 25,'process_id' => 8,'img' => ''],
            ['id'=> 135,'lot_tag_id' => 25,'process_id' => 59,'img' => ''],

            ['id'=> 136,'lot_tag_id' => 26,'process_id' => 1,'img' => ''],
            ['id'=> 137,'lot_tag_id' => 26,'process_id' => 16,'img' => ''],
            ['id'=> 138,'lot_tag_id' => 26,'process_id' => 97,'img' => ''],
            ['id'=> 139,'lot_tag_id' => 26,'process_id' => 8,'img' => ''],
            ['id'=> 140,'lot_tag_id' => 26,'process_id' => 59,'img' => ''],

            ['id'=> 141,'lot_tag_id' => 27,'process_id' => 1,'img' => ''],
            ['id'=> 142,'lot_tag_id' => 27,'process_id' => 12,'img' => ''],
            ['id'=> 143,'lot_tag_id' => 27,'process_id' => 7,'img' => ''],
            ['id'=> 144,'lot_tag_id' => 27,'process_id' => 94,'img' => ''],
            ['id'=> 145,'lot_tag_id' => 27,'process_id' => 13,'img' => ''],

            ['id'=> 146,'lot_tag_id' => 28,'process_id' => 1,'img' => '65633-683-TEA-T000-H1-BL.png'],
            ['id'=> 147,'lot_tag_id' => 28,'process_id' => 28,'img' => '65633-683-TEA-T000-H1-DR#1.png'],
            ['id'=> 148,'lot_tag_id' => 28,'process_id' => 29,'img' => '65633-683-TEA-T000-H1-DR#2.png'],
            ['id'=> 149,'lot_tag_id' => 28,'process_id' => 8,'img' => '65633-683-TEA-T000-H1-BE-REST.png'],
            ['id'=> 150,'lot_tag_id' => 28,'process_id' => 32,'img' => '65633-683-TEA-T000-H1-CUT-C-CUT-C-P12.png'],
            ['id'=> 151,'lot_tag_id' => 28,'process_id' => 98,'img' => '65633-683-TEA-T000-H1-C-PI-C-CUT-SER-MARK.png'],
            ['id'=> 152,'lot_tag_id' => 28,'process_id' => 9,'img' => '65633-683-TEA-T000-H1-C-REST.png'],
            ['id'=> 153,'lot_tag_id' => 28,'process_id' => 9,'img' => null],

            ['id'=> 154,'lot_tag_id' => 29,'process_id' => 15,'img' => '61524-TEA-T000-H1-BL-PI.png'],
            ['id'=> 155,'lot_tag_id' => 29,'process_id' => 22,'img' => '61524-TEA-T000-H1-FO-BE.png'],
            ['id'=> 156,'lot_tag_id' => 29,'process_id' => 8,'img' => '61524-TEA-T000-H1-BE-REST.png'],
            ['id'=> 157,'lot_tag_id' => 29,'process_id' => 24,'img' => '61524-TEA-T000-H1-PI-CUT.png'],
            ['id'=> 158,'lot_tag_id' => 29,'process_id' => 47,'img' => '61524-TEA-T000-H1-PI-MARK.png'],

            ['id'=> 159,'lot_tag_id' => 30,'process_id' => 15,'img' => '61522-TET-H000-H1-BL-PI.png'],
            ['id'=> 160,'lot_tag_id' => 30,'process_id' => 16,'img' => '61522-TET-H000-H1-FO.png'],
            ['id'=> 161,'lot_tag_id' => 30,'process_id' => 27,'img' => '61522-TET-H000-H1-PT.png'],
            ['id'=> 162,'lot_tag_id' => 30,'process_id' => 45,'img' => '61522-TET-H000-H1-BUR-REST.png'],

            ['id'=> 163,'lot_tag_id' => 31,'process_id' => 15,'img' => ''],
            ['id'=> 164,'lot_tag_id' => 31,'process_id' => 16,'img' => ''],
            ['id'=> 165,'lot_tag_id' => 31,'process_id' => 8,'img' => ''],
            ['id'=> 166,'lot_tag_id' => 31,'process_id' => 18,'img' => ''],

            ['id'=> 167,'lot_tag_id' => 32,'process_id' => 15,'img' => ''],
            ['id'=> 168,'lot_tag_id' => 32,'process_id' => 16,'img' => ''],
            ['id'=> 169,'lot_tag_id' => 32,'process_id' => 8,'img' => ''],
            ['id'=> 170,'lot_tag_id' => 32,'process_id' => 18,'img' => ''],

            ['id'=> 171,'lot_tag_id' => 33,'process_id' => 1,'img' => ''],
            ['id'=> 172,'lot_tag_id' => 33,'process_id' => 2,'img' => ''],
            ['id'=> 173,'lot_tag_id' => 33,'process_id' => 7,'img' => ''],
            ['id'=> 174,'lot_tag_id' => 33,'process_id' => 93,'img' => ''],
            ['id'=> 175,'lot_tag_id' => 33,'process_id' => 17,'img' => ''],

            ['id'=> 176,'lot_tag_id' => 34,'process_id' => 1,'img' => ''],
            ['id'=> 177,'lot_tag_id' => 34,'process_id' => 2,'img' => ''],
            ['id'=> 178,'lot_tag_id' => 34,'process_id' => 99,'img' => ''],
            ['id'=> 179,'lot_tag_id' => 34,'process_id' => 86,'img' => ''],
            ['id'=> 180,'lot_tag_id' => 34,'process_id' => 100,'img' => ''],

            ['id'=> 181,'lot_tag_id' => 35,'process_id' => 15,'img' => ''],
            ['id'=> 182,'lot_tag_id' => 35,'process_id' => 101,'img' => ''],
            ['id'=> 183,'lot_tag_id' => 35,'process_id' => 82,'img' => ''],
            ['id'=> 184,'lot_tag_id' => 35,'process_id' => 59,'img' => ''],

            ['id'=> 185,'lot_tag_id' => 36,'process_id' => 15,'img' => ''],
            ['id'=> 186,'lot_tag_id' => 36,'process_id' => 101,'img' => ''],
            ['id'=> 187,'lot_tag_id' => 36,'process_id' => 82,'img' => ''],
            ['id'=> 188,'lot_tag_id' => 36,'process_id' => 59,'img' => ''],

            ['id'=> 189,'lot_tag_id' => 37,'process_id' => 15,'img' => ''],
            ['id'=> 190,'lot_tag_id' => 37,'process_id' => 79,'img' => ''],
            ['id'=> 191,'lot_tag_id' => 37,'process_id' => 102,'img' => ''],

            ['id'=> 192,'lot_tag_id' => 38,'process_id' => 15,'img' => ''],
            ['id'=> 193,'lot_tag_id' => 38,'process_id' => 79,'img' => ''],
            ['id'=> 194,'lot_tag_id' => 38,'process_id' => 102,'img' => ''],

            ['id'=> 195,'lot_tag_id' => 39,'process_id' => 1,'img' => '65626-676-TBA-A001-H1-BL.png'],
            ['id'=> 196,'lot_tag_id' => 39,'process_id' => 2,'img' => '65626-676-TBA-A001-H1-DR.png'],
            ['id'=> 197,'lot_tag_id' => 39,'process_id' => 19,'img' => '65626-676-TBA-A001-H1-TR-PI-SEP.png'],
            ['id'=> 198,'lot_tag_id' => 39,'process_id' => 13,'img' => '65626-676-TBA-A001-H1-BE-REST-MARK.png'],
            ['id'=> 199,'lot_tag_id' => 39,'process_id' => 26,'img' => '65626-676-TBA-A001-H1-PI.png'],
            ['id'=> 200,'lot_tag_id' => 39,'process_id' => 27,'img' => '65626-676-TBA-A001-H1-CUT.png'],

            ['id'=> 201,'lot_tag_id' => 40,'process_id' => 6,'img' => ''],
            ['id'=> 202,'lot_tag_id' => 40,'process_id' => 28,'img' => ''],
            ['id'=> 203,'lot_tag_id' => 40,'process_id' => 29,'img' => ''],
            ['id'=> 204,'lot_tag_id' => 40,'process_id' => 7,'img' => ''],
            ['id'=> 205,'lot_tag_id' => 40,'process_id' => 26,'img' => ''],
            ['id'=> 206,'lot_tag_id' => 40,'process_id' => 51,'img' => ''],

            ['id'=> 207,'lot_tag_id' => 41,'process_id' => 1,'img' => '64745-TEA-T000-H1-BL.png'],
            ['id'=> 208,'lot_tag_id' => 41,'process_id' => 2,'img' => '64745-TEA-T000-H1-DR.png'],
            ['id'=> 209,'lot_tag_id' => 41,'process_id' => 56,'img' => '64745-TEA-T000-H1-TR.png'],
            ['id'=> 210,'lot_tag_id' => 41,'process_id' => 17,'img' => '64745-TEA-T000-H1-BE-RE-MARK.png'],
            ['id'=> 211,'lot_tag_id' => 41,'process_id' => 102,'img' => '64745-TEA-T000-H1-CUT-PI.png'],

            ['id'=> 212,'lot_tag_id' => 42,'process_id' => 1,'img' => null],
            ['id'=> 213,'lot_tag_id' => 42,'process_id' => 2,'img' => '65693-TEA-T100-H1-DR.png'],
            ['id'=> 214,'lot_tag_id' => 42,'process_id' => 56,'img' => '65693-TEA-T100-H1-TR.png'],
            ['id'=> 215,'lot_tag_id' => 42,'process_id' => 47,'img' => '65693-TEA-T100-H1-PI.png'],
            ['id'=> 216,'lot_tag_id' => 42,'process_id' => 49,'img' => '65693-TEA-T100-H1-BE-REST-BUR.png'],
            ['id'=> 217,'lot_tag_id' => 42,'process_id' => 50,'img' => '65693-TEA-T100-H1-PI-BE-REST.png'],

            ['id'=> 218,'lot_tag_id' => 43,'process_id' => 6,'img' => null],
            ['id'=> 219,'lot_tag_id' => 43,'process_id' => 1,'img' => null],
            ['id'=> 220,'lot_tag_id' => 43,'process_id' => 12,'img' => '65643-TEA-T100-H1-DRAW.png'],
            ['id'=> 221,'lot_tag_id' => 43,'process_id' => 48,'img' => '65643-TEA-T100-H1-TRIM.png'],
            ['id'=> 222,'lot_tag_id' => 43,'process_id' => 47,'img' => '65643-TEA-T100-H1-PI-MARK.png'],
            ['id'=> 223,'lot_tag_id' => 43,'process_id' => 49,'img' => '65643-TEA-T100-H1-BE-REST-BUR.png'],
            ['id'=> 224,'lot_tag_id' => 43,'process_id' => 50,'img' => '65643-TEA-T100-H1-PI-BE-REST.png'],

            ['id'=> 225,'lot_tag_id' => 44,'process_id' => 6,'img' => '65748-TEA-T000-H1-RAF-BL.png'],
            ['id'=> 226,'lot_tag_id' => 44,'process_id' => 26,'img' => '65748-TEA-T000-H1-CUT.png'],
            ['id'=> 227,'lot_tag_id' => 44,'process_id' => 41,'img' => '65748-TEA-T000-H1-BE-1.png'],
            ['id'=> 228,'lot_tag_id' => 44,'process_id' => 42,'img' => '65748-TEA-T000-H1-BE-2.png'],

            ['id'=> 229,'lot_tag_id' => 46,'process_id' => 1,'img' => ''],
            ['id'=> 230,'lot_tag_id' => 46,'process_id' => 15,'img' => ''],
            ['id'=> 231,'lot_tag_id' => 46,'process_id' => 16,'img' => ''],
            ['id'=> 232,'lot_tag_id' => 46,'process_id' => 104,'img' => ''],
            ['id'=> 233,'lot_tag_id' => 46,'process_id' => 27,'img' => ''],
            ['id'=> 234,'lot_tag_id' => 46,'process_id' => 26,'img' => ''],

            ['id'=> 235,'lot_tag_id' => 47,'process_id' => 1,'img' => ''],
            ['id'=> 236,'lot_tag_id' => 47,'process_id' => 15,'img' => ''],
            ['id'=> 237,'lot_tag_id' => 47,'process_id' => 16,'img' => ''],
            ['id'=> 238,'lot_tag_id' => 47,'process_id' => 104,'img' => ''],
            ['id'=> 239,'lot_tag_id' => 47,'process_id' => 27,'img' => ''],
            ['id'=> 240,'lot_tag_id' => 47,'process_id' => 26,'img' => ''],

            ['id'=> 241,'lot_tag_id' => 48,'process_id' => 6,'img' => null],
            ['id'=> 242,'lot_tag_id' => 48,'process_id' => 2,'img' => '65661-TEA-T000-50-DR.png'],
            ['id'=> 243,'lot_tag_id' => 48,'process_id' => 7,'img' => '65661-TEA-T000-50-TR-PI.png'],
            ['id'=> 244,'lot_tag_id' => 48,'process_id' => 8,'img' => '65661-TEA-T000-50-BE-REST.png'],
            ['id'=> 245,'lot_tag_id' => 48,'process_id' => 9,'img' => '65661-TEA-T000-50-C-REST.png'],
            ['id'=> 246,'lot_tag_id' => 48,'process_id' => 105,'img' => '65661-TEA-T000-50-PI-C-PI-C-CUT-BUR.png'],
            ['id'=> 247,'lot_tag_id' => 48,'process_id' => 11,'img' => '65661-TEA-T000-50-PI-C-PI-MARK.png'],

            ['id'=> 248,'lot_tag_id' => 49,'process_id' => 6,'img' => null],
            ['id'=> 249,'lot_tag_id' => 49,'process_id' => 2,'img' => '65611-TEA-T000-50-DR.png'],
            ['id'=> 250,'lot_tag_id' => 49,'process_id' => 7,'img' => '65611-TEA-T000-50-TR-PI.png'],
            ['id'=> 251,'lot_tag_id' => 49,'process_id' => 8,'img' => '65611-TEA-T000-50-BE-REST.png'],
            ['id'=> 252,'lot_tag_id' => 49,'process_id' => 9,'img' => '65611-TEA-T000-50-C-REST.png'],
            ['id'=> 253,'lot_tag_id' => 49,'process_id' => 105,'img' => '65611-TEA-T000-50-PI-C-PI-C-CUT-BUR.png'],
            ['id'=> 254,'lot_tag_id' => 49,'process_id' => 11,'img' => '65611-TEA-T000-50-PI-C-PI-MARK.png'],

            ['id'=> 255,'lot_tag_id' => 53,'process_id' => 1,'img' => ''],
            ['id'=> 256,'lot_tag_id' => 53,'process_id' => 2,'img' => ''],
            ['id'=> 257,'lot_tag_id' => 53,'process_id' => 7,'img' => ''],
            ['id'=> 258,'lot_tag_id' => 53,'process_id' => 93,'img' => ''],
            ['id'=> 259,'lot_tag_id' => 53,'process_id' => 17,'img' => ''],

            ['id'=> 260,'lot_tag_id' => 55,'process_id' => 1,'img' => ''],
            ['id'=> 261,'lot_tag_id' => 55,'process_id' => 2,'img' => '64351-751-TEA-T000-H1-DR.png'],
            ['id'=> 262,'lot_tag_id' => 55,'process_id' => 7,'img' => '64351-751-TEA-T000-H1-TR-PI.png'],
            ['id'=> 263,'lot_tag_id' => 55,'process_id' => 106,'img' => '64351-751-TEA-T000-H1-PI-C-PI-C-CUT-SEP.png'],
            ['id'=> 264,'lot_tag_id' => 55,'process_id' => 13,'img' => '64351-751-TEA-T000-H1-BE-REST-MARK.png'],
            ['id'=> 265,'lot_tag_id' => 55,'process_id' => 107,'img' => '64351-751-TEA-T000-H1-PI-C-PI-C-CUT.png'],

            ['id'=> 266,'lot_tag_id' => 56,'process_id' => 6,'img' => ''],
            ['id'=> 267,'lot_tag_id' => 56,'process_id' => 15,'img' => ''],
            ['id'=> 268,'lot_tag_id' => 56,'process_id' => 16,'img' => ''],
            ['id'=> 269,'lot_tag_id' => 56,'process_id' => 87,'img' => ''],
            ['id'=> 270,'lot_tag_id' => 56,'process_id' => 14,'img' => ''],
            ['id'=> 271,'lot_tag_id' => 56,'process_id' => 108,'img' => ''],

            ['id'=> 272,'lot_tag_id' => 57,'process_id' => 6,'img' => ''],
            ['id'=> 273,'lot_tag_id' => 57,'process_id' => 15,'img' => ''],
            ['id'=> 274,'lot_tag_id' => 57,'process_id' => 16,'img' => ''],
            ['id'=> 275,'lot_tag_id' => 57,'process_id' => 87,'img' => ''],
            ['id'=> 276,'lot_tag_id' => 57,'process_id' => 14,'img' => ''],
            ['id'=> 277,'lot_tag_id' => 57,'process_id' => 108,'img' => ''],

            ['id'=> 278,'lot_tag_id' => 58,'process_id' => 1,'img' => '65672-TEA-T000-H1-BL.png'],
            ['id'=> 279,'lot_tag_id' => 58,'process_id' => 2,'img' => '65672-TEA-T000-H1-DR.png'],
            ['id'=> 280,'lot_tag_id' => 58,'process_id' => 7,'img' => '65672-TEA-T000-H1-TR-PI.png'],
            ['id'=> 281,'lot_tag_id' => 58,'process_id' => 8,'img' => '65672-TEA-T000-H1-BE-REST.png'],
            ['id'=> 282,'lot_tag_id' => 58,'process_id' => 109,'img' => '65672-TEA-T000-H1-BE-C-REST.png'],
            ['id'=> 283,'lot_tag_id' => 58,'process_id' => 110,'img' => '65672-TEA-T000-H1-CUT-PI-C-PI-C-REST.png'],
            ['id'=> 284,'lot_tag_id' => 58,'process_id' => 36,'img' => '65672-TEA-T000-H1-PI-C-CUT-C-PI.png'],
            ['id'=> 285,'lot_tag_id' => 58,'process_id' => 111,'img' => '65672-TEA-T000-H1-C-PI-C-CUT-C-BE.png'],

            ['id'=> 286,'lot_tag_id' => 59,'process_id' => 1,'img' => null],
            ['id'=> 287,'lot_tag_id' => 59,'process_id' => 2,'img' => '65622-TEA-T000-H1-DRAW.png'],
            ['id'=> 288,'lot_tag_id' => 59,'process_id' => 7,'img' => '65622-TEA-T000-H1-TR-PI.png'],
            ['id'=> 289,'lot_tag_id' => 59,'process_id' => 8,'img' => '65622-TEA-T000-H1-BE-REST.png'],
            ['id'=> 290,'lot_tag_id' => 59,'process_id' => 109,'img' => '65622-TEA-T000-H1-BE-C-REST.png'],
            ['id'=> 291,'lot_tag_id' => 59,'process_id' => 110,'img' => '65622-TEA-T000-H1-CUT-PI-C-PI-C-REST.png'],
            ['id'=> 292,'lot_tag_id' => 59,'process_id' => 36,'img' => '65622-TEA-T000-H1-PI-C-CUT-C-PI.png'],
            ['id'=> 293,'lot_tag_id' => 59,'process_id' => 111,'img' => '65622-TEA-T000-H1-C-PI-C-CUT-C-BE.png'],

            ['id'=> 294,'lot_tag_id' => 60,'process_id' => 1,'img' => null],
            ['id'=> 295,'lot_tag_id' => 60,'process_id' => 2,'img' => '61165-TEZ-Y000-50-DR.png'],
            ['id'=> 296,'lot_tag_id' => 60,'process_id' => 56,'img' => '61165-TEZ-Y000-50-TR.png'],
            ['id'=> 297,'lot_tag_id' => 60,'process_id' => 112,'img' => '61165-TEZ-Y000-50-C-CUT-C-PI.png'],
            ['id'=> 298,'lot_tag_id' => 60,'process_id' => 113,'img' => '61165-TEZ-Y000-50-BE-REST-C-BE.png'],
            ['id'=> 299,'lot_tag_id' => 60,'process_id' => 11,'img' => '61165-TEZ-Y000-50-PI-C-PI-MARK.png'],

            ['id'=> 300,'lot_tag_id' => 61,'process_id' => 114,'img' => ''],
            ['id'=> 301,'lot_tag_id' => 61,'process_id' => 28,'img' => ''],
            ['id'=> 302,'lot_tag_id' => 61,'process_id' => 29,'img' => ''],
            ['id'=> 303,'lot_tag_id' => 61,'process_id' => 7,'img' => ''],
            ['id'=> 304,'lot_tag_id' => 61,'process_id' => 8,'img' => ''],
            ['id'=> 305,'lot_tag_id' => 61,'process_id' => 26,'img' => ''],
            ['id'=> 306,'lot_tag_id' => 61,'process_id' => 51,'img' => ''],

            ['id'=> 307,'lot_tag_id' => 62,'process_id' => 15,'img' => ''],
            ['id'=> 308,'lot_tag_id' => 62,'process_id' => 16,'img' => ''],
            ['id'=> 309,'lot_tag_id' => 62,'process_id' => 86,'img' => ''],
            ['id'=> 310,'lot_tag_id' => 62,'process_id' => 8,'img' => ''],
            ['id'=> 311,'lot_tag_id' => 62,'process_id' => 115,'img' => ''],

            ['id'=> 312,'lot_tag_id' => 63,'process_id' => 58,'img' => '61524-TEZ-Y000-H1-BL-PI-MARK.png'],
            ['id'=> 313,'lot_tag_id' => 63,'process_id' => 22,'img' => '61524-TEZ-Y000-H1-FO-BE.png'],
            ['id'=> 314,'lot_tag_id' => 63,'process_id' => 8,'img' => '61524-TEZ-Y000-H1-BE-REST.png'],
            ['id'=> 315,'lot_tag_id' => 63,'process_id' => 24,'img' => '61524-TEZ-Y000-H1-PI-CUT.png'],
            ['id'=> 316,'lot_tag_id' => 63,'process_id' => 27,'img' => '61524-TEZ-Y000-H1-PI.png'],
            ['id'=> 317,'lot_tag_id' => 63,'process_id' => 96,'img' => null],

            ['id'=> 318,'lot_tag_id' => 64,'process_id' => 89,'img' => ''],
            ['id'=> 319,'lot_tag_id' => 64,'process_id' => 2,'img' => ''],
            ['id'=> 320,'lot_tag_id' => 64,'process_id' => 90,'img' => ''],
            ['id'=> 321,'lot_tag_id' => 64,'process_id' => 14,'img' => ''],
            ['id'=> 322,'lot_tag_id' => 64,'process_id' => 27,'img' => ''],
            ['id'=> 323,'lot_tag_id' => 64,'process_id' => 91,'img' => ''],

            ['id'=> 324,'lot_tag_id' => 65,'process_id' => 89,'img' => ''],
            ['id'=> 325,'lot_tag_id' => 65,'process_id' => 2,'img' => ''],
            ['id'=> 326,'lot_tag_id' => 65,'process_id' => 90,'img' => ''],
            ['id'=> 327,'lot_tag_id' => 65,'process_id' => 14,'img' => ''],
            ['id'=> 328,'lot_tag_id' => 65,'process_id' => 27,'img' => ''],
            ['id'=> 329,'lot_tag_id' => 65,'process_id' => 91,'img' => ''],

            ['id'=> 330,'lot_tag_id' => 66,'process_id' => 1,'img' => '61517-518-TRD-A000-HI-BL.png'],
            ['id'=> 331,'lot_tag_id' => 66,'process_id' => 2,'img' => '61517-518-TRD-A000-HI-DR.png'],
            ['id'=> 332,'lot_tag_id' => 66,'process_id' => 7,'img' => '61517-518-TRD-A000-HI-TR-PI.png'],
            ['id'=> 333,'lot_tag_id' => 66,'process_id' => 124,'img' => '61517-518-TRD-A000-HI-SEP-C-CUT.png'],
            ['id'=> 334,'lot_tag_id' => 66,'process_id' => 8,'img' => '61517-518-TRD-A000-HI-BE-REST.png'],

            ['id'=> 335,'lot_tag_id' => 67,'process_id' => 2,'img' => '64351-751-TR3-A000-H1-DR.png'],
            ['id'=> 336,'lot_tag_id' => 67,'process_id' => 7,'img' => '64351-751-TR3-A000-H1-TR-PI.png'],
            ['id'=> 337,'lot_tag_id' => 67,'process_id' => 8,'img' => '64351-751-TR3-A000-H1-BE-REST.png'],
            ['id'=> 338,'lot_tag_id' => 67,'process_id' => 24,'img' => '64351-751-TR3-A000-H1-PI-CUT.png'],
            ['id'=> 339,'lot_tag_id' => 67,'process_id' => 91,'img' => '64351-751-TR3-A000-H1-C-PI-C-CUT-SEP.png'],
            ['id'=> 340,'lot_tag_id' => 67,'process_id' => 26,'img' => null],
            ['id'=> 341,'lot_tag_id' => 67,'process_id' => 91,'img' => null],

            ['id'=> 342,'lot_tag_id' => 68,'process_id' => 1,'img' => '61551-TRO-N000-50-BL.png'],
            ['id'=> 343,'lot_tag_id' => 68,'process_id' => 126,'img' => '61551-TRO-N000-50-FO-DR.png'],
            ['id'=> 344,'lot_tag_id' => 68,'process_id' => 7,'img' => '61551-TRO-N000-50-TR-PI.png'],
            ['id'=> 345,'lot_tag_id' => 68,'process_id' => 8,'img' => '61551-TRO-N000-50-BE-REST.png'],
            ['id'=> 346,'lot_tag_id' => 68,'process_id' => 127,'img' => '61551-TRO-N000-50-C-PI.png'],

            ['id'=> 347,'lot_tag_id' => 69,'process_id' => 1,'img' => null],
            ['id'=> 348,'lot_tag_id' => 69,'process_id' => 2,'img' => '64341-741-T8N-T000-H1-DR.png'],
            ['id'=> 349,'lot_tag_id' => 69,'process_id' => 7,'img' => '64341-741-T8N-T000-H1-TR-PI.png'],
            ['id'=> 350,'lot_tag_id' => 69,'process_id' => 5,'img' => '64341-741-T8N-T000-H1-BE-RE.png'],
            ['id'=> 351,'lot_tag_id' => 69,'process_id' => 133,'img' => '64341-741-T8N-T000-H1-C-PI-C-CUT.png'],
            ['id'=> 352,'lot_tag_id' => 69,'process_id' => 91,'img' => '64341-741-T8N-T000-H1-C-PI-C-CUT-SEP.png'],

            ['id'=> 353,'lot_tag_id' => 70,'process_id' => 6,'img' => '66115-155-T2A-A000-H1-RAF-BL.png'],
            ['id'=> 354,'lot_tag_id' => 70,'process_id' => 2,'img' => '66115-155-T2A-A000-H1-DR.png'],
            ['id'=> 355,'lot_tag_id' => 70,'process_id' => 7,'img' => '66115-155-T2A-A000-H1-TR-PI.png'],
            ['id'=> 356,'lot_tag_id' => 70,'process_id' => 8,'img' => '66115-155-T2A-A000-H1-BE-REST.png'],
            ['id'=> 357,'lot_tag_id' => 70,'process_id' => 36,'img' => '66115-155-T2A-A000-H1-PI-C-CUT-C-PI.png'],
            ['id'=> 358,'lot_tag_id' => 70,'process_id' => 91,'img' => '66115-155-T2A-A000-H1-C-PI-C-CUT-SEP.png'],

            ['id'=> 359,'lot_tag_id' => 71,'process_id' => 26,'img' => ''],
            ['id'=> 360,'lot_tag_id' => 71,'process_id' => 41,'img' => ''],
            ['id'=> 361,'lot_tag_id' => 71,'process_id' => 42,'img' => ''],
            ['id'=> 362,'lot_tag_id' => 71,'process_id' => 43,'img' => ''],

            ['id'=> 363,'lot_tag_id' => 72,'process_id' => 1,'img' => ''],
            ['id'=> 364,'lot_tag_id' => 72,'process_id' => 2,'img' => ''],
            ['id'=> 365,'lot_tag_id' => 72,'process_id' => 56,'img' => ''],
            ['id'=> 366,'lot_tag_id' => 72,'process_id' => 128,'img' => ''],
            ['id'=> 367,'lot_tag_id' => 72,'process_id' => 129,'img' => ''],
            ['id'=> 368,'lot_tag_id' => 72,'process_id' => 55,'img' => ''],

            ['id'=> 369,'lot_tag_id' => 73,'process_id' => 6,'img' => null],
            ['id'=> 370,'lot_tag_id' => 73,'process_id' => 15,'img' => '64334-734-TBA-A000-H1-BL-PI.png'],
            ['id'=> 371,'lot_tag_id' => 73,'process_id' => 22,'img' => '64334-734-TBA-A000-H1-FO-BE.png'],
            ['id'=> 372,'lot_tag_id' => 73,'process_id' => 116,'img' => '64334-734-TBA-A000-H1-BE-REST(MARK).png'],
            ['id'=> 373,'lot_tag_id' => 73,'process_id' => 27,'img' => '64334-734-TBA-A000-H1-PI.png'],
            ['id'=> 374,'lot_tag_id' => 73,'process_id' => 117,'img' => '64334-734-TBA-A000-H1-C-PI-SEP.png'],

            ['id'=> 375,'lot_tag_id' => 74,'process_id' => 26,'img' => ''],
            ['id'=> 376,'lot_tag_id' => 74,'process_id' => 41,'img' => ''],
            ['id'=> 377,'lot_tag_id' => 74,'process_id' => 42,'img' => ''],
            ['id'=> 378,'lot_tag_id' => 74,'process_id' => 43,'img' => ''],

            ['id'=> 379,'lot_tag_id' => 75,'process_id' => 118,'img' => ''],
            ['id'=> 380,'lot_tag_id' => 75,'process_id' => 8,'img' => ''],
            ['id'=> 381,'lot_tag_id' => 75,'process_id' => 86,'img' => ''],
            ['id'=> 382,'lot_tag_id' => 75,'process_id' => 18,'img' => ''],

            ['id'=> 383,'lot_tag_id' => 76,'process_id' => 118,'img' => ''],
            ['id'=> 384,'lot_tag_id' => 76,'process_id' => 8,'img' => ''],
            ['id'=> 385,'lot_tag_id' => 76,'process_id' => 86,'img' => ''],
            ['id'=> 386,'lot_tag_id' => 76,'process_id' => 18,'img' => ''],

            ['id'=> 387,'lot_tag_id' => 77,'process_id' => 1,'img' => '64322-722-TBA-A000-H1-BL.png'],
            ['id'=> 388,'lot_tag_id' => 77,'process_id' => 12,'img' => '64322-722-TBA-A000-H1-DRAW.png'],
            ['id'=> 389,'lot_tag_id' => 77,'process_id' => 19,'img' => '64322-722-TBA-A000-H1-TR-PI-SEP.png'],
            ['id'=> 390,'lot_tag_id' => 77,'process_id' => 20,'img' => '64322-722-TBA-A000-H1-BE-REST(ROT).png'],
            ['id'=> 391,'lot_tag_id' => 77,'process_id' => 24,'img' => '64322-722-TBA-A000-H1-PI-CUT.png'],

            ['id'=> 392,'lot_tag_id' => 78,'process_id' => 119,'img' => ''],
            ['id'=> 393,'lot_tag_id' => 78,'process_id' => 120,'img' => ''],
            ['id'=> 394,'lot_tag_id' => 78,'process_id' => 19,'img' => ''],
            ['id'=> 395,'lot_tag_id' => 78,'process_id' => 14,'img' => ''],
            ['id'=> 396,'lot_tag_id' => 78,'process_id' => 24,'img' => ''],

            ['id'=> 397,'lot_tag_id' => 79,'process_id' => 121,'img' => ''],
            ['id'=> 398,'lot_tag_id' => 79,'process_id' => 12,'img' => ''],
            ['id'=> 399,'lot_tag_id' => 79,'process_id' => 122,'img' => ''],
            ['id'=> 400,'lot_tag_id' => 79,'process_id' => 112,'img' => ''],
            ['id'=> 401,'lot_tag_id' => 79,'process_id' => 8,'img' => ''],

            ['id'=> 402,'lot_tag_id' => 80,'process_id' => 123,'img' => null],
            ['id'=> 403,'lot_tag_id' => 80,'process_id' => 12,'img' => '64211-T8N-P001-H1-DRAW.png'],
            ['id'=> 404,'lot_tag_id' => 80,'process_id' => 7,'img' => '64211-T8N-P001-H1-TR-PI.png'],
            ['id'=> 405,'lot_tag_id' => 80,'process_id' => 8,'img' => '64211-T8N-P001-H1-BE(UP-DOWN).png'],
            ['id'=> 406,'lot_tag_id' => 80,'process_id' => 14,'img' => '64211-T8N-P001-H1-PI-C-PI.png'],

            ['id'=> 407,'lot_tag_id' => 81,'process_id' => 26,'img' => '65749-799-TBA-A000-H1-CUT.png'],
            ['id'=> 408,'lot_tag_id' => 81,'process_id' => 41,'img' => ''],
            ['id'=> 409,'lot_tag_id' => 81,'process_id' => 42,'img' => ''],
            ['id'=> 410,'lot_tag_id' => 81,'process_id' => 43,'img' => ''],

            ['id'=> 411,'lot_tag_id' => 82,'process_id' => 2,'img' => ''],
            ['id'=> 412,'lot_tag_id' => 82,'process_id' => 7,'img' => ''],
            ['id'=> 413,'lot_tag_id' => 82,'process_id' => 17,'img' => ''],
            ['id'=> 414,'lot_tag_id' => 82,'process_id' => 27,'img' => ''],

            ['id'=> 415,'lot_tag_id' => 83,'process_id' => 15,'img' => '61561-T8N-T000-H1-BL-PI.png'],
            ['id'=> 416,'lot_tag_id' => 83,'process_id' => 16,'img' => '61561-T8N-T000-H1-FO.png'],
            ['id'=> 417,'lot_tag_id' => 83,'process_id' => 95,'img' => '61561-T8N-T000-H1-REST-MARK.png'],
            ['id'=> 418,'lot_tag_id' => 83,'process_id' => 40,'img' => '61561-T8N-T000-H1-PI-C-PI-CUT.png'],

            ['id'=> 419,'lot_tag_id' => 84,'process_id' => 123,'img' => ''],
            ['id'=> 420,'lot_tag_id' => 84,'process_id' => 12,'img' => ''],
            ['id'=> 421,'lot_tag_id' => 84,'process_id' => 7,'img' => ''],
            ['id'=> 422,'lot_tag_id' => 84,'process_id' => 8,'img' => ''],
            ['id'=> 423,'lot_tag_id' => 84,'process_id' => 14,'img' => ''],

            ['id'=> 424,'lot_tag_id' => 85,'process_id' => 1,'img' => ''],
            ['id'=> 425,'lot_tag_id' => 85,'process_id' => 12,'img' => ''],
            ['id'=> 426,'lot_tag_id' => 85,'process_id' => 7,'img' => ''],
            ['id'=> 427,'lot_tag_id' => 85,'process_id' => 8,'img' => ''],
            ['id'=> 428,'lot_tag_id' => 85,'process_id' => 14,'img' => ''],

            ['id'=> 429,'lot_tag_id' => 86,'process_id' => 1,'img' => ''],
            ['id'=> 430,'lot_tag_id' => 86,'process_id' => 16,'img' => ''],
            ['id'=> 431,'lot_tag_id' => 86,'process_id' => 128,'img' => ''],
            ['id'=> 432,'lot_tag_id' => 86,'process_id' => 14,'img' => ''],

            ['id'=> 433,'lot_tag_id' => 87,'process_id' => 15,'img' => '65193-T7T-M000-H1-BL-PI.png'],
            ['id'=> 434,'lot_tag_id' => 87,'process_id' => 22,'img' => '65193-T7T-M000-H1-FO-BE-1.png'],
            ['id'=> 435,'lot_tag_id' => 87,'process_id' => 92,'img' => '65193-T7T-M000-H1-PI-C-PI-SEP.png'],

            ['id'=> 436,'lot_tag_id' => 88,'process_id' => 1,'img' => ''],
            ['id'=> 437,'lot_tag_id' => 88,'process_id' => 12,'img' => ''],
            ['id'=> 438,'lot_tag_id' => 88,'process_id' => 7,'img' => ''],
            ['id'=> 439,'lot_tag_id' => 88,'process_id' => 8,'img' => ''],
            ['id'=> 440,'lot_tag_id' => 88,'process_id' => 14,'img' => ''],

            ['id'=> 441,'lot_tag_id' => 89,'process_id' => 1,'img' => ''],
            ['id'=> 442,'lot_tag_id' => 89,'process_id' => 12,'img' => ''],
            ['id'=> 443,'lot_tag_id' => 89,'process_id' => 56,'img' => ''],
            ['id'=> 444,'lot_tag_id' => 89,'process_id' => 130,'img' => ''],

            ['id'=> 445,'lot_tag_id' => 90,'process_id' => 1,'img' => null],
            ['id'=> 446,'lot_tag_id' => 90,'process_id' => 2,'img' => '66502-T9A-T000-H1-DR.png'],
            ['id'=> 447,'lot_tag_id' => 90,'process_id' => 52,'img' => '66502-T9A-T000-H1-TRIM-PI-UPR.png'],
            ['id'=> 448,'lot_tag_id' => 90,'process_id' => 131,'img' => '66502-T9A-T000-H1-BE(UP)-BE(DRAW)MARK.png'],
            ['id'=> 449,'lot_tag_id' => 90,'process_id' => 85,'img' => '66502-T9A-T000-H1-PI-C-PI-C-CUT.png'],

            ['id'=> 450,'lot_tag_id' => 91,'process_id' => 1,'img' => null],
            ['id'=> 451,'lot_tag_id' => 91,'process_id' => 2,'img' => '66502-T9A-T500-50-DR.png'],
            ['id'=> 452,'lot_tag_id' => 91,'process_id' => 52,'img' => '66502-T9A-T500-50-TRIM-PI-UPR.png'],
            ['id'=> 453,'lot_tag_id' => 91,'process_id' => 131,'img' => '66502-T9A-T500-50-BE(UP)-BE(DRAW)MARK.png'],
            ['id'=> 454,'lot_tag_id' => 91,'process_id' => 85,'img' => '66502-T9A-T500-50-PI-C-PI-C-CUT.png'],
            ['id'=> 455,'lot_tag_id' => 91,'process_id' => 8,'img' => '66502-T9A-T500-50-BE-REST.png'],
            ['id'=> 456,'lot_tag_id' => 91,'process_id' => 11,'img' => '66502-T9A-T500-50-PI-C-PI-MARK.png'],

            ['id'=> 457,'lot_tag_id' => 92,'process_id' => 114,'img' => '64121-T8N-T000-H1-BL.png'],
            ['id'=> 458,'lot_tag_id' => 92,'process_id' => 12,'img' => '64121-T8N-T000-H1-DRAW.png'],
            ['id'=> 459,'lot_tag_id' => 92,'process_id' => 7,'img' => '64121-T8N-T000-H1-TR-PI.png'],
            ['id'=> 460,'lot_tag_id' => 92,'process_id' => 8,'img' => '64121-T8N-T000-H1-BE-REST.png'],
            ['id'=> 461,'lot_tag_id' => 92,'process_id' => 14,'img' => '64121-T8N-T000-H1-PI-C-PI.png'],

            ['id'=> 462,'lot_tag_id' => 93,'process_id' => 114,'img' => ''],
            ['id'=> 463,'lot_tag_id' => 93,'process_id' => 12,'img' => ''],
            ['id'=> 464,'lot_tag_id' => 93,'process_id' => 7,'img' => ''],
            ['id'=> 465,'lot_tag_id' => 93,'process_id' => 8,'img' => ''],
            ['id'=> 466,'lot_tag_id' => 93,'process_id' => 14,'img' => ''],

            ['id'=> 467,'lot_tag_id' => 94,'process_id' => 15,'img' => ''],
            ['id'=> 468,'lot_tag_id' => 94,'process_id' => 16,'img' => ''],
            ['id'=> 469,'lot_tag_id' => 94,'process_id' => 128,'img' => ''],
            ['id'=> 470,'lot_tag_id' => 94,'process_id' => 132,'img' => ''],
            ['id'=> 471,'lot_tag_id' => 94,'process_id' => 47,'img' => ''],

            ['id'=> 472,'lot_tag_id' => 95,'process_id' => 15,'img' => ''],
            ['id'=> 473,'lot_tag_id' => 95,'process_id' => 16,'img' => ''],
            ['id'=> 474,'lot_tag_id' => 95,'process_id' => 128,'img' => ''],
            ['id'=> 475,'lot_tag_id' => 95,'process_id' => 132,'img' => ''],
            ['id'=> 476,'lot_tag_id' => 95,'process_id' => 47,'img' => ''],

            ['id'=> 477,'lot_tag_id' => 96,'process_id' => 15,'img' => ''],
            ['id'=> 478,'lot_tag_id' => 96,'process_id' => 16,'img' => ''],
            ['id'=> 479,'lot_tag_id' => 96,'process_id' => 128,'img' => ''],
            ['id'=> 480,'lot_tag_id' => 96,'process_id' => 132,'img' => ''],
            ['id'=> 481,'lot_tag_id' => 96,'process_id' => 47,'img' => ''],

            ['id'=> 482,'lot_tag_id' => 97,'process_id' => 15,'img' => ''],
            ['id'=> 483,'lot_tag_id' => 97,'process_id' => 16,'img' => ''],
            ['id'=> 484,'lot_tag_id' => 97,'process_id' => 128,'img' => ''],
            ['id'=> 485,'lot_tag_id' => 97,'process_id' => 132,'img' => ''],
            ['id'=> 486,'lot_tag_id' => 97,'process_id' => 47,'img' => ''],

            ['id'=> 487,'lot_tag_id' => 98,'process_id' => 15,'img' => ''],
            ['id'=> 488,'lot_tag_id' => 98,'process_id' => 22,'img' => ''],
            ['id'=> 489,'lot_tag_id' => 98,'process_id' => 128,'img' => ''],
            ['id'=> 490,'lot_tag_id' => 98,'process_id' => 134,'img' => ''],

            ['id'=> 495,'lot_tag_id' => 99,'process_id' => 15,'img' => ''],
            ['id'=> 496,'lot_tag_id' => 99,'process_id' => 22,'img' => ''],
            ['id'=> 497,'lot_tag_id' => 99,'process_id' => 128,'img' => ''],
            ['id'=> 498,'lot_tag_id' => 99,'process_id' => 134,'img' => ''],

            ['id'=> 499,'lot_tag_id' => 100,'process_id' => 1,'img' => ''],
            ['id'=> 500,'lot_tag_id' => 100,'process_id' => 16,'img' => ''],
            ['id'=> 501,'lot_tag_id' => 100,'process_id' => 128,'img' => ''],
            ['id'=> 502,'lot_tag_id' => 100,'process_id' => 14,'img' => ''],

            ['id'=> 503,'lot_tag_id' => 101,'process_id' => 6,'img' => null],
            ['id'=> 504,'lot_tag_id' => 101,'process_id' => 12,'img' => '64212-T8N-P000-H1-DRAW.png'],
            ['id'=> 505,'lot_tag_id' => 101,'process_id' => 7,'img' => '64212-T8N-P000-H1-TR-PI.png'],
            ['id'=> 506,'lot_tag_id' => 101,'process_id' => 86,'img' => '64212-T8N-P000-H1-BE.png'],
            ['id'=> 507,'lot_tag_id' => 101,'process_id' => 14,'img' => '64212-T8N-P000-H1-PI-C-PI.png'],

            ['id'=> 508,'lot_tag_id' => 102,'process_id' => 6,'img' => '64612-T8N-T000-H1-RAF-BL.png'],
            ['id'=> 509,'lot_tag_id' => 102,'process_id' => 12,'img' => '64612-T8N-T000-H1-DRAW.png'],
            ['id'=> 510,'lot_tag_id' => 102,'process_id' => 7,'img' => '64612-T8N-T000-H1-TR-PI.png'],
            ['id'=> 511,'lot_tag_id' => 102,'process_id' => 86,'img' => '64612-T8N-T000-H1-BE.png'],
            ['id'=> 512,'lot_tag_id' => 102,'process_id' => 14,'img' => '64612-T8N-T000-H1-PI-C-PI.png'],

            ['id'=> 513,'lot_tag_id' => 103,'process_id' => 15,'img' => '61142-T8N-T000-50-BL-PI.png'],
            ['id'=> 514,'lot_tag_id' => 103,'process_id' => 16,'img' => '61142-T8N-T000-50-FO.png'],
            ['id'=> 515,'lot_tag_id' => 103,'process_id' => 8,'img' => '61142-T8N-T000-50-BE-REST.png'],
            ['id'=> 516,'lot_tag_id' => 103,'process_id' => 24,'img' => '61142-T8N-T000-50-PI-CUT.png'],
            ['id'=> 517,'lot_tag_id' => 103,'process_id' => 27,'img' => '61142-T8N-T000-50-PI.png'],

            ['id'=> 518,'lot_tag_id' => 104,'process_id' => 1,'img' => null],
            ['id'=> 519,'lot_tag_id' => 104,'process_id' => 12,'img' => '65165-T9A-Y000-H1-DRAW.png'],
            ['id'=> 520,'lot_tag_id' => 104,'process_id' => 48,'img' => '65165-T9A-Y000-H1-TRIM.png'],
            ['id'=> 521,'lot_tag_id' => 104,'process_id' => 5,'img' => '65165-T9A-Y000-H1-BE-RE.png'],
            ['id'=> 522,'lot_tag_id' => 104,'process_id' => 100,'img' => '65165-T9A-Y000-H1-PI-C-CUT.png'],
            ['id'=> 523,'lot_tag_id' => 104,'process_id' => 135,'img' => '65165-T9A-Y000-H1-PI-CUT-MARK.png'],

            ['id'=> 524,'lot_tag_id' => 105,'process_id' => 1,'img' => null],
            ['id'=> 525,'lot_tag_id' => 105,'process_id' => 2,'img' => '65165-T5H-H000-50-DR.png'],
            ['id'=> 526,'lot_tag_id' => 105,'process_id' => 56,'img' => '65165-T5H-H000-50-TR.png'],
            ['id'=> 527,'lot_tag_id' => 105,'process_id' => 128,'img' => '65165-T5H-H000-50-BR-REST.png'],
            ['id'=> 528,'lot_tag_id' => 105,'process_id' => 100,'img' => '65165-T5H-H000-50-PI-C-CUT.png'],
            ['id'=> 529,'lot_tag_id' => 105,'process_id' => 135,'img' => '65165-T5H-H000-50-PI-CUT-MARK.png'],

            ['id'=> 530,'lot_tag_id' => 106,'process_id' => 1,'img' => null],
            ['id'=> 531,'lot_tag_id' => 106,'process_id' => 2,'img' => '65165-T5L-T000-50-DR.png'],
            ['id'=> 532,'lot_tag_id' => 106,'process_id' => 56,'img' => '65165-T5L-T000-50-TR.png'],
            ['id'=> 533,'lot_tag_id' => 106,'process_id' => 128,'img' => '65165-T5L-T000-50-BR-REST.png'],
            ['id'=> 534,'lot_tag_id' => 106,'process_id' => 100,'img' => '65165-T5L-T000-50-PI-C-CUT.png'],
            ['id'=> 535,'lot_tag_id' => 106,'process_id' => 135,'img' => '65165-T5L-T000-50-PI-CUT-MARK.png'],

            ['id'=> 536,'lot_tag_id' => 107,'process_id' => 1,'img' => null],
            ['id'=> 537,'lot_tag_id' => 107,'process_id' => 2,'img' => '63121-T5L-T000-H1-DR.png'],
            ['id'=> 538,'lot_tag_id' => 107,'process_id' => 136,'img' => '63121-T5L-T000-H1-TR-PI(TR-RAF).png'],
            ['id'=> 539,'lot_tag_id' => 107,'process_id' => 137,'img' => '63121-T5L-T000-H1-C-PI-C-CUT.png'],
            ['id'=> 540,'lot_tag_id' => 107,'process_id' => 133,'img' => '63121-T5L-T000-H1-C-PI-C-CUT-1.png'],
            ['id'=> 541,'lot_tag_id' => 107,'process_id' => 23,'img' => '63121-T5L-T000-H1-REST.png'],

            ['id'=> 542,'lot_tag_id' => 108,'process_id' => 1,'img' => null],
            ['id'=> 543,'lot_tag_id' => 108,'process_id' => 2,'img' => '66117-157-T9A-T000-H1-DR.png'],
            ['id'=> 544,'lot_tag_id' => 108,'process_id' => 7,'img' => '66117-157-T9A-T000-H1-TR-PI.png'],
            ['id'=> 545,'lot_tag_id' => 108,'process_id' => 106,'img' => '66117-157-T9A-T000-H1-PI-C-PI-C-CUT-SEP.png'],
            ['id'=> 546,'lot_tag_id' => 108,'process_id' => 138,'img' => '66117-157-T9A-T000-H1-BE-RST.png'],

            ['id'=> 547,'lot_tag_id' => 109,'process_id' => 15,'img' => '63223-623-T9A-T000-H1-BL-PI.png'],
            ['id'=> 548,'lot_tag_id' => 109,'process_id' => 22,'img' => '63223-623-T9A-T000-H1-FO-BE.png'],
            ['id'=> 549,'lot_tag_id' => 109,'process_id' => 8,'img' => '63223-623-T9A-T000-H1-BE-REST.png'],
            ['id'=> 550,'lot_tag_id' => 109,'process_id' => 27,'img' => '63223-623-T9A-T000-H1-PI.png'],
            ['id'=> 551,'lot_tag_id' => 109,'process_id' => 18,'img' => '63223-623-T9A-T000-H1-PI-SEP.png'],

            ['id'=> 552,'lot_tag_id' => 110,'process_id' => 15,'img' => ''],
            ['id'=> 553,'lot_tag_id' => 110,'process_id' => 16,'img' => ''],
            ['id'=> 554,'lot_tag_id' => 110,'process_id' => 139,'img' => ''],
            ['id'=> 555,'lot_tag_id' => 110,'process_id' => 140,'img' => ''],
            ['id'=> 556,'lot_tag_id' => 110,'process_id' => 27,'img' => ''],

            ['id'=> 557,'lot_tag_id' => 111,'process_id' => 15,'img' => ''],
            ['id'=> 558,'lot_tag_id' => 111,'process_id' => 141,'img' => ''],
            ['id'=> 559,'lot_tag_id' => 111,'process_id' => 142,'img' => ''],

            ['id'=> 560,'lot_tag_id' => 112,'process_id' => 1,'img' => ''],
            ['id'=> 561,'lot_tag_id' => 112,'process_id' => 2,'img' => ''],
            ['id'=> 562,'lot_tag_id' => 112,'process_id' => 7,'img' => ''],
            ['id'=> 563,'lot_tag_id' => 112,'process_id' => 26,'img' => ''],
            ['id'=> 564,'lot_tag_id' => 112,'process_id' => 27,'img' => ''],
            ['id'=> 565,'lot_tag_id' => 112,'process_id' => 143,'img' => ''],

            ['id'=> 566,'lot_tag_id' => 113,'process_id' => 15,'img' => '61553-TOA-3000-BL-PI.png'],
            ['id'=> 567,'lot_tag_id' => 113,'process_id' => 144,'img' => '61553-TOA-3000-FO-BRE.png'],
            ['id'=> 568,'lot_tag_id' => 113,'process_id' => 5,'img' => '61553-TOA-3000-BE-RE.png'],
            ['id'=> 569,'lot_tag_id' => 113,'process_id' => 24,'img' => '61553-TOA-3000-PI-CUT.png'],

            ['id'=> 570,'lot_tag_id' => 114,'process_id' => 1,'img' => null],
            ['id'=> 571,'lot_tag_id' => 114,'process_id' => 2,'img' => '61111-TG1-P000-50-DR.png'],
            ['id'=> 572,'lot_tag_id' => 114,'process_id' => 3,'img' => '61111-TG1-P000-50-TRIM-PI.png'],
            ['id'=> 573,'lot_tag_id' => 114,'process_id' => 4,'img' => '61111-TG1-P000-50-CUT-C-CUT.png'],
            ['id'=> 574,'lot_tag_id' => 114,'process_id' => 5,'img' => '61111-TG1-P000-50-BE-RE.png'],

            ['id'=> 575,'lot_tag_id' => 115,'process_id' => 2,'img' => ''],
            ['id'=> 576,'lot_tag_id' => 115,'process_id' => 7,'img' => ''],
            ['id'=> 577,'lot_tag_id' => 115,'process_id' => 13,'img' => ''],
            ['id'=> 578,'lot_tag_id' => 115,'process_id' => 76,'img' => ''],

            ['id'=> 579,'lot_tag_id' => 116,'process_id' => 15,'img' => ''],
            ['id'=> 580,'lot_tag_id' => 116,'process_id' => 16,'img' => ''],
            ['id'=> 581,'lot_tag_id' => 116,'process_id' => 23,'img' => ''],
            ['id'=> 582,'lot_tag_id' => 116,'process_id' => 27,'img' => ''],

            ['id'=> 583,'lot_tag_id' => 117,'process_id' => 15,'img' => '65751-TMH-T001-H1-BL-PI.png'],
            ['id'=> 584,'lot_tag_id' => 117,'process_id' => 16,'img' => '65751-TMH-T001-H1-FO.png'],
            ['id'=> 585,'lot_tag_id' => 117,'process_id' => 23,'img' => '65751-TMH-T001-H1-REST.png'],
            ['id'=> 586,'lot_tag_id' => 117,'process_id' => 27,'img' => '65751-TMH-T001-H1-PI.png'],

            ['id'=> 587,'lot_tag_id' => 118,'process_id' => 2,'img' => '64312-712-T9A-T000-H1-DR.png'],
            ['id'=> 588,'lot_tag_id' => 118,'process_id' => 7,'img' => '64312-712-T9A-T000-H1-TR-PI.png'],
            ['id'=> 589,'lot_tag_id' => 118,'process_id' => 92,'img' => '64312-712-T9A-T000-H1-PI-C-PI-SEP.png'],
            ['id'=> 590,'lot_tag_id' => 118,'process_id' => 145,'img' => '64312-712-T9A-T000-H1-RE-REST.png'],

            ['id'=> 591,'lot_tag_id' => 119,'process_id' => 1,'img' => null],
            ['id'=> 592,'lot_tag_id' => 119,'process_id' => 2,'img' => '65165-T9A-X000-H1-DR.png'],
            ['id'=> 593,'lot_tag_id' => 119,'process_id' => 56,'img' => '65165-T9A-X000-H1-TR.png'],
            ['id'=> 594,'lot_tag_id' => 119,'process_id' => 5,'img' => '65165-T9A-X000-H1-BE-RE.png'],
            ['id'=> 595,'lot_tag_id' => 119,'process_id' => 100,'img' => '65165-T9A-X000-H1-PI-C-CUT.png'],
            ['id'=> 596,'lot_tag_id' => 119,'process_id' => 47,'img' => '65165-T9A-X000-H1-PI-MARK.png'],
            ['id'=> 597,'lot_tag_id' => 119,'process_id' => 147,'img'=> null],

            ['id'=> 598,'lot_tag_id' => 120,'process_id' => 15,'img' => '61551-T5H-H000-50-BL-PI.png'],
            ['id'=> 599,'lot_tag_id' => 120,'process_id' => 2,'img' => '61551-T5H-H000-50-DR.png'],
            ['id'=> 600,'lot_tag_id' => 120,'process_id' => 7,'img' => '61551-T5H-H000-50-TR-PI.png'],
            ['id'=> 601,'lot_tag_id' => 120,'process_id' => 147,'img' => '61551-T5H-H000-50-REST-C-PI.png'],
            ['id'=> 602,'lot_tag_id' => 120,'process_id' => 148,'img' => '61551-T5H-H000-50-PI-C-CUT.png'],

            ['id'=> 603,'lot_tag_id' => 121,'process_id' => 1,'img' => null],
            ['id'=> 604,'lot_tag_id' => 121,'process_id' => 2,'img' => '66112-T5A-3003-DR.png'],
            ['id'=> 605,'lot_tag_id' => 121,'process_id' => 150,'img' => '66112-T5A-3003-TR-C-PI.png'],
            ['id'=> 606,'lot_tag_id' => 121,'process_id' => 151,'img' =>'66112-T5A-3003-TR-PI-C-PI.png'],
            ['id'=> 607,'lot_tag_id' => 121,'process_id' => 152,'img' => '66112-T5A-3003-BE(UP)-BE(DOWN).png'],
            ['id'=> 608,'lot_tag_id' => 121,'process_id' => 153,'img' => '66112-T5A-3003-C-CUT-PI-C-MARK.png'],

            ['id'=> 609,'lot_tag_id' => 122,'process_id' => 1,'img' => null],
            ['id'=> 610,'lot_tag_id' => 122,'process_id' => 2,'img' => '65117-167-T5A-3000-DR.png'],
            ['id'=> 611,'lot_tag_id' => 122,'process_id' => 7,'img' => '65117-167-T5A-3000-TR-PI.png'],
            ['id'=> 612,'lot_tag_id' => 122,'process_id' => 154,'img' => '65117-167-T5A-3000-PI-CUT-C-PI-C-CUT.png'],
            ['id'=> 613,'lot_tag_id' => 122,'process_id' => 85,'img' => '65117-167-T5A-3000-PI-C-PI-C-CUT.png'],
            ['id'=> 614,'lot_tag_id' => 122,'process_id' => 155,'img' => '65117-167-T5A-3000-C-BE-C-RST-RST-SEP.png']);
            
            foreach($list as $key => $l){
                $public_path_img = public_path().'/images';
                $storage_path_img = storage_path().'/img_mater';
                $id_img = null;
                if($l['img']){
                    Image::configure(array('driver' => 'gd'));
                    $img = Image::make($storage_path_img.'/'.$l['img']);
                    $img->backup();
                    $img->save($public_path_img.'/'.$l['img'],75)->reset();
                    $mime = mime_content_type($public_path_img.'/'.$l['img']);
                    $size = filesize($public_path_img.'/'.$l['img']);

                    $id_img = DB::table('file')->insertGetId([
                        'originalName' => $l['img'],
                        'mimeType' => $mime,
                        'size' => $size,
                        'hashName' => null,
                        'created_by' => 1,
                        'created_at' => date('Y-m-d h:i:s')
                    ]);
                }
            DB::table('lot_tag_process_file')->insert([
                'id' => $l['id'],
                'file_id' => $id_img,
                'lot_tag_id' => $l['lot_tag_id'],
                'process_id' => $l['process_id'],
                'created_by' => 1,
                'created_at' => date('Y-m-d h:i:s')
            ]);
        }
    }
       
}
