<html>
<body>
<div align="center">
<table border="1" cellspacing="0" cellpadding="0" width="602" style="width:451.5pt;border:solid #e88230 1.0pt">
 <tbody>
	<tr>
		<td style="border:none;padding:0in 0in 0in 0in">
			<table border="0" cellpadding="0" width="604" style="width:453.0pt;background:#3881AB">
				<tbody>
					<tr>
						<td style="padding:.75pt .75pt .75pt .75pt">
						<table border="0" cellspacing="0" cellpadding="0" align="right">
							<tbody>
							<tr style="min-height:10.5pt">
								<td style="float:left;width:385px;padding:7px;"><img src="<?php echo "$base$img_path" ?>/logo.png">
								<br><span style="color:white;">Get connected to your dream university</span>
								</td>
								<td style="float:right;width:385px;"></td>
							</tr>
							</tbody>
						</table>
						</td>
					</tr>
				</tbody>
			</table>
			<table border="1" cellspacing="0" cellpadding="0" style="border:none;width:100%;border-bottom:solid #e88230 1.0pt">
				<tbody><tr>
					<td style="border:none;padding:0in 0in 0in 0in">
						<table border="0" cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<td style="padding:0in 12.75pt 0in 12.75pt">
										<table width="100%"><tbody><tr>
											<td width="20%">
											<?php
											if(file_exists(getcwd().'/uploads/univ_gallery/'.$uni_data['univ_logo_path']) && $uni_data['univ_logo_path']!=''){
											?>
												<div><img src="<?php echo $base;?>uploads/univ_gallery/<?php echo trim($uni_data['univ_logo_path']);?>"></div>
											<?php 
											} else {
											?>
												<div><img src="<?php echo $base; ?>uploads/univ_gallery/univ_logo.png"></div>
											<?php
											}
											?>	
											</td>
											<td width="80%">
												<h1 style="margin:0in;margin-bottom:.0001pt;text-align:justify"><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#058dd7">Welcome to <?php echo $uni_data['univ_name'];?></span></h1>
												<div><h3 style="margin:0in;margin-bottom:.0001pt;text-align:justify"><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Check out whats new about <?php echo $uni_data['univ_name'];?></span></h3></div>
											</td>
										</tr></tbody></table>
									</td>
								</tr>
								<?php
								if(isset($uni_data['univ_overview']) && $uni_data['univ_overview'] != '')
								{
								?>
								<tr>
									<td style="padding:0in 12.75pt 0in 12.75pt;display:inline-block">
										<p style="margin-right:0in;margin-bottom:3.75pt;margin-left:1.5pt"><span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#464646">
										<span ><strong>Overview</strong></span></p>
									</td>
								</tr>
								<tr>
									<td style="padding:0in 12.75pt 0in 12.75pt;display:inline-block">
										<p style="margin-right:0in;margin-bottom:3.75pt;margin-left:1.5pt"><span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#464646">
										<span > <?php echo substr($uni_data['univ_overview'],0,300);?>.... </span>
										</p>
										<div style="text-align:right"><a style="text-decoration:none" href="http://<?php echo trim($uni_data['subdomain_name']);?>.meetuniv.com/about">view more..</a></div>
										<br/>
									</td>
								</tr>
								<?php
								}
								?>
								<?php
								$main = array();
								$x = 0;								
								if($uni_data['univ_interstudents']!='' || $uni_data['univ_slife']!='' || $uni_data['univ_faculties']!='' || $uni_data['univ_alumni']!='')
								{
									$fileNameArr = array( 
										"univ_interstudents" =>$uni_data['univ_interstudents'],
										"univ_slife" =>$uni_data['univ_slife'],
										"univ_faculties" =>$uni_data['univ_faculties'],
										"univ_alumni" =>$uni_data['univ_alumni']
										);
									foreach($fileNameArr as $key => $fileName)
									{
										if(!empty($fileName))
										{
											$main[$key] = $fileName;
											$x++;
											if($x == 2) break;
										}
									}
								?>
								<tr>
								<td style="padding:0in 12.75pt 0in 12.75pt;display:inline-block">
									<table width="100%" border="1" cellspacing="0" cellpadding="0" style="border:none;width:100%;0.5pt">
										<tbody>
											<tr>
											<?php
											$nameIndex='';											
											foreach($main as $key => $name)
											{
												if($key=='univ_interstudents') $nameIndex='International Students';
												if($key=='univ_slife') $nameIndex='University Student Life';
												if($key=='univ_faculties') $nameIndex='University Faculties';
												if($key=='univ_alumni') $nameIndex='University Awarded Alumni';
												
											?>
												<td align="center">
													<p style="margin-right:0in;margin-bottom:3.75pt;margin-left:1.5pt"><span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#464646">
													<span ><strong><?php echo $nameIndex;?></strong></span></p>
												</td>
											<?php
											}
											?>									
											</tr>
											<tr>
											<?php
											foreach($main as $name)
											{
											?>
												<td>
													<p style="margin-right:0in;margin-bottom:3.75pt;margin-left:1.5pt"><span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#464646">
													<span > <?php echo substr($uni_data[$key],0,300);?>.... </span>
													</p>
													<div style="text-align:right"><a style="text-decoration:none" href="http://<?php echo trim($uni_data['subdomain_name']);?>.meetuniv.com/internationalstudent-detail">view more..</a></div>
												</td>
											<?php
											}
											?>		
											</tr>
										</tbody>
									</table>
									</br>
								</td>
								</tr>
							<?php }?>
							</tbody>
						</table>
					</td>
					</tr>
				</tbody>
			</table>
			
			<table border="0" cellpadding="0" width="100%" style="width:100.0%;background:#ffead7">
			<tbody><tr>
				<td style="padding:7.5pt 12.75pt 7.5pt 12.75pt">
				<table border="0" cellspacing="0" cellpadding="0" align="left" width="320" style="width:240.0pt;margin-top:1.5pt">
				<tbody><tr>
				<td style="padding:0in 0in 0in 0in">
				<h5 style="margin:0in;margin-bottom:.0001pt"><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#464646">Meet Universities
				please contact: <u></u><u></u></span></h5>
				<span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#464646"><a href="mailto:info@meetuniversities.com" target="_blank">info@meetuniversities.com</a><br>
				<!-- <span>+919891006366</span>--><span dir="ltr" tabindex="-1"></span><u></u><u></u></span></p>
				<p><span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#464646"><u></u><u></u></span></p>
				</td>
				</tr>
				</tbody></table>
    
				</td>
				</tr>
			</tbody></table>
	</td>
 </tr>
</tbody></table>

</div>
</body>
</html>