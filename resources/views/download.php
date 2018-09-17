<?php
/**
 * Created by PhpStorm.
 * User: jypin
 * Date: 11/01/2018
 * Time: 12:39 AM
 */
Excel::create('Export_data_報表', function($excel) {

    $excel->sheet('Sheet 1', function($sheet) {

        //$startDay = session('dtp_input_start');
        //$endDay = session('dtp_input_end');


        $products = DB::table('package')
            ->join('student', 'package.NAME', '=', 'student.NAME')
            ->select('package.*', 'student.UNIT')
            ->get();

        foreach($products as $product) {
            $data[] = array(

                $product->NAME,
                $product->UNIT,
                $product->TYPE,
                $product->RECEIEVE_DATE,
                $product->PLACE,
                $product->STATE,
            );
        }

        $sheet->fromArray($data, null, 'A1', false, false);
        $headings = array('名字', '系所', '類型', '收件時間', '地點',
            '收件人取貨時間',);

        $sheet->prependRow(1, $headings);
    });

})->download('xlsx');

?>