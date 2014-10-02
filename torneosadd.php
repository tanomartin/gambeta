<?php
define("EW_PAGE_ID", "add", TRUE); // Page ID
define("EW_TABLE_NAME", 'torneos', TRUE);
?>
<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php
define("EW_DEFAULT_LOCALE", "es-AR", TRUE);
@setlocale(LC_ALL, EW_DEFAULT_LOCALE);
?>
<?php include "ewcfg50.php" ?>
<?php include "ewmysql50.php" ?>
<?php include "phpfn50.php" ?>
<?php include "torneosinfo.php" ?>
<?php include "userfn50.php" ?>
<?php include "usuariosinfo.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Open connection to the database
$conn = ew_Connect();
?>
<?php
$Security = new cAdvancedSecurity();
?>
<?php
if (!$Security->IsLoggedIn()) $Security->AutoLogin();
if (!$Security->IsLoggedIn()) {
	$Security->SaveLastUrl();
	Page_Terminate("login.php");
}
?>
<?php

// Common page loading event (in userfn*.php)
Page_Loading();
?>
<?php

// Page load event, used in current page
Page_Load();
?>
<?php
$torneos->Export = @$_GET["export"]; // Get export parameter
$sExport = $torneos->Export; // Get export parameter, used in header
$sExportFile = $torneos->TableVar; // Get export file, used in header
?>
<?php

// Load key values from QueryString
$bCopy = TRUE;
if (@$_GET["id"] != "") {
  $torneos->id->setQueryStringValue($_GET["id"]);
} else {
  $bCopy = FALSE;
}

// Create form object
$objForm = new cFormObj();

// Process form if post back
if (@$_POST["a_add"] <> "") {
  $torneos->CurrentAction = $_POST["a_add"]; // Get form action
  GetUploadFiles(); // Get upload files
  LoadFormValues(); // Load form values
} else { // Not post back
  if ($bCopy) {
    $torneos->CurrentAction = "C"; // Copy Record
  } else {
    $torneos->CurrentAction = "I"; // Display Blank Record
    LoadDefaultValues(); // Load default values
  }
}

// Perform action based on action code
switch ($torneos->CurrentAction) {
  case "I": // Blank record, no action required
		break;
  case "C": // Copy an existing record
   if (!LoadRow()) { // Load record based on key
      $_SESSION[EW_SESSION_MESSAGE] = "No se encontraron registros"; // No record found
      Page_Terminate($torneos->getReturnUrl()); // Clean up and return
    }
		break;
  case "A": // ' Add new record
		$torneos->SendEmail = TRUE; // Send email on add success
    if (AddRow()) { // Add successful
      $_SESSION[EW_SESSION_MESSAGE] = "Registro agregado satisfactoriamente"; // Set up success message
      Page_Terminate($torneos->KeyUrl($torneos->getReturnUrl())); // Clean up and return
    } else {
      RestoreFormValues(); // Add failed, restore form values
    }
}

// Render row based on row type
$torneos->RowType = EW_ROWTYPE_ADD;  // Render add type
RenderRow();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--
var EW_PAGE_ID = "add"; // Page id

//-->
</script>
<script type="text/javascript">
<!--

function ew_ValidateForm(fobj) {
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_nombre"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Por favor ingrese los campos requeridos - Nombre"))
				return false;
		}
		elm = fobj.elements["x" + infix + "_fechaInicio"];
		if (elm && !ew_CheckEuroDate(elm.value)) {
			if (!ew_OnError(elm, "Fecha incorrecta, formato = dd/mm/yyyy - Fecha Inicio"))
				return false; 
		}
		elm = fobj.elements["x" + infix + "_fechaFin"];
		if (elm && !ew_CheckEuroDate(elm.value)) {
			if (!ew_OnError(elm, "Fecha incorrecta, formato = dd/mm/yyyy - Fecha Fin"))
				return false; 
		}
		elm = fobj.elements["x" + infix + "_logo"];
		if (elm && !ew_CheckFileType(elm.value)) { 
			if (!ew_OnError(elm, "No se permite el tipo de archivo")) 
				return false; 
		}
		elm = fobj.elements["x" + infix + "_orden"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Por favor ingrese los campos requeridos - Orden"))
				return false;
		}
		elm = fobj.elements["x" + infix + "_orden"];
		if (elm && !ew_CheckInteger(elm.value)) {
			if (!ew_OnError(elm, "Entero Incorrecto - Orden"))
				return false; 
		}
		elm = fobj.elements["x" + infix + "_activo[]"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Por favor ingrese los campos requeridos - Activo"))
				return false;
		}
	}
	return true;
}

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1" />
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script type="text/javascript">
<!--
var ew_MultiPagePage = "Página"; // multi-page Page Text
var ew_MultiPageOf = "de"; // multi-page Of Text
var ew_MultiPagePrev = "Ant"; // multi-page Prev Text
var ew_MultiPageNext = "Siguiente"; // multi-page Next Text

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Agregar a TABLA: Torneos<br><br><a href="<?php echo $torneos->getReturnUrl() ?>">Volver</a></span></p>
<?php
if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Mesasge in Session, display
?>
<p><span class="ewmsg"><?php echo $_SESSION[EW_SESSION_MESSAGE] ?></span></p>
<?php
  $_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
}
?>
<form name="ftorneosadd" id="ftorneosadd" action="torneosadd.php" method="post" enctype="multipart/form-data" onSubmit="return ew_ValidateForm(this);">
<p>
<input type="hidden" name="a_add" id="a_add" value="A">
<table class="ewTable">
  <tr class="ewTableRow">
    <td class="ewTableHeader">Nombre<span class='ewmsg'>&nbsp;*</span></td>
    <td<?php echo $torneos->nombre->CellAttributes() ?>><span id="cb_x_nombre">
<input type="text" name="x_nombre" id="x_nombre" title="" size="100" maxlength="150" value="<?php echo $torneos->nombre->EditValue ?>"<?php echo $torneos->nombre->EditAttributes() ?>>
</span></td>
  </tr>
  <tr class="ewTableAltRow">
    <td class="ewTableHeader">Fecha Inicio</td>
    <td<?php echo $torneos->fechaInicio->CellAttributes() ?>><span id="cb_x_fechaInicio">
<input type="text" name="x_fechaInicio" id="x_fechaInicio" title="" value="<?php echo $torneos->fechaInicio->EditValue ?>"<?php echo $torneos->fechaInicio->EditAttributes() ?>>
&nbsp;<img src="images/ew_calendar.gif" id="cx_fechaInicio" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup(
{
inputField : "x_fechaInicio", // ID of the input field
ifFormat : "%d/%m/%Y", // the date format
button : "cx_fechaInicio" // ID of the button
}
);
</script>
</span></td>
  </tr>
  <tr class="ewTableRow">
    <td class="ewTableHeader">Fecha Fin</td>
    <td<?php echo $torneos->fechaFin->CellAttributes() ?>><span id="cb_x_fechaFin">
<input type="text" name="x_fechaFin" id="x_fechaFin" title="" value="<?php echo $torneos->fechaFin->EditValue ?>"<?php echo $torneos->fechaFin->EditAttributes() ?>>
&nbsp;<img src="images/ew_calendar.gif" id="cx_fechaFin" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup(
{
inputField : "x_fechaFin", // ID of the input field
ifFormat : "%d/%m/%Y", // the date format
button : "cx_fechaFin" // ID of the button
}
);
</script>
</span></td>
  </tr>
  <tr class="ewTableAltRow">
    <td class="ewTableHeader">Logo</td>
    <td<?php echo $torneos->logo->CellAttributes() ?>><span id="cb_x_logo">
<input type="file" name="x_logo" id="x_logo" title="" <?php echo $torneos->logo->EditAttributes() ?>>
</span></td>
  </tr>
  <tr class="ewTableRow">
    <td class="ewTableHeader">Orden<span class='ewmsg'>&nbsp;*</span></td>
    <td<?php echo $torneos->orden->CellAttributes() ?>><span id="cb_x_orden">
<input type="text" name="x_orden" id="x_orden" title="" size="10" value="<?php echo $torneos->orden->EditValue ?>"<?php echo $torneos->orden->EditAttributes() ?>>
</span></td>
  </tr>
  <tr class="ewTableAltRow">
    <td class="ewTableHeader">Activo<span class='ewmsg'>&nbsp;*</span></td>
    <td<?php echo $torneos->activo->CellAttributes() ?>><span id="cb_x_activo">
<?php
$arwrk = $torneos->activo->EditValue;
if (is_array($arwrk)) {
	$armultiwrk= explode(",", strval($torneos->activo->CurrentValue));
	$rowswrk = count($arwrk);
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = "";
		for ($ari = 0; $ari < count($armultiwrk); $ari++) {
			if (strval($arwrk[$rowcntwrk][0]) == trim(strval($armultiwrk[$ari]))) {
				$selwrk = " checked";
				break;
			}
		}
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<input type="checkbox" name="x_activo[]" id="x_activo[]" title="" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $torneos->activo->EditAttributes() ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</span></td>
  </tr>
</table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="  AGREGAR  ">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php

// If control is passed here, simply terminate the page without redirect
Page_Terminate();

// -----------------------------------------------------------------
//  Subroutine Page_Terminate
//  - called when exit page
//  - clean up connection and objects
//  - if url specified, redirect to url, otherwise end response
function Page_Terminate($url = "") {
	global $conn;

	// Page unload event, used in current page
	Page_Unload();

	// Global page unloaded event (in userfn*.php)
	Page_Unloaded();

	 // Close Connection
	$conn->Close();

	// Go to url if specified
	if ($url <> "") {
		ob_end_clean();
		header("Location: $url");
	}
	exit();
}
?>
<?php

// Function Get upload files
function GetUploadFiles() {
	global $objForm, $torneos;

	// Get upload data
		if ($torneos->logo->Upload->UploadFile()) {

			// No action required
		} else {
			echo $torneos->logo->Upload->Message;
			exit();
		}
}
?>
<?php

// Load default values
function LoadDefaultValues() {
	global $torneos;
	$torneos->logo->CurrentValue = NULL; // Clear file related field
	$torneos->activo->CurrentValue = 1;
}
?>
<?php

// Load form values
function LoadFormValues() {

	// Load from form
	global $objForm, $torneos;
	$torneos->nombre->setFormValue($objForm->GetValue("x_nombre"));
	$torneos->fechaInicio->setFormValue($objForm->GetValue("x_fechaInicio"));
	$torneos->fechaInicio->CurrentValue = ew_UnFormatDateTime($torneos->fechaInicio->CurrentValue, 7);
	$torneos->fechaFin->setFormValue($objForm->GetValue("x_fechaFin"));
	$torneos->fechaFin->CurrentValue = ew_UnFormatDateTime($torneos->fechaFin->CurrentValue, 7);
	$torneos->orden->setFormValue($objForm->GetValue("x_orden"));
	$torneos->activo->setFormValue($objForm->GetValue("x_activo"));
}

// Restore form values
function RestoreFormValues() {
	global $torneos;
	$torneos->nombre->CurrentValue = $torneos->nombre->FormValue;
	$torneos->fechaInicio->CurrentValue = $torneos->fechaInicio->FormValue;
	$torneos->fechaInicio->CurrentValue = ew_UnFormatDateTime($torneos->fechaInicio->CurrentValue, 7);
	$torneos->fechaFin->CurrentValue = $torneos->fechaFin->FormValue;
	$torneos->fechaFin->CurrentValue = ew_UnFormatDateTime($torneos->fechaFin->CurrentValue, 7);
	$torneos->orden->CurrentValue = $torneos->orden->FormValue;
	$torneos->activo->CurrentValue = $torneos->activo->FormValue;
}
?>
<?php

// Load row based on key values
function LoadRow() {
	global $conn, $Security, $torneos;
	$sFilter = $torneos->SqlKeyFilter();
	if (!is_numeric($torneos->id->CurrentValue)) {
		return FALSE; // Invalid key, exit
	}
	$sFilter = str_replace("@id@", ew_AdjustSql($torneos->id->CurrentValue), $sFilter); // Replace key value

	// Call Row Selecting event
	$torneos->Row_Selecting($sFilter);

	// Load sql based on filter
	$torneos->CurrentFilter = $sFilter;
	$sSql = $torneos->SQL();
	if ($rs = $conn->Execute($sSql)) {
		if ($rs->EOF) {
			$LoadRow = FALSE;
		} else {
			$LoadRow = TRUE;
			$rs->MoveFirst();
			LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$torneos->Row_Selected($rs);
		}
		$rs->Close();
	} else {
		$LoadRow = FALSE;
	}
	return $LoadRow;
}

// Load row values from recordset
function LoadRowValues(&$rs) {
	global $torneos;
	$torneos->id->setDbValue($rs->fields('id'));
	$torneos->nombre->setDbValue($rs->fields('nombre'));
	$torneos->fechaInicio->setDbValue($rs->fields('fechaInicio'));
	$torneos->fechaFin->setDbValue($rs->fields('fechaFin'));
	$torneos->logo->Upload->DbValue = $rs->fields('logo');
	$torneos->orden->setDbValue($rs->fields('orden'));
	$torneos->activo->setDbValue($rs->fields('activo'));
}
?>
<?php

// Render row values based on field settings
function RenderRow() {
	global $conn, $Security, $torneos;

	// Call Row Rendering event
	$torneos->Row_Rendering();

	// Common render codes for all row types
	// nombre

	$torneos->nombre->CellCssStyle = "";
	$torneos->nombre->CellCssClass = "";

	// fechaInicio
	$torneos->fechaInicio->CellCssStyle = "";
	$torneos->fechaInicio->CellCssClass = "";

	// fechaFin
	$torneos->fechaFin->CellCssStyle = "";
	$torneos->fechaFin->CellCssClass = "";

	// logo
	$torneos->logo->CellCssStyle = "";
	$torneos->logo->CellCssClass = "";

	// orden
	$torneos->orden->CellCssStyle = "";
	$torneos->orden->CellCssClass = "";

	// activo
	$torneos->activo->CellCssStyle = "";
	$torneos->activo->CellCssClass = "";
	if ($torneos->RowType == EW_ROWTYPE_VIEW) { // View row
	} elseif ($torneos->RowType == EW_ROWTYPE_ADD) { // Add row

		// nombre
		$torneos->nombre->EditCustomAttributes = "";
		$torneos->nombre->EditValue = ew_HtmlEncode($torneos->nombre->CurrentValue);

		// fechaInicio
		$torneos->fechaInicio->EditCustomAttributes = "";
		$torneos->fechaInicio->EditValue = ew_HtmlEncode(ew_FormatDateTime($torneos->fechaInicio->CurrentValue, 7));

		// fechaFin
		$torneos->fechaFin->EditCustomAttributes = "";
		$torneos->fechaFin->EditValue = ew_HtmlEncode(ew_FormatDateTime($torneos->fechaFin->CurrentValue, 7));

		// logo
		$torneos->logo->EditCustomAttributes = "";
		$torneos->logo->EditValue = $torneos->logo->CurrentValue;

		// orden
		$torneos->orden->EditCustomAttributes = "";
		$torneos->orden->EditValue = ew_HtmlEncode($torneos->orden->CurrentValue);

		// activo
		$torneos->activo->EditCustomAttributes = "";
		$arwrk = array();
		$arwrk[] = array("1", "Si");
		$torneos->activo->EditValue = $arwrk;
	} elseif ($torneos->RowType == EW_ROWTYPE_EDIT) { // Edit row
	} elseif ($torneos->RowType == EW_ROWTYPE_SEARCH) { // Search row
	}

	// Call Row Rendered event
	$torneos->Row_Rendered();
}
?>
<?php

// Add record
function AddRow() {
	global $conn, $Security, $torneos;

	// Check for duplicate key
	$bCheckKey = TRUE;
	$sFilter = $torneos->SqlKeyFilter();
	if (trim(strval($torneos->id->CurrentValue)) == "") {
		$bCheckKey = FALSE;
	} else {
		$sFilter = str_replace("@id@", ew_AdjustSql($torneos->id->CurrentValue), $sFilter); // Replace key value
	}
	if (!is_numeric($torneos->id->CurrentValue)) {
		$bCheckKey = FALSE;
	}
	if ($bCheckKey) {
		$rsChk = $torneos->LoadRs($sFilter);
		if ($rsChk && !$rsChk->EOF) {
			$_SESSION[EW_SESSION_MESSAGE] = "Valor Duplicado para la Clave Primaria";
			$rsChk->Close();
			return FALSE;
		}
	}
	$rsnew = array();

	// Field nombre
	$torneos->nombre->SetDbValueDef($torneos->nombre->CurrentValue, "");
	$rsnew['nombre'] =& $torneos->nombre->DbValue;

	// Field fechaInicio
	$torneos->fechaInicio->SetDbValueDef(ew_UnFormatDateTime($torneos->fechaInicio->CurrentValue, 7), NULL);
	$rsnew['fechaInicio'] =& $torneos->fechaInicio->DbValue;

	// Field fechaFin
	$torneos->fechaFin->SetDbValueDef(ew_UnFormatDateTime($torneos->fechaFin->CurrentValue, 7), NULL);
	$rsnew['fechaFin'] =& $torneos->fechaFin->DbValue;

	// Field logo
	$torneos->logo->Upload->SaveToSession(); // Save file value to Session
	if (is_null($torneos->logo->Upload->Value)) {
		$torneos->logo->Upload->DbValue = NULL;
	} else {
		$torneos->logo->Upload->DbValue = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, EW_UPLOAD_DEST_PATH), $torneos->logo->Upload->FileName);
	}
	$rsnew['logo'] =& $torneos->logo->Upload->DbValue;

	// Field orden
	$torneos->orden->SetDbValueDef($torneos->orden->CurrentValue, NULL);
	$rsnew['orden'] =& $torneos->orden->DbValue;

	// Field activo
	$torneos->activo->SetDbValueDef($torneos->activo->CurrentValue, 0);
	$rsnew['activo'] =& $torneos->activo->DbValue;

	// Call Row Inserting event
	$bInsertRow = $torneos->Row_Inserting($rsnew);
	if ($bInsertRow) {

		// Field logo
			if (!is_null($torneos->logo->Upload->Value)) ew_SaveFile(ew_UploadPathEx(TRUE, EW_UPLOAD_DEST_PATH), $rsnew['logo'], $torneos->logo->Upload->Value);
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$AddRow = $conn->Execute($torneos->InsertSQL($rsnew));
		$conn->raiseErrorFn = '';
	} else {
		if ($torneos->CancelMessage <> "") {
			$_SESSION[EW_SESSION_MESSAGE] = $torneos->CancelMessage;
			$torneos->CancelMessage = "";
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = "";
		}
		$AddRow = FALSE;
	}
	if ($AddRow) {
		$torneos->id->setDbValue($conn->Insert_ID());
		$rsnew['id'] =& $torneos->id->DbValue;

		// Call Row Inserted event
		$torneos->Row_Inserted($rsnew);
	}

	// Field logo
	$torneos->logo->Upload->RemoveFromSession(); // Remove file value from Session
	return $AddRow;
}
?>
<?php

// Page Load event
function Page_Load() {

	//echo "Page Load";
}

// Page Unload event
function Page_Unload() {

	//echo "Page Unload";
}
?>
