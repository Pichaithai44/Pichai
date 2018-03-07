<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role_id' => '1',
            'is_enable' => 'Y',
        ]);
    }
}
    // $list = array(
    //     [
    //         'part_no'=> '63722-TET-HOOO-50',
    //         'part_name'=> 'ADPE L RR COMBI',
    //         'model_id'=> 1,
    //         'type_id'=> 1,
    //         'material_id'=> 1,
    //         'material_t'=> '0.6',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '63322-TET-HOOO-50',
    //         'part_name'=> 'ADPT R RR COMBI',
    //         'model_id'=> 1,
    //         'type_id'=> 1,
    //         'material_id'=> 1,
    //         'material_t'=> '0.6',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65685-TBA-AOOO-H1',
    //         'part_name'=> 'BRKT L FUEL TANK',
    //         'model_id'=> 1,
    //         'type_id'=> 2,
    //         'material_id'=> 2,
    //         'material_t'=> '2.3',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '61522-TBA-AOOO-H1',
    //         'part_name'=> 'C/MBR R DA/BD LWR',
    //         'model_id'=> 2,
    //         'type_id'=> 2,
    //         'material_id'=> 3,
    //         'material_t'=> '1.6',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65667-TEA-TOOO-H1',
    //         'part_name'=> 'OUTRIGGER L RR FRM SIDE',
    //         'model_id'=> 1,
    //         'type_id'=> 3,
    //         'material_id'=> 4,
    //         'material_t'=> '0.7',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65617-TEA-TOOO-H1',
    //         'part_name'=> 'OUTRIGGER R RR FRM SIDE',
    //         'model_id'=> 1,
    //         'type_id'=> 3,
    //         'material_id'=> 4,
    //         'material_t'=> '0.7',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65667-TEZ-YOOO-H1',
    //         'part_name'=> 'OUTRIGGER L RR FRM SIDE',
    //         'model_id'=> 3,
    //         'type_id'=> 4,
    //         'material_id'=> 3,
    //         'material_t'=> '0.7',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65617-TEZ-YOOO-H1',
    //         'part_name'=> 'OUTRIGGER R RR FRM SIDE',
    //         'model_id'=> 3,
    //         'type_id'=> 4,
    //         'material_id'=> 5,
    //         'material_t'=> '0.7',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65776-TEA-TOOO-H1',
    //         'part_name'=> 'ANCHOR L RR SEAT BELT',
    //         'model_id'=> 1,
    //         'type_id'=> 3,
    //         'material_id'=> 6,
    //         'material_t'=> '1.4',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65726-TEA-TOOO-H1',
    //         'part_name'=> 'ANCHOR R RR SEAT BELT',
    //         'model_id'=> 1,
    //         'type_id'=> 3,
    //         'material_id'=> 6,
    //         'material_t'=> '1.4',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65776-TET-HOOO-H1',
    //         'part_name'=> 'ANCHOR L RR SEAT BELT',
    //         'model_id'=> 1,
    //         'type_id'=> 1,
    //         'material_id'=> 6,
    //         'material_t'=> '1.4',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65726-TET-HOOO-H1',
    //         'part_name'=> 'ANCHOR R RR SEAT BELT',
    //         'model_id'=> 1,
    //         'type_id'=> 1,
    //         'material_id'=> 6,
    //         'material_t'=> '1.4',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65776-TGG-AOOO-H1',
    //         'part_name'=> 'ANCHOR L RR SEAT BELT',
    //         'model_id'=> 1,
    //         'type_id'=> 2,
    //         'material_id'=> 7,
    //         'material_t'=> '1.4',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65726-TGG-AOOO-H1',
    //         'part_name'=> 'ANCHOR R RR SEAT BELT',
    //         'model_id'=> 1,
    //         'type_id'=> 2,
    //         'material_id'=> 8,
    //         'material_t'=> '1.4',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65683-TEA-TOOO-H1',
    //         'part_name'=> 'BRKT L RR SUB FRAME',
    //         'model_id'=> 1,
    //         'type_id'=> 3,
    //         'material_id'=> 9,
    //         'material_t'=> '1.6',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65633-TEA-TOOO-H1',
    //         'part_name'=> 'BRKT R RR SUB FRAME',
    //         'model_id'=> 1,
    //         'type_id'=> 3,
    //         'material_id'=> 9,
    //         'material_t'=> '1.6',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65669-TEZ-YOOO-H1',
    //         'part_name'=> 'BRKT L BPR BEAM',
    //         'model_id'=> 3,
    //         'type_id'=> 4,
    //         'material_id'=> 10,
    //         'material_t'=> '2.0',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65619-TEZ-YOOO-H1',
    //         'part_name'=> 'BRKT R RR BPR BEAM',
    //         'model_id'=> 3,
    //         'type_id'=> 4,
    //         'material_id'=> 10,
    //         'material_t'=> '2.0',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65674-TBA-AOOO-H1',
    //         'part_name'=> 'BRKT L TRG ARM',
    //         'model_id'=> 1,
    //         'type_id'=> 2,
    //         'material_id'=> 11,
    //         'material_t'=> '1.0',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65624-TBA-AOOO-H1',
    //         'part_name'=> 'BRKT R TRG ARM',
    //         'model_id'=> 1,
    //         'type_id'=> 2,
    //         'material_id'=> 11,
    //         'material_t'=> '1.0',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '64336/736-TEA-TOO1-H1',
    //         'part_name'=> 'GST R/L RR SHELH RR',
    //         'model_id'=> 1,
    //         'type_id'=> 3,
    //         'material_id'=> 4,
    //         'material_t'=> '0.8',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65518-TBA-AOOO-H1',
    //         'part_name'=> 'ROD CHILD ANCHOR',
    //         'model_id'=> 1,
    //         'type_id'=> 2,
    //         'material_id'=> 12,
    //         'material_t'=> '',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '01',
    //         'rev_date'=> '15/8/2014'
    //     ],
    //     [
    //         'part_no'=> '64735-TEA-TOOO-H1',
    //         'part_name'=> 'GST L SHELF FR',
    //         'model_id'=> 1,
    //         'type_id'=> 3,
    //         'material_id'=> 13,
    //         'material_t'=> '0.6',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '64335-TEA-TOOO-H1',
    //         'part_name'=> 'GST R SHELF FR',
    //         'model_id'=> 1,
    //         'type_id'=> 3,
    //         'material_id'=> 13,
    //         'material_t'=> '0.6',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65687-TEA-TOOO-H1',
    //         'part_name'=> 'BRKT B L R RR SUB FRAME',
    //         'model_id'=> 1,
    //         'type_id'=> 3,
    //         'material_id'=> 3,
    //         'material_t'=> '2.0',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65637-TEA-TOOO-H1',
    //         'part_name'=> 'BRKT B R R RR SUB FRAME',
    //         'model_id'=> 1,
    //         'type_id'=> 3,
    //         'material_id'=> 3,
    //         'material_t'=> '2.0',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65736-TEX-YOO1-H1',
    //         'part_name'=> 'PIOVT RR SEAT',
    //         'model_id'=> 1,
    //         'type_id'=> 4,
    //         'material_id'=> 14,
    //         'material_t'=> '1.4',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65633/683-TEA-TOOO-H1',
    //         'part_name'=> 'BRKT R/L RR SUB FRAME',
    //         'model_id'=> 1,
    //         'type_id'=> 3,
    //         'material_id'=> 9,
    //         'material_t'=> '1.6',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '61524-TEA-TOOO-H1',
    //         'part_name'=> 'STIFF R DA/BD L WR TUNNEL',
    //         'model_id'=> 1,
    //         'type_id'=> 3,
    //         'material_id'=> 15,
    //         'material_t'=> '1.2',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '61522-TET-HOOO-H1',
    //         'part_name'=> 'C/MBR R DA/BD LWR',
    //         'model_id'=> 1,
    //         'type_id'=> 1,
    //         'material_id'=> 4,
    //         'material_t'=> '1.6',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],
    //     [
    //         'part_no'=> '65624-TBA-AOOO-H1',
    //         'part_name'=> 'BRKT R TRG ARM',
    //         'model_id'=> 1,
    //         'type_id'=> 2,
    //         'material_id'=> 11,
    //         'material_t'=> '1.0',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'
    //     ],  
    //     [
    //         'part_no'=> '65688-TEA-TOOO-H1',
    //         'part_name'=> 'BRKT C L RR SUB FRAME',
    //         'model_id'=> 1,
    //         'type_id'=> 2,
    //         'material_id'=> 11,
    //         'material_t'=> '2.3',
    //         'refer'=> 'FM-QA-33',
    //         'rev'=> '02',
    //         'rev_date'=> '20/12/2017'//345 จบ
    //     ],
        
       
    
