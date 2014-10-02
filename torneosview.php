<?php
define("EW_PAGE_ID", "view", TRUE); // Page ID
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
if (@$_GET["id"] <> "") {
	$torneos->id->setQueryStringValue($_GET["id"]);
} else {
	Page_Terminate("torneoslist.php"); // Return to list page
}

// Get action
if (@$_POST["a_view"] <> "") {
	$torneos->CurrentAction = $_POST["a_view"];
} else {
	$torneos->CurrentAction = "I"; // Display form
}
switch ($torneos->CurrentAction) {
	case "I": // Get a record to display
		if (!LoadRow()) { // Load record based on key
			$_SESSION[EW_SESSION_MESSAGE] = "No se encontraron registros"; // Set no record message
			Page_Terminate("torneoslist.php"); // Return to list
		}
}

// Set return url
$torneos->setReturnUrl("torneosview.php");

// Render row
$torneos->RowType = EW_ROWTYPE_VIEW;
RenderRow();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--
var EW_PAGE_ID = "view"; // Page id

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Ver TABLA: Torneos
<br><br>
<a href="torneoslist.php">Volver al listado</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="torneosadd.php"></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $torneos->EditUrl() ?>"></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $torneos->CopyUrl() ?>"></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('¿Quiere borrar este registro?');" href="<?php echo $torneos->DeleteUrl() ?>"></a>&nbsp;
<?php } ?>
</span>
</p>
<?php
if (@$_SESSION[EW_SESSION_MESSAGE] <> "") {
?>
<p><span class="ewmsg"><?php echo $_SESSION[EW_SESSION_MESSAGE] ?></span></p>
<?php
	$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message
}
?>
<p>
<form>
<table class="ewTable">
	<tr class="ewTableRow">
		<td class="ewTableHeader">Nombre</td>
		<td<?php echo $torneos->nombre->CellAttributes() ?>>
<div<?php echo $torneos->nombre->ViewAttributes() ?>><?php echo $torneos->nombre->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">Fecha Inicio</td>
		<td<?php echo $torneos->fechaInicio->CellAttributes() ?>>
<div<?php echo $torneos->fechaInicio->ViewAttributes() ?>><?php echo $torneos->fechaInicio->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">Fecha Fin</td>
		<td<?php echo $torneos->fechaFin->CellAttributes() ?>>
<div<?php echo $torneos->fechaFin->ViewAttributes() ?>><?php echo $torneos->fechaFin->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">Logo</td>
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
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">Activo</td>
		<td<?php echo $torneos->activo->CellAttributes() ?>>
<div<?php echo $torneos->activo->ViewAttributes() ?>><?php echo $torneos->activo->ViewValue ?></div>
</td>
	</tr>
</table>
</form>
<p>
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

// Set up Starting Record parameters based on Pager Navigation
function SetUpStartRec() {
	global $nDisplayRecs, $nStartRec, $nTotalRecs, $nPageNo, $torneos;
	if ($nDisplayRecs == 0) return;

	// Check for a START parameter
	if (@$_GET[EW_TABLE_START_REC] <> "") {
		$nStartRec = $_GET[EW_TABLE_START_REC];
		$torneos->setStartRecordNumber($nStartRec);
	} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
		$nPageNo = $_GET[EW_TABLE_PAGE_NO];
		if (is_numeric($nPageNo)) {
			$nStartRec = ($nPageNo-1)*$nDisplayRecs+1;
			if ($nStartRec <= 0) {
				$nStartRec = 1;
			} elseif ($nStartRec >= intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1) {
				$nStartRec = intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1;
			}
			$torneos->setStartRecordNumber($nStartRec);
		} else {
			$nStartRec = $torneos->getStartRecordNumber();
		}
	} else {
		$nStartRec = $torneos->getStartRecordNumber();
	}

	// Check if correct start record counter
	if (!is_numeric($nStartRec) || $nStartRec == "") { // Avoid invalid start record counter
		$nStartRec = 1; // Reset start record counter
		$torneos->setStartRecordNumber($nStartRec);
	} elseif (intval($nStartRec) > intval($nTotalRecs)) { // Avoid starting record > total records
		$nStartRec = intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1; // Point to last page first record
		$torneos->setStartRecordNumber($nStartRec);
	} elseif (($nStartRec-1) % $nDisplayRecs <> 0) {
		$nStartRec = intval(($nStartRec-1)/$nDisplayRecs)*$nDisplayRecs+1; // Point to page boundary
		$torneos->setStartRecordNumber($nStartRec);
	}
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
