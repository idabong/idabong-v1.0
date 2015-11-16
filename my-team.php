<?php $title = 'idabong.com'; include 'includes/header.php';?>

	<div id="content">
			
			<div class="row"> <!-- MAIN ROW -->
					<!-- Left Collumn -->
					<div class="col-sm-3">

					</div><!--end .col-sm-3 left collumn -->

					<div class="col-sm-6"><!-- MAIN COLLUMN-->

						<div class="panel panel-success"><!--Team Avatar Form-->
							<div class="panel-heading"><strong><span class="glyphicon glyphicon-picture"></span> Hình đại diện đội bóng</strong></div>
							<div class="panel-body">
								    <form>
										<div class="form-group">
											<div class="media">
												<div class="media-left">
													<a href="#">
								      					<img src="uploads/images/team-avatar-2.png" alt="team avatar">
								    				</a>
												</div>
												<div class="media-body">
													<input type="file" id="teamAvatar">
									    			<p class="help-block">Chọn hình định dạng jpg/png, dung lượng không quá 512kb.</p>
												</div>
											</div>
										</div>

									  	 <div class="form-group"><a href="#" target="_blank" class="btn btn-success btn-block">Cập Nhật</a></div>
									</form>   
							</div><!-- End . panel-body -->
						</div><!--END Team Avatar Form-->

						<div class="panel panel-success"><!-- Form Team infos-->
							<div class="panel-heading"><strong><span class="glyphicon glyphicon-info-sign"></span> Thông tin đội bóng</strong></div>
							<div class="panel-body">
								<form>
									<div class="form-group">
									    <label>Đánh Giá</label>
									    <div>
									    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
									    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
									    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
									    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
									    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
										</div>
									</div>

									<div class="form-group">
									    <label for="teamName">Tên đội bóng</label>
									    <input type="text" name="teamName" class="form-control" id="teamName" size="20" maxlength="80" tabindex="1" placeholder="XYZ FC">
								    </div>
									 
									<div class="form-group">
									    <label for="type">Thể thức</label>
									    <div>
									    	<select name="type" class="form-control">
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

									<div class="form-group">
										<label for="province">Tỉnh/Thành Phố</label>
										<div>
											<select class="form-control" name="province" tabindex="6">
													<option value="HoChiMinh" selected="selected">TP Hồ Chí Minh</option>
													<option value="HaNoi">Hà Nội</option>
													<option value="AnGiang">An Giang</option>
													<option value="BaRiaVungTau">Bà Rịa-Vũng Tàu</option>
													<option value="BacLieu">Bạc Liêu</option>
													<option value="BacKan">Bắc Kạn</option>
													<option value="BacGiang">Bắc Giang</option>
													<option value="BacNinh">Bắc Ninh</option>
													<option value="BenTre">Bến Tre</option>
													<option value="BinhDuong">Bình Dương</option>
													<option value="BinhDinh">Bình Định</option>
													<option value="BinhPhuoc">Bình Phước</option>
													<option value="BinhThuan">Bình Thuận</option>
													<option value="CaMau">Cà Mau</option>
													<option value="CaoBang">Cao Bằng</option>
													<option value="CanTho">Cần Thơ</option>
													<option value="DaNang">Đà Nẵng</option>
													<option value="DakLak">Đắk Lắk</option>
													<option value="DakNong">Đắk Nông</option>
													<option value="DongNai">Đồng Nai</option>
													<option value="DongThap">Đồng Tháp</option>
													<option value="DienBien">Điện Biên</option>
													<option value="GiaLai">Gia Lai</option>
													<option value="HaGiang">Hà Giang</option>
													<option value="HaNam">Hà Nam</option>
													<option value="HaTinh">Hà Tĩnh</option>
													<option value="HaiDuong">Hải Dương</option>
													<option value="HaiPhong">Hải Phòng</option>
													<option value="HoaBinh">Hòa Bình</option>
													<option value="HauGiang">Hậu Giang</option>
													<option value="HungYen">Hưng Yên</option>
													<option value="KhanhHoa">Khánh Hòa</option>
													<option value="KienGiang">Kiên Giang</option>
													<option value="KomTum">Kom Tum</option>
													<option value="LaiChau">Lai Châu</option>
													<option value="LaoCai">Lào Cai</option>
													<option value="LangSon">Lạng Sơn</option>
													<option value="LamDong">Lâm Đồng</option>
													<option value="LongAn">Long An</option>
													<option value="NamDinh">Nam Định</option>
													<option value="NgheAn">Nghệ An</option>
													<option value="NinhBinh">Ninh Bình</option>
													<option value="NinhThuan">Ninh Thuận</option>
													<option value="PhuTho">Phú Thọ</option>
													<option value="PhuYen">Phú Yên</option>
													<option value="QuangBinh">Quảng Bình</option>
													<option value="QuangNam">Quảng Nam</option>
													<option value="QuangNgai">Quảng Ngãi</option>
													<option value="QuangNinh">Quảng Ninh</option>
													<option value="QuangTri">Quảng Trị</option>
													<option value="SocTrang">Sóc Trăng</option>
													<option value="SonLa">Sơn La</option>
													<option value="TayNinh">Tây Ninh</option>
													<option value="ThaiBinh">Thái Bình</option>
													<option value="ThaiNguyen">Thái Nguyên</option>
													<option value="ThanhHoa">Thanh Hóa</option>
													<option value="ThuaThienHue">Thừa Thiên-Huế</option>
													<option value="TienGiang">Tiền Giang</option>
													<option value="TraVinh">Trà Vinh</option>
													<option value="TuyenQuang">Tuyên Quang</option>
													<option value="VinhLong">Vĩnh Long</option>
													<option value="VinhPhuc">Vĩnh Phúc</option>
													<option value="YenBai">Yên Bái</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="area">Khu vực</label>
										<div>
											<select name="area" class="form-control" tabindex="7">
												<option value="Q1" selected="selected">Quận 1</option>
												<option value="Q2">Quận 2</option>
												<option value="Q3">Quận 3</option>
												<option value="Q4">Quận 4</option>
												<option value="Q5">Quận 5</option>
												<option value="Q6">Quận 6</option>
												<option value="Q7">Quận 7</option>
												<option value="Q8">Quận 8</option>
												<option value="Q9">Quận 9</option>
												<option value="Q10">Quận 10</option>
												<option value="Q11">Quận 11</option>
												<option value="Q12">Quận 12</option>
												<option value="ThuDuc">Q.Thủ Đức</option>
												<option value="TanPhu">Q.Tân Phú</option>
												<option value="TanBinh">Q.Tân Bình</option>
												<option value="PhuNhuan">Q.Phú Nhuận</option>
												<option value="GoVap">Q.Gò Vấp</option>
												<option value="BinhThanh" selected="selected">Q.Bình Thạnh</option>
												<option value="BinhTan">Q.Bình Tân</option>
												<option value="BinhChanh">Huyện Bình Chánh</option>
												<option value="CanGio">Huyện Cần Giờ</option>
												<option value="CuChi">Huyện Củ Chi</option>
												<option value="HocMon">Huyện Hóc Môn</option>
												<option value="NhaBe">Huyện Nhà Bè</option>
											</select>
										</div>
										
										<button type="button" class="btn btn-success" tabindex="8">Thêm</button>
									</div>

									<div class="form-group">
									    <label for="teamName">Tên người liên hệ</label>
									    <input type="text" name="contactName" id="contactName" class="form-control" size="20" maxlength="80" tabindex="1" placeholder="Tên của bạn">
								    </div>

								    <div class="form-group">
									    <label for="teamName">Điện thoại di động</label>
									    <input type="tel" name="tel" id="tel" class="form-control" size="20" maxlength="80" tabindex="1" placeholder="012-3456-789">
								    </div>

									<a href="#" target="_blank" class="btn btn-success btn-block">Cập Nhật</a>
								</form>

							</div><!-- End . panel-body -->
						</div><!--END Form Team infos-->
						
						<div class="panel panel-success"><!-- Form Team fixtures-->
							<div class="panel-heading"><strong><span class="glyphicon glyphicon-calendar"></span> Lịch thi đấu cố định hàng tuần</strong></div>
							<div class="panel-body table-responsive">
								<table class="table">
									<tr>
										<th>Ngày</th>
										<th>Thời gian</th>
										<th>Sân thi đấu</th>
									</tr>

									<tr>
										<td>Thứ 3</td>
										<td>19h00-20h30</td>
										<td>Sân 367</td>
									</tr>
									
									<tr>
										<td>Thứ 7</td>
										<td>19h00-20h30</td>
										<td>Sân A41</td>
									</tr>
								</table>
								<a href="#" target="_blank" class="btn btn-success btn-block">Cập Nhật</a>
							</div><!-- End . panel-body -->
						</div><!--END Form Team fixtures-->
					
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