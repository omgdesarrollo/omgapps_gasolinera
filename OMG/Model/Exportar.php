<?php

class Exportar {

     public static function data()
    {
//         $datos
        $users = [
            ["id" => 1, "username" => "iparra", "created_at" => date("Y-m-d")],
            ["id" => 2, "username" => "juan", "created_at" => date("Y-m-d")],
            ["id" => 3, "username" => "andrés", "created_at" => date("Y-m-d")],
            ["id" => 4, "username" => "luís", "created_at" => date("Y-m-d")]
        ];
         
        return $users;
    }
    public static function toExcel()
    {
     
        $array = Exportar::data();

        if (count($array) == 0) {
            throw new Exception("Array cannot be empty");
        }

        $headers = ''; // just creating the var for field headers to append to below
        $data = ''; // just creating the var for field data to append to below

        foreach (array_keys($array[0]) as $columns)
        {
            $headers.=$columns. "\t";
        }

        foreach ($array as $row) {
            $line = '';

            foreach ($row as $key => $value)
            {
                if ((!isset($value)) OR ($value == "")) {
                    $value = "\t";
                } else {
                    $value = str_replace('"', '""', $value);
                    $value = '"' . $value . '"' . "\t";
                }
                $line .= $value;
            }
            $data .= trim($line) . "\n";
        }

        $data = str_replace("\r", "", $data);

        header("Content-type: application/x-msdownload");
        header("Content-Disposition: attachment; filename=data_" . date('d-m-Y') . ".xls");
        return mb_convert_encoding("$headers\n$data", 'utf-16', 'utf-8');
    }


    public static function toXml()
    {
        $array = Exportar::data();

        if (count($array) == 0) {
            throw new Exception("Array cannot be empty");
        }

        $xml = new SimpleXMLElement('<xml/>');
        $track = $xml->addChild('users');
        foreach ($array as $key => $value)
        {
            $track->addChild('user');
            foreach($value as $k => $v)
            {
                $track->addChild($k, $v);
            }
        }
        header("Content-disposition: attachment; filename=data_" . date('d-m-Y') . ".xml");
        header('Content-type: "text/xml"; charset="utf8"');
        return $xml->asXML();
    }
    private static function headers($filename, $now)
    {
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
//        header("Content-Transfer-Encoding: binary");
    }
}
