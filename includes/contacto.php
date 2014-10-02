<?php
								$sql="SELECT * from contacto";
								//echo $sql;
								$rs = new RecordSet();
								$con = Conectar();
								$rs->Open($sql, $con);		
								$retVal = "";
								if(!$rs->Eof())
								{
									$tels =  $rs->Fields("tel1") . "<br />" .  $rs->Fields("tel2") . "<br />"  .  $rs->Fields("tel3") . "<br />"  . $rs->Fields("tel4");
									$mails = $rs->Fields("mail1") . "<br />" . $rs->Fields("mail2") . "<br />" . $rs->Fields("mail3") . "<br />"  . $rs->Fields("mail4");
									
								}
						?>
                        <div style="color:#000000; font-weight:bold"><br />
                        
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td style="width:60%"><img src="images/email.jpg" alt="" width="40" height="44" /></td>
                            <td><img src="images/movill.jpg" alt="" width="52" height="44" /></td>
                          </tr>
                          <tr>
                            <td><?php echo $mails; ?></td>
                            <td><?php echo $tels; ?></td>
                          </tr>
                        </table>
                        </div>
                        <br />
                        <br />