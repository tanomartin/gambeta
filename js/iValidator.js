/* ************************************************************************************* *\
 * The MIT License
 * Copyright (c) 2007 Horacio R. Valdez  - http://www.hvaldez.com.ar
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this
 * software and associated documentation files (the "Software"), to deal in the Software
 * without restriction, including without limitation the rights to use, copy, modify,
 * merge, publish, distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to the following
 * conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all copies
 * or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A
 * PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 * 
\* ************************************************************************************* */
var iValidator = new Class
({
 	////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Propiedades
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	formatoFecha: 'EURO',													
	formatoHora: '12',	
	hayErrores: false,
	automatico: 'false',
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Contructor
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	initialize: function() 
	{ 
		this.errorColor="#FFF0F0";													
	},		
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Recibe como primer parámetro el mensaje de error y los parámetros subsiguientes son los
	// objetos que causan el error.
	// Pinta de color los objetos que causan errores.
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	//TODO: usar un tru/false si deseamos aplicar el estilo a las cosas.
	AgregarError: function AgregarError(field, msg, useStyle) 
	{
		this.hayErrores = true;
		if(useStyle)
		{
			$(field).setProperty('class','Error');
			$(field).currentstyle = 'Error';
		}
		
		//Deja el layer debajo del error
		var divElem = document.createElement("span");
		var brElem = document.createElement("br"); 
		divElem.id = field + "_div";
		brElem.id = field + "_br";
		divElem.style.height = "22";
		divElem.innerHTML = "* " + msg;
		divElem.style.color = "#ff0000";
		//$(field).parentNode.appendChild(brElem);	
		$(field).parentNode.appendChild(divElem);	
	},
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Recibe como parametros los objetos que debe despintar ya que no tienen errores.
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	EliminarError: function ()
	{
		for (var i=0; i < arguments.length ; i++) 
		{
			$(arguments[i]).style.backgroundColor="";
				this.RemoveError(arguments[i]);
		}
	},
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Indica si el campo es vacio o no. 
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	Requerido: function(field ,msg) 
	{
		//Verifico si son radiogroup
		var group = document.getElementsByName(field);
		if(group.length > 1)
		{
			for(var i=0; i < group.length; i++)
			{
				if(group[i].type == 'radio')
				{
					group[i].addEvent('click', function () { this._RadioRequerido(field,msg);	}.bind(this) );	
					
				}
			}

			output = this._RadioRequerido(field,msg);
		}
		else
		{
			switch($(field).type)
			{
				case 'text':
				case 'password':
				case 'textarea':
					$(field).addEvent('blur', function () { this._TextBoxRequerido(field,msg);	}.bind(this) );	
					output = this._TextBoxRequerido(field,msg);
					break;
				case 'checkbox':
					$(field).addEvent('click', function () { this._CheckBoxRequerido(field,msg);	}.bind(this) );	
					output = this._CheckBoxRequerido(field,msg);
					break;
			}
		}
		
		return output;
	},
	
	_TextBoxRequerido: function(field,msg) 
	{
		this.EliminarError(field);
		var retVal = true;
		
		if ($(field).value.replace(/ /g, '') == "")
		{
			this.AgregarError(field, msg, true);
			retVal = false
		}
		else
		{
			$(field).setProperty('class','Validated');
			$(field).currentstyle = 'Validated';
		}
		return retVal;
	},
	
	_CheckBoxRequerido: function(field,msg) 
	{
		this.EliminarError(field);
		var retVal = true;
		if (!$(field).checked)
		{
			this.AgregarError(field, msg, false);
			retVal = false
		}
		return retVal;
	},
	
	_RadioRequerido: function(field,msg) 
	{
		retVal=false;
		var group = document.getElementsByName(field);
		if(group.length > 1)
		{
			for(var i=0; i < group.length; i++)
			{
				this.EliminarError(group[i].id);
				retVal = retVal || group[i].checked;
			}
			if(!retVal)	this.AgregarError(group[group.length-1].id, msg, false);
		}
		return retVal;
	},
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Indica si el e-mail ingresado es vàlido. 
	// Devuelve TRUE si es vàlido y FALSE si no lo es.
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	Email: function (field,msg) 
	{
		$(field).addEvent('blur', function () { this._Email(field,msg);	}.bind(this) );	
		return this._Email(field,msg);
	},
	
	_Email: function (field,msg) 
	{
		this.EliminarError(field);
		var retVal = true;
		var email  = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
		if (!email.test($(field).value)) 
		{
			this.AgregarError(field, msg, true);
			retVal = false
		}
		else
		{
			$(field).setProperty('class','Validated');
			$(field).currentstyle = 'Validated';
		}
		return retVal;
	},
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Dado el textbox1 y el textbox2, compara su contenido y devuelve TRUE si son iguales 
	// y FALSE si no lo son.
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	Iguales: function (field2, field1, msg)
	{
		$(field2).addEvent('blur', function () { this._Iguales(field1, field2, msg);	}.bind(this) );	
		return this._Iguales(field1, field2, msg);
	},
	
	_Iguales: function (field1, field2, msg)
	{
		this.EliminarError(field2);
		var retVal = true;
		if($(field1).value != $(field2).value || $(field2).value.replace(/ /g, '') == "")
		{
			this.AgregarError(field2, msg, true);
			retVal = false
		}
		else
		{
			$(field2).setProperty('class','Validated');
			$(field2).currentstyle = 'Validated';
		}
		return retVal;
	
	},
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Dado un textboxcompara su contenido con la longitud y el operador indicado.  
	// Devuelve TRUE si machea la expresion y FALSE si no lo hace.
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	Longitud: function (field, operator, length, msg)
	{
		$(field).addEvent('blur', function () { this._Longitud(field, operator, length, msg);	}.bind(this) );	
		return this._Longitud(field, operator, length, msg);
	},
	
	_Longitud: function (field, operator, length, msg)
	{
		this.EliminarError(field);
		var retVal = true;
		if (operator == "=") operator = "==";
		if ( !(eval("$(field).value.length "+operator+" length")) )
		{
			this.AgregarError(field, msg, true);
			retVal = false
		}
		else
		{
			$(field).setProperty('class','Validated');
			$(field).currentstyle = 'Validated';
		}
		return retVal;
	},
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Indica si el numero ingresado es un entero. 
	// Devuelve TRUE si lo es  y FALSE si no lo es.
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	Entero: function (field, msg)
	{
		$(field).addEvent('blur', function () { this._Entero(field,msg); }.bind(this) );	
		return this._Entero(field,msg);
	},
	
	_Entero: function (field, msg)
	{
		//alert("llega"+event.client.x);
		this.EliminarError(field);
		var retVal = true;
		if ( ! ( parseInt($(field).value) == $(field).value ) )
		{
			this.AgregarError(field, msg, true);
			retVal = false
		}
		else
		{
			$(field).setProperty('class','Validated');
			$(field).currentstyle = 'Validated';
		}
		return retVal;
	},
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Dado un textbox compara su contenido con el valor y el operador indicado.  
	// Devuelve TRUE si machea la expresion y FALSE si no lo hace.
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	Valor: function (field, operator, valor, msg)
	{
		this.EliminarError(field);
		var retVal = true;
		if (operator == "=") operator = "==";
		if ( !(eval("$(field).value "+operator+" valor")) )
		{
			this.AgregarError(field, msg, true);
			retVal = false;
		}
		return retVal;
	},
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Elimina el mensaje junto al campo que fue validado
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	RemoveError: function (name)
	{
		var divElement = $(name+"_div");

		if(divElement != null) 
		{
			$(name).parentNode.removeChild(divElement);

		}
	},
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Indica si el una fecha ingresada es vàlida y tiene el formato correcto. 
	// Devuelve TRUE si es vàlida y FALSE si no lo es.
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	Fecha: function (field, msg) 
	{
		$(field).addEvent('blur', function () { this._Fecha(field, msg);	}.bind(this) );	
		return this._Fecha(field, msg);
	},
	
	_Fecha: function (field, msg) 
	{
		
		this.EliminarError(field);
		var retVal = true;
		var datePat;
		var formatoCorrecto;
		
		switch(this.formatoFecha) {
			case 'ISO':
				datePat = /^(?:(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(\/|-|\.)(?:0?2\1(?:29))$)|(?:(?:1[6-9]|[2-9]\d)?\d{2})(\/|-|\.)(?:(?:(?:0?[13578]|1[02])\2(?:31))|(?:(?:0?[1,3-9]|1[0-2])\2(29|30))|(?:(?:0?[1-9])|(?:1[0-2]))\2(?:0?[1-9]|1\d|2[0-8]))$/;
				formatoCorrecto = "aaaa/mm/dd";
				break;
			case 'EURO': 
				datePat = "(((0[1-9]|[12][0-9]|3[01])([/])(0[13578]|10|12)([/])([1-2][0,9][0-9][0-9]))|(([0][1-9]|[12][0-9]|30)([/])(0[469]|11)([/])([1-2][0,9][0-9][0-9]))|((0[1-9]|1[0-9]|2[0-8])([/])(02)([/])([1-2][0,9][0-9][0-9]))|((29)(\.|-|\/)(02)([/])([02468][048]00))|((29)([/])(02)([/])([13579][26]00))|((29)([/])(02)([/])([0-9][0-9][0][48]))|((29)([/])(02)([/])([0-9][0-9][2468][048]))|((29)([/])(02)([/])([0-9][0-9][13579][26])))";
				formatoCorrecto = "dd/mm/aaaa";
				break;
			case 'ANSI':
				datePat = /^((\d{2}(([02468][048])|([13579][26]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|([1-2][0-9])))))|(\d{2}(([02468][1235679])|([13579][01345789]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|(1[0-9])|(2[0-8]))))))(\s(((0?[1-9])|(1[0-2]))\:([0-5][0-9])((\s)|(\:([0-5][0-9])\s))([AM|PM|am|pm]{2,2})))?$/;
				formatoCorrecto = "aaaa/mm/dd hh:mm:ss am/pm";
				break;
		}		
		
		var matchArray = $(field).value.match(datePat);
		if (matchArray == null) 
		{
			msg += ' [formato: '+formatoCorrecto+']'
			this.AgregarError(field, msg, true);
			retVal = false;		
		}
		else
		{
			$(field).setProperty('class','Validated');
			$(field).currentstyle = 'Validated';
		}
		
		return retVal;
	},


	////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Indica si el una hora ingresada es vàlida y tiene el formato correcto. 
	// Devuelve TRUE si es vàlida y FALSE si no lo es.
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	Hora: function (field, msg)
	{
		this.EliminarError(field);
		var retVal = true;
		var datePat;
	
		switch(this.formatoHora) 
		{
			case '24':
				datePat = /^([0-1][0-9]|2[0-3]):[0-5][0-9]$/;
				formatoCorrecto = "hh:mm";
				break;
				
			case '12':
				datePat = /^(1|01|2|02|3|03|4|04|5|05|6|06|7|07|8|08|9|09|10|11|12{1,2}):(([0-5]{1}[0-9]{1}\s{0,1})([AM|PM|am|pm]{2,2}))\W{0}$/;
				formatoCorrecto = "hh:mm am/pm";
				break;
		}
		var matchArray = $(field).value.match(datePat);
		
		if (matchArray == null) 
		{
			msg += ' [formato: '+formatoCorrecto+']'
			this.AgregarError(field, msg, true);
			retVal = false;		
		}
		
		return retVal;
	},
	
	CaracteresNoValidos: function(field, msg, novalidos)
	{
		$(field).addEvent('blur', function () { this._CaracteresNoValidos(field, msg, novalidos);	}.bind(this) );	
		return this._CaracteresNoValidos(field, msg, novalidos);
	
	},
	
	_CaracteresNoValidos: function(field, msg, novalidos)
	{
		this.EliminarError(field);
		var retVal = true;
		var i=0;
		while(i < novalidos.length && retVal)
		{
			if($(field).value.toLowerCase().indexOf(novalidos[i]) != -1) 
				retVal = false;
			i++;
		}
		if(!retVal)	
			this.AgregarError(field, msg, true);
		else
		{
			$(field).setProperty('class','Validated');
			$(field).currentstyle = 'Validated';
		}
			
		return retVal;
	}
});

