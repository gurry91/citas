<?php 

	/*
		Genera un elemento select de HTML a partir de un array de datos
	*/
	function generarCombo($datos, $atributos, $elementoVacio){
		$SEPARATOR = " ";
		$comboNodo = "<select";
		
		$comboNodo .= serializaAtributos($atributos);
		$comboNodo .= ">" ;

		if($elementoVacio){
			$comboNodo .= "<option >";
			$comboNodo .= "Seleccione una opcion";
			$comboNodo .= "</option>";
		}

		foreach ($datos as $valor => $label) {
			$comboNodo .= "<option ";
			$comboNodo .= "value='" . $valor . "'>";
			$comboNodo .= $label;
			$comboNodo .= "</option>";
		}

		$comboNodo .= "</select>" ;

		return $comboNodo;
	}

	/*
		Genera select HTML a partir de un array de arrays asociativos. Util para parsear resultados desde base de datos.
	*/
	function generarComboDesdeAssocArray($datos, $atributos, $campoId, $campoLabel, $elementoVacio){
		$datosParseadosParaCombo = array();
		
		foreach ($datos as $row) {
			$id = $row[$campoId];
			$label = $row[$campoLabel];

			$datosParseadosParaCombo[$id] = $label;
		}

		return generarCombo($datosParseadosParaCombo, $atributos, $elementoVacio);
	}

	/*
		Genera una cadena de atributos HTML a partir de un array
	*/
	function serializaAtributos($atributos){
		$SEPARATOR = " ";
		$atributosHTML = "";

		foreach ($atributos as $atributo => $valor) {
			$atributosHTML .= $SEPARATOR ;
			$atributosHTML .= $atributo ;
			$atributosHTML .= "=" ;
			$atributosHTML .= "'" . $valor . "'" ;
		}

		return $atributosHTML;
	}
 ?>