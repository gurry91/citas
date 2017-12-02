<?php 

	/*
		Genera un elemento select de HTML a partir de un array de datos
	*/
	function generarCombo($datos, $atributos){
		$SEPARATOR = " ";
		$comboNodo = "<select";
		
		$comboNodo .= serializaAtributos($atributos);
		$comboNodo .= ">" ;

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