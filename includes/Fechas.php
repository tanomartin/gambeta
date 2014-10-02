  <?php
  
		$year = date("Y-m-d");
		$sql= "select  DATE_FORMAT(fecha,'%d/%m/%Y') as fecha, descripcion, lugar, ciudad from agenda where fecha > '" .  $year . "' order by agenda.fecha";
		$rs = new RecordSet();
		$con = Conectar();
		$rs->Open($sql, $con);		
		//echo $rs->recordCount();
	 ?>
    <div style="margin-top:15px; height:5px;"></div>
        <?php 
			if (!$rs->Eof())
			{
				$rs->moveFirst();
				for($i=0; $i < 2; $i++)
				{	
					if(!$rs->Eof())
					{
		?>
                    
                    <div class="FechaEntrada">
                        <b><?php echo $rs->Fields("fecha") . ' ' . $rs->Fields("descripcion"); ?> </b><br />
                        <?php echo $rs->Fields("lugar"); ?> <br />
                        <?php echo $rs->Fields("ciudad"); ?> <br />
                        
                    </div>
          <?php		
		  			$rs->moveNext();
					}
					
				}
			}
		  ?>
       
    </div>
    <div class="FechaBox">
   	    <div style="margin-top:15px; height:5px;"></div>
        <?php 
			if (!$rs->Eof())
			{
				for($i=0; $i < 2; $i++)
				{	
					if(!$rs->Eof())
					{
		?>
                    
                    <div class="FechaEntrada">
                        <b><?php echo $rs->Fields("fecha") . ' ' . $rs->Fields("descripcion"); ?> </b><br />
                        <?php echo $rs->Fields("lugar"); ?> <br />
                        <?php echo $rs->Fields("ciudad"); ?> <br />
                        
                    </div>
          <?php		
		  			$rs->moveNext();
					}
					
				}
			}
		  ?>
        <div class="FechaTodas"><a href="Agenda.php"><?=GetResource("full_date"); ?></a></div>
    </div>