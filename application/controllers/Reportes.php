<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Reportes_model');
        $this->load->model('Libros_model');
        if (!$this->session->userdata('login')) {
            redirect(base_url());
        }
	}

	public function cuadro_anual()
	{
		$año = $this->input->post("year");
		$categorias = '';
		if ($this->input->post("buscar")) {
			$categorias = $this->Reportes_model->getCategorias($año);
		}
		$contenido_interno = array(
            'categorias' => $categorias,
            'year' => $año,
        );
		$data = array(
            'title'     => 'Cuadro Anual de Prestamos de Libros',
            'contenido' => $this->load->view('reportes/cuadro_anual', $contenido_interno, true),
        );

        $this->load->view('template', $data);
	}

	public function exportar($año){
		$this->load->library('excel');
		

		//$this->excel->setActiveSheetIndex(0);
		$this->excel->setActiveSheetIndex(0)->mergeCells('B1:O1');
	    $this->excel->getActiveSheet()->setTitle('Cuadro Anual');
	    $contador = 3;

	    $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);

        $styleArray = array(
	        'font' => array(
	            'bold' => true,
	        ),
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        )
	    );
        //Le aplicamos negrita a los títulos de la cabecera.
        $this->excel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);

        $this->excel->getActiveSheet()->getStyle("A{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("B{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("C{$contador}")->getFont()->setBold(true);
        
        $this->excel->getActiveSheet()->getStyle("D{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("E{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("F{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("G{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("H{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("I{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("J{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("K{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("L{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("M{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("N{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("O{$contador}")->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(35);
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName("logo");
        $objDrawing->setDescription("Tt's my logo");
        $objDrawing->setPath("./assets/images/logo.png");
        $objDrawing->setOffsetY(10);
        $objDrawing->setOffsetX(10);
        $objDrawing->setCoordinates('A1');
        $objDrawing->setWidth(30);
        $objDrawing->setHeight(30);
        $objDrawing->setWorksheet($this->excel->getActiveSheet());

        $this->excel->getActiveSheet()->setCellValue("B1", 'CUADRO ANUAL DE PRESTAMOS DE LIBRO AÑO '.$año);

        $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'Codigo');	        
        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Categoria/Meses');
        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'Enero');
        $this->excel->getActiveSheet()->setCellValue("D{$contador}", 'Febrero');
        $this->excel->getActiveSheet()->setCellValue("E{$contador}", 'Marzo');
        $this->excel->getActiveSheet()->setCellValue("F{$contador}", 'Abril');
        $this->excel->getActiveSheet()->setCellValue("G{$contador}", 'Mayo');
        $this->excel->getActiveSheet()->setCellValue("H{$contador}", 'Junio');
        $this->excel->getActiveSheet()->setCellValue("I{$contador}", 'Julio');
        $this->excel->getActiveSheet()->setCellValue("J{$contador}", 'Agosto');
        $this->excel->getActiveSheet()->setCellValue("K{$contador}", 'Septiembre');
        $this->excel->getActiveSheet()->setCellValue("L{$contador}", 'Octubre');
        $this->excel->getActiveSheet()->setCellValue("M{$contador}", 'Noviembre');
        $this->excel->getActiveSheet()->setCellValue("N{$contador}", 'Diciembre');
        $this->excel->getActiveSheet()->setCellValue("O{$contador}", 'Total');

        $categorias = $this->Reportes_model->getCategorias($año);

         //Definimos la data del cuerpo.
        $i = 1;
        $totaljan=0;
        $totalfeb=0;
        $totalmar=0;
        $totalapr=0;
        $totalmay=0;
        $totaljun=0;
        $totaljul=0;
        $totalaug=0;
        $totalsep=0;
        $totaloct=0;
        $totalnov=0;
        $totaldec=0;
        foreach($categorias as $c){
        	//Incrementamos una fila más, para ir a la siguiente.
        	$contador++;
        	//Informacion de las filas de la consulta.
			$this->excel->getActiveSheet()->setCellValue("A{$contador}", $c->codigo);
	        $this->excel->getActiveSheet()->setCellValue("B{$contador}", $c->nombre);
	        $this->excel->getActiveSheet()->setCellValue("C{$contador}", $c->cantidades->jan);
	        $this->excel->getActiveSheet()->setCellValue("D{$contador}", $c->cantidades->feb);
	        $this->excel->getActiveSheet()->setCellValue("E{$contador}", $c->cantidades->mar);
	        $this->excel->getActiveSheet()->setCellValue("F{$contador}", $c->cantidades->apr);
	        $this->excel->getActiveSheet()->setCellValue("G{$contador}", $c->cantidades->may);
	        $this->excel->getActiveSheet()->setCellValue("H{$contador}", $c->cantidades->jun);
	        $this->excel->getActiveSheet()->setCellValue("I{$contador}", $c->cantidades->jul);
	        $this->excel->getActiveSheet()->setCellValue("J{$contador}", $c->cantidades->aug);
	        $this->excel->getActiveSheet()->setCellValue("K{$contador}", $c->cantidades->sep);
	        $this->excel->getActiveSheet()->setCellValue("L{$contador}", $c->cantidades->oct);
	        $this->excel->getActiveSheet()->setCellValue("M{$contador}", $c->cantidades->nov);
	        $this->excel->getActiveSheet()->setCellValue("N{$contador}", $c->cantidades->dec);
	        $this->excel->getActiveSheet()->setCellValue("O{$contador}", $c->cantidades->total_yearly);
	        
	        $i++;

            $totaljan = $totaljan + $c->cantidades->jan;
            $totalfeb = $totalfeb + $c->cantidades->feb;
            $totalmar = $totalmar + $c->cantidades->mar;
            $totalapr = $totalapr + $c->cantidades->apr;
            $totalmay = $totalmay + $c->cantidades->may;
            $totaljun = $totaljun + $c->cantidades->jun;
            $totaljul = $totaljul + $c->cantidades->jul;
            $totalaug = $totalaug + $c->cantidades->aug;
            $totalsep = $totalsep + $c->cantidades->sep;
            $totaloct = $totaloct + $c->cantidades->oct;
            $totalnov = $totalnov + $c->cantidades->nov;
            $totaldec = $totaldec + $c->cantidades->dec;
        }
        $contador = $contador +1;
        $this->excel->setActiveSheetIndex(0)->mergeCells("A{$contador}:B{$contador}");
        $this->excel->getActiveSheet()->getStyle("A{$contador}")->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->setCellValue("A{$contador}", "TOTAL MENSUALES");
        $this->excel->getActiveSheet()->setCellValue("C{$contador}", $totaljan);
        $this->excel->getActiveSheet()->setCellValue("D{$contador}", $totalfeb);
        $this->excel->getActiveSheet()->setCellValue("E{$contador}", $totalmar);
        $this->excel->getActiveSheet()->setCellValue("F{$contador}", $totalapr);
        $this->excel->getActiveSheet()->setCellValue("G{$contador}", $totalmay);
        $this->excel->getActiveSheet()->setCellValue("H{$contador}", $totaljun);
        $this->excel->getActiveSheet()->setCellValue("I{$contador}", $totaljul);
        $this->excel->getActiveSheet()->setCellValue("J{$contador}", $totalaug);
        $this->excel->getActiveSheet()->setCellValue("K{$contador}", $totalsep);
        $this->excel->getActiveSheet()->setCellValue("L{$contador}", $totaloct);
        $this->excel->getActiveSheet()->setCellValue("M{$contador}", $totalnov);
        $this->excel->getActiveSheet()->setCellValue("N{$contador}", $totaldec);
        $this->excel->getActiveSheet()->setCellValue("O{$contador}", $totaljan + $totalfeb + $totalmar + $totalapr + $totalmay + $totaljun + $totaljul + $totalaug + $totalsep + $totaloct + $totalnov + $totaldec);
        //Le ponemos un nombre al archivo que se va a generar.
        $archivo = "Cuadro_anual_de_prestamo_de_libros_ano_".$año.".xlsx";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$archivo.'"');
        header('Cache-Control: max-age=0');
        $objWriter = new PHPExcel_Writer_Excel2007($this->excel); 
        //Hacemos una salida al navegador con el archivo Excel.
        $objWriter->save('php://output');

	}


    public function cuadro_mensual(){
        $monthYear = $this->input->post("month-year");
        $data = explode("-", $monthYear);
        $year ='';
        $month ='';
        $dias = '';

       
        $categorias = '';
        if ($this->input->post("buscar")) {
            $categorias = $this->Reportes_model->getCategoriasMonth($data[0],$data[1]);
            $year =$data[1];
            $month =$data[0];
            $dias = $this->days_month($data[0],$data[1]);
        }
        $contenido_interno = array(
            'categorias' => $categorias,
            'year' => $year,
            'month' => $month,
            'monthYear' => $monthYear,
            'dias' => $dias
        );
        $data = array(
            'title'     => 'Cuadro Mensual de Prestamos de Libros',
            'contenido' => $this->load->view('reportes/cuadro_mensual', $contenido_interno, true),
        );

        $this->load->view('template', $data);
    }



    public function days_month($mes,$año){
        $dates = [];
        $num_of_days = cal_days_in_month(CAL_GREGORIAN, $mes, $año);
        for( $i=1; $i<= $num_of_days; $i++)
            $dates[]= str_pad($i,2,'0', STR_PAD_LEFT);

        return $dates;
    }

    public function exportarByMonth($mes,$año){

        $dias = $this->days_month($mes,$año);
        $categorias = $this->Reportes_model->getCategoriasMonth($mes,$año);
        $meses = ["ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SETIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"];

        $this->load->library('excel');
        $this->excel->getActiveSheet()->mergeCells($this->cellsToMergeByColsRow(1,count($dias) +2,1));
        $this->excel->getActiveSheet()->setTitle('Cuadro Mensual');

        $this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(35);
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName("logo");
        $objDrawing->setDescription("Tt's my logo");
        $objDrawing->setPath("./assets/images/logo.png");
        $objDrawing->setOffsetY(10);
        $objDrawing->setOffsetX(10);
        $objDrawing->setCoordinates('A1');
        $objDrawing->setWidth(30);
        $objDrawing->setHeight(30);
        $objDrawing->setWorksheet($this->excel->getActiveSheet());

        $this->excel->getActiveSheet()->setCellValue("B1", 'CUADRO DE PRESTAMOS DE LIBRO DEL MES '.$meses[$mes - 1]." DEL AÑO ".$año);

        $styleArray = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $this->excel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);

        $this->excel->getActiveSheet()->getColumnDimensionByColumn (1)->setAutoSize(true);
        for ($i=2; $i <= count($dias) + 2; $i++) { 
            $this->excel->getActiveSheet()->getColumnDimensionByColumn ($i)->setAutoSize(true);
        }
        $this->excel->getActiveSheet()->getCellByColumnAndRow(0,3)->getStyle()->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getCellByColumnAndRow(1,3)->getStyle()->applyFromArray($styleArray);
        for ($i=2; $i <= count($dias) + 2; $i++) { 
            $this->excel->getActiveSheet()->getCellByColumnAndRow($i,3)->getStyle()->applyFromArray($styleArray);
        }

        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 3, "CODIGO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, 3, "CATEGORIA/DIA");
        $col =2;
        foreach ($dias as $dia) {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 3, $dia);
            $col++;
        }
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 3, "TOTAL");

        $row = 4;
        $col =0;
        $totales =0;
        foreach ($categorias as $c) {
            $total = 0;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $c->codigo);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $c->nombre);
            $col = 2;
            foreach ($c->amountPerDays as $key => $value) {
                $total += $value;
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                $col++;
            }
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $total);
            $row++;
            $totales +=$total;
        }
        $this->excel->getActiveSheet()->mergeCells($this->cellsToMergeByColsRow(0,count($dias) +1,$row));

        $this->excel->getActiveSheet()->getCellByColumnAndRow(0,$row)->getStyle()->applyFromArray($styleArray);

        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, "TOTAL");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $totales);

        //Le ponemos un nombre al archivo que se va a generar.
        $archivo = "Cuadro_de_prestamos_de_libros_del_mes_de_".$meses[$mes-1]."_del_año_".$año.".xlsx";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$archivo.'"');
        header('Cache-Control: max-age=0');
        $objWriter = new PHPExcel_Writer_Excel2007($this->excel); 
        //Hacemos una salida al navegador con el archivo Excel.
        $objWriter->save('php://output');
    }

    public function cellsToMergeByColsRow($start = -1, $end = -1, $row = -1){
        $merge = 'A1:A1';
        if($start>=0 && $end>=0 && $row>=0){
            $start = PHPExcel_Cell::stringFromColumnIndex($start);
            $end = PHPExcel_Cell::stringFromColumnIndex($end);
            $merge = "$start{$row}:$end{$row}";
        }
        return $merge;
    }

    public function prestamos_realizados(){

        $contenido_interno = array(
            "prestamos" => $this->Reportes_model->getPrestamos()
        );
        $data = array(
            'title'     => 'Prestamos Realizados',
            'contenido' => $this->load->view('reportes/prestamos_realizados', $contenido_interno, true),
        );

        $this->load->view('template', $data);
    }

    public function exportarPrestamos(){
        $this->load->library('excel');
        

        //$this->excel->setActiveSheetIndex(0);
        $this->excel->setActiveSheetIndex(0)->mergeCells('B1:I1');
        $this->excel->getActiveSheet()->setTitle('Prestamos Realizados');
        $contador = 3;

        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);


        $styleArray = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        //Le aplicamos negrita a los títulos de la cabecera.
        $this->excel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);

        $this->excel->getActiveSheet()->getStyle("A{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("B{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("C{$contador}")->getFont()->setBold(true);
        
        $this->excel->getActiveSheet()->getStyle("D{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("E{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("F{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("G{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("H{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("I{$contador}")->getFont()->setBold(true);
        

        $this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(35);
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName("logo");
        $objDrawing->setDescription("Tt's my logo");
        $objDrawing->setPath("./assets/images/logo.png");
        $objDrawing->setOffsetY(10);
        $objDrawing->setOffsetX(10);
        $objDrawing->setCoordinates('A1');
        $objDrawing->setWidth(30);
        $objDrawing->setHeight(30);
        $objDrawing->setWorksheet($this->excel->getActiveSheet());

        $this->excel->getActiveSheet()->setCellValue("B1", 'REGISTRO DE PRESTAMOS REALIZADOS');

        $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'N°');         
        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'APELLIDOS Y NOMBRES');
        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'TIPO DE LECTOR');
        $this->excel->getActiveSheet()->setCellValue("D{$contador}", 'DNI/CARNET');
        $this->excel->getActiveSheet()->setCellValue("E{$contador}", 'TITULO DE LIBRO');
        $this->excel->getActiveSheet()->setCellValue("F{$contador}", 'CODIGO TOPOGRAFICO');
        $this->excel->getActiveSheet()->setCellValue("G{$contador}", 'FECHA DE PRESTAMO');
        $this->excel->getActiveSheet()->setCellValue("H{$contador}", 'FECHA DE DEVOLUCION');
        $this->excel->getActiveSheet()->setCellValue("I{$contador}", 'HORA');

        $prestamos = $this->Reportes_model->getPrestamos();
        $i=1;
        foreach($prestamos as $p){
            //Incrementamos una fila más, para ir a la siguiente.
            $contador++;
            //Informacion de las filas de la consulta.
            $this->excel->getActiveSheet()->setCellValue("A{$contador}", $i);
            $this->excel->getActiveSheet()->setCellValue("B{$contador}", $p->apellidos.",".$p->nombres);
            $this->excel->getActiveSheet()->setCellValue("C{$contador}", $p->tipolector);
            $this->excel->getActiveSheet()->setCellValue("D{$contador}", $p->num_documento);
            $this->excel->getActiveSheet()->setCellValue("E{$contador}", $p->titulo);
            $this->excel->getActiveSheet()->setCellValue("F{$contador}", $p->codigo_topografico);
            $this->excel->getActiveSheet()->setCellValue("G{$contador}", $p->fecha_prestamo);
            $this->excel->getActiveSheet()->setCellValue("H{$contador}", $p->fecha_devolucion);
            $this->excel->getActiveSheet()->setCellValue("I{$contador}",  date("h:i a", strtotime($p->hora)));
            
            $i++;
        }

        //Le ponemos un nombre al archivo que se va a generar.
        $archivo = "Registro_prestamos_realizados.xlsx";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$archivo.'"');
        header('Cache-Control: max-age=0');
        $objWriter = new PHPExcel_Writer_Excel2007($this->excel); 
        //Hacemos una salida al navegador con el archivo Excel.
        $objWriter->save('php://output');
    }

    public function total_libros(){

        $contenido_interno = array(
            "libros" => $this->Libros_model->getLibros()
        );
        $data = array(
            'title'     => 'Total de libros',
            'contenido' => $this->load->view('reportes/total_libros', $contenido_interno, true),
        );

        $this->load->view('template', $data);
    }

    public function exportarLibros(){
        $this->load->library('excel');
        

        //$this->excel->setActiveSheetIndex(0);
        $this->excel->setActiveSheetIndex(0)->mergeCells('B1:k1');
        $this->excel->getActiveSheet()->setTitle('Total de Libros');
        $contador = 3;

        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        

        $styleArray = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        //Le aplicamos negrita a los títulos de la cabecera.
        $this->excel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);

        $this->excel->getActiveSheet()->getStyle("A{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("B{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("C{$contador}")->getFont()->setBold(true);
        
        $this->excel->getActiveSheet()->getStyle("D{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("E{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("F{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("G{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("H{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("I{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("J{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("K{$contador}")->getFont()->setBold(true);
        

        $this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(35);
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName("logo");
        $objDrawing->setDescription("Tt's my logo");
        $objDrawing->setPath("./assets/images/logo.png");
        $objDrawing->setOffsetY(10);
        $objDrawing->setOffsetX(10);
        $objDrawing->setCoordinates('A1');
        $objDrawing->setWidth(30);
        $objDrawing->setHeight(30);
        $objDrawing->setWorksheet($this->excel->getActiveSheet());

        $this->excel->getActiveSheet()->setCellValue("B1", 'TOTAL DE LIBROS');

        $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'N°');         
        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'TITULO');
        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'AUTOR');
        $this->excel->getActiveSheet()->setCellValue("D{$contador}", 'AÑO');
        $this->excel->getActiveSheet()->setCellValue("E{$contador}", 'EDITORIAL');
        $this->excel->getActiveSheet()->setCellValue("F{$contador}", 'EDICCION');
        $this->excel->getActiveSheet()->setCellValue("G{$contador}", 'CODIGO TOPOGRAFICO');
        $this->excel->getActiveSheet()->setCellValue("H{$contador}", 'CODIGO DE BARRAS');
        $this->excel->getActiveSheet()->setCellValue("I{$contador}", 'CATEGORIA');
        $this->excel->getActiveSheet()->setCellValue("J{$contador}", 'IDIOMA');
        $this->excel->getActiveSheet()->setCellValue("K{$contador}", 'EJEMPLARES');

        $libros = $this->Libros_model->getLibros();

         //Definimos la data del cuerpo.
        $i = 1;
        foreach($libros as $l){
            //Incrementamos una fila más, para ir a la siguiente.
            $contador++;
            //Informacion de las filas de la consulta.
            $this->excel->getActiveSheet()->setCellValue("A{$contador}", $i);
            $this->excel->getActiveSheet()->setCellValue("B{$contador}", $l->titulo);
            $this->excel->getActiveSheet()->setCellValue("C{$contador}", $l->autor);
            $this->excel->getActiveSheet()->setCellValue("D{$contador}", $l->año_publicacion);
            $this->excel->getActiveSheet()->setCellValue("E{$contador}", $l->editorial);
            $this->excel->getActiveSheet()->setCellValue("F{$contador}", $l->ediccion);
            $this->excel->getActiveSheet()->setCellValue("G{$contador}", $l->codigo_topografico);
            $this->excel->getActiveSheet()->setCellValue("H{$contador}", $l->codigo_barras);
            $this->excel->getActiveSheet()->setCellValue("I{$contador}", $l->categoria);
            $this->excel->getActiveSheet()->setCellValue("J{$contador}", $l->idioma);
            $this->excel->getActiveSheet()->setCellValue("K{$contador}", $l->ejemplares);
            
            $i++;
        }
        //Le ponemos un nombre al archivo que se va a generar.
        $archivo = "total_libros.xlsx";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$archivo.'"');
        header('Cache-Control: max-age=0');
        $objWriter = new PHPExcel_Writer_Excel2007($this->excel); 
        //Hacemos una salida al navegador con el archivo Excel.
        $objWriter->save('php://output');

    }
}
