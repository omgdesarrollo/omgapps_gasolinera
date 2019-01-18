<?php
require_once '../dao/ConsultasDAO.php';

class ConsultasModel{
    
    public function listarConsultas($CONTRATO)
    {
        try
        {
            date_default_timezone_set("America/Mexico_city");
            $dao=new ConsultasDAO();
            $lista= $dao->listarConsultas($CONTRATO);
            // var_dump($lista);
            $hoy = new Datetime();
	        $al = strftime("%d - %B - %y");
            $hoy = new Datetime($al);
            foreach($lista as $key=>$value)
            {
                // $dias = 0;
                // if($value["fecha_inicio"] != "0000-00-00")
                // {
                    $fecha_inicio = new Datetime($value["fecha_inicio"]);
                    // var_dump($fecha_inicio);
                    $frecuencia = $value["frecuencia"];
                    if($frecuencia == "DIARIO")
                    {
                        $dias = strtotime(strftime("%d-%B-%y",$hoy -> getTimestamp())) - strtotime(strftime("%d-%B-%y",$fecha_inicio -> getTimestamp()));
                        $diario = $dias / 86400;
                        // $lista[$key]["CANTIDAD_REALIZAR"] = $year;
                        $lista[$key]["evidencias_realizar"] = $diario+1;
                    }
                    if($frecuencia == "SEMANAL")
                    {
                        $dias = strtotime(strftime("%d-%B-%y",$hoy -> getTimestamp())) - strtotime(strftime("%d-%B-%y",$fecha_inicio -> getTimestamp()));
                        $dias = $dias / 86400;
                        $semanas = $dias/7;
                        $lista[$key]["evidencias_realizar"] = floor($semanas);
                    }
                    if($frecuencia == "MENSUAL")
                    {
                        $cantidad_a_realizar = 0;
                        $dias = strtotime(strftime("%d-%B-%y",$hoy -> getTimestamp())) - strtotime(strftime("%d-%B-%y",$fecha_inicio -> getTimestamp()));
                        $dias = $dias / 86400;
                        $mesInicio = strftime("%m",$fecha_inicio->getTimestamp());
                        $yearInicio = strftime("%Y",$fecha_inicio->getTimestamp());
                        $finWhile=true;
                        while($finWhile)
                        {
                            $mensual = cal_days_in_month(CAL_GREGORIAN,$mesInicio,$yearInicio);
                            if($mesInicio==12)
                            {
                                $mesInicio=0;
                                $yearInicio++;
                            }
                            if($dias > 0)
                            {
                                $cantidad_a_realizar++;
                            }
                            if($dias < 0)
                            {
                                $finWhile=false;
                            }
                            if($dias == 0)
                            {
                                $finWhile=false;
                                $cantidad_a_realizar++;
                            }
                            $mesInicio++;
                            $dias = $dias - $mensual;
                        };
                        $lista[$key]["evidencias_realizar"] = $cantidad_a_realizar;
                    }
                    if($frecuencia == "BIMESTRAL")
                    {
                        $cantidad_a_realizar = 0;
                        $dias = strtotime(strftime("%d-%B-%y",$hoy -> getTimestamp())) - strtotime(strftime("%d-%B-%y",$fecha_inicio -> getTimestamp()));
                        $dias = $dias / 86400;
                        $mesInicio = strftime("%m",$fecha_inicio->getTimestamp());
                        $yearInicio = strftime("%Y",$fecha_inicio->getTimestamp());
                        $finWhile=true;
                        while($finWhile)
                        {
                            $mensual = cal_days_in_month(CAL_GREGORIAN,$mesInicio,$yearInicio);
                            $mensual = $mensual + cal_days_in_month(CAL_GREGORIAN,$mesInicio+1,$yearInicio);

                            if($mesInicio==11)
                            {
                                $mesInicio=-1;
                                $yearInicio++;
                            }
                            else
                            {
                                if($mesInicio==12)
                                {
                                    $mesInicio=0;
                                    $yearInicio++;
                                }
                            }
                            if($dias > 0)
                            {
                                $cantidad_a_realizar++;
                            }
                            if($dias < 0)
                            {
                                $finWhile=false;
                            }
                            if($dias == 0)
                            {
                                $finWhile=false;
                                $cantidad_a_realizar++;
                            }
                            $mesInicio+=2;
                            $dias = $dias - $mensual;
                        };
                        $lista[$key]["evidencias_realizar"] = $cantidad_a_realizar;
                    }
                    if($frecuencia == "ANUAL")
                    {
                        $cantidad_a_realizar = 1;
                        $yearInicio = strftime("%Y",$fecha_inicio->getTimestamp());
                        $yearHoy = strftime("%Y",$hoy->getTimestamp());
                        // $diasInicio = strftime("%d",$fecha_inicio->getTimestamp());
                        // $diasHoy = strftime("%d",$hoy->getTimestamp());
                        // if($diasInicio < $diasHoy)
                        // {
                        //     $cantidad_a_realizar++;
                        //     $yearInicio++;
                        // }
                        // if($diasInicio == $diasHoy)
                        // {
                        //     $cantidad_a_realizar++;
                        // }
                        $finWhile=true;
                        while($finWhile)
                        {
                            if($yearInicio >= $yearHoy)
                            {
                                $finWhile=false;
                            }
                            else
                            {
                                $yearInicio++;
                                $cantidad_a_realizar++;
                            }
                        }
                        $lista[$key]["evidencias_realizar"] = $cantidad_a_realizar;
                        // echo $diasInicio."\n";
                        // echo $diasHoy."\n";
                        // echo $yearInicio."\n";
                        // echo $yearHoy."\n";
                        // echo $cantidad_a_realizar."\n";
                    }
                    if($frecuencia == "INDEFINIDO")
                    {
                        $lista[$key]["evidencias_realizar"] = -1;
                    }
                    if($frecuencia == "POR EVENTO")
                    {
                        $lista[$key]["evidencias_realizar"] = -1;
                    }
                // }
                // else
                // {
                //     $lista[$key]["evidencias_realizar"] = "X";
                // }
                if($value["id_registro"]==null)
                {
                    $lista[$key]["evidencias_realizar"] = "X";
                }

                if($lista[$key]["evidencias_realizar"]==0)
                    $lista[$key]["cumplimiento_evidencias"] = 100;

                if($lista[$key]["evidencias_realizar"]>0)
                    $lista[$key]["cumplimiento_evidencias"] = ($lista[$key]["evidencias_validadas"]/$lista[$key]["evidencias_realizar"])*100;

                if($lista[$key]["evidencias_realizar"]==-1)
                {
                    if( $lista[$key]["evidencias_totales"] == $lista[$key]["evidencias_validadas"] && $lista[$key]["evidencias_totales"]>0)
                        $lista[$key]["cumplimiento_evidencias"] = 100;
                    else
                        if( $lista[$key]["evidencias_totales"]>0 )
                        {
                            $lista[$key]["cumplimiento_evidencias"] = ($lista[$key]["evidencias_validadas"]/$lista[$key]["evidencias_totales"])*100;
                        }
                        else
                            $lista[$key]["cumplimiento_evidencias"] = 0;
                }

                if($lista[$key]["evidencias_realizar"]=="X")
                    $lista[$key]["cumplimiento_evidencias"] = "X";
            }
            // var_dump($lista);
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return-1;
        }
    }

    public function calcular($lista)
    {
        try
        {
            $id_registro=-1;
            $bandera=0;
            $banderaTema=0;
            $divisor_requisito=0;
            $cumplimiento_requisito=0;
            $id_requisito=0;
            $id_tema=0;
            $cumplimiento_tema=[];
            // $cumplimiento_porTema;
            $lista2=[];
            $tam = sizeof($lista);
            $contador=0;
            $contador2=0;
            for($i = 0;$i<$tam;$i++)
            {
                if($bandera==0)
                {
                    $id_requisito = $lista[$i]["id_requisito"];
                    $bandera=1;
                }
                if($id_requisito==$lista[$i]["id_requisito"])
                {
                    $lista2[$contador]["id_tema"]=$lista[$i]["id_tema"];
                    $lista2[$contador]["no_tema"]=$lista[$i]["no"];
                    $lista2[$contador]["nombre_tema"]=$lista[$i]["nombre"];
                    $lista2[$contador]["fecha_inicio"]=$lista[$i]["fecha_inicio"];
                    $lista2[$contador]["id_templeado"]=$lista[$i]["id_empleado"];
                    $lista2[$contador]["responsable_tema"]=$lista[$i]["responsable"];
                    $lista2[$contador]["id_requisito"]=$lista[$i]["id_requisito"];
                    $lista2[$contador]["requisito"]=$lista[$i]["requisito"];
                    $lista2[$contador]["penalizacion"]=$lista[$i]["penalizacion"];
                    

                    $lista2[$contador]["detalles_requisito"][$contador2]["id_registro"] = $lista[$i]["id_registro"];
                    $lista2[$contador]["detalles_requisito"][$contador2]["registro"] = $lista[$i]["registro"];
                    $lista2[$contador]["detalles_requisito"][$contador2]["frecuencia"] = $lista[$i]["frecuencia"];
                    $lista2[$contador]["detalles_requisito"][$contador2]["evidencias_validadas"] = $lista[$i]["evidencias_validadas"];
                    $lista2[$contador]["detalles_requisito"][$contador2]["evidencias_totales"] = $lista[$i]["evidencias_totales"];
                    $lista2[$contador]["detalles_requisito"][$contador2]["evidencias_realizar"] = $lista[$i]["evidencias_realizar"];
                    $lista2[$contador]["detalles_requisito"][$contador2]["evidencias_proceso"] = $lista[$i]["evidencias_totales"]-$lista[$i]["evidencias_validadas"];
                    $lista2[$contador]["detalles_requisito"][$contador2]["cumplimiento_evidencias"] = $lista[$i]["cumplimiento_evidencias"];

                    // if($lista[$i]["frecuencia"]=="INDEFINIDO")
                    // {
                        // if($lista[$i]["evidencias_validadas"]==$lista[$i]["evidencias_totales"])
                        //     $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"] = "CUMPLIDO";

                    // if($lista[$i]["fecha_inicio"]!="0000-00-00")
                    // {
                    if( $lista2[$contador]["detalles_requisito"][$contador2]["frecuencia"]=="INDEFINIDO" || $lista2[$contador]["detalles_requisito"][$contador2]["frecuencia"]=="POR EVENTO" )
                    {
                        if( $lista2[$contador]["detalles_requisito"][$contador2]["cumplimiento_evidencias"]==100 )
                            $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"]= "CUMPLIDO";
                        else
                        {
                            if( ($lista[$i]["evidencias_totales"] - $lista[$i]["evidencias_validadas"] ) >= 2)
                                $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"] = "ATRASADO";
                            else
                            {
                                if( $lista2[$contador]["detalles_requisito"][$contador2]["evidencias_proceso"]>0 )
                                    $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"] = "EN PROCESO";
                                else
                                {
                                    if( $lista2[$contador]["detalles_requisito"][$contador2]["frecuencia"]=="INDEFINIDO" )
                                        $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"] = "NO APLICA";
                                    else
                                    {
                                        $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"] = "EN PROCESO";
                                        $lista2[$contador]["detalles_requisito"][$contador2]["evidencias_proceso"] = 1;
                                    }
                                }
                            }
                        }
                    }
                    else
                    {
                        if( ($lista[$i]["evidencias_realizar"] - $lista[$i]["evidencias_validadas"] ) >= 2)
                            $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"] = "ATRASADO";
                        else
                        {
                            if( $lista2[$contador]["detalles_requisito"][$contador2]["cumplimiento_evidencias"] == 100 )
                                $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"] = "CUMPLIDO";
                            else
                                $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"] = "EN PROCESO";
                        }
                    }

                    if(isset($lista2[$contador]["estado_requisito"]))
                    {
                        if($lista2[$contador]["estado_requisito"]!="ATRASADO")
                        {
                            if( $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"] == "ATRASADO")
                                $lista2[$contador]["estado_requisito"] = "ATRASADO";
                            else
                            {
                                if( $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"] == "EN PROCESO" || $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"] == "NO APLICA")
                                    $lista2[$contador]["estado_requisito"] = "EN PROCESO";
                                else
                                    $lista2[$contador]["estado_requisito"] = "CUMPLIDO";
                            }
                        }
                    }
                    else
                    {
                        if( $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"] == "NO APLICA" )
                        {
                            $lista2[$contador]["estado_requisito"] = "EN PROCESO";
                        }
                        else
                            $lista2[$contador]["estado_requisito"] = $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"];
                    }

                    if($lista[$i]["id_registro"]==NULL)
                    {
                        if(isset($lista2[$contador]["divisor_evidencias"]))
                        {
                            // if( $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"] != "NO APLICA" )
                            // {
                                $lista2[$contador]["divisor_evidencias"]++;
                                $lista2[$contador]["sumatoria_evidencias"] += $lista[$i]["cumplimiento_evidencias"];
                                $lista2[$contador]["cumplimiento_requisito"] = $lista2[$contador]["sumatoria_evidencias"]/$lista2[$contador]["divisor_evidencias"];
                            // }
                        }
                        else
                        {
                            // if( $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"] != "NO APLICA" )
                            // {
                                $lista2[$contador]["divisor_evidencias"] = 1;
                                $lista2[$contador]["sumatoria_evidencias"] = 100;
                                $lista2[$contador]["cumplimiento_requisito"] = 100;
                            // }
                            // else{}
                        }
                    }
                    else
                    {
                        if(isset($lista2[$contador]["divisor_evidencias"]))
                        {
                            if( $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"] != "NO APLICA" )
                            {
                                $lista2[$contador]["divisor_evidencias"]++;
                                $lista2[$contador]["sumatoria_evidencias"] += $lista[$i]["cumplimiento_evidencias"];
                                $lista2[$contador]["cumplimiento_requisito"] = $lista2[$contador]["sumatoria_evidencias"]/$lista2[$contador]["divisor_evidencias"];
                            }
                        }
                        else
                        {
                            if( $lista2[$contador]["detalles_requisito"][$contador2]["estado_evidencias"] != "NO APLICA" )
                            {
                                $lista2[$contador]["divisor_evidencias"] = 1;
                                $lista2[$contador]["sumatoria_evidencias"] = $lista[$i]["cumplimiento_evidencias"];
                                $lista2[$contador]["cumplimiento_requisito"] = $lista[$i]["cumplimiento_evidencias"];
                            }
                            else
                            {
                                $lista2[$contador]["divisor_evidencias"] = 0;
                                $lista2[$contador]["sumatoria_evidencias"] = 0;
                                $lista2[$contador]["cumplimiento_requisito"] = 0;
                            }
                        }
                    }
                    $lista2[$contador]["estado_tema"]=1;
                    // }
                    // else
                    // {
                    //     $lista2[$contador]["cumplimiento_requisito"] = "X";
                    //     $lista2[$contador]["estado_tema"]=0;
                    //     $lista2[$contador]["estado_requisito"]="NO INICIADO";
                    // }
                    $contador2++;
                }
                else
                {
                    $id_requisito = $lista[$i]["id_requisito"];
                    $contador++;
                    $contador2=0;
                    $i--;
                }
                // if( ( ($value["evidencias_validadas"] + $value["evidencias_proceso"]) - $value["evidencias_realizar"] ) - )
            //                 if( ($value["evidencias_realizar"] - $value["evidencias_validadas"] ) >= 2)
            //                     $lista[$key]["estado_requisito"]="ATRASADO";
            //                 else
            //                     $lista[$key]["estado_requisito"]="EN PROCESO";
            }
            // var_dump($lista2);
            
            $bandera=0;
            $cumplimiento_tema=[];
            $id_tema;
            foreach($lista2 as $key => $value)
            {
                if($bandera==0)
                {
                    $id_tema = $value["id_tema"];
                    $bandera=1;
                }
                // if($value["fecha_inicio"]!="0000-00-00")
                // {
                    if($id_tema==$value["id_tema"])
                    {
                        if(isset($cumplimiento_tema[$id_tema]))
                        {
                            $cumplimiento_tema[$id_tema]["divisor"]++;
                            $cumplimiento_tema[$id_tema]["sumatoria"] += $value["cumplimiento_requisito"];
                            $cumplimiento_tema[$id_tema]["cumplimiento"] = $cumplimiento_tema[$id_tema]["sumatoria"]/$cumplimiento_tema[$id_tema]["divisor"];
                        }
                        else
                        {
                            $cumplimiento_tema[$id_tema]["divisor"] = 1;
                            $cumplimiento_tema[$id_tema]["sumatoria"] = $value["cumplimiento_requisito"];
                            $cumplimiento_tema[$id_tema]["cumplimiento"] = $cumplimiento_tema[$id_tema]["sumatoria"];
                        }
                    }
                    else
                    {
                        $id_tema = $value["id_tema"];
                        if(isset($cumplimiento_tema[$id_tema]))
                        {
                            $cumplimiento_tema[$id_tema]["divisor"]++;
                            $cumplimiento_tema[$id_tema]["sumatoria"] += $value["cumplimiento_requisito"];
                            $cumplimiento_tema[$id_tema]["cumplimiento"] = $cumplimiento_tema[$id_tema]["sumatoria"]/$cumplimiento_tema[$id_tema]["divisor"];
                        }
                        else
                        {
                            $cumplimiento_tema[$id_tema]["divisor"] = 1;
                            $cumplimiento_tema[$id_tema]["sumatoria"] = $value["cumplimiento_requisito"];
                            $cumplimiento_tema[$id_tema]["cumplimiento"] = $cumplimiento_tema[$id_tema]["sumatoria"];
                        }
                    }
                // }
                // else
                // {
                //     $cumplimiento_tema[$value["id_tema"]]["cumplimiento"] = "X";
                // }
            }
            // $cumplimiento_contrato = 0;
            $contador=0;
            $total=0;
            foreach($cumplimiento_tema as $key => $value)
            {
                $total += $value["cumplimiento"];
                $contador++;
            }
            foreach($lista2 as $key => $value)
            {
                // if($cumplimiento_tema[$value["id_tema"]]["cumplimiento"]!="X")
                //     $lista2[$key]["cumplimiento_tema"] = number_format(floatval($cumplimiento_tema[$value["id_tema"]]["cumplimiento"]),2,".","");
                // else
                    $lista2[$key]["cumplimiento_tema"] = $cumplimiento_tema[$value["id_tema"]]["cumplimiento"];
                    // if(gettype($cumplimiento_tema[$value["id_tema"]]["cumplimiento"])!="string")
                    // {
                        // $total += $cumplimiento_tema[$value["id_tema"]]["cumplimiento"];
                        // $contador++;
                        // $cumplimiento_contrato = $total/$contador;
                    // }
            }
            $lista2[0]["cumplimiento_contrato"] = $total/$contador;
            // var_dump($lista2);
            // var_dump($cumplimiento_tema);
            // foreach($lista as $key=>$value)
            // {
            //     if($value["fecha_inicio"] != "0000-00-00")
            //     {
            //         if($value["id_registro"]!=null)
            //         {
            //             if($bandera == 0)
            //             {
            //                 $id_tema = $value["id_tema"];
            //                 $id_requisito = $value["id_requisito"];
            //                 $bandera = 1;
            //                 $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]=0;
            //                 $cumplimiento_tema[$value["id_tema"]]["divisor"] = 0;
            //             }
            //             if($id_requisito == $value["id_requisito"])
            //             {
            //                 // $lista[$key]["evidencias_proceso"] = $value["evidencias_totales"]-$value["evidencias_validadas"];
            //                 // $lista[$key]["cumplimiento_registro"] = ($value["evidencias_validadas"]/$value["evidencias_realizar"])*100;
            //                 $cumplimiento_requisito += ($value["evidencias_validadas"]/$value["evidencias_realizar"])*100;
            //                 $divisor_requisito++;
            //                 $lista[$key]["cumplimiento_requisito"] = $cumplimiento_requisito/$divisor_requisito;
            //                 // $lista[$key]["divisor_requisito"] = $divisor_requisito;
            //                 // if(!isset($cumplimiento_tema[$value["id_tema"]]))
            //                 // {
                                
            //                     $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]=$cumplimiento_requisito/$divisor_requisito;
            //                     $cumplimiento_tema[$value["id_tema"]]["divisor"] = 1;

            //                     // $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]=$cumplimiento_requisito/$divisor_requisito;
            //                     // $cumplimiento_tema[$value["id_tema"]]["divisor"] = 1;
            //                 // }
            //                 // else
            //                 // {
            //                 //     $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]=$cumplimiento_requisito;
            //                 //     // $cumplimiento_tema[$value["id_tema"]]["divisor"]++;
            //                 // }
            //             }
            //             else
            //             {
            //                 $id_registro = $value["id_registro"];
            //                 $id_requisito = $value["id_requisito"];
            //                 $divisor_requisito = 0;
            //                 $cumplimiento_requisito = 0;
            //                 // $lista[$key]["evidencias_proceso"] = $value["evidencias_totales"]-$value["evidencias_validadas"];
            //                 // $lista[$key]["cumplimiento_registro"] = ($value["evidencias_validadas"]/$value["evidencias_realizar"])*100;
            //                 if($value["evidencias_realizar"]>0)
            //                     $cumplimiento_requisito += ($value["evidencias_validadas"]/$value["evidencias_realizar"])*100;
            //                 if($value["evidencias_realizar"]==0)
            //                     $cumplimiento_requisito += 100;
            //                 if($value["evidencias_realizar"]==-1)
            //                     $cumplimiento_requisito += 0;
                                
            //                 $divisor_requisito++;
            //                 $lista[$key]["cumplimiento_requisito"] = $cumplimiento_requisito/$divisor_requisito;
            //                 if($id_tema != $value["id_tema"])
            //                 {
            //                     $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]=$cumplimiento_requisito;
            //                     $cumplimiento_tema[$value["id_tema"]]["divisor"] = 1;
            //                 }
            //                 else
            //                 {
            //                     $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]+=$cumplimiento_requisito;
            //                     $cumplimiento_tema[$value["id_tema"]]["divisor"]++;
            //                 }
            //                     // $cumplimiento_tema[$id_tema]]["cumplimiento"]+=$cumplimiento_requisito;
            //                     // if(isset($cumplimiento_tema[$value["id_tema"]]))
            //                     // {
            //                     //     $cumplimiento_tema[$id_tema]["divisor"]++;
            //                     // }
            //                     // else
            //                     //     $cumplimiento_tema[$id_tema]["divisor"]++;
            //                     $id_tema=$value["id_tema"];
            //                 // }
            //             }
            //             // if($id_tema == $value["id_tema"])
            //             // {

            //             // }
            //             // else
            //             // {
            //                 // $id_tema = $value["id_tema"];
            //                 // if(!isset($cumplimiento_tema[$id_tema]))
            //                 // {
            //                     // $cumplimiento_tema[$id_tema]["cumplimiento"]=$cumplimiento_requisito;
            //                     // $cumplimiento_tema[$id_tema]["divisor"] = 1;
            //                 // }
            //                 // else
            //                 // {
            //                 //     $cumplimiento_tema[$id_tema]["cumplimiento"]+=$cumplimiento_requisito;
            //                 //     $cumplimiento_tema[$id_tema]["divisor"]++;
            //                 // }
            //             // }

            //             $lista[$key]["evidencias_proceso"] = $value["evidencias_totales"]-$value["evidencias_validadas"];
            //             if($value["evidencias_realizar"]>0)
            //                 $lista[$key]["cumplimiento_registro"] = ($value["evidencias_validadas"]/$value["evidencias_realizar"])*100;
            //             if($value["evidencias_realizar"]==0)
            //                 $lista[$key]["cumplimiento_registro"] = 100;
            //             if($value["evidencias_realizar"]==-1)
            //                 $lista[$key]["cumplimiento_registro"] = 0;
            //         }
            //         else
            //         {
            //             $lista[$key]["evidencias_proceso"] = 0;
            //             $lista[$key]["cumplimiento_registro"] = 0;

            //             if($id_requisito == $value["id_requisito"])
            //             {
            //                 // $lista[$key]["evidencias_proceso"] = $value["evidencias_totales"]-$value["evidencias_validadas"];
            //                 // $lista[$key]["cumplimiento_registro"] = ($value["evidencias_validadas"]/$value["evidencias_realizar"])*100;
            //                 $cumplimiento_requisito += 100;
            //                 $divisor_requisito++;
            //                 $lista[$key]["cumplimiento_requisito"] = $cumplimiento_requisito/$divisor_requisito;
            //                 // $lista[$key]["divisor_requisito"] = $divisor_requisito;
            //                 // if(!isset($cumplimiento_tema[$value["id_tema"]]))
            //                 // {
            //                     if(isset($cumplimiento_tema[$value["id_tema"]]["cumplimiento"]))
            //                     {
            //                         $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]+=$cumplimiento_requisito/$divisor_requisito;
            //                         $cumplimiento_tema[$value["id_tema"]]["divisor"]++;
            //                     }
            //                     else
            //                     {
            //                         $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]=$cumplimiento_requisito/$divisor_requisito;
            //                         $cumplimiento_tema[$value["id_tema"]]["divisor"]=1;
            //                     }
            //                 // }
            //                 // else
            //                 // {
            //                 //     $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]=$cumplimiento_requisito;
            //                 //     // $cumplimiento_tema[$value["id_tema"]]["divisor"]++;
            //                 // }
            //             }
            //             else
            //             {

            //                 $id_registro = $value["id_registro"];
            //                 $id_requisito = $value["id_requisito"];
            //                 $divisor_requisito = 0;
            //                 $cumplimiento_requisito = 0;
            //                 // $lista[$key]["evidencias_proceso"] = $value["evidencias_totales"]-$value["evidencias_validadas"];
            //                 // $lista[$key]["cumplimiento_registro"] = ($value["evidencias_validadas"]/$value["evidencias_realizar"])*100;
            //                 $cumplimiento_requisito += 100;
            //                 $divisor_requisito++;
            //                 $lista[$key]["cumplimiento_requisito"] = $cumplimiento_requisito;
            //                 if($id_tema != $value["id_tema"])
            //                 {
            //                     $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]=$cumplimiento_requisito;
            //                     $cumplimiento_tema[$value["id_tema"]]["divisor"] = 1;
            //                 }
            //                 else
            //                 {
            //                     $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]+=$cumplimiento_requisito;
            //                     $cumplimiento_tema[$value["id_tema"]]["divisor"]++;
            //                 }
            //                     // $cumplimiento_tema[$id_tema]]["cumplimiento"]+=$cumplimiento_requisito;
            //                     // if(isset($cumplimiento_tema[$value["id_tema"]]))
            //                     // {
            //                     //     $cumplimiento_tema[$id_tema]["divisor"]++;
            //                     // }
            //                     // else
            //                     //     $cumplimiento_tema[$id_tema]["divisor"]++;
            //                     $id_tema=$value["id_tema"];
            //                 // }
            //             }

            //             // $lista[$key]["cumplimiento_requisito"] = 100;
            //             // $cumplimiento_requisito+=100;
            //             // if(!isset($cumplimiento_tema[$id_tema]))
            //             // {
            //             //     $cumplimiento_tema[$id_tema]["cumplimiento"]=$cumplimiento_requisito;
            //             //     $cumplimiento_tema[$id_tema]["divisor"] = 1;
            //             // }
            //             // else
            //             // {
            //             //     $cumplimiento_tema[$id_tema]["cumplimiento"]+=$cumplimiento_requisito;
            //             //     $cumplimiento_tema[$id_tema]["divisor"]++;
            //             // }
            //             // if($id_tema == $value["id_tema"])
            //             // {
            //                 // if(!isset($cumplimiento_tema[$value["id_tema"]]))
            //                 // {
            //                 //     $cumplimiento_tema[$value["id_tema"]]["divisor"] = 1;
            //                 //     $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]=$cumplimiento_requisito/1;
            //                 // }
            //                 // else
            //                 // {
            //                 //     $cumplimiento_tema[$value["id_tema"]]["divisor"]++;
            //                 //     $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]+=$cumplimiento_requisito/$cumplimiento_tema[$value["id_tema"]]["divisor"];
            //                 // }
            //             // }
            //             // else
            //             // {
            //             //     $id_tema = $value["id_tema"];
            //             //     $cumplimiento_tema[$id_tema]["cumplimiento"]=$cumplimiento_requisito;
            //             //     $cumplimiento_tema[$id_tema]["divisor"] = 1;   // }
            //             // }
            //             // $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]=0; //en $id_tema hay que darle el value de id_tema abajo igual
            //             // $cumplimiento_tema[$value["id_tema"]]["divisor"]=1;
            //             // $lista[$key]["divisor_requisito"] = 0;
            //         }
            //     }
            //     else
            //     {
            //         $lista[$key]["evidencias_proceso"] = "X";
            //         $lista[$key]["cumplimiento_registro"] = "X";
            //         $lista[$key]["cumplimiento_requisito"] = "X";
            //         // $cumplimiento_tema[$id_tema]=0;
            //         // $cumplimiento_tema["divisor"]=0;
            //         if(!isset($cumplimiento_tema[$value["id_tema"]]))
            //         {
            //             $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]="X";
            //             $cumplimiento_tema[$value["id_tema"]]["divisor"] = "X";
            //         }
            //         // else
            //         // {
            //         //     $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]+=$cumplimiento_requisito;
            //         //     $cumplimiento_tema[$value["id_tema"]]["divisor"]++;
            //         // }
            //         // $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]=0;
            //         // $cumplimiento_tema[$value["id_tema"]]["divisor"]=1;
            //         // $lista[$key]["divisor_requisito"] = "X";
            //     }
            // }
            // $id_registro=0;
            // $bandera=0;
            // // var_dump($cumplimiento_tema);
            // foreach($lista as $key=>$value)
            // {
            //     $lista[$key]["estado_tema"]=1;
            //     if($value["fecha_inicio"] != "0000-00-00")
            //     {
            //         if($value["id_registro"]!=null)
            //         {
            //             if($bandera==0)
            //             {
            //                 $id_registro = $value["id_registro"];
            //                 $bandera=1;
            //             }
            //             // if($value["id_registro"]==$id_registro)
            //             // {
            //             //     $divisor_tema++;
            //             //     $cumplimiento_tema .= ($value["cumplimiento_requisito"]/$value["divisor_requisito"])*100;
            //             //     $lista[$key]["cumplimiento_tema"] = $cumplimiento_tema/$divisor_tema;
            //             // }
            //             // else
            //             // {
            //             //     $divisor_tema=0;
            //             //     $cumplimiento_tema=0;
            //             // }
            //             // $lista[$key]["cumplimiento_requisito"] = ($value["cumplimiento_requisito"]/$value["divisor_requisito"])*100;
            //             if($value["evidencias_validadas"] == $value["evidencias_realizar"] )
            //             {
            //                 $lista[$key]["estado_requisito"]="CUMPLIDO";
            //             }
            //             else
            //             {
            //                 // if( ( ($value["evidencias_validadas"] + $value["evidencias_proceso"]) - $value["evidencias_realizar"] ) - )
            //                 if( ($value["evidencias_realizar"] - $value["evidencias_validadas"] ) >= 2)
            //                     $lista[$key]["estado_requisito"]="ATRASADO";
            //                 else
            //                     $lista[$key]["estado_requisito"]="EN PROCESO";
            //             }
            //         }
            //         else
            //         {
            //             $lista[$key]["estado_requisito"] = "CUMPLIDO";
            //             $lista[$key]["cumplimiento_tema"] = 0;
            //             $lista[$key]["divisor_tema"] = 0;
            //         }
            //     }
            //     else
            //     {
            //         $lista[$key]["estado_tema"]=0;
            //         $lista[$key]["estado_requisito"]="NO INICIADO";
            //         $lista[$key]["cumplimiento_tema"] = 0;
            //         $lista[$key]["divisor_tema"] = 0;
            //     }
            // }
            // $listaFinal;
            // $bandera=0;
            // $bandera2=0;
            // $id_requisito=0;
            // $contador=0;
            // $contador2=0;
            // $cumplimiento_tema=0;
            // $divisor_tema=0;
            // $detalles=[];
            // $totalCumplimientoTema = 0;
            // $lista2=[];
            // $id_tema=0;
            // foreach($lista as $key=>$value)
            // {
            //     // echo $value["cumplimiento_requisito"]."\n";
            //     if($bandera==0)
            //         $id_tema = $value["id_tema"];
            //     $bandera=1;
            //     if($id_tema == $value["id_tema"])
            //     {
            //         if($bandera2==0)
            //         {
            //             $id_requisito = $value["id_requisito"];
            //         }
            //         $bandera2=1;
            //         if($id_requisito == $value["id_requisito"])
            //         {
            //             if(isset($lista2[$id_tema][$id_requisito]["cumplimiento"]))
            //             {
            //                 $lista2[$id_tema][$id_requisito]["cumplimiento"] += $value["cumplimiento_requisito"];
            //                 $lista2[$id_tema][$id_requisito]["contador"]++;
            //                 $lista2[$id_tema][$id_requisito]["cumplimientoT"] = $lista2[$id_tema][$id_requisito]["cumplimiento"]/$lista2[$id_tema][$id_requisito]["contador"];
            //             }
            //             else
            //             {
            //                 $lista2[$id_tema][$id_requisito]["cumplimiento"] = $value["cumplimiento_requisito"];
            //                 $lista2[$id_tema][$id_requisito]["contador"]=1;
            //                 $lista2[$id_tema][$id_requisito]["cumplimientoT"] = $lista2[$id_tema][$id_requisito]["cumplimiento"]/$lista2[$id_tema][$id_requisito]["contador"];
            //             }
            //         }
            //         else
            //         {
            //             $id_requisito = $value["id_requisito"];
            //             $lista2[$id_tema][$id_requisito]["cumplimiento"] = $value["cumplimiento_requisito"];
            //             $lista2[$id_tema][$id_requisito]["contador"]=1;
            //             $lista2[$id_tema][$id_requisito]["cumplimientoT"] = $lista2[$id_tema][$id_requisito]["cumplimiento"]/$lista2[$id_tema][$id_requisito]["contador"];
            //         }
            //     }
            //     else
            //     {
            //         $id_tema = $value["id_tema"];
            //         if($id_requisito == $value["id_requisito"])
            //         {
            //             if(isset($lista2[$id_tema][$id_requisito]["cumplimiento"]))
            //             {
            //                 $lista2[$id_tema][$id_requisito]["cumplimiento"] += $value["cumplimiento_requisito"];
            //                 $lista2[$id_tema][$id_requisito]["contador"]++;
            //                 $lista2[$id_tema][$id_requisito]["cumplimientoT"] = $lista2[$id_tema][$id_requisito]["cumplimiento"]/$lista2[$id_tema][$id_requisito]["contador"];
            //             }
            //             else
            //             {
            //                 $lista2[$id_tema][$id_requisito]["cumplimiento"] = $value["cumplimiento_requisito"];
            //                 $lista2[$id_tema][$id_requisito]["contador"]=1;
            //             $lista2[$id_tema][$id_requisito]["cumplimientoT"] = $lista2[$id_tema][$id_requisito]["cumplimiento"]/$lista2[$id_tema][$id_requisito]["contador"];
            //             }
            //         }
            //         else
            //         {
            //             $id_requisito = $value["id_requisito"];
            //             $lista2[$id_tema][$id_requisito]["cumplimiento"] = $value["cumplimiento_requisito"];
            //             $lista2[$id_tema][$id_requisito]["contador"]=1;
            //             $lista2[$id_tema][$id_requisito]["cumplimientoT"] = $lista2[$id_tema][$id_requisito]["cumplimiento"]/$lista2[$id_tema][$id_requisito]["contador"];
            //         }
            //     }
            // }
            // $lista3 = array();
            // $bandera = 0;
            // foreach($lista2 as $key => $value)
            // {
            //     // echo $key;
            //     if($bandera==0)
            //         $id_tema = $key;
            //     $bandera=1;
            //     if($id_tema == $key)
            //     {
            //         $lista3[$id_tema] = 0;
            //         foreach($lista2[$id_tema] as $value)
            //             $lista3[$id_tema]+=$value["cumplimientoT"];
            //     }
            //     else
            //     {
            //         $id_tema = $key;
            //         $lista3[$id_tema] = 0;
            //         foreach($lista2[$id_tema] as $value)
            //             $lista3[$id_tema]+=$value["cumplimientoT"];
            //     }
            // }
            // var_dump($lista3);
            // foreach($lista2 as $key=>$value)
            // {
            //     // $lista[$key]["estado_tema"]="NO INICIADO";
            //     if($bandera == 0)
            //     {
            //         $id_requisito = $value["id_requisito"];
            //         $bandera = 1;
            //     }
            //     if($id_requisito == $value["id_requisito"])
            //     {
            //         // $id_requisito = $value["id_requisito"];
            //         $listaFinal[$contador]["no_tema"] = $value["no"];
            //         $listaFinal[$contador]["id_tema"] = $value["id_tema"];
            //         $listaFinal[$contador]["nombre_tema"] = $value["nombre"];
            //         $listaFinal[$contador]["id_responsable"] = $value["id_empleado"];
            //         $listaFinal[$contador]["responsable_tema"] = $value["responsable"];
            //         $listaFinal[$contador]["estado_tema"] = $value["estado_tema"];
            //         // $cumplimiento_tema += $value["cumplimiento_requisito"];
            //         // $divisor_tema++;
            //         // $cumplimiento_tema[$id_tema]["divisor"]++;
            //         // echo $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]."\n";
            //         $totalCumplimientoTema += $cumplimiento_tema[$value["id_tema"]]["cumplimiento"];

            //         if($cumplimiento_tema[$value["id_tema"]]["divisor"] == 0)
            //             $listaFinal[$contador]["cumplimiento_tema"] = $totalCumplimientoTema/1;
            //         else
            //             $listaFinal[$contador]["cumplimiento_tema"] = $totalCumplimientoTema/$cumplimiento_tema[$value["id_tema"]]["divisor"];
            //         $listaFinal[$contador]["requisitos_por_tema"] = $cumplimiento_tema[$value["id_tema"]]["divisor"];
                    
            //         if(isset($listaFinal[$contador]["divisor"]))
            //         {
            //             $listaFinal[$contador]["divisor"]++;
            //             $listaFinal[$contador]["cumplimiento_temaTemp"]+=$value["cumplimiento_requisito"];
            //             // echo $value["cumplimiento_requisito"]."\n";
            //         }
            //         else
            //         {
            //             $listaFinal[$contador]["divisor"]=1;
            //             $listaFinal[$contador]["cumplimiento_temaTemp"]=$value["cumplimiento_requisito"];
            //             // echo $value["cumplimiento_requisito"]."\n";
            //         }
            //         // $listaFinal[$contador]["divisor_tema"] = $cumplimiento_tema[$value["id_tema"]];
            //         // $listaFinal[$contador]["estado_tema"] = $value["estado_tema"];
            //         // if($value["divisor_tema"]==0)
            //         //     $divisor_tema = 1;
            //         // else
            //         //     $divisor_tema = $value["divisor_tema"];
            //         // $listaFinal[$contador]["cumplimiento_tema"] = ($value["cumplimiento_tema"]/$divisor_tema)*100;

            //         $listaFinal[$contador]["id_requisito"] = $value["id_requisito"];
            //         $listaFinal[$contador]["requisito"] = $value["requisito"];
            //         $listaFinal[$contador]["penalizacion"] = $value["penalizacion"];
            //         $listaFinal[$contador]["cumplimiento_requisito"] = $value["cumplimiento_requisito"];
            //         $listaFinal[$contador]["estado_requisito"] = $value["estado_requisito"];
            //         // if($bandera2 == 0)
            //         // {
            //         //     $id_registro = $value["id_registro"];
            //         //     $bandera2 = 1;
            //         // }
            //         // if($id_registro == $value["id_registro"])
            //         // {
            //             $detalles[$contador2]["id_registro"] = $value["id_registro"];
            //             $detalles[$contador2]["registro"] = $value["registro"];
            //             $detalles[$contador2]["frecuencia"] = $value["frecuencia"];
            //             $detalles[$contador2]["cumplimiento_registro"] = $value["cumplimiento_registro"];
            //             $detalles[$contador2]["evidencias_realizar"] = $value["evidencias_realizar"];
            //             $detalles[$contador2]["evidencias_validadas"] = $value["evidencias_validadas"];
            //             $detalles[$contador2]["evidencias_totales"] = $value["evidencias_totales"];
            //             $detalles[$contador2]["evidencias_proceso"] = $value["evidencias_proceso"];
                        
            //             $listaFinal[$contador]["detalles"] = $detalles;
            //             $contador2++;
            //         // }
            //         // else
            //         // {
            //             // $detalles=[];
            //             // $id_registro = $value["id_registro"];
            //             // $contador2=0;
            //             // $detalles[$contador2]["id_registro"] = $value["id_registro"];
            //             // $detalles[$contador2]["registro"] = $value["registro"];
            //             // $detalles[$contador2]["frecuencia"] = $value["frecuencia"];
            //             // $detalles[$contador2]["cumplimiento_registro"] = $value["cumplimiento_registro"];
            //             // $detalles[$contador2]["evidencias_realizar"] = $value["evidencias_realizar"];
            //             // $detalles[$contador2]["evidencias_validadas"] = $value["evidencias_validadas"];
            //             // $detalles[$contador2]["evidencias_totales"] = $value["evidencias_totales"];
            //             // $detalles[$contador2]["evidencias_proceso"] = $value["evidencias_proceso"];

            //             // $listaFinal[$contador]["detalles"] = $detalles;
            //             // $contador2++;
            //         // }
            //     }
            //     else
            //     {
            //         $contador++;
            //         $contador2=0;
            //         $detalles=[];
            //         // $cumplimiento_tema=0;
            //         // $divisor_tema=0;
            //         $id_requisito = $value["id_requisito"];
            //         $listaFinal[$contador]["no_tema"] = $value["no"];
            //         $listaFinal[$contador]["id_tema"] = $value["id_tema"];
            //         $listaFinal[$contador]["nombre_tema"] = $value["nombre"];
            //         $listaFinal[$contador]["id_responsable"] = $value["id_empleado"];
            //         $listaFinal[$contador]["responsable_tema"] = $value["responsable"];
            //         $listaFinal[$contador]["estado_tema"] = $value["estado_tema"];

            //         // $cumplimiento_tema += $value["cumplimiento_requisito"];
            //         // $divisor_tema++;
            //         // $listaFinal[$contador]["cumplimiento_tema"] = $cumplimiento_tema/$divisor_tema;
            //         // if($value["divisor_tema"]==0)
            //         //     $divisor_tema = 1;
            //         // else
            //         //     $divisor_tema = $value["divisor_tema"];
            //         // $listaFinal[$contador]["cumplimiento_tema"] = ($value["cumplimiento_tema"]/$divisor_tema)*100;
            //         if($cumplimiento_tema[$value["id_tema"]]["divisor"] == 0)
            //             $listaFinal[$contador]["cumplimiento_tema"] = $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]/1;
            //         else
            //             $listaFinal[$contador]["cumplimiento_tema"] = $cumplimiento_tema[$value["id_tema"]]["cumplimiento"]/$cumplimiento_tema[$value["id_tema"]]["divisor"];
            //         // $listaFinal[$contador]["divisor_tema"] = $cumplimiento_tema[$value["id_tema"]]["divisor"];
            //         $listaFinal[$contador]["requisitos_por_tema"] = $cumplimiento_tema[$value["id_tema"]]["divisor"];

            //         if(isset($listaFinal[$contador]["divisor"]))
            //         {
            //             $listaFinal[$contador]["divisor"]++;
            //             $listaFinal[$contador]["cumplimiento_temaTemp"]+=$value["cumplimiento_requisito"];
            //             // echo $value["cumplimiento_requisito"]."\n";
            //         }
            //         else
            //         {
            //             $listaFinal[$contador]["divisor"]=1;
            //             $listaFinal[$contador]["cumplimiento_temaTemp"]=$value["cumplimiento_requisito"];
            //             // echo $value["cumplimiento_requisito"]."\n";
            //         }
                    
            //         $listaFinal[$contador]["id_requisito"] = $value["id_requisito"];
            //         $listaFinal[$contador]["requisito"] = $value["requisito"];
            //         $listaFinal[$contador]["penalizacion"] = $value["penalizacion"];
            //         $listaFinal[$contador]["cumplimiento_requisito"] = $value["cumplimiento_requisito"];
            //         $listaFinal[$contador]["estado_requisito"] = $value["estado_requisito"];
                    
            //         // if($bandera2 == 0)
            //         // {
            //         //     $id_registro = $value["id_registro"];
            //         //     $bandera2 = 1;
            //         // }
            //         // if($id_registro == $value["id_registro"])
            //         // {
            //             $detalles[$contador2]["id_registro"] = $value["id_registro"];
            //             $detalles[$contador2]["registro"] = $value["registro"];
            //             $detalles[$contador2]["frecuencia"] = $value["frecuencia"];
            //             $detalles[$contador2]["cumplimiento_registro"] = $value["cumplimiento_registro"];
            //             $detalles[$contador2]["evidencias_realizar"] = $value["evidencias_realizar"];
            //             $detalles[$contador2]["evidencias_validadas"] = $value["evidencias_validadas"];
            //             $detalles[$contador2]["evidencias_totales"] = $value["evidencias_totales"];
            //             $detalles[$contador2]["evidencias_proceso"] = $value["evidencias_proceso"];

            //             $listaFinal[$contador]["detalles"] = $detalles;
            //             $contador2++;
            //         }
            //         // else
            //         // {
            //         //     $detalles=[];
            //         //     $id_registro = $value["id_registro"];
            //         //     $contador2=0;
            //         //     $detalles[$contador2]["id_registro"] = $value["id_registro"];
            //         //     $detalles[$contador2]["registro"] = $value["registro"];
            //         //     $detalles[$contador2]["frecuencia"] = $value["frecuencia"];
            //         //     $detalles[$contador2]["cumplimiento_registro"] = $value["cumplimiento_registro"];
            //         //     $detalles[$contador2]["evidencias_realizar"] = $value["evidencias_realizar"];
            //         //     $detalles[$contador2]["evidencias_validadas"] = $value["evidencias_validadas"];
            //         //     $detalles[$contador2]["evidencias_totales"] = $value["evidencias_totales"];
            //         //     $detalles[$contador2]["evidencias_proceso"] = $value["evidencias_proceso"];

            //         //     $listaFinal[$contador]["detalles"] = $detalles;
            //         //     $contador2++;
            //         // }
            //     // }
            // }
            // var_dump($lista2);
            // $lista4= array();
            // foreach($listaFinal as $key => $value)
            // {
            //     if($bandera==0)
            //         $id_tema=$value["id_tema"];
            //         $bandera=1;
            //     if($id_tema==$value["id_tema"])
            //     {
            //         // if(isset($lista4[$id_tema]))
            //             $lista4[$id_tema] = $value["cumplimiento_temaTemp"]/$value["divisor"];
            //     }
            //     else
            //     {
            //         $id_tema = $value["id_tema"];
            //         $lista4[$id_tema] = $value["cumplimiento_temaTemp"]/$value["divisor"];
            //     }
            // }
            // foreach($listaFinal as $key=>$value)
            // {
            //     $listaFinal[$key]["cumplimiento_tema"] = $lista4[$value["id_tema"]];
            // }
            // var_dump($lista4);
            $bandera = 0;
            $id_tema;
            $lista3 = [];
            foreach($lista2 as $key => $value)
            {
                // if($bandera == 0)
                // {
                //     // $lista3[0];
                //     $id_tema = $value["id_tema"];
                //     $bandera=1;
                // }
                if(!isset($lista3[$value["id_tema"]]))
                    $lista3[$value["id_tema"]] = [];
                // if($id_tema != $value["id_tema"])
                // {
                //     array_push($lista3[],$value);
                //     $id_tema = $value["id_tema"];
                // }
                // else
                // {
                    // $id_tema = $value["id_tema"];
                    array_push($lista3[$value["id_tema"]],$value);
                // }
            }
            return $lista3;
        }catch(Exception $e)
        {
            throw $e;
            return -1;
        }
    }
    
    public function limpiar($lista)
    {
        $posicionesBorrar = array();
        foreach($lista as $key => $value)
        {
            $lista[$key]["requisitos_cumplidos"]=0;
            $lista[$key]["requisitos_tema"]=0;
            foreach($value as $ind => $val)
            {
                $lista[$key]["responsable_tema"]=$val["responsable_tema"];
                $lista[$key]["nombre_tema"]=$val["nombre_tema"];
                $lista[$key]["no_tema"]=$val["no_tema"];
                $bandera = 0;
                if($val["estado_requisito"] == "CUMPLIDO")
                    $lista[$key]["requisitos_cumplidos"]++;
                foreach($val["detalles_requisito"] as $i => $v)
                {
                    if($v["id_registro"] != null)
                        $bandera = 1;
                }
                if($bandera==1)
                    $lista[$key]["requisitos_tema"]++;
            }
            $lista[$key]["requisitos_tema"]==0? $posicionesBorrar[$key]=0: $lista[$key]["cumplimiento_tema"] = $lista[$key]["requisitos_cumplidos"]/$lista[$key]["requisitos_tema"] ;
        }
        foreach($posicionesBorrar as $key=>$val)
        {
            unset($lista[$key]);
        }
        return $lista;
    }
    // {
    // tempData["cumplimiento_tema"] = (tempData["requisitos_tema"]==0)?
    // }
    // tempData["requisitos_tema"] = 0;
    
    // tempData["requisitos_cumplidos"] = 0;
    // $.each(value,(ind,val)=>
    // {
    //     bandera = 0;
    //     if(val["estado_requisito"] == "CUMPLIDO")
    //         tempData["requisitos_cumplidos"]++;
    //     $.each(val.detalles_requisito,(i,v)=>{
    //         if(v.id_registro != null)
    //             bandera = 1;
    //     });
    //     if(bandera==1)
    //         tempData["requisitos_tema"]++;
    // });
    // tempData["cumplimiento_tema"] = (tempData["requisitos_tema"]==0)?
}


?>