<?php
define("EW_PAGE_ID", "list", TRUE); // Page ID
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
if ($torneos->Export == "excel") {
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename=' . $sExportFile .'.xls');
}
if ($torneos->Export == "xml") {
	header('Content-Type: text/xml');
	header('Content-Disposition: attachment; filename=' . $sExportFile .'.xml');
}
if ($torneos->Export == "csv") {
	header('Content-Type: application/csv');
	header('Content-Disposition: attachment; filename=' . $sExportFile .'.csv');
}
?>
<?php

// Paging variables
$nStartRec = 0; // Start record index
$nStopRec = 0; // Stop record index
$nTotalRecs = 0; // Total number of records
$nDisplayRecs = 30;
$nRecRange = 10;
$nRecCount = 0; // Record count

// Search filters
$sSrchAdvanced = ""; // Advanced search filter
$sSrchBasic = ""; // Basic search filter
$sSrchWhere = ""; // Search where clause
$sFilter = "";
$sDeleteConfirmMsg = "¿Quiere borrar este registro?"; // Delete confirm message

// Master/Detail
$sDbMasterFilter = ""; // Master filter
$sDbDetailFilter = ""; // Detail filter
$sSqlMaster = ""; // Sql for master record

// Handle reset command
ResetCmd();

// Get basic search criteria
$sSrchBasic = BasicSearchWhere();

// Build search criteria
if ($sSrchAdvanced <> "") {
	if ($sSrchWhere <> "") $sSrchWhere .= " AND ";
	$sSrchWhere .= "(" . $sSrchAdvanced . ")";
}
if ($sSrchBasic <> "") {
	if ($sSrchWhere <> "") $sSrchWhere .= " AND ";
	$sSrchWhere .= "(" . $sSrchBasic . ")";
}

// Save search criteria
if ($sSrchWhere <> "") {
	if ($sSrchBasic == "") ResetBasicSearchParms();
	$torneos->setSearchWhere($sSrchWhere); // Save to Session
	$nStartRec = 1; // Reset start record counter
	$torneos->setStartRecordNumber($nStartRec);
} else {
	RestoreSearchParms();
}

// Build filter
$sFilter = "";
if ($sDbDetailFilter <> "") {
	if ($sFilter <> "") $sFilter .= " AND ";
	$sFilter .= "(" . $sDbDetailFilter . ")";
}
if ($sSrchWhere <> "") {
	if ($sFilter <> "") $sFilter .= " AND ";
	$sFilter .= "(" . $sSrchWhere . ")";
}

// Set up filter in Session
$torneos->setSessionWhere($sFilter);
$torneos->CurrentFilter = "";

// Set Up Sorting Order
SetUpSortOrder();

// Export data only
if ($torneos->Export == "xml" || $torneos->Export == "csv") {
	ExportData();
	Page_Terminate(); // Terminate response
}

// Set Return Url
$torneos->setReturnUrl("torneoslist.php");
?>
<?php include "header.php" ?>
<?php if ($torneos->Export == "") { ?>
<script type="text/javascript">
<!--
var EW_PAGE_ID = "list"; // Page id

//-->
</script>
<script type="text/javascript">
<!--
var firstrowoffset = 1; // First data row start at
var lastrowoffset = 0; // Last data row end at
var EW_LIST_TABLE_NAME = 'ewlistmain'; // Table name for list page
var rowclass = 'ewTableRow'; // Row class
var rowaltclass = 'ewTableAltRow'; // Row alternate class
var rowmoverclass = 'ewTableHighlightRow'; // Row mouse over class
var rowselectedclass = 'ewTableSelectRow'; // Row selected class
var roweditclass = 'ewTableEditRow'; // Row edit class

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($torneos->Export == "") { ?>
<?php } ?>
<?php

// Load recordset
$bExportAll = (defined("EW_EXPORT_ALL") && $torneos->Export <> "");
$bSelectLimit = ($torneos->Export == "" && $torneos->SelectLimit);
if (!$bSelectLimit) $rs = LoadRecordset();
$nTotalRecs = ($bSelectLimit) ? $torneos->SelectRecordCount() : $rs->RecordCount();
$nStartRec = 1;
if ($nDisplayRecs <= 0) $nDisplayRecs = $nTotalRecs; // Display all records
if (!$bExportAll) SetUpStartRec(); // Set up start record position
if ($bSelectLimit) $rs = LoadRecordset($nStartRec-1, $nDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLA: Torneos
<?php if ($torneos->Export == "") { ?>
&nbsp;&nbsp;<a href="torneoslist.php?export=excel">Exportar a Excel</a>
&nbsp;&nbsp;<a href="torneoslist.php?export=xml">Exportar a XML</a>
&nbsp;&nbsp;<a href="torneoslist.php?export=csv">Exportar a CSV</a>
<?php } ?>
</span></p>
<?php if ($torneos->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<form name="ftorneoslistsrch" id="ftorneoslistsrch" action="torneoslist.php" >
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($torneos->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="  Buscar  ">&nbsp;
			<a href="torneoslist.php?cmd=reset">Mostrar todos</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="" <?php if ($torneos->getBasicSearchType() == "") { ?>checked<?php } ?>>Frase exacta&nbsp;&nbsp;<input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND" <?php if ($torneos->getBasicSearchType() == "AND") { ?>checked<?php } ?>>Todas las palabras&nbsp;&nbsp;<input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR" <?php if ($torneos->getBasicSearchType() == "OR") { ?>checked<?php } ?>>Cualquier palabra</span></td>
	</tr>
</table>
</form>
<?php } ?>
<?php } ?>
<?php
if (@$_SESSION[EW_SESSION_MESSAGE] <> "") {
?>
<p><span class="ewmsg"><?php echo $_SESSION[EW_SESSION_MESSAGE] ?></span></p>
<?php
	$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message
}
?>
<form method="post" name="ftorneoslist" id="ftorneoslist">
<?php if ($torneos->Export == "") { ?>
<table>
	<tr><td><span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="torneosadd.php">Agregar</a>&nbsp;&nbsp;
<?php } ?>
	</span></td></tr>
</table>
<?php } ?>
<?php if ($nTotalRecs > 0) { ?>
<table id="ewlistmain" class="ewTable">
<?php
	$OptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$OptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$OptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$OptionCnt++; // delete
}
?>
	<!-- Table header -->
	<tr class="ewTableHeader">
		<td valign="top">
<?php if ($torneos->Export <> "") { ?>
Nombre
<?php } else { ?>
	<a href="torneoslist.php?order=<?php echo urlencode('nombre') ?>&ordertype=<?php echo $torneos->nombre->ReverseSort() ?>">Nombre&nbsp;(*)<?php if ($torneos->nombre->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($torneos->nombre->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($torneos->Export <> "") { ?>
Fecha Inicio
<?php } else { ?>
	<a href="torneoslist.php?order=<?php echo urlencode('fechaInicio') ?>&ordertype=<?php echo $torneos->fechaInicio->ReverseSort() ?>">Fecha Inicio<?php if ($torneos->fechaInicio->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($torneos->fechaInicio->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($torneos->Export <> "") { ?>
Fecha Fin
<?php } else { ?>
	<a href="torneoslist.php?order=<?php echo urlencode('fechaFin') ?>&ordertype=<?php echo $torneos->fechaFin->ReverseSort() ?>">Fecha Fin<?php if ($torneos->fechaFin->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($torneos->fechaFin->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($torneos->Export <> "") { ?>
Logo
<?php } else { ?>
	<a href="torneoslist.php?order=<?php echo urlencode('logo') ?>&ordertype=<?php echo $torneos->logo->ReverseSort() ?>">Logo&nbsp;(*)<?php if ($torneos->logo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($torneos->logo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($torneos->Export <> "") { ?>
Orden
<?php } else { ?>
	<a href="torneoslist.php?order=<?php echo urlencode('orden') ?>&ordertype=<?php echo $torneos->orden->ReverseSort() ?>">Orden<?php if ($torneos->orden->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($torneos->orden->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($torneos->Export <> "") { ?>
Activo
<?php } else { ?>
	<a href="torneoslist.php?order=<?php echo urlencode('activo') ?>&ordertype=<?php echo $torneos->activo->ReverseSort() ?>">Activo<?php if ($torneos->activo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($torneos->activo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
<?php if ($torneos->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap>&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap>&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap>&nbsp;</td>
<?php } ?>
<?php } ?>
	</tr>
<?php
if (defined("EW_EXPORT_ALL") && $torneos->Export <> "") {
	$nStopRec = $nTotalRecs;
} else {
	$nStopRec = $nStartRec + $nDisplayRecs - 1; // Set the last record to display
}
$nRecCount = $nStartRec - 1;
if (!$rs->EOF) {
	$rs->MoveFirst();
	if (!$torneos->SelectLimit) $rs->Move($nStartRec - 1); // Move to first record directly
}
$RowCnt = 0;
while (!$rs->EOF && $nRecCount < $nStopRec) {
	$nRecCount++;
	if (intval($nRecCount) >= intval($nStartRec)) {
		$RowCnt++;

	// Init row class and style
	$torneos->CssClass = "ewTableRow";
	$torneos->CssStyle = "";

	// Init row event
	$torneos->RowClientEvents = "onmouseover='ew_MouseOver(this);' onmouseout='ew_MouseOut(this);' onclick='ew_Click(this);'";

	// Display alternate color for rows
	if ($RowCnt % 2 == 0) {
		$torneos->CssClass = "ewTableAltRow";
	}
	LoadRowValues($rs); // Load row values
	$torneos->RowType = EW_ROWTYPE_VIEW; // Render view
	RenderRow();
?>
	<!-- Table body -->
	<tr<?php echo $torneos->DisplayAttributes() ?>>
		<!-- nombre -->
		<td<?php echo $torneos->nombre->CellAttributes() ?>>
<div<?php echo $torneos->nombre->ViewAttributes() ?>><?php echo $torneos->nombre->ViewValue ?></div>
</td>
		<!-- fechaInicio -->
		<td<?php echo $torneos->fechaInicio->CellAttributes() ?>>
<div<?php echo $torneos->fechaInicio->ViewAttributes() ?>><?php echo $torneos->fechaInicio->ViewValue ?></div>
</td>
		<!-- fechaFin -->
		<td<?php echo $torneos->fechaFin->CellAttributes() ?>>
<div<?php echo $torneos->fechaFin->ViewAttributes() ?>><?php echo $torneos->fechaFin->ViewValue ?></div>
</td>
		<!-- logo -->
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
		<!-- orden -->
		<td<?php echo $torneos->orden->CellAttributes() ?>>
<div<?php echo $torneos->orden->ViewAttributes() ?>><?php echo $torneos->orden->ViewValue ?></div>
</td>
		<!-- activo -->
		<td<?php echo $torneos->activo->CellAttributes() ?>>
<div<?php echo $torneos->activo->ViewAttributes() ?>><?php echo $torneos->activo->ViewValue ?></div>
</td>
<?php if ($torneos->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap><span class="phpmaker">
<a href="<?php echo $torneos->EditUrl() ?>">Editar</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap><span class="phpmaker">
<a href="<?php echo $torneos->CopyUrl() ?>">Copiar</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap><span class="phpmaker">
<a onclick="ew_ClickDelete();return ew_ConfirmDelete('¿Quiere borrar este registro?');" href="<?php echo $torneos->DeleteUrl() ?>">Borrar</a>
</span></td>
<?php } ?>
<?php } ?>
	</tr>
<?php
	}
	$rs->MoveNext();
}
?>
</table>
<?php if ($torneos->Export == "") { ?>
<table>
	<tr><td><span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="torneosadd.php">Agregar</a>&nbsp;&nbsp;
<?php } ?>
	</span></td></tr>
</table>
<?php } ?>
<?php } ?>
</form>
<?php

// Close recordset and connection
if ($rs) $rs->Close();
?>
<?php if ($torneos->Export == "") { ?>
<form action="torneoslist.php" name="ewpagerform" id="ewpagerform">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($Pager)) $Pager = new cNumericPager($nStartRec, $nDisplayRecs, $nTotalRecs, $nRecRange) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<a href="torneoslist.php?start=<?php echo $Pager->FirstButton->Start ?>"><b>Primera</b></a>&nbsp;
	<?php } ?>
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<a href="torneoslist.php?start=<?php echo $Pager->PrevButton->Start ?>"><b>Anterior</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="torneoslist.php?start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($Pager->NextButton->Enabled) { ?>
	<a href="torneoslist.php?start=<?php echo $Pager->NextButton->Start ?>"><b>Siguiente</b></a>&nbsp;
	<?php } ?>
	<?php if ($Pager->LastButton->Enabled) { ?>
	<a href="torneoslist.php?start=<?php echo $Pager->LastButton->Start ?>"><b>Ultima</b></a>&nbsp;
	<?php } ?>
	<?php if ($Pager->ButtonCount > 0) { ?><br><?php } ?>
	Registro <?php echo $Pager->FromIndex ?> a <?php echo $Pager->ToIndex ?> de <?php echo $Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($sSrchWhere == "0=101") { ?>
	<?php } else { ?>
	No se encontraron registros
	<?php } ?>
<?php } ?>
</span>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php if ($torneos->Export == "") { ?>
<?php } ?>
<?php if ($torneos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
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

// Return Basic Search sql
function BasicSearchSQL($Keyword) {
	$sKeyword = ew_AdjustSql($Keyword);
	$sql = "";
	$sql .= "`nombre` LIKE '%" . $sKeyword . "%' OR ";
	$sql .= "`logo` LIKE '%" . $sKeyword . "%' OR ";
	if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
	return $sql;
}

// Return Basic Search Where based on search keyword and type
function BasicSearchWhere() {
	global $Security, $torneos;
	$sSearchStr = "";
	$sSearchKeyword = ew_StripSlashes(@$_GET[EW_TABLE_BASIC_SEARCH]);
	$sSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	if ($sSearchKeyword <> "") {
		$sSearch = trim($sSearchKeyword);
		if ($sSearchType <> "") {
			while (strpos($sSearch, "  ") !== FALSE)
				$sSearch = str_replace("  ", " ", $sSearch);
			$arKeyword = explode(" ", trim($sSearch));
			foreach ($arKeyword as $sKeyword) {
				if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
				$sSearchStr .= "(" . BasicSearchSQL($sKeyword) . ")";
			}
		} else {
			$sSearchStr = BasicSearchSQL($sSearch);
		}
	}
	if ($sSearchKeyword <> "") {
		$torneos->setBasicSearchKeyword($sSearchKeyword);
		$torneos->setBasicSearchType($sSearchType);
	}
	return $sSearchStr;
}

// Clear all search parameters
function ResetSearchParms() {

	// Clear search where
	global $torneos;
	$sSrchWhere = "";
	$torneos->setSearchWhere($sSrchWhere);

	// Clear basic search parameters
	ResetBasicSearchParms();
}

// Clear all basic search parameters
function ResetBasicSearchParms() {

	// Clear basic search parameters
	global $torneos;
	$torneos->setBasicSearchKeyword("");
	$torneos->setBasicSearchType("");
}

// Restore all search parameters
function RestoreSearchParms() {
	global $sSrchWhere, $torneos;
	$sSrchWhere = $torneos->getSearchWhere();
}

// Set up Sort parameters based on Sort Links clicked
function SetUpSortOrder() {
	global $torneos;

	// Check for an Order parameter
	if (@$_GET["order"] <> "") {
		$torneos->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
		$torneos->CurrentOrderType = @$_GET["ordertype"];

		// Field nombre
		$torneos->UpdateSort($torneos->nombre);

		// Field fechaInicio
		$torneos->UpdateSort($torneos->fechaInicio);

		// Field fechaFin
		$torneos->UpdateSort($torneos->fechaFin);

		// Field logo
		$torneos->UpdateSort($torneos->logo);

		// Field orden
		$torneos->UpdateSort($torneos->orden);

		// Field activo
		$torneos->UpdateSort($torneos->activo);
		$torneos->setStartRecordNumber(1); // Reset start position
	}
	$sOrderBy = $torneos->getSessionOrderBy(); // Get order by from Session
	if ($sOrderBy == "") {
		if ($torneos->SqlOrderBy() <> "") {
			$sOrderBy = $torneos->SqlOrderBy();
			$torneos->setSessionOrderBy($sOrderBy);
		}
	}
}

// Reset command based on querystring parameter cmd=
// - RESET: reset search parameters
// - RESETALL: reset search & master/detail parameters
// - RESETSORT: reset sort parameters
function ResetCmd() {
	global $sDbMasterFilter, $sDbDetailFilter, $nStartRec, $sOrderBy;
	global $torneos;

	// Get reset cmd
	if (@$_GET["cmd"] <> "") {
		$sCmd = $_GET["cmd"];

		// Reset search criteria
		if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall") {
			ResetSearchParms();
		}

		// Reset Sort Criteria
		if (strtolower($sCmd) == "resetsort") {
			$sOrderBy = "";
			$torneos->setSessionOrderBy($sOrderBy);
			$torneos->nombre->setSort("");
			$torneos->fechaInicio->setSort("");
			$torneos->fechaFin->setSort("");
			$torneos->logo->setSort("");
			$torneos->orden->setSort("");
			$torneos->activo->setSort("");
		}

		// Reset start position
		$nStartRec = 1;
		$torneos->setStartRecordNumber($nStartRec);
	}
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

// Export data in Xml or Csv format
function ExportData() {
	global $nTotalRecs, $nStartRec, $nStopRec, $nTotalRecs, $nDisplayRecs, $torneos;
	$sCsvStr = "";
	$rs = LoadRecordset();
	$nTotalRecs = $rs->RecordCount();
	$nStartRec = 1;

	// Export all
	if (defined("EW_EXPORT_ALL")) {
		$nStopRec = $nTotalRecs;
	} else { // Export 1 page only
		SetUpStartRec(); // Set Up Start Record Position

		// Set the last record to display
		if ($nDisplayRecs < 0) {
			$nStopRec = $nTotalRecs;
		} else {
			$nStopRec = $nStartRec + $nDisplayRecs - 1;
		}
	}
	if ($torneos->Export == "xml") {
		$XmlDoc = new cXMLDocument();
	}
	if ($torneos->Export == "csv") {
		$sCsvStr .= "nombre" . ",";
		$sCsvStr .= "fechaInicio" . ",";
		$sCsvStr .= "fechaFin" . ",";
		$sCsvStr .= "logo" . ",";
		$sCsvStr .= "orden" . ",";
		$sCsvStr .= "activo" . ",";
		$sCsvStr = substr($sCsvStr, 0, strlen($sCsvStr)-1); // Remove last comma
		$sCsvStr .= "\n";
	}

	// Move to first record directly for performance reason
	$nRecCount = $nStartRec - 1;
	if (!$rs->EOF) {
		$rs->MoveFirst();
		$rs->Move($nStartRec - 1);
	}
	while (!$rs->EOF && $nRecCount < $nStopRec) {
		$nRecCount++;
		if (intval($nRecCount) >= intval($nStartRec)) {
			LoadRowValues($rs);
			if ($torneos->Export == "xml") {
				$XmlDoc->BeginRow();
				$XmlDoc->AddField('nombre', $torneos->nombre->CurrentValue);
				$XmlDoc->AddField('fechaInicio', $torneos->fechaInicio->CurrentValue);
				$XmlDoc->AddField('fechaFin', $torneos->fechaFin->CurrentValue);
				$XmlDoc->AddField('logo', $torneos->logo->CurrentValue);
				$XmlDoc->AddField('orden', $torneos->orden->CurrentValue);
				$XmlDoc->AddField('activo', $torneos->activo->CurrentValue);
				$XmlDoc->EndRow();
			}
			if ($torneos->Export == "csv") {
				$sCsvStr .= '"' . str_replace('"', '""', strval($torneos->nombre->CurrentValue)) . '",';
				$sCsvStr .= '"' . str_replace('"', '""', strval($torneos->fechaInicio->CurrentValue)) . '",';
				$sCsvStr .= '"' . str_replace('"', '""', strval($torneos->fechaFin->CurrentValue)) . '",';
				$sCsvStr .= '"' . str_replace('"', '""', strval($torneos->logo->CurrentValue)) . '",';
				$sCsvStr .= '"' . str_replace('"', '""', strval($torneos->orden->CurrentValue)) . '",';
				$sCsvStr .= '"' . str_replace('"', '""', strval($torneos->activo->CurrentValue)) . '",';
				$sCsvStr = substr($sCsvStr, 0, strlen($sCsvStr)-1); // Remove last comma
				$sCsvStr .= "\n";
			}
		}
		$rs->MoveNext();
	}

	// Close recordset
	$rs->Close();
	if ($torneos->Export == "xml") {
		header("Content-Type: text/xml");
		echo $XmlDoc->XML();
	}
	if ($torneos->Export == "csv") {
		echo $sCsvStr;
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
