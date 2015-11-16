<?php
	include 'includes/header.php';
?>
	<div id="content">
			
			<div class="row"> <!-- MAIN ROW -->
					<!-- Left Collumn -->
					<div class="col-sm-3">

					</div><!--end .col-sm-3 left collumn -->

					<div class="col-sm-6"><!-- MAIN COLLUMN-->

						<div class="panel panel-success"><!-- Form Transactions-->
							<div class="panel-heading"><strong><span class="glyphicon glyphicon-fire"></span> Cáp kèo</strong></div>
							<div class="panel-body">
								<form>
									 
									<div class="input-group form-group">
									   <span class="input-group-addon">Thể thức</span>
									    <div>
									    	<select class="form-control">
										    	<option value="5" selected="selected">5 người</option>
										    	<option value="6">6 người</option>
										    	<option value="7">7 người</option>
										    	<option value="8">8 người</option>
										    	<option value="9">9 người</option>
										    	<option value="10">10 người</option>
										    	<option value="11">11 người</option>
									   		 </select>
									    </div>									    
									</div>

									<div class="input-group form-group">
										<span class="input-group-addon">Ngày</span>
										<input class="form-control" type="date" name="date" id="date" size="20" maxlength="80" tabindex="1">
									</div>

									<div class="input-group form-group">
										<span class="input-group-addon">Giờ bắt đầu</span>
										<input class="form-control" type="time" name="start_time" id="start_stime" size="20" maxlength="80" tabindex="2">
									</div>

									<div class="input-group form-group">
										<span class="input-group-addon">Giờ kết thúc</span>
										<input class="form-control" type="time" name="end_time" id="end_stime" size="20" maxlength="80" tabindex="3">
									</div>

									<div class="input-group form-group">
									    <span class="input-group-addon">Sân thi đấu</span>
									    <input class="form-control" type="text" name="contactName" id="contactName" class="form-control" size="20" maxlength="80" tabindex="1" placeholder="Tên Sân">
								    </div>

								    <div class="input-group form-group">
									    <span class="input-group-addon">Địa chỉ sân</span>
									    <input class="form-control" type="text" name="contactName" id="contactName" class="form-control" size="20" maxlength="80" tabindex="1" placeholder="Số 00 Đường ABC Tỉnh/TP XYZ">
								    </div>

								    <div class="input-group form-group">
									    <span class="input-group-addon">Tên người liên hệ</span>
									    <input class="form-control" type="text" name="contactName" id="contactName" class="form-control" size="20" maxlength="80" tabindex="1" placeholder="Tên của bạn">
								    </div>

								    <div class="input-group form-group">
									    <span class="input-group-addon">Điện thoại di động</span>
									    <input class="form-control" type="tel" name="tel" id="tel" class="form-control" size="20" maxlength="80" tabindex="1" placeholder="012-3456-789">
								    </div>

									<a href="#" target="_blank" class="btn btn-success btn-block">Loan Tin</a>
								</form>

							</div><!-- End . panel-body -->
						</div><!--END Form Transactions-->

						<!-- REQUEST#1 -->
						<div class="panel panel-success">
							<div class="panel-heading"><strong><span class="glyphicon glyphicon-flash"></span> Yêu cầu thi đấu #1</strong></div>
								<div class="panel-body">
									
									<div class="media">
										<div class="media-left">
										    <a href="#">
										    	<img src="uploads/images/team-avatar.png" alt="team avatar">
										    </a>
									 	</div>

										<div class="media-body">
										    <h4 class="media-heading text-success"><strong>Competitor #1</strong></h4>
										    <div>
										    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
										    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
										    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
										    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
										    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
										    </div>
										</div>
									</div><!--end div.media-->

									<p class="text" ><strong>Thể thức</strong>: 5 người</p>
									<p class="text"><strong>Ngày</strong>:  <span class="text-danger">dd/mm/yyyy - Day of Week</span> 
									<p class="text"><strong>Giờ</strong>: <span class="text-danger">17h30</span> đến <span class="text-danger">19h00</span></p>
									<p class="text"><strong>Sân Thi Đấu</strong>: Cảng Dầu Khí</p>
									<p class="text"><strong>Địa chỉ</strong>: Số 00 Đường 30/4 TP Vũng Tàu</p>
									<p class="text"><strong>Liên Hệ</strong>: 0000000000 - <span>Mananger's Name</span></p>

									<!-- Button for sending request -->
									<a href="#" target="_blank" class="btn btn-warning btn-block">Chấp Nhận</a>
								</div>
								
							</div><!--end REQUEST#1-->

							<!-- REQUEST#2 -->
							<div class="panel panel-success">
							<div class="panel-heading"><strong><span class="glyphicon glyphicon-flash"></span> Yêu cầu thi đấu #2</strong></div>
									<div class="panel-body">
										
										<div class="media">
											<div class="media-left">
											    <a href="#">
											    	<img src="uploads/images/team-avatar-4.png" alt="team avatar">
											    </a>
										 	</div>

											<div class="media-body">
											    <h4 class="media-heading text-success"><strong>Competitor #2</strong></h4>
											    <div>
											    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
											    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
											    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
											    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
											    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
											    </div>
											</div>
										</div><!--end div.media-->

										<p class="text" ><strong>Thể thức</strong>: 7 người</p>
										<p class="text"><strong>Ngày</strong>:  <span class="text-danger">dd/mm/yyyy - Day of Week</span> 
										<p class="text"><strong>Giờ</strong>: <span class="text-danger">17h30</span> đến <span class="text-danger">19h00</span></p>
										<p class="text"><strong>Sân Thi Đấu</strong>: Cảng Dầu Khí</p>
										<p class="text"><strong>Địa chỉ</strong>: Số 00 Đường 30/4 TP Vũng Tàu</p>
										<p class="text"><strong>Liên Hệ</strong>: 0000000000 - <span>Mananger's Name</span></p>

										<!-- Button for sending request -->
										<a href="#" target="_blank" class="btn btn-warning btn-block">Chấp Nhận</a>
									</div>
								</div><!--end REQUEST#2-->

					</div> <!--end MAIN COLLUMN -->
						
					<!-- right collumn -->
					<div class="col-sm-3">
						
					</div><!--end .col-sm-3 right collumn -->
			</div><!-- end MAIN ROW -->

		</div><!--END #content-->
			
<?php include 'includes/footer.php';?>

<!--******** Additional Scrip ********-->
<!-- Vietnamese reCaptcha by Google-->
<script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>

<!-- Custom JS -->
<script language="javascript" type="text/javascript" src="js/validate-forms.js"></script>

</body>

</html>