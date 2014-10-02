<?php
define("EW_PAGE_ID", "delete", TRUE); // Page ID
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

// Load Key Parameters
$sKey = "";
$bSingleDelete = TRUE; // Initialize as single delete
$arRecKeys = array();
$nKeySelected = 0; // Initialize selected key count
$sFilter = "";
if (@$_GET["id"] <> "") {
	$torneos->id->setQueryStringValue($_GET["id"]);
	if (!is_numeric($torneos->id->QueryStringValue)) {
		Page_Terminate($torneos->getReturnUrl()); // Prevent sql injection, exit
	}
	$sKey .= $torneos->id->QueryStringValue;
} else {
	$bSingleDelete = FALSE;
}
if ($bSingleDelete) {
	$nKeySelected = 1; // Set up key selected count
	$arRecKeys[0] = $sKey;
} else {
	if (isset($_POST["key_m"])) { // Key in form
		$nKeySelected = count($_POST["key_m"]); // Set up key selected count
		$arRecKeys = ew_StripSlashes($_POST["key_m"]);
	}
}
if ($nKeySelected <= 0) Page_Terminate($torneos->getReturnUrl()); // No key specified, exit

// Build filter
foreach ($arRecKeys as $sKey) {
	$sFilter .= "(";

	// Set up key field
	$sKeyFld = $sKey;
	if (!is_numeric($sKeyFld)) {
		Page_Terminate($torneos->getReturnUrl()); // Prevent sql injection, exit
	}
	$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
	if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
}
if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

// Set up filter (Sql Where Clause) and get Return Sql
// Sql constructor in torneos class, torneosinfo.php

$torneos->CurrentFilter = $sFilter;

// Get action
if (@$_POST["a_delete"] <> "") {
	$torneos->CurrentAction = $_POST["a_delete"];
} else {
	$torneos->CurrentAction = "D"; // Delete record directly
}
switch ($torneos->CurrentAction) {
	case "D": // Delete
		$torneos->SendEmail = TRUE; // Send email on delete success
		if (DeleteRows()) { // delete rows
			$_SESSION[EW_SESSION_MESSAGE] = "Borrado Exitoso"; // Set up success message
			Page_Terminate($torneos->getReturnUrl()); // Return to caller
		}
}

// Load records for display
$rs = LoadRecordset();
$nTotalRecs = $rs->RecordCount(); // Get record count
if ($nTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	Page_Terminate($torneos->getReturnUrl()); // Return to caller
}
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--
var EW_PAGE_ID = "delete"; // Page id

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Borrar de TABLA: Torneos<br><br><a href="<?php echo $torneos->getReturnUrl() ?>">Volver</a></span></p>
<?php
if (@$_SESSION[EW_SESSION_MESSAGE] <> "") {
?>
<p><span class="ewmsg"><?php echo $_SESSION[EW_SESSION_MESSAGE] ?></span></p>
<?php
	$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message
}
?>
<form action="torneosdelete.php" method="post">
<p>
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($arRecKeys as $sKey) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($sKey) ?>">
<?php } ?>
<table class="ewTable">
	<tr class="ewTableHeader">
		<td valign="top">Nombre</td>
		<td valign="top">Fecha Inicio</td>
		<td valign="top">Fecha Fin</td>
		<td valign="top">Logo</td>
		<td valign="top">Orden</td>
		<td valign="top">Activo</td>
	</tr>
<?php
$nRecCount = 0;
$i = 0;
while (!$rs->EOF) {
	$nRecCount++;

	// Set row class and style
	$torneos->CssClass = "ewTableRow";
	$torneos->CssStyle = "";

	// Display alternate color for rows
	if ($nRecCount % 2 <> 1) {
		$torneos->CssClass = "ewTableAltRow";
	}

	// Get the field contents
	LoadRowValues($rs);

	// Render row value
	$torneos->RowType = EW_ROWTYPE_VIEW; // view
	RenderRow();
?>
	<tr<?php echo $torneos->DisplayAttributes() ?>>
		<td<?php echo $torneos->nombre->CellAttributes() ?>>
<div<?php echo $torneos->nombre->ViewAttributes() ?>><?php echo $torneos->nombre->ViewValue ?></div>
</td>
		<td<?php echo $torneos->fechaInicio->CellAttributes() ?>>
<div<?php echo $torneos->fechaInicio->ViewAttributes() ?>><?php echo $torneos->fechaInicio->ViewValue ?></div>
</td>
		<td<?php echo $torneos->fechaFin->CellAttributes() ?>>
<div<?php echo $torneos->fechaFin->ViewAttributes() ?>><?php echo $torneos->fechaFin->ViewValue ?></div>
</td>
		<td<?php echo $torneos->logo->CellAttributes() ?>>
<?php if ($torneos->logo->HrefValue <> "") { ?>
<?php if (!is_null($torneos->logo->Upload->DbValue)) { ?>
<a href="<?php echo $torneos->logo->HrefValue ?>"><?php echo $torneos->logo->ViewValue ?></a>
<?php } ?>
<?php } else { ?>
<?php if (!is_null($torneos->logo->Upload->DbValue)) { ?>
<?php echo $torneos->logo->ViewValue ?>
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $torneos->orden->CellAttributes() ?>>
<div<?php echo $torneos->orden->ViewAttributes() ?>><?php echo $torneos->orden->ViewValue ?></div>
</td>
		<td<?php echo $torneos->activo->CellAttributes() ?>>
<div<?php echo $torneos->activo->ViewAttributes() ?>><?php echo $torneos->activo->ViewValue ?></div>
</td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</table>
<p>
<input type="submit" name="Action" id="Action" value="CONFIRMAR BORRADO">
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

// ------------------------------------------------
//  Function DeleteRows
//  - Delete Records based on current filter
function DeleteRows() {
	global $conn, $Security, $torneos;
	$DeleteRows = TRUE;
	$sWrkFilter = $torneos->CurrentFilter;

	// Set up filter (Sql Where Clause) and get Return Sql
	// Sql constructor in torneos class, torneosinfo.php

	$torneos->CurrentFilter = $sWrkFilter;
	$sSql = $torneos->SQL();
	$conn->raiseErrorFn = 'ew_ErrorFn';
	$rs = $conn->Execute($sSql);
	$conn->raiseErrorFn = '';
	if ($rs === FALSE) {
		return FALSE;
	} elseif ($rs->EOF) {
		$_SESSION[EW_SESSION_MESSAGE] = "No se encontraron registros"; // No record found
		$rs->Close();
		return FALSE;
	}
	$conn->BeginTrans();

	// Clone old rows
	$rsold = ($rs) ? $rs->GetRows() : array();
	if ($rs) $rs->Close();

	// Call row deleting event
	if ($DeleteRows) {
		foreach ($rsold as $row) {
			$DeleteRows = $torneos->Row_Deleting($row);
			if (!$DeleteRows) break;
		}
	}
	if ($DeleteRows) {
		$sKey = "";
		foreach ($rsold as $row) {
			$sThisKey = "";
			if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
			$sThisKey .= $row['id'];
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$DeleteRows = $conn->Execute($torneos->DeleteSQL($row)); // Delete
			$conn->raiseErrorFn = '';
			if ($DeleteRows === FALSE)
				break;
			if ($sKey <> "") $sKey .= ", ";
			$sKey .= $sThisKey;
		}
	} else {

		// Set up error message
		if ($torneos->CancelMessage <> "") {
			$_SESSION[EW_SESSION_MESSAGE] = $torneos->CancelMessage;
			$torneos->CancelMessage = "";
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = "";
		}
	}
	if ($DeleteRows) {
		$conn->CommitTrans(); // Commit the changes
	} else {
		$conn->RollbackTrans(); // Rollback changes
	}

	// Call recordset deleted event
	if ($DeleteRows) {
		foreach ($rsold as $row) {
			$torneos->Row_Deleted($row);
		}	
	}
	return $DeleteRows;
}
?>
<?php

// Load recordset
function LoadRecordset($offset = -1, $rowcnt = -1) {
	global $conn, $torneos;

	// Call Recordset Selecting event
	$torneos->Recordset_Selecting($torneos->CurrentFilter);

	// Load list page sql
	$sSql = $torneos->SelectSQL();
	if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

	// Load recordset
	$conn->raiseErrorFn = 'ew_ErrorFn';	
	$rs = $conn->Execute($sSql);
	$conn->raiseErrorFn = '';

	// Call Recordset Selected event
	$torneos->Recordset_Selected($rs);
	return $rs;
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

		// nombre
		$torneos->nombre->ViewValue = $torneos->nombre->CurrentValue;
		$torneos->nombre->CssStyle = "";
		$torneos->nombre->CssClass = "";
		$torneos->nombre->ViewCustomAttributes = "";

		// fechaInicio
		$torneos->fechaInicio->ViewValue = $torneos->fechaInicio->CurrentValue;
		$torneos->fechaInicio->ViewValue = ew_FormatDateTime($torneos->fechaInicio->ViewValue, 7);
		$torneos->fechaInicio->CssStyle = "";
		$torneos->fechaInicio->CssClass = "";
		$torneos->fechaInicio->ViewCustomAttributes = "";

		// fechaFin
		$torneos->fechaFin->ViewValue = $torneos->fechaFin->CurrentValue;
		$torneos->fechaFin->ViewValue = ew_FormatDateTime($torneos->fechaFin->ViewValue, 7);
		$torneos->fechaFin->CssStyle = "";
		$torneos->fechaFin->CssClass = "";
		$torneos->fechaFin->ViewCustomAttributes = "";

		// logo
		if (!is_null($torneos->logo->Upload->DbValue)) {
			$torneos->logo->ViewValue = $torneos->logo->Upload->DbValue;
		} else {
			$torneos->logo->ViewValue = "";
		}
		$torneos->logo->CssStyle = "";
		$torneos->logo->CssClass = "";
		$torneos->logo->ViewCustomAttributes = "";

		// orden
		$torneos->orden->ViewValue = $torneos->orden->CurrentValue;
		$torneos->orden->CssStyle = "";
		$torneos->orden->CssClass = "";
		$torneos->orden->ViewCustomAttributes = "";

		// activo
		if (!is_null($torneos->activo->CurrentValue)) {
			$torneos->activo->ViewValue = "";
			$arwrk = explode(",", strval($torneos->activo->CurrentValue));
			for ($ari = 0; $ari < count($arwrk); $ari++) {
				switch (trim($arwrk[$ari])) {
					case "1":
						$torneos->activo->ViewValue .= "Si";
						break;
					default:
						$torneos->activo->ViewValue .= trim($arwrk[$ari]);
				}
				if ($ari < count($arwrk)-1) $torneos->activo->ViewValue .= ew_ViewOptionSeparator($ari);
			}
		} else {
			$torneos->activo->ViewValue = NULL;
		}
		$torneos->activo->CssStyle = "";
		$torneos->activo->CssClass = "";
		$torneos->activo->ViewCustomAttributes = "";

		// nombre
		$torneos->nombre->HrefValue = "";

		// fechaInicio
		$torneos->fechaInicio->HrefValue = "";

		// fechaFin
		$torneos->fechaFin->HrefValue = "";

		// logo
		if (!is_null($torneos->logo->Upload->DbValue)) {
			$torneos->logo->HrefValue = ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . ((!empty($torneos->logo->ViewValue)) ? $torneos->logo->ViewValue : $torneos->logo->CurrentValue);
			if ($torneos->Export <> "") $torneos->logo->HrefValue = ew_ConvertFullUrl($torneos->logo->HrefValue);
		} else {
			$torneos->logo->HrefValue = "";
		}

		// orden
		$torneos->orden->HrefValue = "";

		// activo
		$torneos->activo->HrefValue = "";
	} elseif ($torneos->RowType == EW_ROWTYPE_ADD) { // Add row
	} elseif ($torneos->RowType == EW_ROWTYPE_EDIT) { // Edit row
	} elseif ($torneos->RowType == EW_ROWTYPE_SEARCH) { // Search row
	}

	// Call Row Rendered event
	$torneos->Row_Rendered();
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
