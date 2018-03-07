<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcessTableSeeder extends Seeder
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
            ['id' => 1,'name' => 'BL'],
            ['id' => 2,'name' => 'DR'],
            ['id' => 3,'name' => 'TRIM-PI'],
            ['id' => 4,'name' => 'CUT-C/CUT'],
            ['id' => 5,'name' => 'BE-RE'],
            ['id' => 6,'name' => 'RAF-BL'],
            ['id' => 7,'name' => 'TR-PI'],
            ['id' => 8,'name' => 'BE-REST'],
            ['id' => 9,'name' => 'C/REST'],
            ['id' => 10,'name' => 'PI-C/PI-C-CUT-BUK'],
            ['id' => 11,'name' => 'PI-C/PI-MARK'],
            ['id' => 12,'name' => 'DRAW'],
            ['id' => 13,'name' => 'BE-REST-MARK'],
            ['id' => 14,'name' => 'PI-C/PI'],
            ['id' => 15,'name' => 'BL-PI'],
            ['id' => 16,'name' => 'FO'],
            ['id' => 17,'name' => 'BE-RE-MARK'],
            ['id' => 18,'name' => 'PI-SEP'],
            ['id' => 19,'name' => 'TR-PI-SEP'],
            ['id' => 20,'name' => 'BE-REST(ROT)'],
            ['id' => 21,'name' => 'PI CUT'],
            ['id' => 22,'name' => 'FO-BE'],
            ['id' => 23,'name' => 'REST'],
            ['id' => 24,'name' => 'PI-CUT'],
            ['id' => 25,'name' => 'FO-MARK'],
            ['id' => 26,'name' => 'CUT'],
            ['id' => 27,'name' => 'PI'],
            ['id' => 28,'name' => 'DR#1'],
            ['id' => 29,'name' => 'DR#2'],
            ['id' => 30,'name' => 'DR#3'],
            ['id' => 31,'name' => 'CUT-C/CUT-C/P11'],
            ['id' => 32,'name' => 'CUT-C/CUT-C/P12'],
            ['id' => 33,'name' => 'C/P1-C/CUT-SEP-MARK'],
            ['id' => 34,'name' => 'BE-C-REST'],
            ['id' => 35,'name' => 'CUT-PI-C/C/REST'],
            ['id' => 36,'name' => 'PI-C/CUT-C/PI'],
            ['id' => 37,'name' => 'C/PI-C/CUT-C-BE'],
            ['id' => 38,'name' => 'C-REST'],
            ['id' => 39,'name' => 'FO-BE-UP-DOWN-MARK'],
            ['id' => 40,'name' => 'PI-C/PI-CUT'],
            ['id' => 41,'name' => 'BE-1'],
            ['id' => 42,'name' => 'BE-2'],
            ['id' => 43,'name' => 'BE-3'],
            ['id' => 44,'name' => 'BL-MARK'],
            ['id' => 45,'name' => 'BUR-REST'],
            ['id' => 46,'name' => 'PRG'],
            ['id' => 47,'name' => 'PI-MARK'],
            ['id' => 48,'name' => 'TRIM'],
            ['id' => 49,'name' => 'BE-REST-BUR'],
            ['id' => 50,'name' => 'PI-BE-REST'],
            ['id' => 51,'name' => 'C/SEP-PI(SECE1)MARK'],
            ['id' => 52,'name' => 'TRIM-PI-UPR'],
            ['id' => 53,'name' => 'BE(UP)-BE(DOEW)/MARK'],
            ['id' => 54,'name' => 'FO-BE-UP-DOWN'],
            ['id' => 55,'name' => 'C/BE-C/PI'],
            ['id' => 56,'name' => 'TR'],
            ['id' => 57,'name' => 'TR(ROT)-BE'],
            ['id' => 58,'name' => 'BL-PI-MARK'],
            ['id' => 59,'name' => 'PI-CUT-SEP'],
            ['id' => 60,'name' => 'NUT SUQARE WELD 8 MM.'],
            ['id' => 61,'name' => 'NUT SQ WELD 8 MM.'],
            ['id' => 62,'name' => 'NUT PLATE 7/16'],
            ['id' => 63,'name' => 'NUT PLATE 10 MM.'],
            ['id' => 64,'name' => 'NUT SQ. 6 MM'],
            ['id' => 65,'name' => 'NUT HEX M.8'],
            ['id' => 66,'name' => 'NUT SQ M.6'],
            ['id' => 67,'name' => 'SQYARE 8 MM.'],
            ['id' => 68,'name' => 'NUT SQ. M.5'],
            ['id' => 69,'name' => 'WELDING'],
            ['id' => 70,'name' => 'BOLT WELDING 6 MM.'],
            ['id' => 71,'name' => 'BOLT WEL. 6*20'],
            ['id' => 72,'name' => 'WELDING SPOT 2 POINT'],
            ['id' => 73,'name' => 'BE-2-MARK'],
            ['id' => 74,'name' => 'RE-BART'],
            ['id' => 75,'name' => 'BEND'],
            ['id' => 76,'name' => 'PI-CAM-REST'],
            ['id' => 77,'name' => 'BE1-MARK'],
            ['id' => 78,'name' => 'FL-REST-MARK'],
            ['id' => 79,'name' => 'FO-BE-MARK'],
            ['id' => 80,'name' => 'FO(ROUGH)'],
            ['id' => 81,'name' => 'FO-BE(DOWE)-PI'],
            ['id' => 82,'name' => 'BE(UP)'],
            ['id' => 83,'name' => 'BE(UP-DOWR)']
            );

            foreach($list as $key => $l){
                DB::table('lkup_process')->insert([
                    'id' => $l['id'],
                    'name' => $l['name'],
                    'created_by' => 1,
                    'is_enable' => 'Y',
                    'created_at' => date('Y-m-d h:i:s')
                ]);
            }
    }
}
